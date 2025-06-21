<?php
// app/Http/Controllers/ProductoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource with advanced filtering
     */
    public function index(Request $request)
    {
        $query = DB::table('productos')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id_categoria')
            ->select(
                'productos.id_producto',
                'productos.nombre',
                'productos.marca',
                'productos.precio',
                'productos.stock',
                'productos.created_at',
                'categorias.descripcion as categoria_descripcion',
                'categorias.id_categoria'
            )
            ->where('productos.estado', 1);

        // Búsqueda avanzada
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('productos.nombre', 'LIKE', "%{$search}%")
                  ->orWhere('productos.marca', 'LIKE', "%{$search}%")
                  ->orWhere('categorias.descripcion', 'LIKE', "%{$search}%");
            });
        }

        // Filtro por categoría
        if ($request->has('categoria') && !empty($request->categoria)) {
            $query->where('productos.id_categoria', $request->categoria);
        }

        // Ordenamiento dinámico
        $orderBy = $request->get('order_by', 'nombre');
        $orderDirection = $request->get('order_direction', 'asc');
        
        $orderFields = [
            'nombre' => 'productos.nombre',
            'marca' => 'productos.marca',
            'precio' => 'productos.precio',
            'stock' => 'productos.stock',
            'created_at' => 'productos.created_at'
        ];
        
        $orderField = $orderFields[$orderBy] ?? 'productos.nombre';
        $query->orderBy($orderField, $orderDirection);

        // Obtener resultados
        $productosRaw = $query->paginate(10)->withQueryString();

        // Convertir cada producto para que tenga objetos Carbon y categoría
        $productos = $productosRaw->through(function ($producto) {
            return (object) [
                'id_producto' => $producto->id_producto,
                'nombre' => $producto->nombre,
                'marca' => $producto->marca,
                'precio' => $producto->precio,
                'stock' => $producto->stock,
                'created_at' => $producto->created_at ? Carbon::parse($producto->created_at) : null,
                'categoria' => (object) [
                    'descripcion' => $producto->categoria_descripcion
                ]
            ];
        });

        // Obtener categorías para el filtro
        $categorias = DB::table('categorias')
            ->where('estado', 1)
            ->orderBy('descripcion')
            ->get();

        return view('productos.index', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        $categorias = DB::table('categorias')
            ->select('id_categoria', 'descripcion')
            ->where('estado', 1)
            ->orderBy('descripcion')
            ->get();
        
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:100',
            'marca' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'descripcion' => 'nullable|string|max:500'
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'El precio debe ser un número válido',
            'stock.required' => 'El stock es obligatorio',
            'stock.integer' => 'El stock debe ser un número entero',
            'id_categoria.required' => 'Debe seleccionar una categoría',
            'id_categoria.exists' => 'La categoría seleccionada no es válida'
        ]);

        DB::table('productos')->insert([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'id_categoria' => $request->id_categoria,
            'descripcion' => $request->descripcion,
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->route('productos.index')
                        ->with('success', 'ELEMENTO INICIALIZADO EXITOSAMENTE EN EL SISTEMA NEXUS');
    }

    /**
     * Display the specified resource
     */
    public function show($id)
    {
        $producto = DB::table('productos')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id_categoria')
            ->select(
                'productos.*',
                'categorias.descripcion as categoria_descripcion'
            )
            ->where('productos.id_producto', $id)
            ->where('productos.estado', 1)
            ->first();

        if (!$producto) {
            abort(404, 'Elemento no encontrado en el sistema NEXUS');
        }

        // Crear objeto similar a Eloquent para compatibilidad con las vistas
        $producto = (object) [
            'id_producto' => $producto->id_producto,
            'nombre' => $producto->nombre,
            'marca' => $producto->marca,
            'precio' => $producto->precio,
            'stock' => $producto->stock,
            'descripcion' => $producto->descripcion,
            'created_at' => $producto->created_at ? Carbon::parse($producto->created_at) : null,
            'updated_at' => $producto->updated_at ? Carbon::parse($producto->updated_at) : null,
            'categoria' => (object) [
                'descripcion' => $producto->categoria_descripcion
            ]
        ];
        
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit($id)
    {
        $producto = DB::table('productos')
            ->where('id_producto', $id)
            ->where('estado', 1)
            ->first();

        if (!$producto) {
            abort(404, 'Elemento no encontrado en el sistema NEXUS');
        }
        
        $categorias = DB::table('categorias')
            ->select('id_categoria', 'descripcion')
            ->where('estado', 1)
            ->orderBy('descripcion')
            ->get();
        
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:100',
            'marca' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'descripcion' => 'nullable|string|max:500'
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'El precio debe ser un número válido',
            'stock.required' => 'El stock es obligatorio',
            'stock.integer' => 'El stock debe ser un número entero',
            'id_categoria.required' => 'Debe seleccionar una categoría',
            'id_categoria.exists' => 'La categoría seleccionada no es válida'
        ]);

        $updated = DB::table('productos')
            ->where('id_producto', $id)
            ->where('estado', 1)
            ->update([
                'nombre' => $request->nombre,
                'marca' => $request->marca,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'id_categoria' => $request->id_categoria,
                'descripcion' => $request->descripcion,
                'updated_at' => now()
            ]);

        if (!$updated) {
            return redirect()->route('productos.index')
                           ->with('error', 'ERROR: Elemento no encontrado en el sistema');
        }
        
        return redirect()->route('productos.index')
                        ->with('success', 'ELEMENTO ACTUALIZADO EXITOSAMENTE EN EL SISTEMA NEXUS');
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy($id)
    {
        $deleted = DB::table('productos')
            ->where('id_producto', $id)
            ->delete();

        if (!$deleted) {
            return redirect()->route('productos.index')
                           ->with('error', 'ERROR: Elemento no encontrado en el sistema');
        }
        
        return redirect()->route('productos.index')
                        ->with('success', 'ELEMENTO ELIMINADO DEL SISTEMA NEXUS');
    }

    /**
     * Método para mostrar búsqueda de productos (Query Builder legacy)
     */
    public function list()
    {
        $categorias = DB::table('categorias')
            ->select('id_categoria', 'descripcion')
            ->where('estado', 1)
            ->orderBy('descripcion')
            ->get();
        
        $productos = DB::table('productos')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id_categoria')
            ->select(
                'productos.id_producto',
                'productos.nombre',
                'productos.marca', 
                'productos.precio',
                'productos.stock',
                'categorias.descripcion as categoria'
            )
            ->where('productos.estado', 1)
            ->orderBy('productos.nombre', 'asc')
            ->get();
        
        return view('productos.search', compact('categorias', 'productos'));
    }

    /**
     * Método para buscar productos por categoría (Query Builder legacy)
     */
    public function search(Request $request)
    {
        $categorias = DB::table('categorias')
            ->select('id_categoria', 'descripcion')
            ->where('estado', 1)
            ->orderBy('descripcion')
            ->get();
        
        $productos = DB::table('productos')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id_categoria')
            ->select(
                'productos.id_producto',
                'productos.nombre',
                'productos.marca',
                'productos.precio',
                'productos.stock',
                'categorias.descripcion as categoria'
            )
            ->where('productos.id_categoria', $request->categoria)
            ->where('productos.estado', 1)
            ->orderBy('productos.nombre', 'asc')
            ->get();
        
        return view('productos.search', compact('categorias', 'productos'));
    }
}
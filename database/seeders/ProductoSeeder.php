<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categoria::all();
        $contador = 0;
        
        foreach ($categorias as $cat) {
            $cantidad_productos = mt_rand(1, 10);
            
            for ($i = 1; $i <= $cantidad_productos; $i++) {
                $contador++;
                Producto::create([
                    'nombre' => "Producto $contador",
                    'marca' => 'Marca ' . Str::random(10),
                    'precio' => mt_rand(1, 500),
                    'stock' => mt_rand(1, 10),
                    'id_categoria' => $cat->id_categoria
                ]);
            }
        }
    }
}
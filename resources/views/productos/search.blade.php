@extends('layouts.layout')

@section('contenido')
<h2>Consulta de Productos por Categoría</h2>

<form action="{{ route('productos.search') }}" method="POST" style="margin-bottom: 30px;">
    @csrf
    <div class="form-group">
        <label for="categoria">Seleccione una categoría:</label>
        <select name="categoria" id="categoria" required>
            <option value="">[- SELECCIONE UNA CATEGORÍA -]</option>
            @foreach ($categorias as $item)
                <option value="{{ $item->id_categoria }}">{{ $item->descripcion }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Buscar Productos</button>
</form>

@if(isset($productos) && count($productos) > 0)
    <h3>Resultados de la búsqueda:</h3>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $item)
            <tr>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->categoria }}</td>
                <td>{{ $item->marca }}</td>
                <td>${{ number_format($item->precio, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@elseif(request()->isMethod('post'))
    <div style="text-align: center; margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
        <p style="color: #666;">No se encontraron productos para la categoría seleccionada.</p>
    </div>
@endif
@endsection
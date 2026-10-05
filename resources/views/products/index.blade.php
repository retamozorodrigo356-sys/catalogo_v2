@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Catálogo de Productos V2</h1>

    <!-- Mensajes de sesión (Manejo de errores) -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">{{ session('error') }}</div>
    @endif

    <!-- Filtros y Búsqueda -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-6 flex gap-4">
        <input type="text" name="search" placeholder="Buscar producto..." value="{{ request('search') }}" class="border p-2 rounded w-1/3">
        <select name="category" class="border p-2 rounded">
            <option value="">Todas las categorías</option>
            <option value="Electrónica" {{ request('category') == 'Electrónica' ? 'selected' : '' }}>Electrónica</option>
            <option value="Ropa" {{ request('category') == 'Ropa' ? 'selected' : '' }}>Ropa</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
        <a href="{{ route('products.create') }}" class="bg-green-500 text-white px-4 py-2 rounded ml-auto">+ Nuevo Producto</a>
    </form>

    <!-- Tabla de Productos -->
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Nombre</th>
                    <th class="p-3">Categoría</th>
                    <th class="p-3">Precio</th>
                    <th class="p-3">Stock</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-b">
                    <!-- Blade escapa automáticamente (Previene XSS) -->
                    <td class="p-3">{{ $product->name }}</td>
                    <td class="p-3">{{ $product->category }}</td>
                    <td class="p-3">${{ number_format($product->price, 2) }}</td>
                    <td class="p-3">{{ $product->stock }}</td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('products.edit', $product) }}" class="text-blue-500">Editar</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection

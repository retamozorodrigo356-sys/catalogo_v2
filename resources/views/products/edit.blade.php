@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Editar Producto: {{ $product->name }}</h1>

    <!-- El action apunta a la ruta update, pasando el ID del producto -->
    <form action="{{ route('products.update', $product) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <!-- ¡Muy importante! Los formularios HTML solo soportan GET y POST.
             Para hacer un PUT (actualizar), Laravel usa esta directiva: -->
        @method('PUT')

        <div class="mb-4">
            <label>Nombre:</label>
            <!-- value="{{ old('name', $product->name) }}" mantiene el dato si hay error de validación -->
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="border p-2 w-full" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label>Descripción:</label>
            <textarea name="description" class="border p-2 w-full">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label>Precio:</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="border p-2 w-full" required>
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label>Stock:</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="border p-2 w-full" required>
            @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label>Categoría:</label>
            <select name="category" class="border p-2 w-full" required>
                <option value="Electrónica" {{ old('category', $product->category) == 'Electrónica' ? 'selected' : '' }}>Electrónica</option>
                <option value="Ropa" {{ old('category', $product->category) == 'Ropa' ? 'selected' : '' }}>Ropa</option>
                <option value="Alimentos" {{ old('category', $product->category) == 'Alimentos' ? 'selected' : '' }}>Alimentos</option>
            </select>
            @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar Producto</button>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
        </div>
    </form>
@endsection

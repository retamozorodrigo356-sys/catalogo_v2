@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Nuevo Producto</h1>
    <form action="{{ route('products.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label>Nombre:</label>
            <input type="text" name="name" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Descripción:</label>
            <textarea name="description" class="border p-2 w-full"></textarea>
        </div>
        <div class="mb-4">
            <label>Precio:</label>
            <input type="number" step="0.01" name="price" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Stock:</label>
            <input type="number" name="stock" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Categoría:</label>
            <select name="category" class="border p-2 w-full" required>
                <option value="Electrónica">Electrónica</option>
                <option value="Ropa">Ropa</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
    </form>
@endsection

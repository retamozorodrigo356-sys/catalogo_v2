<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('products.index', compact('products'));
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category' => 'required|string',
    ]);

    try {
        DB::beginTransaction(); // Iniciamos transacción

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
        ]);

        DB::commit(); // Confirmamos cambios (Commit)

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');

    } catch (Exception $e) {
        DB::rollBack(); // Deshacemos todo si hay error (Rollback)
        return redirect()->back()->with('error', 'Error al crear el producto: ' . $e->getMessage());
    }
}
public function create()
    {
        // Simplemente retornamos la vista que contiene el formulario
        return view('products.create');
    }
    public function edit(Product $product)
    {
        // Laravel usa "Route Model Binding".
        // Al poner (Product $product), Laravel busca automáticamente el producto por su ID.
        // Luego se lo pasamos a la vista usando compact()
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category' => 'required|string',
    ]);

    $product->update($request->all());
    return redirect()->route('products.index')->with('success', 'Producto actualizado.');
}
public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Producto eliminado.');
}
}

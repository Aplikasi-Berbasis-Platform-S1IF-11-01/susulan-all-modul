<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(): View
    {
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'stock'       => 'required|numeric|min:0|integer',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ], [
            'name.required'  => 'Nama produk wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.numeric'  => 'Stok harus berupa angka.',
            'stock.min'      => 'Stok tidak boleh negatif.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric'  => 'Harga harus berupa angka.',
            'price.min'      => 'Harga tidak boleh negatif.',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'stock'       => 'required|numeric|min:0|integer',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ], [
            'name.required'  => 'Nama produk wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.numeric'  => 'Stok harus berupa angka.',
            'stock.min'      => 'Stok tidak boleh negatif.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric'  => 'Harga harus berupa angka.',
            'price.min'      => 'Harga tidak boleh negatif.',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk "' . $name . '" berhasil dihapus!');
    }
}

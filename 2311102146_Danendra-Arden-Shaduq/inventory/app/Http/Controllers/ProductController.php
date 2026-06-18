<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisialisasi Query dari model Product
        $query = Product::query();

        // 2. Logika Search: Jika ada input 'search', tambahkan filter
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where('nama_produk', 'like', "%{$searchTerm}%")
                  ->orWhere('kode_barang', 'like', "%{$searchTerm}%");
        }

        // 3. Eksekusi query dengan pagination
        // .appends(request()->query()) penting agar parameter pencarian 
        // tetap terbawa meskipun kamu pindah ke halaman pagination berikutnya
        $products = $query->latest()->paginate(10)->appends($request->query());

        // 4. Statistik (Tetap menggunakan total keseluruhan agar akurat)
        $totalSkus = Product::count();
        $lowStock = Product::where('stok', '<', 10)->count();
        $inventoryValue = Product::sum(\DB::raw('stok * harga'));

        return view('products.index', compact('products', 'totalSkus', 'lowStock', 'inventoryValue'));
    }

    public function create()
    {
        $generatedSku = 'SKU-' . date('Y') . '-' . strtoupper(Str::random(3));
        return view('products.form', compact('generatedSku'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|unique:products',
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
        ]);

        Product::create($validatedData);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
        ]);

        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
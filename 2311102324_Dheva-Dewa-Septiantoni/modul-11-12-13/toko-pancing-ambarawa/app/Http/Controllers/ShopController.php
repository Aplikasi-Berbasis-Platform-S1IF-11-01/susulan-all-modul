<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Hanya menampilkan produk pancing yang stoknya di atas 0
        $query = Product::where('stock', '>', 0);

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->latest()->paginate(12);
        return view('shop.index', compact('products'));
    }

    public function buy(Product $product)
    {
        if ($product->stock > 0) {
            $product->decrement('stock');
            return back()->with('success', "Transaksi Berhasil! Anda membeli {$product->name}. Siap untuk pergi memancing!");
        }

        return back()->with('error', 'Stok perlengkapan pancing ini sudah habis terjual!');
    }
}
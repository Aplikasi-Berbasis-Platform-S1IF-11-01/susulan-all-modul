<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil metrik data untuk ringkasan di halaman dashboard admin
        $totalProduk = Product::count();
        $totalStok = Product::sum('stock');
        $stokMenipis = Product::where('stock', '<=', 5)->where('stock', '>', 0)->count();
        $kategori = Product::distinct('category')->count('category');

        // Mengambil 5 produk terbaru yang baru dimasukkan ke gudang
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProduk', 'totalStok', 'stokMenipis', 'kategori', 'recentProducts'));
    }
}
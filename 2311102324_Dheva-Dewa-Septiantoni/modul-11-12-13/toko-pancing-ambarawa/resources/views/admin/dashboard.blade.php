@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-slate-100 overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-xl z-20">
        <div class="p-6 border-b border-slate-800">
            <h2 class="text-xl font-bold tracking-wide flex items-center gap-2">
                <i class="fas fa-fish text-sky-500"></i>
                <span>Hook & Line</span>
            </h2>
            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider font-semibold">Admin Panel</p>
        </div>

        <div class="flex-1 py-4">
            <div class="px-6 text-xs font-semibold text-slate-500 mb-2 uppercase">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-sky-600 text-white font-medium transition-all">
                <i class="fas fa-chart-pie w-5 mr-2"></i> Dashboard
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center px-6 py-3 text-slate-400 hover:text-white hover:bg-slate-800 font-medium transition-all">
                <i class="fas fa-tools w-5 mr-2"></i> Kelola Toko (CRUD)
            </a>
        </div>

        <div class="p-4 bg-slate-950 border-t border-slate-800 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-sky-600 flex items-center justify-center font-bold text-sm">
                    A
                </div>
                <div>
                    <p class="text-sm font-bold truncate w-24">Owner Store</p>
                    <p class="text-[10px] text-gray-400">Main Admin</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-white transition-colors" title="Keluar Dermaga">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto p-8">
        <div class="mb-8 border-b border-slate-200 pb-4">
            <h1 class="text-3xl font-extrabold text-slate-800">Dashboard Statistik</h1>
            <p class="text-sm text-slate-500 mt-1">Ikhtisar operasional dan kondisi inventaris alat pancing saat ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Varian</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalProduk }}</h3>
                    <p class="text-[11px] text-slate-500 mt-1">Model alat pancing</p>
                </div>
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Stok</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ number_format($totalStok, 0, ',', '.') }}</h3>
                    <p class="text-[11px] text-slate-500 mt-1">Item tersedia di gudang</p>
                </div>
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-warehouse"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Stok Menipis</p>
                    <h3 class="text-3xl font-extrabold text-rose-600 mt-1">{{ $stokMenipis }}</h3>
                    <p class="text-[11px] text-rose-500 mt-1">Segera lakukan restock</p>
                </div>
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Kategori</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $kategori }}</h3>
                    <p class="text-[11px] text-slate-500 mt-1">Kelompok perlengkapan</p>
                </div>
                <div class="w-12 h-12 bg-sky-50 text-sky-600 rounded-xl flex items-center justify-center text-xl">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 max-w-4xl">
            <div class="flex justify-between items-center mb-4 border-b pb-3">
                <h3 class="text-lg font-bold text-slate-800"><i class="fas fa-history mr-2 text-sky-600"></i>Alat Pancing Baru Masuk</h3>
                <a href="{{ route('products.index') }}" class="text-xs font-bold text-sky-600 hover:underline">Kelola Semua <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentProducts as $rp)
                <div class="flex justify-between items-center py-3.5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500"><i class="fas fa-anchor text-sm"></i></div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">{{ $rp->name }}</p>
                            <span class="text-[10px] bg-slate-100 border px-2 py-0.5 rounded text-slate-600 font-medium">{{ $rp->category }}</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($rp->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400">Stok: {{ $rp->stock }} unit</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-slate-500 text-center py-4">Belum ada pasokan data alat pancing.</p>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 pb-12">
    <!-- NAVBAR PEMBELI -->
    <nav class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-sky-600 rounded-xl flex items-center justify-center text-white shadow-md shadow-sky-600/20">
                        <i class="fas fa-fish text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Hook & Line <span class="text-sky-600">Tackle</span></h1>
                </div>

                <div class="flex items-center gap-6">
                    <div class="hidden md:block text-right">
                        <p class="text-xs text-slate-400 uppercase font-bold tracking-widest">Selamat Datang, Angler</p>
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 px-4 py-2.5 rounded-xl text-sm font-bold transition-all flex items-center gap-2 border border-slate-200 hover:border-rose-200">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER / HERO SECTION -->
    <div class="bg-slate-900 py-16 mb-10 relative overflow-hidden">
        <!-- Dekorasi Background -->
        <div class="absolute -right-20 -top-20 opacity-5">
            <i class="fas fa-anchor text-[300px] text-white"></i>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-4">Lengkapi Persenjataan Mancingmu!</h2>
            <p class="text-sky-200 text-lg font-medium mb-10 max-w-2xl mx-auto opacity-90">
                Temukan joran berkualitas, reel tangguh, dan umpan mematikan untuk target monster idaman Anda.
            </p>

            <!-- Fitur Pencarian -->
            <form action="{{ route('shop.index') }}" method="GET" class="max-w-2xl mx-auto flex flex-col md:flex-row gap-3">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari joran, reel, atau umpan..."
                        class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-700 bg-slate-800/50 text-white placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/50 transition-all shadow-inner">
                </div>
                <button type="submit" class="bg-sky-600 hover:bg-sky-500 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-sky-600/30 flex items-center justify-center gap-2">
                    <i class="fas fa-binoculars"></i> Cari
                </button>
            </form>
        </div>
    </div>

    <!-- AREA KATALOG PRODUK -->
    <div class="max-w-7xl mx-auto px-4">
        
        <!-- Notifikasi Pembelian -->
        @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl shadow-sm flex items-center gap-4">
                <div class="bg-emerald-500 w-10 h-10 rounded-full flex items-center justify-center text-white shrink-0 shadow-md shadow-emerald-500/20">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <h4 class="font-bold">Strike!</h4>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 p-5 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-sm flex items-center gap-4">
                <div class="bg-rose-500 w-10 h-10 rounded-full flex items-center justify-center text-white shrink-0 shadow-md shadow-rose-500/20">
                    <i class="fas fa-times"></i>
                </div>
                <div>
                    <h4 class="font-bold">Mocel!</h4>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="flex justify-between items-end mb-8 border-b border-slate-200 pb-4">
            <h3 class="text-2xl font-extrabold text-slate-800">Katalog Tersedia</h3>
            <span class="text-xs font-bold text-sky-700 bg-sky-100 px-3 py-1.5 rounded-lg border border-sky-200">
                Total: {{ $products->total() }} Item
            </span>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-dashed border-slate-300">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-4 text-3xl">
                    <i class="fas fa-box-open"></i>
                </div>
                <h4 class="text-lg font-bold text-slate-700 mb-1">Katalog Kosong</h4>
                <p class="text-sm text-slate-500">Alat pancing yang Anda cari tidak ditemukan atau stok sedang kosong.</p>
            </div>
        @else
            <!-- Grid Produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $p)
                <div class="group bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col h-full hover:-translate-y-1">
                    <!-- Area Gambar Dummy / Ikon -->
                    <div class="h-48 bg-gradient-to-br from-slate-100 to-slate-200 relative flex items-center justify-center">
                        @php
                            $icon = match($p->category) {
                                'Joran' => 'fa-water',
                                'Reel' => 'fa-dharmachakra',
                                'Senar' => 'fa-wave-square',
                                'Umpan' => 'fa-bug',
                                'Aksesoris' => 'fa-toolbox',
                                default => 'fa-box'
                            };
                        @endphp
                        <i class="fas {{ $icon }} text-7xl text-slate-300 group-hover:text-sky-300 transition-colors duration-300"></i>
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-[10px] font-bold text-sky-600 border border-sky-100 shadow-sm uppercase tracking-wider">
                            {{ $p->category }}
                        </span>
                    </div>

                    <!-- Detail Produk -->
                    <div class="p-6 flex flex-col flex-1">
                        <h4 class="font-extrabold text-slate-800 text-lg mb-1 line-clamp-1" title="{{ $p->name }}">{{ $p->name }}</h4>
                        <p class="text-slate-500 text-xs mb-5 line-clamp-2 h-8 leading-relaxed">{{ $p->description ?? 'Alat pancing berkualitas untuk menemani petualangan Anda.' }}</p>

                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-5">
                                <span class="text-xl font-black text-sky-600">Rp{{ number_format($p->price, 0, ',', '.') }}</span>
                                <span class="text-[10px] font-bold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-md border border-slate-200">
                                    Sisa: {{ $p->stock }}
                                </span>
                            </div>

                            <!-- Tombol Beli -->
                            <form action="{{ route('shop.buy', $p->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-slate-900 hover:bg-sky-600 text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-all shadow-md">
                                    <i class="fas fa-shopping-cart"></i> Masukkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <div class="mt-12">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
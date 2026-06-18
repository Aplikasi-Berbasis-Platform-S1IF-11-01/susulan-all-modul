@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-slate-100 overflow-hidden">

    <!-- SIDEBAR -->
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
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-slate-400 hover:text-white hover:bg-slate-800 font-medium transition-all">
                <i class="fas fa-chart-pie w-5 mr-2"></i> Dashboard
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center px-6 py-3 bg-sky-600 text-white font-medium transition-all">
                <i class="fas fa-tools w-5 mr-2"></i> Kelola Toko (CRUD)
            </a>
        </div>
        
        <div class="p-4 bg-slate-950 border-t border-slate-800 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-sky-600 flex items-center justify-center font-bold text-sm">A</div>
                <div>
                    <p class="text-sm font-bold truncate w-24">Owner Store</p>
                    <p class="text-[10px] text-gray-400">Main Admin</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-white transition-colors" title="Keluar"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA FORM EDIT -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto p-8">
        <div class="mb-8 border-b border-slate-200 pb-4 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800">Edit Data Alat Pancing</h1>
                <p class="text-sm text-slate-500 mt-1">Inventaris <i class="fas fa-chevron-right text-[10px] mx-1"></i> Form Edit Data</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-bold text-slate-500 hover:text-amber-500 transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-8 max-w-4xl">
            <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-100">
                <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 text-xl shadow-inner">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Koreksi Spesifikasi Barang</h2>
                    <p class="text-xs text-slate-500 mt-1">Perbarui harga, stok masuk/keluar, atau detail deskripsi barang.</p>
                </div>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf 
                @method('PUT') <!-- Wajib untuk proses Update di Laravel -->
                
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Perlengkapan <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all text-sm" required>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kategori <span class="text-rose-500">*</span></label>
                        <select name="category" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all text-sm bg-white" required>
                            <option value="Joran" {{ old('category', $product->category) == 'Joran' ? 'selected' : '' }}>Joran (Rod)</option>
                            <option value="Reel" {{ old('category', $product->category) == 'Reel' ? 'selected' : '' }}>Reel</option>
                            <option value="Senar" {{ old('category', $product->category) == 'Senar' ? 'selected' : '' }}>Senar (Line)</option>
                            <option value="Umpan" {{ old('category', $product->category) == 'Umpan' ? 'selected' : '' }}>Umpan (Lure/Bait)</option>
                            <option value="Aksesoris" {{ old('category', $product->category) == 'Aksesoris' ? 'selected' : '' }}>Aksesoris & Box</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div class="col-span-2 md:col-span-1 relative">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga Jual <span class="text-rose-500">*</span></label>
                        <div class="absolute inset-y-0 left-0 top-7 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-400 font-bold text-sm">Rp</span>
                        </div>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-slate-300 rounded-xl pl-12 pr-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all text-sm" required>
                    </div>
                    <div class="col-span-2 md:col-span-1 relative">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Sisa Stok <span class="text-rose-500">*</span></label>
                        <div class="absolute inset-y-0 right-0 top-7 pr-4 flex items-center pointer-events-none">
                            <span class="text-slate-400 font-medium text-sm">Unit</span>
                        </div>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all text-sm" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Spesifikasi / Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all text-sm resize-none">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('products.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3 rounded-xl transition-colors text-sm">Batal</a>
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-8 py-3 rounded-xl transition-all shadow-md shadow-amber-500/20 flex items-center gap-2 text-sm">
                        <i class="fas fa-check"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
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
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-slate-400 hover:text-white hover:bg-slate-800 font-medium transition-all">
                <i class="fas fa-chart-pie w-5 mr-2"></i> Dashboard
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center px-6 py-3 bg-sky-600 text-white font-medium transition-all">
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
        <div class="mb-8 border-b border-slate-200 pb-4 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800">Manajemen Produk Toko</h1>
                <p class="text-sm text-slate-500 mt-1">Lakukan manipulasi data (Tambah, Lihat, Ubah, Hapus) inventaris kail dan senar.</p>
            </div>
            <a href="{{ route('products.create') }}" class="bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold py-2.5 px-4 rounded-xl transition-all shadow-md flex items-center gap-2">
                <i class="fas fa-plus-circle"></i> Tambah Alat Pancing
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-xl shadow-sm flex items-center gap-3">
                <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6">
            
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row justify-between items-center gap-4 mb-5 text-sm w-full bg-slate-50 p-4 rounded-xl border border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="text-slate-600 font-medium">Tampilkan</span>
                    <select name="per_page" class="border border-slate-300 rounded-lg p-2 bg-white focus:outline-none focus:border-sky-500 font-semibold text-slate-700" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span class="text-slate-600 font-medium">data pancing</span>
                </div>

                <div class="flex items-center gap-2 w-full md:w-auto">
                    <span class="text-slate-600 font-medium hidden md:inline">Cari:</span>
                    <div class="relative flex items-center w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama joran/reel..." class="border border-slate-300 rounded-l-xl px-4 py-2 w-full md:w-64 focus:outline-none focus:border-sky-500">
                        <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-r-xl transition-colors border border-sky-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto rounded-xl border border-slate-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs text-slate-500 uppercase font-bold tracking-wider bg-slate-50 border-b border-slate-200">
                            <th class="py-3.5 px-4 w-12">#</th>
                            <th class="py-3.5 px-4">Detail Perlengkapan</th>
                            <th class="py-3.5 px-4 text-center">Kategori</th>
                            <th class="py-3.5 px-4">Harga Unit</th>
                            <th class="py-3.5 px-4 text-center">Stok</th>
                            <th class="py-3.5 px-4 text-center">Status Gudang</th>
                            <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700 divide-y divide-slate-100">
                        @forelse($products as $index => $p)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 text-slate-400 font-mono">{{ $products->firstItem() + $index }}</td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-slate-800 text-sm">{{ $p->name }}</div>
                                <div class="text-[11px] text-slate-400 truncate max-w-xs mt-0.5">{{ $p->description ?? 'Tidak ada spesifikasi tambahan.' }}</div>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-1 rounded-md text-xs font-semibold uppercase tracking-wider">{{ $p->category }}</span>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-800">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-4 text-center font-extrabold text-slate-800">{{ $p->stock }} <span class="text-xs font-normal text-slate-400">pcs</span></td>
                            <td class="py-3.5 px-4 text-center">
                                @if($p->stock == 0)
                                    <span class="px-2.5 py-1 text-[10px] font-bold text-rose-600 bg-rose-50 border border-rose-200 rounded-full">Habis</span>
                                @elseif($p->stock <= 5)
                                    <span class="px-2.5 py-1 text-[10px] font-bold text-amber-600 bg-amber-50 border border-amber-200 rounded-full">Kritis</span>
                                @else
                                    <span class="px-2.5 py-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-200 rounded-full">Aman</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('products.edit', $p->id) }}" class="text-amber-500 border border-amber-200 hover:bg-amber-50 p-2 rounded-lg transition-colors" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus perlengkapan pancing ini dari database toko?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-rose-500 border border-rose-200 hover:bg-rose-50 p-2 rounded-lg transition-colors" title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-slate-400 font-medium">Alat pancing yang dicari tidak ada dalam daftaran katalog gudang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5 flex flex-col md:flex-row justify-between items-center text-xs text-slate-400 gap-4">
                <div>Menampilkan {{ $products->firstItem() ?? 0 }} sampai {{ $products->lastItem() ?? 0 }} dari total {{ $products->total() }} unit perlengkapan</div>
                <div class="font-semibold">{{ $products->appends(request()->query())->links() }}</div>
            </div>
        </div>
    </main>
</div>
@endsection
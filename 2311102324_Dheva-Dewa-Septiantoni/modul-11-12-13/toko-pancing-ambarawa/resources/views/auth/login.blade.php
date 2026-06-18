@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4" style="background-color: #f0f4f8;">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden border border-gray-100">

        <div class="bg-[#1e293b] py-8 text-center text-white border-b-4 border-sky-600">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-sky-600 rounded-full mb-3 shadow-md">
                <i class="fas fa-fish text-2xl animate-pulse"></i>
            </div>
            <h1 class="text-2xl font-extrabold tracking-wide">Hook & Line Tackle</h1>
            <p class="text-sm text-gray-400 mt-1">Premium Fishing Equipment Store</p>
        </div>

        <div class="p-8">
            <h2 class="text-center text-lg font-semibold text-gray-800 mb-6">Masuk ke Ruang Angler</h2>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative mb-6 text-sm flex items-center gap-2">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Email Dermaga</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 top-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-anchor text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-sky-50/50 border border-sky-100 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition-all text-sm text-gray-800 placeholder-gray-400"
                            placeholder="angler@email.com">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 top-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-sky-50/50 border border-sky-100 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition-all text-sm text-gray-800 placeholder-gray-400"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-4 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-lg shadow-sky-600/20">
                    <i class="fas fa-sign-in-alt"></i> Masuk Sistem Shop
                </button>
            </form>

            <div class="mt-8 bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm text-gray-700">
                <div class="flex items-center gap-2 font-bold mb-3 text-slate-800 border-b border-slate-200 pb-2">
                    <i class="fas fa-info-circle text-sky-600"></i> Akun Demo Akses:
                </div>
                <div class="space-y-2.5">
                    <div class="flex items-center gap-2 justify-between">
                        <div class="flex items-center gap-2">
                            <span class="bg-[#1e293b] text-white text-[10px] px-2 py-0.5 rounded font-bold tracking-wider uppercase">Admin</span>
                            <span class="text-xs text-gray-600 font-medium">adminpancing@toko.com</span>
                        </div>
                        <span class="text-xs text-gray-400 font-mono">admin123</span>
                    </div>
                    <div class="flex items-center gap-2 justify-between">
                        <div class="flex items-center gap-2">
                            <span class="bg-sky-600 text-white text-[10px] px-2 py-0.5 rounded font-bold tracking-wider uppercase">User</span>
                            <span class="text-xs text-gray-600 font-medium">mamatpancing@gmail.com</span>
                        </div>
                        <span class="text-xs text-gray-400 font-mono">user123</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
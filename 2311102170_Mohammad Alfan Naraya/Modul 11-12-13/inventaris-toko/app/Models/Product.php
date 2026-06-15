<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional, jika nama tabel sesuai jamak dari model)
    protected $table = 'products';

    // Mendaftarkan kolom-kolom yang diizinkan untuk diisi massal lewat form
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'stok',
        'harga',
        'deskripsi'
    ];
}
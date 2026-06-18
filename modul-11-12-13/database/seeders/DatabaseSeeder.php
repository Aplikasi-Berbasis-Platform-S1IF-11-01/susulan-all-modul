<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Login Admin Cipa
        User::create([
            'name' => 'Cipa',
            'email' => 'shiva@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // Daftar Produk Toko Kucing Lengkap & Jelas
        $produkKucing = [
            [
                'nama_produk' => 'Whiskas Adult Tuna 1kg',
                'deskripsi' => 'Makanan kering lezat penuh nutrisi rasa tuna untuk kucing dewasa.',
                'stok' => 25,
                'harga' => 65000,
            ],
            [
                'nama_produk' => 'Me-O Cat Treats Salmon',
                'deskripsi' => 'Camilan cair (creamy treats) rasa salmon yang sangat disukai anabul.',
                'stok' => 40,
                'harga' => 15000,
            ],
            [
                'nama_produk' => 'Pasir Gumpal Wangi Lavender 10L',
                'deskripsi' => 'Pasir bento premium wangi lavender, cepat menggumpal dan menyerap bau.',
                'stok' => 15,
                'harga' => 55000,
            ],
            [
                'nama_produk' => 'Kandang Besi Lipat Ukuran M',
                'deskripsi' => 'Kandang besi kokoh kualitas premium, praktis dan bisa dilipat.',
                'stok' => 8,
                'harga' => 125000,
            ],
            [
                'nama_produk' => 'Mainan Tikus Bulu Bunyi',
                'deskripsi' => 'Mainan interaktif bentuk tikus bulu untuk melatih kelincahan kucing.',
                'stok' => 50,
                'harga' => 12000,
            ],
            [
                'nama_produk' => 'Shampo Kucing Anti Kutu 250ml',
                'deskripsi' => 'Shampo khusus formula lembut untuk membasmi kutu, jamur, dan melembutkan bulu.',
                'stok' => 20,
                'harga' => 35000,
            ],
            [
                'nama_produk' => 'Royal Canin Mother & Babycat 400g',
                'deskripsi' => 'Makanan khusus untuk induk kucing menyusui dan anak kucing usia 1-4 bulan.',
                'stok' => 12,
                'harga' => 78000,
            ],
            [
                'nama_produk' => 'Kalung Kucing Lonceng Pita Pink',
                'deskripsi' => 'Kalung leher imut bermotif pita pink dengan lonceng nyaring, bikin anabul makin cantik.',
                'stok' => 30,
                'harga' => 8000,
            ],
            [
                'nama_produk' => 'Sisir Grooming Tombol Otomatis',
                'deskripsi' => 'Sisir bulu rontok dengan tombol otomatis di belakang untuk memudahkan pembersihan bulu.',
                'stok' => 18,
                'harga' => 28000,
            ],
            [
                'nama_produk' => 'Kasur Kucing Lembut Bentuk Kepala Kucing',
                'deskripsi' => 'Tempat tidur super empuk dan hangat, sangat nyaman untuk tempat tidur siang anabul.',
                'stok' => 5,
                'harga' => 95000,
            ]
        ];

        // Looping untuk memasukkan data ke database
        foreach ($produkKucing as $produk) {
            Product::create($produk);
        }
    }
}
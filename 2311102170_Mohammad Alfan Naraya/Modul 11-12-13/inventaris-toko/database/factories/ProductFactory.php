<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Kumpulan data gitar realistik untuk inventaris toko
        $gitars = [
            // --- Gitar Elektrik ---
            ['nama' => 'Fender Stratocaster Player Series', 'kode' => 'GTR-EL01', 'harga' => 12500000, 'desc' => 'Gitar elektrik legendaris dengan 3 single-coil pickups, warna 3-Tone Sunburst.'],
            ['nama' => 'Gibson Les Paul Standard 60s', 'kode' => 'GTR-EL02', 'harga' => 38000000, 'desc' => 'Gitar elektrik premium dengan dual Burstbucker humbuckers, sustain luar biasa.'],
            ['nama' => 'Ibanez RG421AHM-BMT', 'kode' => 'GTR-EL03', 'harga' => 6200000, 'desc' => 'Gitar elektrik modern dengan neck super tipis Wizard III, cocok untuk musik rock/metal.'],
            ['nama' => 'PRS SE Custom 24', 'kode' => 'GTR-EL04', 'harga' => 11800000, 'desc' => 'Gitar elektrik serbaguna dengan top mapel yang indah dan playability tinggi.'],
            ['nama' => 'Epiphone Casino Archtop', 'kode' => 'GTR-EL05', 'harga' => 9500000, 'desc' => 'Gitar hollow-body klasik yang sering digunakan oleh The Beatles.'],
            ['nama' => 'Schecter Omen Extreme-6', 'kode' => 'GTR-EL06', 'harga' => 5400000, 'desc' => 'Gitar elektrik dengan pickup high-output dan tampilan quilted maple top.'],
            ['nama' => 'Squier Affinity Stratocaster', 'kode' => 'GTR-EL07', 'harga' => 3600000, 'desc' => 'Gitar elektrik entry-level terbaik dengan lisensi resmi Fender.'],
            ['nama' => 'Yamaha Pacifica PAC112V', 'kode' => 'GTR-EL08', 'harga' => 3200000, 'desc' => 'Gitar elektrik HSS pickup configuration yang sangat andal untuk pemula.'],
            
            // --- Gitar Akustik / Akustik Elektrik ---
            ['nama' => 'Taylor 214ce Rosewood SB', 'kode' => 'GTR-AK01', 'harga' => 18500000, 'desc' => 'Gitar akustik-elektrik premium Grand Auditorium dengan sistem elektronik ES2.'],
            ['nama' => 'Martin LX1E Little Martin', 'kode' => 'GTR-AK02', 'harga' => 7800000, 'desc' => 'Gitar akustik travel berukuran ringkas yang digunakan oleh Ed Sheeran.'],
            ['nama' => 'Yamaha F310 Acoustic', 'kode' => 'GTR-AK03', 'harga' => 1400000, 'desc' => 'Gitar akustik string legendaris, sejuta umat, dengan proyeksi suara jernih.'],
            ['nama' => 'Ibanez AW54CE-OPN', 'kode' => 'GTR-AK04', 'harga' => 4100000, 'desc' => 'Gitar akustik-elektrik dengan bodi full mahoni dan finishing open pore alami.'],
            ['nama' => 'Cort AD810 Acoustic', 'kode' => 'GTR-AK05', 'harga' => 1250000, 'desc' => 'Gitar akustik model Dreadnought yang sangat populer untuk latihan harian.'],
            ['nama' => 'Fender CD-60SCE', 'kode' => 'GTR-AK06', 'harga' => 4300000, 'desc' => 'Gitar akustik dengan solid spruce top dan cutaway untuk akses fret tinggi.'],
            ['nama' => 'Yamaha APX600 Thinline', 'kode' => 'GTR-AK07', 'harga' => 3100000, 'desc' => 'Gitar akustik-elektrik dengan bodi tipis yang sangat nyaman dimainkan di panggung.'],
            ['nama' => 'Taylor GS Mini Mahogany', 'kode' => 'GTR-AK08', 'harga' => 9900000, 'desc' => 'Gitar akustik berukuran mini dengan suara bass yang sangat bertenaga.'],
        ];

        // Mengambil satu data gitar secara acak dari list di atas setiap kali factory dipanggil
        $gitarAcak = $this->faker->randomElement($gitars);

        return [
            // Menambahkan angka unik acak di belakang kode agar tidak duplikat saat generate banyak data
            'kode_produk' => $gitarAcak['kode'] . '-' . $this->faker->unique()->numberBetween(10, 99),
            'nama_produk' => $gitarAcak['nama'],
            'stok'        => $this->faker->numberBetween(3, 25), // Stok toko gitar biasanya berkisar sekian
            'harga'       => $gitarAcak['harga'],
            'deskripsi'   => $gitarAcak['desc'],
        ];
    }
}
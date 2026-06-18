<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM</h1>
  <br />
  <h3>MODUL 11,12,13 <br> Laravel : CRUD Inventaris, Seeder, Factory, dan Authentication</h3>
  <br />
  <img src="assets/logo.jpeg" alt="logo" width="300">
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Mohammad Alfan Naraya</strong><br>
    <strong>2311102170</strong><br>
    <strong>S1 IF-11-01</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
  </p>
  <br />
  <br />
  <h4>Asisten Praktikum :</h4>
  <strong>Apri Pandu Wicaksono</strong> <br>
  <strong>Rangga Pradarrell Fathi</strong>
  <br />
  <br />
  <br />
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE <br> FAKULTAS INFORMATIKA <br> UNIVERSITAS TELKOM PURWOKERTO <br> 2026</h3>
</div>

---

## A. Dasar Teori

### 1. Laravel
Laravel adalah salah satu *framework* PHP yang digunakan untuk membangun aplikasi web secara terstruktur, efisien, dan mudah dikembangkan. Laravel employs the **MVC (Model-View-Controller)** architecture, which makes the application development process more efficient since program, tampilan, and data processing are done in accordance with its functions. In this practice, Laravel is used to create an inventory application with features like product data analysis, user authentication, and database integration.

### 2. Konsep MVC (*Model-View-Controller*)
MVC adalah pola perancangan aplikasi yang membagi sistem menjadi tiga bagian utama: "Model", yang mengelola data dan berhubungan dengan database, dan "View", yang menampilkan antarmuka pengguna.

Controller mengatur logika aplikasi dan berfungsi sebagai penghubung antara Model dan View.
Konsep MVC membuat pengembangan kode program untuk fitur baru lebih mudah dan lebih teratur.

### 3. CRUD (*Create, Read, Update, Delete*)
CRUD adalah empat operasi dasar dalam pengelolaan data pada aplikasi:
- **Create**, digunakan untuk menambahkan data baru.
- **Read**, digunakan untuk menampilkan atau membaca data.
- **Update**, digunakan untuk mengubah data yang sudah ada.
- **Delete**, digunakan untuk menghapus data.

Aplikasi inventaris toko menggunakan CRUD untuk mengelola data produk, yang memungkinkan pengguna menambah, melihat, mengubah, dan menghapus informasi barang.

### 4. Database dan MySQL
Database adalah kumpulan data yang disimpan secara sistematis sehingga mudah dikelola dan diakses. Database berfungsi sebagai tempat penyimpanan data penting dalam pengembangan aplikasi web, termasuk data pengguna, produk, kategori, stok, dan transaksi.  
Database yang digunakan dalam praktikum ini adalah MySQL, sistem manajemen basis data relasional yang umum digunakan bersama Laravel. MySQL mendukung penyimpanan data dalam bentuk tabel yang saling berelasi, yang membuatnya ideal untuk aplikasi inventaris.

### 5. Migration
Fitur migrasi Laravel adalah fitur yang memungkinkan pengembang untuk memastikan struktur database konsisten, terutama ketika proyek dikerjakan secara bertahap atau kolaboratif. Ini memungkinkan pembuatan, perubahan, dan penghapusan tabel secara terstruktur tanpa harus menulis perintah SQL secara manual.

### 6. Seeder dan Factory
Seder secara otomatis mengisi database dengan data awal atau data dummy, sedangkan pabrik menghasilkan banyak data tiruan dengan format yang telah ditentukan.  
Seder dan pabrik sangat membantu dalam aplikasi inventaris agar tabel tidak kosong saat aplikasi dimulai. Oleh karena itu, aplikasi dapat diuji langsung dengan data contoh tanpa harus memasukkan semua data secara manual.

### 7. Eloquent ORM
Eloquent ORM adalah fitur Laravel yang memungkinkan interaksi dengan database dengan menggunakan representasi objek atau model. Dengan Eloquent, pengembang tidak selalu perlu menulis query SQL secara langsung karena model PHP memungkinkan pengambilan, penyimpanan, pembaruan, dan penghapusan data. Pada praktikum ini, Eloquent dikelola data produk, kategori, dan pengguna pada aplikasi inventaris.

### 8. Authentication dan Session
Proses verifikasi identitas pengguna sebelum mereka dapat mengakses sistem dikenal sebagai autentikasi. Autentikasi dapat diterapkan dalam Laravel dengan menggunakan sistem login berbasis "session". Session adalah mekanisme yang menyimpan data pengguna sementara di sisi server setelah login berhasil. Hanya pengguna tertentu yang dapat mengakses halaman yang dilindungi, seperti halaman manajemen produk, setelah sesi diidentifikasi oleh sistem.

### 9. DataTables
Plugin berbasis JavaScript bernama DataTables digunakan untuk membuat tampilan tabel lebih interaktif. Pencarian, pengurutan kolom, pagination, dan pengaturan jumlah data yang ditampilkan adalah fitur yang tersedia.  
DataTables digunakan pada halaman daftar produk dalam aplikasi inventaris toko untuk membuat pencarian dan pengelolaan data barang lebih mudah.

### 10. Bootstrap
Bootstrap adalah framework CSS yang digunakan untuk mempercepat pembuatan tampilan web yang responsif dan rapi. Dengan bantuan Bootstrap, komponen antarmuka seperti tombol, form, tabel, alert, dan modal dapat dibuat dengan lebih mudah. Dalam kasus ini, Bootstrap digunakan untuk mendukung tampilan form tambah/edit produk, tabel data, serta modal konfirmasi hapus untuk membuat antarmuka aplikasi lebih menarik dan mudah digunakan.

### 11. Inventaris Barang
Data barang yang dimiliki oleh suatu toko atau organisasi dapat dicatat, dikelola, dan dipantau melalui sistem inventaris barang. Aplikasi inventaris berbasis web mencatat data seperti nama, kode, kategori, harga, stok, dan status barang. Pencatatan menggunakan aplikasi ini lebih cepat, lebih akurat, dan lebih mudah digunakan dibandingkan dengan pencatatan manual.

---

## B. Penjelasan Kode

### 1. Sourcecode routes/web.php
```php
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () { return redirect()->route('products.index'); });
    Route::resource('products', ProductController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
```

### Penjelasan

Kode rute (routing) Laravel tersebut berfungsi untuk mengatur dan membatasi hak akses halaman web berdasarkan status login pengguna menggunakan fitur middleware. Pada blok pertama yang dibungkus oleh middleware('guest'), akses hanya diberikan kepada pengguna yang belum login untuk membuka halaman form login serta memproses validasi akun saat tombol masuk ditekan.

Sementara pada blok kedua yang dibungkus oleh middleware('auth'), akses dikunci rapat khusus bagi pengguna yang sudah login, di mana pengguna yang belum login akan otomatis dihadang dan dialihkan kembali ke halaman login jika mencoba mengaksesnya. Di dalam blok aman ini, terdapat fungsi untuk mengalihkan halaman utama langsung ke daftar produk, rute Resource yang otomatis menyediakan seluruh jalur CRUD (tampil tabel DataTables, tambah, edit, dan hapus produk gitar), serta rute khusus untuk memproses aksi keluar (logout) dari aplikasi.

### 2. Sourcecode ProductController.php
```php
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'kode_produk' => 'required|unique:products',
            'nama_produk' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'kode_produk' => 'required|unique:products,kode_produk,'.$product->id,
            'nama_produk' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
```

### Penjelasan

Kode di atas merupakan sebuah Controller pada framework Laravel bernama ProductController yang berfungsi sebagai pusat logika untuk mengelola siklus data produk (CRUD) secara terintegrasi. Di dalam class ini terdapat lima fungsi (method) utama yang menjembatani interaksi antara pengguna, database melaui model Product, dan halaman tampilan web. Fungsi pertama adalah index() yang bertugas mengambil seluruh data produk dari database menggunakan ORM Eloquent, lalu mengirimkannya ke halaman utama produk untuk ditampilkan dalam bentuk tabel. Fungsi kedua, create(), bekerja sangat sederhana dengan hanya mengarahkan pengguna ke halaman form yang digunakan untuk menginput produk baru. Ketika form tersebut dikirim, fungsi ketiga yaitu store() akan mengambil alih kendali dengan melakukan validasi ketat terhadap data inputan seperti memastikan kode produk bersifat unik, stok berupa angka bulat, dan harga berupa data numerik; jika data tersebut lolos validasi, sistem akan langsung menyimpannya ke database dan mengalihkan halaman kembali ke index dengan membawa pesan sukses.

Untuk proses perubahan data, controller ini mengandalkan fungsi keempat yaitu edit() yang secara otomatis mencari detail data produk spesifik berdasarkan ID-nya melalui fitur Route Model Binding Laravel, kemudian melempar data produk tersebut ke form modifikasi. Setelah pengguna mengubah isi form dan menekannya, fungsi update() akan memproses validasi ulang—dengan pengecualian kode produk yang sedang diedit itu sendiri agar tidak dianggap duplikat—lalu memperbarui record data lama di database sebelum akhirnya mengembalikan pengguna ke halaman utama. Terakhir, fungsi destroy() bertugas mengeksekusi perintah penghapusan data produk tertentu dari database secara permanen saat tombol hapus ditekan, yang kemudian diakhiri dengan pengalihan halaman kembali ke daftar utama disertai notifikasi bahwa produk telah berhasil dihapus.

### 3. Sourcecode Product.php
```php
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
```

### Penjelasan

Kode di atas merupakan sebuah file Model bernama Product pada framework Laravel yang berfungsi sebagai representasi dan penghubung utama antara logika aplikasi dengan tabel products di dalam database menggunakan ORM (Object-Relational Mapping) Eloquent. Di dalam class yang mewarisi sifat bawaan Model ini, terdapat penggunaan trait use HasFactory yang berguna untuk kebutuhan testing atau pembuatan data acak (seeding) berbasis factory. Selain itu, properti protected $table = 'products'; digunakan untuk menegaskan secara eksplisit bahwa model ini terikat dengan tabel bernama products di database. Poin paling krusial pada kode ini terletak pada properti protected $fillable, yang bertugas mendaftarkan kolom-kolom tertentu seperti kode_produk, nama_produk, stok, harga, dan deskripsi agar diizinkan menerima pengisian data secara massal (mass assignment) dari form input aplikasi; fitur ini bertindak sebagai tameng keamanan otomatis Laravel untuk mencegah disusupinya kolom sensitif lain yang tidak terdaftar saat proses penyimpanan data berlangsung.

### 4. Sourcecode Migration (0001_01_01_000000_create_users_table.php)
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('stock');
            $table->string('unit')->default('pcs');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```
### Penjelasan

Kode di atas merupakan sebuah file Migration bawaan framework Laravel yang berfungsi sebagai cetak biru (blueprint) berbasis kode untuk membuat, mengatur, dan menghapus tabel-tabel sistem autentikasi pengguna di dalam database secara otomatis. Di dalam struktur berkas ini terdapat dua fungsi (method) utama dengan peran yang berlawanan, yaitu fungsi up() dan fungsi down(). Fungsi up() bertugas untuk mengeksekusi pembuatan tiga tabel utama sekaligus saat perintah perintah migrasi dijalankan, mulai dari tabel users untuk menyimpan data akun inti pengguna (seperti ID otomatis, nama, email unik, password, token pengingat login, beserta pencatatan waktu otomatis), tabel password_reset_tokens yang menggunakan email sebagai kunci utama (primary key) untuk menyimpan token pemulihan kata sandi, hingga tabel sessions yang bertugas mencatat riwayat aktivitas sesi aktif pengguna di web lengkap dengan data pelacak seperti nomor IP address, informasi perangkat browser (user agent), data muatan (payload), serta index aktivitas terakhir. Kebalikannya, fungsi down() berperan sebagai fitur pembatalan (rollback) yang memanfaatkan perintah Schema::dropIfExists untuk menghapus ketiga tabel tersebut dari database secara berurutan dan bersih apabila struktur database ingin dikembalikan ke kondisi semula sebelum migrasi dijalankan.

### 5. Sourcecode DatabaseSeeder.php
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
```

### Penjelasan

Kode di atas merupakan file Seeder bawaan framework Laravel bernama ProductSeeder yang berfungsi sebagai wadah untuk mengisi data awal (initial data) atau data buatan (dummy data) ke dalam tabel products di database secara otomatis. Di dalam kelas yang mewarisi sifat Seeder ini, terdapat satu fungsi (method) utama bernama run(), tempat di mana pengembang dapat menuliskan kode perintah pengisian data—baik menggunakan Eloquent ORM, Query Builder, maupun diintegrasikan dengan Laravel Factory untuk menghasilkan puluhan data acak sekaligus. Secara bawaan, fungsi run() ini masih kosong dan belum mengeksekusi apa pun, namun ketika nantinya diisi dengan instruksi pengisian data dan dipanggil melalui perintah terminal php artisan db:seed, fungsi ini akan langsung bekerja menyuntikkan data siap pakai ke database sehingga pengembang tidak perlu repot menginputkan data uji coba satu per satu secara manual lewat form aplikasi atau phpMyAdmin.

### 6. Sourcecode ProductFactory.php
```php
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
```

### Penjelasan

Kode di atas merupakan file Factory pada framework Laravel bernama ProductFactory yang berfungsi sebagai mesin pembuat data tiruan (dummy data) produk secara otomatis, dinamis, dan terstruktur untuk kebutuhan pengujian aplikasi toko gitar premium. Di dalam kelas ini terdapat fungsi definition() yang mengembalikan sebuah struktur array data yang siap dimasukkan ke database. Di dalam fungsi tersebut, mulanya didefinisikan sebuah variabel array $gitars berisi daftar katalog produk gitar spesifik dunia nyata—mulai dari varian elektrik kelas atas hingga akustik populer—lengkap dengan nama, format kode dasar, harga asli, dan deskripsi karakteristiknya.

Setiap kali factory ini dipanggil, sistem memanfaatkan pustaka Faker bawaan melalui perintah $this->faker->randomElement($gitars) untuk mengundi dan mengambil satu baris data gitar secara acak dari katalog tersebut. Hasil undian tersebut kemudian dipetakan ke dalam kolom-kolom tabel database, di mana kolom nama_produk, harga, dan deskripsi langsung diisi sesuai data asli gitar terpilih, kolom stok digenerate secara acak menggunakan rentang angka realistis antara 3 hingga 25, dan kolom kunci kode_produk dimodifikasi secara cerdas dengan menggabungkan kode dasar gitar asli dengan fungsi unik $this->faker->unique()->numberBetween(10, 99) guna memastikan tidak terjadi bentrok atau duplikasi kode produk di database meskipun data tiruan ini digenerate dalam jumlah puluhan hingga ratusan data sekaligus.

---

## C. Penjelasan Implementasi Sistem

Implementasi sistem inventaris toko gitar premium berbasis Laravel ini diwujudkan dengan mengintegrasikan arsitektur Model-View-Controller (MVC) yang kokoh, sistem autentikasi terproteksi, dan pengelolaan basis data terotomatisasi. Pada sisi keamanan dan regulasi data, sistem mengimplementasikan routing berbasis middleware yang secara ketat memisahkan hak akses antara pengunjung umum (guest) dan pengguna terautentikasi (auth), di mana halaman manajemen produk dikunci rapat dan hanya bisa dioperasikan setelah pengguna resmi login. Seluruh data operasional dijembatani oleh Model Product berbasis Eloquent ORM yang terhubung langsung ke tabel database, lengkap dengan pengamanan properti $fillable untuk menangkal serangan siber Mass Assignment serta cetak biru otomatis (migration) untuk membangun struktur tabel pengguna, token, dan sesi aktif secara instan.

---

## D. Hasil Tampilan 

### Halaman Login
![Halaman Login](assets/1.png)

Untuk mengakses dashboard dan fitur manajemen produk, pengguna harus memasukkan alamat email dan password mereka di halaman login sistem.

---

### Halaman Dashboard
![Halaman Dashboard](assets/2.png)

Dashboard menampilkan daftar produk terbaru yang masuk ke dalam sistem. Ini juga menampilkan ringkasan data inventaris seperti total produk, total stok, tipe gitar, dan harga jual.

---

### Halaman Daftar Produk
![Halaman Daftar Produk](assets/3.png)

Halaman daftar produk menampilkan tabel dengan semua data produk, termasuk nama, deskripsi, tipe, stok, harga, dan tombol untuk mengubah atau menghapus data.

---

### Halaman Tambah Produk
![Halaman Tambah Produk](assets/4.png)

Untuk memasukkan data produk baru ke dalam database, pengguna harus mengisi tipe gitar, kode produk, nama, stok awal, harga dan deskripsi, pada halaman tambah produk sebelum data disimpan.

---

### Hasil Berhasil Menambah Produk
![Berhasil Menambah Produk](assets/5.png)

Setelah data disimpan dengan sukses, sistem memberikan notifikasi kepada pengguna bahwa produk telah ditambahkan. Data yang baru ditambahkan juga ditampilkan secara langsung pada daftar produk.

---

### Halaman Edit Produk
![Halaman Edit Produk](assets/6.png)

Untuk memperbarui data produk yang sudah ada, halaman edit produk digunakan. Form ini menampilkan data lama agar dapat diubah sesuai kebutuhan.

---

### Hasil Berhasil Update Produk
![Berhasil Update Produk](assets/7.png)

Setelah proses edit selesai, notifikasi diberikan oleh sistem bahwa data produk telah diperbarui dengan sukses.

---

### Modal Konfirmasi Hapus
![Modal Hapus Produk](assets/8.png)

Untuk mencegah penghapusan data secara tidak sengaja, sistem akan menampilkan modal konfirmasi sebelum data dihapus.

---

### Hasil Berhasil Hapus Produk
![Berhasil Hapus Produk](assets/9.png)

Setelah pengguna menekan tombol "hapus" pada modal konfirmasi, data akan dihapus dari database. Setelah selesai, sistem menampilkan notifikasi bahwa produk dihapus dengan sukses.

---

### Dropdown Profil pada Dashboard
![Dropdown Profil Dashboard](assets/10.png)

Pada bagian atas tabel daftar produk, terdapat dropdown "Tampilkan" yang berfungsi untuk mengatur jumlah entitas barang yang ingin ditampilkan dalam satu halaman, mulai dari 10 hingga 100 data, guna memudahkan pengguna dalam meninjau stok barang secara fleksibel.

---

## E. Kesimpulan

Melalui pelaksanaan praktikum modul ini, implementasi aplikasi web inventaris toko gitar telah sukses diwujudkan dengan memanfaatkan keunggulan arsitektur modern framework Laravel. Pengembangan aplikasi ini berpusat pada optimalisasi logika bisnis di dalam ProductController untuk menangani siklus CRUD secara dinamis, yang diperkuat dengan proteksi keamanan Mass Assignment pada model data serta pembatasan hak akses halaman siber melalui mekanisme auth dan guest middleware.
---

## Referensi

[1] Modul Praktikum Aplikasi Berbasis Platform (ABP) Modul 11  
[2] Modul Praktikum Aplikasi Berbasis Platform (ABP) Modul 12  
[3] Modul Praktikum Aplikasi Berbasis Platform (ABP) Modul 13  
[4] W3Schools. https://www.w3schools.com  

<h1 align="center">LAPORAN PRAKTIKUM</h1>
<h1 align="center">APLIKASI BERBASIS PLATFORM</h1>

<br>

<h2 align="center">MODUL 4</h2>
<h2 align="center">BOOTSTRAP</h2>

<br><br>

<p align="center">
<img src="logo.png" width="350">
</p>
<br><br><br>

<h2 align="center">Disusun Oleh :</h2>

<p align="center" style="font-size:28px;">
  <b>Imelda Fajar Awalina Crisyanti</b><br>
  <b>2311102004</b><br>
  <b>S1 IF-11-REG 01</b>
</p>
<br>
<h2 align="center">Dosen Pengampu :</h2>

<p align="center" style="font-size:28px;">
  <b>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</b>
</p>
<br>
<h2 align="center">Asisten Praktikum :</h2>

<p align="center" style="font-size:28px;">
  <b>Apri Pandu Wicaksono</b><br>
  <b>Rangga Pradarrell Fathi</b>
</p>
<br>
<h1 align="center">LABORATORIUM HIGH PERFORMANCE</h1>
<h1 align="center">FAKULTAS INFORMATIKA</h1>
<h1 align="center">UNIVERSITAS TELKOM PURWOKERTO</h1>
<h1 align="center">TAHUN 2026</h1>

<hr>

### Dasar Teori
Bootstrap adalah framework front-end open-source yang dirancang untuk memudahkan pengembangan halaman web menjadi lebih cepat, rapi, dan responsif. Framework ini menyediakan berbagai komponen siap pakai seperti tombol, form, navigasi, modal, carousel, dan sistem grid berbasis baris dan kolom. Dengan komponen ini, pengembang dapat menyusun layout halaman secara konsisten dan efisien tanpa harus menulis kode CSS atau JavaScript dari awal.

Kelebihan utama Bootstrap adalah desain responsif, yang memungkinkan halaman web menyesuaikan ukuran layar perangkat secara otomatis, mulai dari smartphone, tablet, hingga desktop. Bootstrap juga menyediakan plugin JavaScript opsional untuk menambahkan fitur interaktif seperti dropdown, modal, tooltip, dan carousel, sehingga halaman web lebih dinamis dan menarik.

Selain itu, Bootstrap mendukung kustomisasi tema melalui variabel CSS dan preprocessor seperti Sass, sehingga pengembang dapat menyesuaikan tampilan halaman sesuai branding atau kebutuhan proyek. Bootstrap juga bersifat open-source, sehingga dapat digunakan secara bebas dan terus diperbarui oleh komunitas pengembang.

Dalam praktikum ini, Bootstrap digunakan melalui CDN, sehingga semua komponen dapat langsung diterapkan pada halaman web tanpa perlu mengunduh file framework secara manual. Metode ini memudahkan praktikan membuat halaman web yang rapi, fungsional, dan menarik dengan efisiensi waktu yang lebih tinggi, serta meningkatkan pemahaman penggunaan framework modern dalam pengembangan web.

### Source Code
```
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ramadan Kareem</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.card { border-radius: 0.5rem; }
.hero-img { max-width: 600px; margin: 0 auto; display: block; }
.text-green { color: #2E7D32; }
.bg-lightgreen { background-color: #E8F5E9; }
</style>
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <h1 class="text-green fw-bold">Ramadan Kareem</h1>
    <h4 class="text-secondary">Mari Tingkatkan Ibadah dan Kebaikan</h4>
    <img src="images.jpg" alt="Ramadan Illustration" class="hero-img mt-4">
    <p class="mt-4">
        Semoga Ramadan menjadi waktu terbaik untuk memperbaiki diri, memperkuat ibadah, dan menebarkan kebaikan kepada sesama.
    </p>
    <a href="#" class="btn btn-success mt-2">Lihat Kegiatan</a>
</div>

<div class="container mt-5">
    <div class="row text-center g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-green">Sahur</h5>
                    <p class="card-text">Awali puasa dengan sahur agar tubuh tetap kuat menjalani aktivitas harian.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-green">Berbuka</h5>
                    <p class="card-text">Berbukalah tepat waktu dan tetap menjaga rasa syukur atas nikmat yang diterima.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-green">Tarawih</h5>
                    <p class="card-text">Mari hidupkan malam Ramadan dengan tarawih.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="p-3 bg-lightgreen rounded text-center">
        Ramadan mengajarkan kedisiplinan, kesabaran, dan kepedulian kepada sesama.
    </div>
</div>

<footer class="text-center mt-5 mb-3 text-muted">
    <p>© Imelda Fajar Awalina Crisyanti - Bootstrap</p>
</footer>

</body>
</html>

```
### Output 

<img src="output.png" alt="Ramadan Illustration" class="hero-img mt-4">

### Penjelasan Kode Program
Pada halaman web ini, Bootstrap dipanggil melalui CDN pada bagian `<head>`, sehingga semua komponen seperti tombol, card, form, dan grid dapat langsung digunakan tanpa perlu mengunduh file CSS dan JavaScript secara lokal. Hal ini mempercepat proses pengembangan dan memastikan halaman selalu menggunakan versi terbaru dari Bootstrap.

Bagian `<body class="bg-light">` memberikan background terang yang membuat halaman terlihat bersih dan nyaman dilihat. Seluruh konten utama dibungkus menggunakan `<div class="container text-center mt-5">`. Class `container` menjaga tata letak agar rapi, `text-center` memposisikan teks di tengah, dan `mt-5` memberi jarak dari atas halaman. Judul utama menggunakan `text-green fw-bold` agar berwarna hijau sesuai tema Ramadan dan terlihat menonjol, sedangkan subjudul menggunakan `text-secondary` agar lebih lembut dan kontras dengan judul utama.

Gambar banner halaman menggunakan class `hero-img img-fluid mt-4` agar ukurannya responsif sesuai layar perangkat, tetap berada di tengah, dan tidak merusak layout. Bagian informasi Ramadan menggunakan sistem grid Bootstrap dengan `<div class="row text-center g-3">`, sehingga tiga card (Sahur, Berbuka, Tarawih) tampil sejajar pada layar medium ke atas. Class `g-3` memberi jarak antar card agar tidak rapat. Setiap card menggunakan `card shadow-sm` untuk efek bayangan ringan, dan isi card ditempatkan dalam `card-body` dengan judul `card-title text-green` dan teks `card-text`.

Tombol aksi menggunakan `<a class="btn btn-success mt-2">`, sehingga terlihat interaktif dengan warna hijau khas Bootstrap. Footer halaman menggunakan `text-center mt-5 mb-3 text-muted` untuk memposisikan teks di tengah, memberi jarak dari konten dan bawah halaman, serta menampilkan teks lembut.

Secara keseluruhan, kode ini memanfaatkan class-class Bootstrap untuk membuat halaman web yang responsif, rapi, dan interaktif, dengan semua elemen seperti judul, gambar, tombol, card, dan footer tersusun secara sistematis sesuai tema Ramadan.

### Kesimpulan
Berdasarkan praktikum yang telah dilakukan, dapat disimpulkan bahwa Bootstrap merupakan framework front-end yang efektif dan efisien dalam pembuatan halaman web. Dengan menggunakan class-class bawaan Bootstrap, praktikan dapat membuat tampilan web yang rapi, responsif, dan interaktif tanpa harus menulis CSS atau JavaScript dari awal.

Penggunaan sistem grid memudahkan penyusunan elemen seperti card, tombol, dan gambar agar tampil sejajar dan proporsional di berbagai ukuran layar. Selain itu, komponen siap pakai seperti card, tombol, dan container membantu meningkatkan konsistensi desain dan mempercepat proses pembuatan halaman.

Pada praktikum ini, halaman web bertema Ramadan berhasil dibuat dengan struktur yang jelas: judul, gambar banner, tombol aksi, card informasi (Sahur, Berbuka, Tarawih), dan footer. Seluruh elemen disusun menggunakan Bootstrap sehingga halaman web menjadi lebih profesional dan menarik. Praktikum ini juga menekankan pentingnya responsivitas dan interaktivitas pada pengembangan web modern.

Secara keseluruhan, Bootstrap memudahkan pengembangan halaman web yang estetis, fungsional, dan sesuai dengan tema yang diinginkan, dalam hal ini modul praktikum bertema Ramadan.

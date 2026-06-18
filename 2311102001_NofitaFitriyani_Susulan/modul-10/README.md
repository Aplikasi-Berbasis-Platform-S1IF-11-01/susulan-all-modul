<h1 align="center">LAPORAN PRAKTIKUM</h1>
<h1 align="center">APLIKASI BERBASIS PLATFORM</h1>

<br>

<h2 align="center">MODUL 10</h2>
<h2 align="center">AJAX</h2>

<br><br>

<p align="center">
<img src="asset\LogoTelkom.png" width="350">
</p>
<br><br><br>

<h2 align="center">Disusun Oleh :</h2>

<p align="center" style="font-size:28px;">
  <b>Nofita Fitriyani</b><br>
  <b>2311102001</b><br>
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

## DASAR TEORI
### 1. Pengertian AJAX
AJAX adalah singkatan dari Asynchronous JavaScript and XML. AJAX merupakan teknik pada pengembangan web yang memungkinkan halaman web mengambil atau mengirim data ke server tanpa harus me-reload seluruh halaman.

Walaupun namanya mengandung kata XML, pada praktik modern AJAX lebih sering menggunakan format JSON karena lebih ringan dan lebih mudah diproses dengan JavaScript.

Dengan AJAX, interaksi antara pengguna dan server menjadi lebih cepat dan nyaman, karena hanya bagian tertentu dari halaman yang diperbarui.

### 2. Fungsi AJAX dalam Website
AJAX digunakan agar website menjadi lebih interaktif. Beberapa manfaat AJAX adalah:

- menampilkan data dari server tanpa reload halaman,
- mempercepat proses pertukaran data,
- meningkatkan kenyamanan pengguna,
- membuat aplikasi web terasa lebih responsif.

Pada praktikum ini, AJAX digunakan untuk mengambil data profil dari file PHP lalu menampilkannya ke halaman HTML saat tombol diklik.

### 3. PHP Server
PHP (PHP: Hypertext Preprocessor) adalah sebuah bahasa pemrograman server
side scripting yang bersifat open source. Sebagai sebuah scripting language,
PHP menjalankan instruksi pemrograman saat proses runtime. Hasil dari instruksi
tentu akan berbeda tergantung data yang diproses. PHP merupakan bahasa
pemrograman server-side, maka script dari PHP nantinya akan diproses di server.
Dalam praktikum ini, file data.php berfungsi sebagai server sederhana yang menyediakan data profil.

Data disimpan dalam bentuk array asosiatif, lalu diubah menjadi format JSON menggunakan fungsi json_encode().

### 4. Fungsi PHP
Secara umum, fungsi PHP adalah digunakan untuk pengembangan website. Baik
website statis seperti situs berita yang tidak membutuhkan banyak fitur. Ataupun
website dinamis seperti toko online dengan segudang fitur pendukung. Namun,
penggunaan PHP tidak terbatas pada pengembangan website saja. Karena
fleksibilitasnya yang tinggi, PHP juga bisa digunakan untuk membuat aplikasi
komputer sekalipun.
Sintaks Dasar PHP
Setiap bahasa pemrograman memiliki aturan coding sendiri. Begitu pula dengan
PHP. Sintaks dasarnya dibuka dengan <?php dan ditutup dengan ?> sebagai
terlihat di contoh berikut:
```
<?php
echo "Selamat datang";
?>
```
penjelasan:

• `<?php` ini adalah kode wajib untuk membuka program PHP.

• `Echo` adalah sebuah perintah untuk menampilkan teks.

• `“Selamat Datang”;` teks yang hendak ditampilkan dan ditulis diantara tanda
petik dan titik koma.

• `?>` adalah kode untuk mengakhiri PHP dan wajib digunakan saat digabung
dengan bahasa pemrograman lain seperti HTML.

Sintaks PHP bersifat case sensitive. Jadi, penggunaan huruf besar atau kecil akan
turut mempengaruhi output yang diberikan

### 5. JSON
JSON adalah singkatan dari JavaScript Object Notation. JSON merupakan format pertukaran data yang ringan, sederhana, dan mudah dibaca manusia maupun mesin.

Contoh JSON:
```
  $profil = [
    'nama' => 'Nofita Fitriyani',
    'pekerjaan' => 'Lagi nganggur ueyy :(',
    'lokasi' => 'Puertorico'
];
```
JSON sering digunakan dalam AJAX karena formatnya cocok untuk diproses oleh JavaScript.

### 6. DOM (Document Object Model)

DOM adalah representasi struktur dokumen HTML yang memungkinkan JavaScript mengakses dan mengubah isi halaman.
Dalam praktikum ini, JavaScript menggunakan DOM untuk:

- mengambil elemen tombol,
- mengambil elemen tempat hasil ditampilkan,
- mengubah isi elemen tersebut setelah data - berhasil diambil dari server.

## SOURCE CODE
### data.php
```
<?php
header('Content-Type: application/json');

$profil = [
    'nama' => 'Nofita Fitriyani',
    'pekerjaan' => 'Lagi nganggur ueyy :(',
    'lokasi' => 'Puertorico'
];

echo json_encode($profil);
?>
```
### index.html
```
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Modul-10 AJAX</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f6f6f6;
      margin: 0;
      padding: 40px 20px;
      color: #333;
    }

    .container {
      max-width: 420px;
      margin: auto;
      background: white;
      padding: 24px;
      border-radius: 12px;
      border: 1px solid #e5e5e5;
    }

    h2 {
      margin-bottom: 8px;
    }

    .sub {
      font-size: 14px;
      color: #777;
      margin-bottom: 20px;
    }

    button {
      width: 100%;
      padding: 10px;
      background: #333;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }

    button:hover {
      background: #111;
    }

    #hasil-profil {
      margin-top: 20px;
      font-size: 14px;
      line-height: 1.6;
    }

    .card {
      border-top: 1px solid #ddd;
      padding-top: 15px;
    }

    .item {
      margin-bottom: 8px;
    }

    .label {
      color: #888;
      font-size: 13px;
    }

    .value {
      font-weight: bold;
    }

    .loading {
      color: #999;
      font-style: italic;
    }

    .error {
      color: red;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Profil</h2>
    <div class="sub">Data diambil dari server</div>

    <button id="btn">Tampilkan Profil</button>

    <div id="hasil-profil">
      <div class="sub">Belum ada data</div>
    </div>
  </div>

  <script>
    const btn = document.getElementById("btn");
    const hasil = document.getElementById("hasil-profil");

    btn.addEventListener("click", function () {
      hasil.innerHTML = '<div class="loading">mengambil data...</div>';

      fetch("data.php")
        .then(res => res.json())
        .then(data => {
          hasil.innerHTML = `
            <div class="card">
              <div class="item">
                <div class="label">Nama</div>
                <div class="value">${data.nama}</div>
              </div>
              <div class="item">
                <div class="label">Pekerjaan</div>
                <div class="value">${data.pekerjaan}</div>
              </div>
              <div class="item">
                <div class="label">Lokasi</div>
                <div class="value">${data.lokasi}</div>
              </div>
            </div>
          `;
        })
        .catch(() => {
          hasil.innerHTML = '<div class="error">gagal mengambil data</div>';
        });
    });
  </script>

</body>
</html>
```
## PENJELASAN KODE PROGRAM
### Kode pada file data.php
```
header('Content-Type: application/json');
```
Baris ini digunakan untuk memberi tahu browser bahwa data yang dikirim oleh file ini bertipe JSON.

- supaya browser tahu format respons dari server,
- supaya JavaScript bisa membaca hasilnya sebagai JSON,
- supaya komunikasi data antara server dan client menjadi jelas.

```
$profil = [
    'nama' => 'Nofita Fitriyani',
    'pekerjaan' => 'Lagi nganggur ueyy :(',
    'lokasi' => 'Puertorico'
];
```
Di sini dibuat sebuah variabel bernama $profil yang berisi array asosiatif. Array asosiatif adalah array yang menggunakan key dan value.

Penjelasannya:
- key nama berisi nilai Nofita Fitriyani
- key pekerjaan berisi nilai Lagi nganggur ueyy :(
- key lokasi berisi nilai Puertorico

```
echo json_encode($profil);
```
Fungsi `json_encode()` digunakan untuk mengubah array PHP menjadi format JSON.

Kemudian `echo` dipakai untuk menampilkan atau mengirim hasil JSON tersebut ke browser.

### kode pada data index.html
`<meta charset="UTF-8">` digunakan agar karakter pada halaman dapat tampil dengan benar.
`<title>` menentukan judul halaman yang muncul di tab browser.

Bagian `<style>` berisi aturan tampilan halaman.
Class seperti .card, .item, .label, .value, .loading, dan .error digunakan agar tampilan data lebih rapi.
Contohnya:

`.label` untuk tulisan nama field,
`.value` untuk isi data,
`.loading` untuk pesan saat proses pengambilan data,
`.error` untuk pesan gagal.

Pada halaman body :
```
<div class="container">
  <h2>Profil</h2>
  <div class="sub">Ambil data dari server tanpa reload</div>

  <button id="btn">Tampilkan Profil</button>

  <div id="hasil-profil">
    <div class="sub">Belum ada data</div>
  </div>
</div>
```
Penjelasan:
- `<h2>Profil</h2>` adalah judul halaman.
- `<div class="sub">...</div>` adalah teks penjelas singkat.
- `<button id="btn">`Tampilkan Profil`</button>` adalah tombol untuk memicu AJAX.
- `<div id="hasil-profil">...</div>` adalah tempat hasil data ditampilkan.

Awalnya isi div tersebut adalah:
```
<div class="sub">Belum ada data</div>
```
Jadi sebelum tombol diklik, pengguna melihat pesan bahwa data belum ditampilkan.

Mengambil elemen HTML :
```
const btn = document.getElementById("btn");
const hasil = document.getElementById("hasil-profil");
```
`btn.addEventListener("click", function () {` Artinya, saat tombol diklik, jalankan fungsi di dalamnya.

`fetch("data.php")` Perintah ini digunakan untuk meminta data ke file `data.php`. Karena `data.php` ada di folder yang sama dengan `index.html`, cukup ditulis "data.php".

## KESIMPULAN
Berdasarkan praktikum yang telah dilakukan, dapat disimpulkan bahwa AJAX memungkinkan halaman web mengambil data dari server dan menampilkannya secara dinamis tanpa perlu me-refresh seluruh halaman. Pada program ini, file data.php berperan sebagai penyedia data dalam format JSON, sedangkan file index.html menggunakan JavaScript fetch() untuk mengambil dan menampilkan data tersebut ke halaman web. Implementasi ini menunjukkan bahwa kombinasi HTML, PHP, JavaScript, dan JSON dapat digunakan untuk membangun halaman web yang lebih interaktif, efisien, dan responsif.

## REFERENCE
- PHP : https://lmsspada.kemdiktisaintek.go.id/pluginfile.php/718778/mod_resource/content/0/Materi%20Pemrograman%20Web%20P9.pdf
- JSON dalam AJAX : https://www.geeksforgeeks.org/jquery/how-to-use-json-in-ajax-jquery/?utm_source=chatgpt.com


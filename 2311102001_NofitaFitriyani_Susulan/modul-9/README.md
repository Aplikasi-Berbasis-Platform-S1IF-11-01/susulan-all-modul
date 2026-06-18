<h1 align="center">LAPORAN PRAKTIKUM</h1>
<h1 align="center">APLIKASI BERBASIS PLATFORM</h1>

<br>

<h2 align="center">MODUL 9</h2>
<h2 align="center">PHP</h2>

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

## Dasar Teori
### 1. Pengenalan PHP
PHP (PHP: Hypertext Preprocessor) adalah sebuah bahasa pemrograman server
side scripting yang bersifat open source. Sebagai sebuah scripting language,
PHP menjalankan instruksi pemrograman saat proses runtime. Hasil dari instruksi
tentu akan berbeda tergantung data yang diproses. PHP merupakan bahasa
pemrograman server-side, maka script dari PHP nantinya akan diproses di server.
Jenis server yang sering digunakan bersama dengan PHP antara
lain Apache, Nginx, dan LiteSpeed. Selain itu, PHP juga merupakan bahasa
pemrograman yang bersifat open source. Pengguna bebas memodifikasi dan
mengembangkan sesuai dengan kebutuhan mereka.

### 2. Fungsi PHP
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

### 3. Penulisan kode-kode PHP
#### PHP Native
Native adalah penulisan kode PHP dari nol ketika melakukan perancangan
sebuah website. PHP Native sering digunakan oleh developer yang memiliki
keahlian coding cukup baik atau mereka yang ingin membuat kerangka alur yang
unik dengan fungsionalitas tinggi.
Salah satu contoh penulisan kode PHP native dapat Anda lihat pada
panduan cara membuat session login PHP untuk mengelola dan membatasi login
hanya untuk pengguna terdaftar.

#### PHP Framework
Ketika menggunakan framework, developer dapat memanfaatkan kerangka
pengelolaan website yang sudah jadi. Artinya, tidak perlu membuatnya dari awal
sehingga memudahkan pekerjaan. Framework adalah kerangka kerja yang dapat
membantu developer bekerja lebih efisien dan menyelesaikan pengembangan
website lebih cepat.
Beberapa Framework PHP yang populer digunakan antara
lain: CodeIgniter, framework Laravel, Yii, Symfony dan Zend Framework.
Jika Anda sudah mahir PHP native, sangat disarankan untuk mencoba beralih ke
PHP framework. Itu karena kode pada framework sudah dioptimasi sesuai
standar, dari segi kecepatan maupun keamanan.

## Source Code
```
<?php
$mahasiswa = [
    [
        "nama" => "Nofita Fitriyani",
        "nim" => "2311102001",
        "tugas" => 85,
        "uts" => 80,
        "uas" => 88
    ],
    [
        "nama" => "Aulia Rahman",
        "nim" => "2311102002",
        "tugas" => 78,
        "uts" => 75,
        "uas" => 82
    ],
    [
        "nama" => "Salsa Putri",
        "nim" => "2311102003",
        "tugas" => 90,
        "uts" => 92,
        "uas" => 89
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
}

function tentukanGrade($nilaiAkhir)
{
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 75) {
        return "B";
    } elseif ($nilaiAkhir >= 65) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}

function tentukanStatus($nilaiAkhir)
{
    return ($nilaiAkhir >= 70) ? "Lulus" : "Tidak Lulus";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
$namaTertinggi = "";

foreach ($mahasiswa as $mhs) {
    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
    $totalNilai += $nilaiAkhir;

    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
        $namaTertinggi = $mhs["nama"];
    }
}

$rataRataKelas = $totalNilai / count($mahasiswa);
?>

```

## Output 
<img src="asset\output.jpeg">

## Penjelasan Kode Program
Data mahasiswa disimpan dalam array asosiatif berikut :
```
$mahasiswa = [
    [
        "nama" => "...",
        "nim" => "...",
        ...
    ]
];
```
Function yang digunakan untuk menghitung nilai akhir :
```
function hitungNilaiAkhir($tugas, $uts, $uas)
```
if/else untuk grade :
```
function tentukanGrade($nilaiAkhir)
{
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 75) {
        return "B";
    } elseif ($nilaiAkhir >= 65) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}
```

Operator aritmatika dipakai saat menghitung nilai akhir :
```
($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40)
```
untuk menentukan lulus/tidaknya, menggunakan operator perbandingan berikut :
```
function tentukanStatus($nilaiAkhir)
{
    return ($nilaiAkhir >= 70) ? "Lulus" : "Tidak Lulus";
}
```
Loop untuk menampilkan semua data : `foreach ($mahasiswa as $mhs)`

## Kesimpulan 
Berdasarkan hasil perancangan dan implementasi program Sistem Penilaian Mahasiswa menggunakan PHP, dapat disimpulkan bahwa program ini berhasil memenuhi seluruh ketentuan yang diberikan pada modul praktikum. Program mampu mengelola data mahasiswa menggunakan array asosiatif, melakukan perhitungan nilai akhir dengan memanfaatkan function, serta menentukan grade dan status kelulusan berdasarkan hasil perhitungan tersebut.

Selain itu, penggunaan struktur kontrol seperti percabangan (if/else) dan perulangan (foreach) terbukti efektif dalam mengolah dan menampilkan data secara dinamis ke dalam bentuk tabel HTML. Program juga mampu menampilkan informasi tambahan seperti rata-rata nilai kelas dan nilai tertinggi, sehingga memberikan gambaran umum terhadap performa akademik mahasiswa dalam satu kelas.

Dari sisi tampilan, integrasi antara PHP dan HTML dengan tambahan CSS sederhana membuat hasil output menjadi lebih rapi dan mudah dipahami oleh pengguna. Hal ini menunjukkan bahwa pembuatan aplikasi berbasis web sederhana tidak hanya berfokus pada logika program, tetapi juga pada aspek visual agar lebih user-friendly.

Secara keseluruhan, praktikum ini membantu dalam memahami dasar-dasar pemrograman PHP, terutama dalam penggunaan array, function, operator, serta integrasi dengan tampilan web. Pengetahuan ini menjadi fondasi penting untuk pengembangan aplikasi web yang lebih kompleks di tahap selanjutnya.

## Reference
https://lmsspada.kemdiktisaintek.go.id/pluginfile.php/718778/mod_resource/content/0/Materi%20Pemrograman%20Web%20P9.pdf
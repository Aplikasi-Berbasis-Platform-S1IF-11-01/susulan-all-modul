
<div align="center">

## LAPORAN PRAKTIKUM
## APLIKASI BERBASIS PLATFORM

### MODUL 6
### WEB

<br><br>

<img src="aset/logo.png" width="150">

<br><br>

**Disusun oleh:**
**Syafanida Khakiki**
**2311102005**

<br>

**KELAS PS1IF-11-REG01**
**Dosen: Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom**

<br><br>

## PROGRAM STUDI S1 TEKNIK INFORMATIKA <br> FAKULTAS INFORMATIKA <br> UNIVERSITAS TELKOM PURWOKERTO <br> 2026 <br><br>

</div>

---

# 1. Dasar Teori

Aplikasi web merupakan sistem yang berjalan melalui browser dengan memanfaatkan teknologi frontend dan backend. Pada praktikum ini digunakan Node.js sebagai runtime JavaScript untuk membangun aplikasi web sederhana dengan konsep routing dan tampilan dinamis.

:contentReference[oaicite:0]{index=0} adalah framework minimalis untuk Node.js yang digunakan untuk membangun aplikasi web dan API dengan cepat melalui sistem routing dan middleware.

:contentReference[oaicite:1]{index=1} adalah template engine yang memungkinkan HTML digabungkan dengan JavaScript untuk menghasilkan tampilan dinamis dari data server.

:contentReference[oaicite:2]{index=2} adalah framework CSS yang digunakan untuk membuat tampilan web yang responsif dan modern dengan komponen siap pakai.

---

# 2. Hasil Praktikum

Aplikasi yang dibuat adalah **Sistem Manajemen Produk Sederhana** yang memiliki tiga halaman utama yaitu Home, Tambah Produk, dan Daftar Produk. Aplikasi ini digunakan untuk mengelola data produk melalui antarmuka web.

## Output 1 — Halaman Home

Halaman Home merupakan halaman utama aplikasi yang menampilkan tampilan awal serta menu navigasi ke fitur lainnya.

![Output 1 - Home](aset/output1.png)

## Output 2 — Halaman Tambah Produk

Halaman ini digunakan untuk menambahkan data produk baru melalui form input yang tersedia.

![Output 2 - Tambah Produk](aset/output2.png)

## Output 3 — Halaman Daftar Produk

Halaman ini menampilkan seluruh data produk yang sudah ditambahkan dalam bentuk tabel sederhana.

![Output 3 - Daftar Produk](aset/output3.png)

---

# 3. Penjelasan Sistem

Aplikasi ini memiliki konsep sederhana berbasis web dengan tiga halaman utama. Halaman Home digunakan sebagai landing page, halaman Tambah Produk digunakan untuk input data, dan halaman Daftar Produk digunakan untuk menampilkan seluruh data yang telah disimpan.

Alur sistem berjalan sebagai berikut: user membuka halaman Home, kemudian dapat menuju halaman Tambah Produk untuk memasukkan data, setelah itu data akan ditampilkan pada halaman Daftar Produk.

Struktur project terdiri dari folder views untuk halaman EJS, folder assets untuk menyimpan gambar output, serta file server.js sebagai backend utama yang mengatur routing aplikasi.

---

# 4. Kesimpulan

Aplikasi berhasil dibuat dengan konsep web sederhana menggunakan Node.js. Sistem ini mampu menampilkan tiga halaman utama yang saling terhubung serta memudahkan pengelolaan data produk secara sederhana melalui browser.

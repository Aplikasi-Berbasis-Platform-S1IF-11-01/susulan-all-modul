# <div align="center">

# &#x20; <br />

# &#x20; <h1>LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM</h1>

# &#x20; <br />

# &#x20; <h3>MODUL 4 <br> Flutter Layout</h3>

# &#x20; <br />

# &#x20; <img width="256" height="256" alt="telyu" src="https://github.com/user-attachments/assets/724a3291-bcf9-448d-a395-3886a8659d79" />

# &#x20; <br />

# &#x20; <br />

# &#x20; <h3>Disusun Oleh :</h3>

# &#x20; <p>

# &#x20;   <strong>Imelda Fajar Awalina Crisyanti</strong><br>

# &#x20;   <strong>2311102004</strong><br>

# &#x20;   <strong>S1 IF-11-REG 01</strong>

# &#x20; </p>

# &#x20; <br />

# &#x20; <h3>Dosen Pengampu :</h3>

# &#x20; <p>

# &#x20;   <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>

# &#x20; </p>

# &#x20; <br />

# &#x20; <h4>Asisten Praktikum :</h4>

# &#x20; <p>

# &#x20;   <strong>Apri Pandu Wicaksono</strong><br>

# &#x20;   <strong>Rangga Pradarrel Fathi</strong>

# &#x20; </p>

# &#x20; <br />

# &#x20; <h3>LABORATORIUM HIGH PERFORMANCE<br>FAKULTAS INFORMATIKA<br>UNIVERSITAS TELKOM PURWOKERTO<br>2026</h3>

# </div>

# 

# \---

# 

# \## Dasar Teori

# 

# \### Konsep Layout pada Flutter

# 

# Flutter menggunakan pendekatan deklaratif dalam membangun antarmuka pengguna (UI), di mana seluruh elemen visual direpresentasikan sebagai \*widget\*. Dalam mendesain tata letak (\*layout\*), Flutter membagi widget menjadi dua kategori utama: widget dengan elemen tunggal (\*single-child widget\*) seperti `Container` yang digunakan untuk memberikan gaya atau modifikasi bentuk, serta widget dengan elemen jamak (\*multi-child widget\*) seperti `Stack`, `Row`, dan `Column` yang digunakan untuk mengatur posisi susunan beberapa widget sekaligus.

# 

# \### Grid View

# 

# `GridView` merupakan widget \*scrollable\* yang dirancang khusus untuk menyusun antarmuka dalam pola kisi (\*grid\*) dua dimensi yang terdiri dari baris dan kolom. Komponen ini sangat ideal digunakan untuk menampilkan koleksi data visual yang padat, seperti galeri foto, etalase katalog menu, maupun susunan tombol kategori. Flutter menyediakan metode `GridView.count` untuk membuat struktur grid statis dengan jumlah kolom tetap yang sangat mudah diimplementasikan, serta `GridView.builder` untuk manajemen memori yang lebih efisien saat merender ratusan item.

# 

# \### List View

# 

# Berbeda dengan GridView, `ListView` adalah komponen esensial yang menyajikan kumpulan elemen data secara berderet linear (seperti daftar) dan dapat digeser (\*scroll\*). Widget ini adalah solusi utama untuk menangani konten yang melebihi kapasitas layar. Untuk daftar statis yang pendek, penggunaan `ListView` standar sudah cukup. Namun, untuk menangani data dinamis dari \*database\* atau \*array\*, sangat disarankan menggunakan `ListView.builder` yang memiliki mekanisme \*lazy-loading\*. Selain itu, terdapat `ListView.separated` yang secara otomatis menyisipkan komponen pemisah (seperti garis) di antara setiap elemen daftar.

# 

# \---

# 

# \## Task — Praktikum Modul 4

# 

# \### Source Code (`lib/main.dart`)

# 

# ```dart

# import 'package:flutter/material.dart';

# 

# void main() {

# &#x20; runApp(const MyApp());

# }

# 

# class MyApp extends StatelessWidget {

# &#x20; const MyApp({super.key});

# 

# &#x20; @override

# &#x20; Widget build(BuildContext context) {

# &#x20;   return MaterialApp(

# &#x20;     title: 'Tugas Modul 4',

# &#x20;     theme: ThemeData(

# &#x20;       primarySwatch: Colors.orange,

# &#x20;       scaffoldBackgroundColor: Colors.grey\[100],

# &#x20;     ),

# &#x20;     home: const ModulEmpatPage(),

# &#x20;     debugShowCheckedModeBanner: false,

# &#x20;   );

# &#x20; }

# }

# 

# class ModulEmpatPage extends StatelessWidget {

# &#x20; const ModulEmpatPage({super.key});

# 

# &#x20; // Data array untuk ListView.builder

# &#x20; final List<Map<String, String>> dataWarung = const \[

# &#x20;   {'nama': 'Angkringan \& Bakso Yone', 'menu': 'Bakso Spesial \& Sate-satean'},

# &#x20;   {'nama': 'Askara Cafe', 'menu': 'Kopi Susu \& Snack'},

# &#x20;   {'nama': 'Nasi Goreng Mas Acil', 'menu': 'Nasi Goreng Gila \& Kwetiau'},

# &#x20;   {'nama': 'Restu Bundo', 'menu': 'Nasi Padang Rendang'},

# &#x20; ];

# 

# &#x20; @override

# &#x20; Widget build(BuildContext context) {

# &#x20;   return Scaffold(

# &#x20;     appBar: AppBar(

# &#x20;       title: const Text(

# &#x20;         'Eksplorasi Kuliner',

# &#x20;         style: TextStyle(fontWeight: FontWeight.bold),

# &#x20;       ),

# &#x20;       backgroundColor: Colors.orange\[700],

# &#x20;       elevation: 0,

# &#x20;     ),

# &#x20;     body: SingleChildScrollView(

# &#x20;       padding: const EdgeInsets.all(16.0),

# &#x20;       child: Column(

# &#x20;         crossAxisAlignment: CrossAxisAlignment.start,

# &#x20;         children: \[

# &#x20;           // --- IDENTITAS PEMILIK TUGAS ---

# &#x20;           Card(

# &#x20;             color: Colors.orange\[50],

# &#x20;             elevation: 0,

# &#x20;             shape: RoundedRectangleBorder(

# &#x20;               side: BorderSide(color: Colors.orange\[300]!, width: 1.5),

# &#x20;               borderRadius: BorderRadius.circular(12),

# &#x20;             ),

# &#x20;             child: const ListTile(

# &#x20;               leading: CircleAvatar(

# &#x20;                 backgroundColor: Colors.deepOrange,

# &#x20;                 child: Icon(Icons.person, color: Colors.white),

# &#x20;               ),

# &#x20;               title: Text(

# &#x20;                 'Imelda Fajar Awalina Crisyanti',

# &#x20;                 style: TextStyle(fontWeight: FontWeight.bold, fontSize: 16),

# &#x20;               ),

# &#x20;               subtitle: Text('Praktikum Modul 4 - Flutter Layout'),

# &#x20;             ),

# &#x20;           ),

# &#x20;           const SizedBox(height: 24),

# 

# &#x20;           // --- 1. Container (Banner Utama) ---

# &#x20;           const Text(

# &#x20;             '1. Container (Banner)',

# &#x20;             style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),

# &#x20;           ),

# &#x20;           const SizedBox(height: 8),

# &#x20;           Container(

# &#x20;             padding: const EdgeInsets.all(20),

# &#x20;             width: double.infinity,

# &#x20;             decoration: BoxDecoration(

# &#x20;               gradient: LinearGradient(

# &#x20;                 colors: \[Colors.orange\[400]!, Colors.deepOrange\[600]!],

# &#x20;               ),

# &#x20;               borderRadius: BorderRadius.circular(15),

# &#x20;               boxShadow: const \[

# &#x20;                 BoxShadow(

# &#x20;                   color: Colors.black26,

# &#x20;                   blurRadius: 5,

# &#x20;                   offset: Offset(0, 3),

# &#x20;                 ),

# &#x20;               ],

# &#x20;             ),

# &#x20;             child: const Column(

# &#x20;               crossAxisAlignment: CrossAxisAlignment.start,

# &#x20;               children: \[

# &#x20;                 Text(

# &#x20;                   'Selamat Datang!',

# &#x20;                   style: TextStyle(

# &#x20;                     color: Colors.white,

# &#x20;                     fontSize: 22,

# &#x20;                     fontWeight: FontWeight.bold,

# &#x20;                   ),

# &#x20;                 ),

# &#x20;                 SizedBox(height: 5),

# &#x20;                 Text(

# &#x20;                   'Temukan makanan favoritmu di sini.',

# &#x20;                   style: TextStyle(color: Colors.white70, fontSize: 14),

# &#x20;                 ),

# &#x20;               ],

# &#x20;             ),

# &#x20;           ),

# &#x20;           const SizedBox(height: 24),

# 

# &#x20;           // --- 2. Stack (Kartu Promo) ---

# &#x20;           const Text(

# &#x20;             '2. Stack (Promo Hari Ini)',

# &#x20;             style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),

# &#x20;           ),

# &#x20;           const SizedBox(height: 8),

# &#x20;           Stack(

# &#x20;             children: \[

# &#x20;               Container(

# &#x20;                 height: 120,

# &#x20;                 width: double.infinity,

# &#x20;                 decoration: BoxDecoration(

# &#x20;                   color: Colors.blue\[100],

# &#x20;                   borderRadius: BorderRadius.circular(15),

# &#x20;                 ),

# &#x20;               ),

# &#x20;               Positioned(

# &#x20;                 right: -20,

# &#x20;                 top: -20,

# &#x20;                 child: Icon(Icons.fastfood, size: 100, color: Colors.blue\[200]),

# &#x20;               ),

# &#x20;               const Positioned(

# &#x20;                 left: 20,

# &#x20;                 top: 30,

# &#x20;                 child: Column(

# &#x20;                   crossAxisAlignment: CrossAxisAlignment.start,

# &#x20;                   children: \[

# &#x20;                     Text(

# &#x20;                       'Diskon 50%',

# &#x20;                       style: TextStyle(

# &#x20;                         fontSize: 24,

# &#x20;                         fontWeight: FontWeight.bold,

# &#x20;                         color: Colors.blueAccent,

# &#x20;                       ),

# &#x20;                     ),

# &#x20;                     Text(

# &#x20;                       'Khusus pemesanan hari ini!',

# &#x20;                       style: TextStyle(fontSize: 14, color: Colors.black54),

# &#x20;                     ),

# &#x20;                   ],

# &#x20;                 ),

# &#x20;               ),

# &#x20;             ],

# &#x20;           ),

# &#x20;           const SizedBox(height: 24),

# 

# &#x20;           // --- 3. GridView (Kategori Menu) ---

# &#x20;           const Text(

# &#x20;             '3. GridView (Kategori Makanan)',

# &#x20;             style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),

# &#x20;           ),

# &#x20;           const SizedBox(height: 8),

# &#x20;           GridView.count(

# &#x20;             crossAxisCount: 3,

# &#x20;             shrinkWrap: true,

# &#x20;             physics: const NeverScrollableScrollPhysics(),

# &#x20;             crossAxisSpacing: 12,

# &#x20;             mainAxisSpacing: 12,

# &#x20;             children: \[

# &#x20;               \_buildGridItem(Icons.ramen\_dining, 'Mie Ayam', Colors.green),

# &#x20;               \_buildGridItem(Icons.rice\_bowl, 'Soto Kwali', Colors.brown),

# &#x20;               \_buildGridItem(Icons.local\_fire\_department, 'Ayam Bakar', Colors.red),

# &#x20;               \_buildGridItem(Icons.set\_meal, 'Dimsum', Colors.teal),

# &#x20;               \_buildGridItem(Icons.lunch\_dining, 'Burger', Colors.amber),

# &#x20;               \_buildGridItem(Icons.local\_cafe, 'Minuman', Colors.blueGrey),

# &#x20;             ],

# &#x20;           ),

# &#x20;           const SizedBox(height: 24),

# 

# &#x20;           // --- 4. ListView (Paket Hemat A, B, C) ---

# &#x20;           const Text(

# &#x20;             '4. ListView (Paket Hemat)',

# &#x20;             style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),

# &#x20;           ),

# &#x20;           ListView(

# &#x20;             shrinkWrap: true,

# &#x20;             physics: const NeverScrollableScrollPhysics(),

# &#x20;             children: const \[

# &#x20;               Card(

# &#x20;                 child: ListTile(

# &#x20;                   leading: CircleAvatar(

# &#x20;                     backgroundColor: Colors.orange,

# &#x20;                     child: Text('A'),

# &#x20;                   ),

# &#x20;                   title: Text('Paket Kenyang A'),

# &#x20;                   subtitle: Text('Ayam Bakar + Nasi + Es Teh'),

# &#x20;                 ),

# &#x20;               ),

# &#x20;               Card(

# &#x20;                 child: ListTile(

# &#x20;                   leading: CircleAvatar(

# &#x20;                     backgroundColor: Colors.orange,

# &#x20;                     child: Text('B'),

# &#x20;                   ),

# &#x20;                   title: Text('Paket Kenyang B'),

# &#x20;                   subtitle: Text('Mie Ayam + Dimsum + Jeruk Hangat'),

# &#x20;                 ),

# &#x20;               ),

# &#x20;               Card(

# &#x20;                 child: ListTile(

# &#x20;                   leading: CircleAvatar(

# &#x20;                     backgroundColor: Colors.orange,

# &#x20;                     child: Text('C'),

# &#x20;                   ),

# &#x20;                   title: Text('Paket Kenyang C'),

# &#x20;                   subtitle: Text('Nasi Goreng + Telur + Krupuk'),

# &#x20;                 ),

# &#x20;               ),

# &#x20;             ],

# &#x20;           ),

# &#x20;           const SizedBox(height: 24),

# 

# &#x20;           // --- 5. ListView.builder (Daftar Restoran dari Array) ---

# &#x20;           const Text(

# &#x20;             '5. ListView.builder (Restoran Pilihan)',

# &#x20;             style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),

# &#x20;           ),

# &#x20;           const SizedBox(height: 8),

# &#x20;           ListView.builder(

# &#x20;             shrinkWrap: true,

# &#x20;             physics: const NeverScrollableScrollPhysics(),

# &#x20;             itemCount: dataWarung.length,

# &#x20;             itemBuilder: (context, index) {

# &#x20;               return Container(

# &#x20;                 margin: const EdgeInsets.only(bottom: 8),

# &#x20;                 decoration: BoxDecoration(

# &#x20;                   color: Colors.white,

# &#x20;                   borderRadius: BorderRadius.circular(10),

# &#x20;                   border: Border.all(color: Colors.grey\[300]!),

# &#x20;                 ),

# &#x20;                 child: ListTile(

# &#x20;                   leading: const Icon(Icons.storefront, color: Colors.deepOrange),

# &#x20;                   title: Text(

# &#x20;                     dataWarung\[index]\['nama']!,

# &#x20;                     style: const TextStyle(fontWeight: FontWeight.bold),

# &#x20;                   ),

# &#x20;                   subtitle: Text(dataWarung\[index]\['menu']!),

# &#x20;                   trailing: const Icon(Icons.arrow\_forward\_ios, size: 16),

# &#x20;                 ),

# &#x20;               );

# &#x20;             },

# &#x20;           ),

# &#x20;           const SizedBox(height: 24),

# 

# &#x20;           // --- 6. ListView.separated (Riwayat Pesanan) ---

# &#x20;           const Text(

# &#x20;             '6. ListView.separated (Riwayat Transaksi)',

# &#x20;             style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),

# &#x20;           ),

# &#x20;           const SizedBox(height: 8),

# &#x20;           Container(

# &#x20;             color: Colors.white,

# &#x20;             child: ListView.separated(

# &#x20;               shrinkWrap: true,

# &#x20;               physics: const NeverScrollableScrollPhysics(),

# &#x20;               itemCount: 3,

# &#x20;               separatorBuilder: (context, index) =>

# &#x20;                   const Divider(height: 1, color: Colors.grey),

# &#x20;               itemBuilder: (context, index) {

# &#x20;                 List<String> riwayat = \[

# &#x20;                   'Pembayaran QRIS - Rp 45.000',

# &#x20;                   'Transfer Bank - Rp 20.000',

# &#x20;                   'Top Up Saldo - Rp 100.000',

# &#x20;                 ];

# &#x20;                 List<String> waktu = \[

# &#x20;                   'Hari ini, 12:30',

# &#x20;                   'Kemarin, 19:15',

# &#x20;                   '2 Hari lalu, 09:00',

# &#x20;                 ];

# &#x20;                 return ListTile(

# &#x20;                   leading: const Icon(Icons.history, color: Colors.blue),

# &#x20;                   title: Text(riwayat\[index]),

# &#x20;                   subtitle: Text(waktu\[index]),

# &#x20;                 );

# &#x20;               },

# &#x20;             ),

# &#x20;           ),

# &#x20;         ],

# &#x20;       ),

# &#x20;     ),

# &#x20;   );

# &#x20; }

# 

# &#x20; // Widget helper untuk GridView agar kode lebih rapi

# &#x20; Widget \_buildGridItem(IconData icon, String title, MaterialColor color) {

# &#x20;   return Container(

# &#x20;     decoration: BoxDecoration(

# &#x20;       color: color\[50],

# &#x20;       borderRadius: BorderRadius.circular(15),

# &#x20;       border: Border.all(color: color\[200]!),

# &#x20;     ),

# &#x20;     child: Column(

# &#x20;       mainAxisAlignment: MainAxisAlignment.center,

# &#x20;       children: \[

# &#x20;         Icon(icon, size: 36, color: color\[700]),

# &#x20;         const SizedBox(height: 8),

# &#x20;         Text(

# &#x20;           title,

# &#x20;           style: TextStyle(

# &#x20;             color: color\[900],

# &#x20;             fontWeight: FontWeight.bold,

# &#x20;             fontSize: 12,

# &#x20;           ),

# &#x20;         ),

# &#x20;       ],

# &#x20;     ),

# &#x20;   );

# &#x20; }

# }

# ```

# 

# \---

# 

# \## Screenshots Output

# 

# \### Tampilan Bagian Atas

# 

# <img src="screenshots\hasil_ui.png" alt="Screenshot UI Atas" width="400">

# 

# \### Tampilan Bagian Bawah

# 

# <img src="screenshots\hasil_ui2.png" alt="Screenshot UI Bawah" width="400">

# 

# \---

# 

# \## Penjelasan Aplikasi \& Widget Terpakai

# 

# Aplikasi ini dikembangkan untuk memenuhi tugas eksplorasi Layout pada Flutter melalui studi kasus antarmuka \*\*Aplikasi Eksplorasi Kuliner\*\*. Halaman utama membungkus seluruh elemen di dalam `SingleChildScrollView` agar pengguna dapat melakukan \*scroll\* ke bawah tanpa khawatir elemen antarmuka terpotong (\*overflow\*). Keseluruhan UI dibangun dengan memenuhi 6 kriteria penggunaan widget utama secara terstruktur.

# 

# | No. | Widget | Penggunaan |

# |-----|--------|------------|

# | 1 | \*\*Container\*\* | Banner utama dengan `decoration` berisi gradient warna, `borderRadius`, dan `boxShadow`. |

# | 2 | \*\*Stack\*\* | Kartu promo yang menumpuk background berwarna, ikon makanan besar (diposisikan dengan `Positioned`), dan teks diskon. |

# | 3 | \*\*GridView\*\* | Menampilkan 6 ikon kategori makanan dalam grid 3 kolom menggunakan `GridView.count`. |

# | 4 | \*\*ListView\*\* | Daftar statis 3 item "Paket Hemat" menggunakan `Card` dan `ListTile`. |

# | 5 | \*\*ListView.builder\*\* | Daftar "Restoran Pilihan" yang dirender secara dinamis dari array `dataWarung` untuk efisiensi memori. |

# | 6 | \*\*ListView.separated\*\* | Log "Riwayat Transaksi" dengan pemisah otomatis berupa `Divider` antar item menggunakan `separatorBuilder`. |


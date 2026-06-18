# <div align="center">

# 

# \## LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM

# 

# \### MODUL 7

# \### MOBILE

# 

# <br>

# <br>

# 

# <img src="aset/logo.png" width="150">

# 

# <br>

# <br>

# 

# \*\*Disusun oleh:\*\*  

# \*\*Syafanida Khakiki\*\*  

# \*\*2311102005\*\*

# 

# <br>

# 

# \*\*KELAS PS1IF-11-REG01\*\*  

# \*\*Dosen: Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom\*\*

# 

# <br><br>

# 

# \## PROGRAM STUDI S1 TEKNIK INFORMATIKA <br> FAKULTAS INFORMATIKA <br> UNIVERSITAS TELKOM PURWOKERTO <br> 2026 <br><br>

# 

# </div>

# 

# \---

# 

# \## 1. Dasar Teori

# 

# Flutter adalah framework UI open-source dari Google yang memungkinkan pengembangan aplikasi mobile, web, dan desktop dari satu codebase menggunakan bahasa \*\*Dart\*\*. Pada modul ini, fokus pembelajaran adalah \*\*navigasi antar halaman\*\*, \*\*manajemen state dengan StatefulWidget\*\*, serta \*\*pengelolaan data dinamis\*\* menggunakan list.

# 

# \### Navigasi di Flutter

# 

# Flutter menggunakan konsep \*\*Navigator\*\* berbasis stack untuk berpindah antar halaman (route).

# 

# | Method | Deskripsi |

# |--------|-----------|

# | `Navigator.push()` | Membuka halaman baru dan menambahkannya ke stack navigasi. |

# | `Navigator.pop()` | Menutup halaman saat ini dan kembali ke halaman sebelumnya. |

# | `Navigator.pop(result)` | Menutup halaman dan mengembalikan data ke halaman pemanggil. |

# | `MaterialPageRoute` | Route bawaan Flutter dengan transisi bergaya Material Design. |

# 

# \### StatefulWidget vs StatelessWidget

# 

# | Widget | Deskripsi |

# |--------|-----------|

# | \*\*StatelessWidget\*\* | Widget statis tanpa state internal yang berubah. Cocok untuk tampilan tetap. |

# | \*\*StatefulWidget\*\* | Widget dengan state internal yang dapat berubah via `setState()`. Digunakan untuk elemen interaktif dan data dinamis. |

# 

# \### Widget dan Konsep Utama

# 

# | Konsep | Deskripsi |

# |--------|-----------|

# | \*\*Model Class\*\* | Class Dart untuk merepresentasikan struktur data (nama, NIM, kelas). Menggunakan `copyWith` untuk menghasilkan objek baru dari yang sudah ada. |

# | \*\*List\\<T\\>\*\* | Struktur data untuk menyimpan kumpulan objek secara dinamis. |

# | \*\*TextEditingController\*\* | Mengontrol dan membaca nilai dari `TextField`. Harus di-dispose untuk mencegah memory leak. |

# | \*\*TextField\*\* | Input field untuk menerima teks dari pengguna. |

# | \*\*ElevatedButton\*\* | Tombol Material Design dengan tampilan solid. |

# | \*\*SnackBar\*\* | Notifikasi sementara yang muncul di bagian bawah layar. |

# | \*\*ListView.builder\*\* | Membangun daftar secara efisien dan lazy dari sebuah List. |

# | \*\*AppBar\*\* | Bar navigasi di bagian atas layar. |

# 

# \### Google Fonts

# 

# Package `google\_fonts` memungkinkan penggunaan ratusan font dari Google Fonts tanpa mengunduh file font secara manual. Cukup tambahkan dependensi di `pubspec.yaml` dan panggil `GoogleFonts.namaFont()`.

# 

# \---

# 

# \## 2. Hasil Praktikum

# 

# \### Deskripsi Aplikasi

# 

# Aplikasi yang dibuat adalah \*\*Sistem Data Mahasiswa\*\* — sebuah aplikasi manajemen data mahasiswa sederhana. Pengguna dapat menambahkan data mahasiswa (Nama, NIM, Kelas) melalui form input, dan data tersebut akan tampil sebagai daftar di halaman utama. Aplikasi juga menampilkan jumlah data yang sudah tersimpan secara real-time.

# 

# \*\*Fitur utama:\*\*

# \- Halaman Home dengan daftar mahasiswa dinamis dan badge jumlah data

# \- State kosong yang informatif saat belum ada data

# \- Form input dengan validasi, tombol Reset, dan tombol Simpan

# \- Preview data sebelum ditambahkan ke daftar

# \- Tombol "Tambahkan ke Daftar" yang mengirim data ke halaman Home via `Navigator.pop()`

# \- Navigasi dua arah menggunakan `Navigator.push()` dan `Navigator.pop()`

# 

# \---

# 

# \### Langkah-Langkah Pembuatan

# 

# \*\*1.\*\* Buka \*\*Visual Studio Code\*\*, pastikan extension \*\*Flutter\*\* dan \*\*Dart\*\* sudah terpasang, lalu verifikasi instalasi dengan:

# 

# ```bash

# flutter doctor

# ```

# 

# \*\*2.\*\* Buat project Flutter baru melalui \*\*View → Command Palette → Flutter: New Project → Application\*\*, beri nama project `modul7\_mahasiswa`, lalu tekan Enter dan tunggu proses selesai.

# 

# \*\*3.\*\* Tambahkan package `google\_fonts` pada `pubspec.yaml`:

# 

# ```yaml

# dependencies:

# &#x20; flutter:

# &#x20;   sdk: flutter

# &#x20; google\_fonts: ^6.2.1

# ```

# 

# Lalu jalankan:

# 

# ```bash

# flutter pub get

# ```

# 

# \*\*4.\*\* Buat struktur file di dalam folder `lib/` sebagai berikut:

# 

# ```

# lib/

# ├── main.dart

# ├── models/

# │   └── mahasiswa.dart

# └── screens/

# &#x20;   ├── home\_screen.dart

# &#x20;   └── form\_screen.dart

# ```

# 

# \*\*5.\*\* Isi masing-masing file dengan kode berikut:

# 

# \*\*`lib/models/mahasiswa.dart`\*\*

# ```dart

# // lib/models/mahasiswa.dart

# // Model data untuk menyimpan informasi mahasiswa

# 

# class Mahasiswa {

# &#x20; final String nama;

# &#x20; final String nim;

# &#x20; final String kelas;

# 

# &#x20; const Mahasiswa({

# &#x20;   required this.nama,

# &#x20;   required this.nim,

# &#x20;   required this.kelas,

# &#x20; });

# 

# &#x20; // Salin objek dengan perubahan nilai tertentu

# &#x20; Mahasiswa copyWith({String? nama, String? nim, String? kelas}) {

# &#x20;   return Mahasiswa(

# &#x20;     nama:  nama  ?? this.nama,

# &#x20;     nim:   nim   ?? this.nim,

# &#x20;     kelas: kelas ?? this.kelas,

# &#x20;   );

# &#x20; }

# 

# &#x20; @override

# &#x20; String toString() => 'Mahasiswa(nama: $nama, nim: $nim, kelas: $kelas)';

# }

# ```

# 

# \*\*`lib/main.dart`\*\*

# ```dart

# import 'package:flutter/material.dart';

# import 'package:google\_fonts/google\_fonts.dart';

# import 'screens/home\_screen.dart';

# 

# void main() => runApp(const AppMahasiswa());

# 

# class AppMahasiswa extends StatelessWidget {

# &#x20; const AppMahasiswa({super.key});

# 

# &#x20; @override

# &#x20; Widget build(BuildContext context) {

# &#x20;   return MaterialApp(

# &#x20;     debugShowCheckedModeBanner: false,

# &#x20;     title: 'Data Mahasiswa',

# &#x20;     theme: ThemeData(

# &#x20;       useMaterial3: true,

# &#x20;       colorSchemeSeed: Colors.blue,

# &#x20;       textTheme: GoogleFonts.poppinsTextTheme(),

# &#x20;     ),

# &#x20;     home: const HomeScreen(),

# &#x20;   );

# &#x20; }

# }

# ```

# 

# \*\*`lib/screens/home\_screen.dart`\*\*

# ```dart

# import 'package:flutter/material.dart';

# import 'package:google\_fonts/google\_fonts.dart';

# import '../models/mahasiswa.dart';

# import 'form\_screen.dart';

# 

# class HomeScreen extends StatefulWidget {

# &#x20; const HomeScreen({super.key});

# 

# &#x20; @override

# &#x20; State<HomeScreen> createState() => \_HomeScreenState();

# }

# 

# class \_HomeScreenState extends State<HomeScreen> {

# &#x20; final List<Mahasiswa> \_daftarMahasiswa = \[];

# 

# &#x20; void \_navigasiKeForm() async {

# &#x20;   // Menunggu data yang dikembalikan dari FormScreen

# &#x20;   final Mahasiswa? mahasiswaBaru = await Navigator.push(

# &#x20;     context,

# &#x20;     MaterialPageRoute(builder: (\_) => const FormScreen()),

# &#x20;   );

# 

# &#x20;   if (mahasiswaBaru != null) {

# &#x20;     setState(() {

# &#x20;       \_daftarMahasiswa.add(mahasiswaBaru);

# &#x20;     });

# &#x20;   }

# &#x20; }

# 

# &#x20; @override

# &#x20; Widget build(BuildContext context) {

# &#x20;   return Scaffold(

# &#x20;     backgroundColor: const Color(0xFFF0F4FF),

# &#x20;     appBar: AppBar(

# &#x20;       backgroundColor: const Color(0xFF1A56DB),

# &#x20;       title: Text(

# &#x20;         'Data Mahasiswa',

# &#x20;         style: GoogleFonts.poppins(

# &#x20;             color: Colors.white, fontWeight: FontWeight.w700),

# &#x20;       ),

# &#x20;       centerTitle: true,

# &#x20;       actions: \[

# &#x20;         IconButton(

# &#x20;           icon: const Icon(Icons.person\_outline, color: Colors.white),

# &#x20;           onPressed: () {},

# &#x20;         ),

# &#x20;       ],

# &#x20;     ),

# &#x20;     body: Column(

# &#x20;       children: \[

# &#x20;         // Banner Header

# &#x20;         Container(

# &#x20;           margin: const EdgeInsets.all(16),

# &#x20;           padding: const EdgeInsets.all(16),

# &#x20;           decoration: BoxDecoration(

# &#x20;             color: const Color(0xFF1A56DB),

# &#x20;             borderRadius: BorderRadius.circular(16),

# &#x20;           ),

# &#x20;           child: Row(

# &#x20;             children: \[

# &#x20;               Container(

# &#x20;                 padding: const EdgeInsets.all(10),

# &#x20;                 decoration: BoxDecoration(

# &#x20;                   color: Colors.white.withOpacity(0.2),

# &#x20;                   borderRadius: BorderRadius.circular(12),

# &#x20;                 ),

# &#x20;                 child: const Icon(Icons.school, color: Colors.white, size: 28),

# &#x20;               ),

# &#x20;               const SizedBox(width: 14),

# &#x20;               Expanded(

# &#x20;                 child: Column(

# &#x20;                   crossAxisAlignment: CrossAxisAlignment.start,

# &#x20;                   children: \[

# &#x20;                     Text('Selamat Datang!',

# &#x20;                         style: GoogleFonts.poppins(

# &#x20;                             color: Colors.white70, fontSize: 12)),

# &#x20;                     Text('Sistem Data Mahasiswa',

# &#x20;                         style: GoogleFonts.poppins(

# &#x20;                             color: Colors.white,

# &#x20;                             fontSize: 16,

# &#x20;                             fontWeight: FontWeight.w700)),

# &#x20;                   ],

# &#x20;                 ),

# &#x20;               ),

# &#x20;               Container(

# &#x20;                 padding:

# &#x20;                     const EdgeInsets.symmetric(horizontal: 12, vertical: 6),

# &#x20;                 decoration: BoxDecoration(

# &#x20;                   color: Colors.white.withOpacity(0.2),

# &#x20;                   borderRadius: BorderRadius.circular(20),

# &#x20;                 ),

# &#x20;                 child: Text(

# &#x20;                   '${\_daftarMahasiswa.length} Data',

# &#x20;                   style: GoogleFonts.poppins(

# &#x20;                       color: Colors.white,

# &#x20;                       fontSize: 12,

# &#x20;                       fontWeight: FontWeight.w600),

# &#x20;                 ),

# &#x20;               ),

# &#x20;             ],

# &#x20;           ),

# &#x20;         ),

# 

# &#x20;         // Daftar Mahasiswa atau Empty State

# &#x20;         Expanded(

# &#x20;           child: \_daftarMahasiswa.isEmpty

# &#x20;               ? Center(

# &#x20;                   child: Column(

# &#x20;                     mainAxisSize: MainAxisSize.min,

# &#x20;                     children: \[

# &#x20;                       Icon(Icons.group\_outlined,

# &#x20;                           size: 72, color: Colors.grey.shade400),

# &#x20;                       const SizedBox(height: 16),

# &#x20;                       Text('Belum ada data mahasiswa',

# &#x20;                           style: GoogleFonts.poppins(

# &#x20;                               fontSize: 15,

# &#x20;                               fontWeight: FontWeight.w600,

# &#x20;                               color: Colors.grey.shade500)),

# &#x20;                       const SizedBox(height: 6),

# &#x20;                       Text('tekan tombol di bawah untuk menambahkan',

# &#x20;                           style: GoogleFonts.poppins(

# &#x20;                               fontSize: 12, color: Colors.grey.shade400)),

# &#x20;                     ],

# &#x20;                   ),

# &#x20;                 )

# &#x20;               : ListView.builder(

# &#x20;                   padding: const EdgeInsets.symmetric(horizontal: 16),

# &#x20;                   itemCount: \_daftarMahasiswa.length,

# &#x20;                   itemBuilder: (context, index) {

# &#x20;                     final mhs = \_daftarMahasiswa\[index];

# &#x20;                     return Container(

# &#x20;                       margin: const EdgeInsets.only(bottom: 10),

# &#x20;                       padding: const EdgeInsets.all(14),

# &#x20;                       decoration: BoxDecoration(

# &#x20;                         color: Colors.white,

# &#x20;                         borderRadius: BorderRadius.circular(14),

# &#x20;                         border: Border.all(color: const Color(0xFFE5E7EB)),

# &#x20;                       ),

# &#x20;                       child: Row(

# &#x20;                         children: \[

# &#x20;                           Container(

# &#x20;                             width: 36,

# &#x20;                             height: 36,

# &#x20;                             alignment: Alignment.center,

# &#x20;                             decoration: BoxDecoration(

# &#x20;                               color: const Color(0xFF1A56DB),

# &#x20;                               borderRadius: BorderRadius.circular(10),

# &#x20;                             ),

# &#x20;                             child: Text('${index + 1}',

# &#x20;                                 style: GoogleFonts.poppins(

# &#x20;                                     color: Colors.white,

# &#x20;                                     fontWeight: FontWeight.w700)),

# &#x20;                           ),

# &#x20;                           const SizedBox(width: 14),

# &#x20;                           Expanded(

# &#x20;                             child: Column(

# &#x20;                               crossAxisAlignment: CrossAxisAlignment.start,

# &#x20;                               children: \[

# &#x20;                                 Text(mhs.nama,

# &#x20;                                     style: GoogleFonts.poppins(

# &#x20;                                         fontWeight: FontWeight.w700,

# &#x20;                                         fontSize: 14)),

# &#x20;                                 const SizedBox(height: 4),

# &#x20;                                 Row(

# &#x20;                                   children: \[

# &#x20;                                     const Icon(Icons.badge\_outlined,

# &#x20;                                         size: 12, color: Colors.grey),

# &#x20;                                     const SizedBox(width: 4),

# &#x20;                                     Text(mhs.nim,

# &#x20;                                         style: GoogleFonts.poppins(

# &#x20;                                             fontSize: 12,

# &#x20;                                             color: Colors.grey.shade600)),

# &#x20;                                     const SizedBox(width: 12),

# &#x20;                                     const Icon(Icons.class\_outlined,

# &#x20;                                         size: 12, color: Colors.grey),

# &#x20;                                     const SizedBox(width: 4),

# &#x20;                                     Text(mhs.kelas,

# &#x20;                                         style: GoogleFonts.poppins(

# &#x20;                                             fontSize: 12,

# &#x20;                                             color: Colors.grey.shade600)),

# &#x20;                                   ],

# &#x20;                                 ),

# &#x20;                               ],

# &#x20;                             ),

# &#x20;                           ),

# &#x20;                           Container(

# &#x20;                             padding: const EdgeInsets.symmetric(

# &#x20;                                 horizontal: 10, vertical: 4),

# &#x20;                             decoration: BoxDecoration(

# &#x20;                               color: const Color(0xFFEBF5FF),

# &#x20;                               borderRadius: BorderRadius.circular(8),

# &#x20;                             ),

# &#x20;                             child: Text(mhs.kelas,

# &#x20;                                 style: GoogleFonts.poppins(

# &#x20;                                     fontSize: 11,

# &#x20;                                     fontWeight: FontWeight.w600,

# &#x20;                                     color: const Color(0xFF1A56DB))),

# &#x20;                           ),

# &#x20;                         ],

# &#x20;                       ),

# &#x20;                     );

# &#x20;                   },

# &#x20;                 ),

# &#x20;         ),

# &#x20;       ],

# &#x20;     ),

# 

# &#x20;     // Tombol Tambah Mahasiswa

# &#x20;     floatingActionButton: FloatingActionButton.extended(

# &#x20;       onPressed: \_navigasiKeForm,

# &#x20;       backgroundColor: const Color(0xFF1A56DB),

# &#x20;       icon: const Icon(Icons.add, color: Colors.white),

# &#x20;       label: Text('Tambah Mahasiswa',

# &#x20;           style: GoogleFonts.poppins(

# &#x20;               color: Colors.white, fontWeight: FontWeight.w600)),

# &#x20;     ),

# &#x20;     floatingActionButtonLocation: FloatingActionButtonLocation.centerFloat,

# &#x20;   );

# &#x20; }

# }

# ```

# 

# \*\*`lib/screens/form\_screen.dart`\*\*

# ```dart

# import 'package:flutter/material.dart';

# import 'package:google\_fonts/google\_fonts.dart';

# import '../models/mahasiswa.dart';

# 

# class FormScreen extends StatefulWidget {

# &#x20; const FormScreen({super.key});

# 

# &#x20; @override

# &#x20; State<FormScreen> createState() => \_FormScreenState();

# }

# 

# class \_FormScreenState extends State<FormScreen> {

# &#x20; final \_namaController  = TextEditingController();

# &#x20; final \_nimController   = TextEditingController();

# &#x20; final \_kelasController = TextEditingController();

# 

# &#x20; Mahasiswa? \_preview;

# 

# &#x20; void \_simpan() {

# &#x20;   if (\_namaController.text.isEmpty ||

# &#x20;       \_nimController.text.isEmpty ||

# &#x20;       \_kelasController.text.isEmpty) {

# &#x20;     ScaffoldMessenger.of(context).showSnackBar(

# &#x20;       SnackBar(

# &#x20;         content: Text('Harap isi semua field!',

# &#x20;             style: GoogleFonts.poppins()),

# &#x20;         backgroundColor: Colors.redAccent,

# &#x20;         behavior: SnackBarBehavior.floating,

# &#x20;       ),

# &#x20;     );

# &#x20;     return;

# &#x20;   }

# 

# &#x20;   setState(() {

# &#x20;     \_preview = Mahasiswa(

# &#x20;       nama:  \_namaController.text.trim(),

# &#x20;       nim:   \_nimController.text.trim(),

# &#x20;       kelas: \_kelasController.text.trim(),

# &#x20;     );

# &#x20;   });

# 

# &#x20;   ScaffoldMessenger.of(context).showSnackBar(

# &#x20;     SnackBar(

# &#x20;       content: Text('Data berhasil disimpan! ✅',

# &#x20;           style: GoogleFonts.poppins(fontWeight: FontWeight.w600)),

# &#x20;       backgroundColor: Colors.green,

# &#x20;       behavior: SnackBarBehavior.floating,

# &#x20;       shape:

# &#x20;           RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),

# &#x20;     ),

# &#x20;   );

# &#x20; }

# 

# &#x20; void \_reset() {

# &#x20;   \_namaController.clear();

# &#x20;   \_nimController.clear();

# &#x20;   \_kelasController.clear();

# &#x20;   setState(() => \_preview = null);

# &#x20; }

# 

# &#x20; void \_tambahkanKeDaftar() {

# &#x20;   if (\_preview == null) {

# &#x20;     ScaffoldMessenger.of(context).showSnackBar(

# &#x20;       SnackBar(

# &#x20;         content: Text('Simpan data terlebih dahulu!',

# &#x20;             style: GoogleFonts.poppins()),

# &#x20;         backgroundColor: Colors.orange,

# &#x20;         behavior: SnackBarBehavior.floating,

# &#x20;       ),

# &#x20;     );

# &#x20;     return;

# &#x20;   }

# &#x20;   // Mengembalikan data ke HomeScreen

# &#x20;   Navigator.pop(context, \_preview);

# &#x20; }

# 

# &#x20; @override

# &#x20; void dispose() {

# &#x20;   \_namaController.dispose();

# &#x20;   \_nimController.dispose();

# &#x20;   \_kelasController.dispose();

# &#x20;   super.dispose();

# &#x20; }

# 

# &#x20; @override

# &#x20; Widget build(BuildContext context) {

# &#x20;   return Scaffold(

# &#x20;     backgroundColor: const Color(0xFFF0F4FF),

# &#x20;     appBar: AppBar(

# &#x20;       backgroundColor: const Color(0xFF1A56DB),

# &#x20;       leading: IconButton(

# &#x20;         icon: const Icon(Icons.arrow\_back, color: Colors.white),

# &#x20;         onPressed: () => Navigator.pop(context),

# &#x20;       ),

# &#x20;       title: Text('Form Mahasiswa',

# &#x20;           style: GoogleFonts.poppins(

# &#x20;               color: Colors.white, fontWeight: FontWeight.w700)),

# &#x20;       centerTitle: true,

# &#x20;     ),

# &#x20;     body: SingleChildScrollView(

# &#x20;       padding: const EdgeInsets.all(20),

# &#x20;       child: Column(

# &#x20;         crossAxisAlignment: CrossAxisAlignment.start,

# &#x20;         children: \[

# &#x20;           Text('Isi Data Mahasiswa',

# &#x20;               style: GoogleFonts.poppins(

# &#x20;                   fontSize: 16,

# &#x20;                   fontWeight: FontWeight.w700,

# &#x20;                   color: const Color(0xFF1A56DB))),

# &#x20;           const SizedBox(height: 16),

# 

# &#x20;           // Form Card

# &#x20;           Container(

# &#x20;             padding: const EdgeInsets.all(20),

# &#x20;             decoration: BoxDecoration(

# &#x20;               color: Colors.white,

# &#x20;               borderRadius: BorderRadius.circular(16),

# &#x20;               border: Border.all(color: const Color(0xFFE5E7EB)),

# &#x20;             ),

# &#x20;             child: Column(

# &#x20;               children: \[

# &#x20;                 \_buildField(

# &#x20;                   controller: \_namaController,

# &#x20;                   label: 'Nama Lengkap',

# &#x20;                   icon: Icons.person\_outline,

# &#x20;                 ),

# &#x20;                 const SizedBox(height: 14),

# &#x20;                 \_buildField(

# &#x20;                   controller: \_nimController,

# &#x20;                   label: 'N I M',

# &#x20;                   icon: Icons.badge\_outlined,

# &#x20;                   keyboardType: TextInputType.number,

# &#x20;                 ),

# &#x20;                 const SizedBox(height: 14),

# &#x20;                 \_buildField(

# &#x20;                   controller: \_kelasController,

# &#x20;                   label: 'Kelas',

# &#x20;                   icon: Icons.class\_outlined,

# &#x20;                 ),

# &#x20;                 const SizedBox(height: 20),

# &#x20;                 Row(

# &#x20;                   children: \[

# &#x20;                     Expanded(

# &#x20;                       child: OutlinedButton.icon(

# &#x20;                         onPressed: \_reset,

# &#x20;                         icon: const Icon(Icons.refresh\_rounded),

# &#x20;                         label: Text('Reset',

# &#x20;                             style: GoogleFonts.poppins(

# &#x20;                                 fontWeight: FontWeight.w600)),

# &#x20;                         style: OutlinedButton.styleFrom(

# &#x20;                           padding: const EdgeInsets.symmetric(vertical: 14),

# &#x20;                           side: const BorderSide(color: Color(0xFF1A56DB)),

# &#x20;                           foregroundColor: const Color(0xFF1A56DB),

# &#x20;                           shape: RoundedRectangleBorder(

# &#x20;                               borderRadius: BorderRadius.circular(12)),

# &#x20;                         ),

# &#x20;                       ),

# &#x20;                     ),

# &#x20;                     const SizedBox(width: 12),

# &#x20;                     Expanded(

# &#x20;                       flex: 2,

# &#x20;                       child: ElevatedButton.icon(

# &#x20;                         onPressed: \_simpan,

# &#x20;                         icon: const Icon(Icons.save\_rounded,

# &#x20;                             color: Colors.white),

# &#x20;                         label: Text('Simpan',

# &#x20;                             style: GoogleFonts.poppins(

# &#x20;                                 color: Colors.white,

# &#x20;                                 fontWeight: FontWeight.w600)),

# &#x20;                         style: ElevatedButton.styleFrom(

# &#x20;                           backgroundColor: const Color(0xFF1A56DB),

# &#x20;                           padding: const EdgeInsets.symmetric(vertical: 14),

# &#x20;                           shape: RoundedRectangleBorder(

# &#x20;                               borderRadius: BorderRadius.circular(12)),

# &#x20;                         ),

# &#x20;                       ),

# &#x20;                     ),

# &#x20;                   ],

# &#x20;                 ),

# &#x20;               ],

# &#x20;             ),

# &#x20;           ),

# 

# &#x20;           // Preview Data

# &#x20;           if (\_preview != null) ...\[

# &#x20;             const SizedBox(height: 20),

# &#x20;             Container(

# &#x20;               width: double.infinity,

# &#x20;               padding: const EdgeInsets.all(16),

# &#x20;               decoration: BoxDecoration(

# &#x20;                 color: const Color(0xFFECFDF5),

# &#x20;                 borderRadius: BorderRadius.circular(16),

# &#x20;                 border: Border.all(color: const Color(0xFF6EE7B7)),

# &#x20;               ),

# &#x20;               child: Column(

# &#x20;                 crossAxisAlignment: CrossAxisAlignment.start,

# &#x20;                 children: \[

# &#x20;                   Row(

# &#x20;                     children: \[

# &#x20;                       const Icon(Icons.check\_circle\_rounded,

# &#x20;                           color: Colors.green, size: 20),

# &#x20;                       const SizedBox(width: 8),

# &#x20;                       Text('Data Berhasil Disimpan',

# &#x20;                           style: GoogleFonts.poppins(

# &#x20;                               fontWeight: FontWeight.w700,

# &#x20;                               color: Colors.green.shade700)),

# &#x20;                     ],

# &#x20;                   ),

# &#x20;                   const SizedBox(height: 12),

# &#x20;                   \_previewRow(Icons.person\_outline, 'Nama: ${\_preview!.nama}'),

# &#x20;                   const SizedBox(height: 6),

# &#x20;                   \_previewRow(Icons.badge\_outlined, 'NIM: ${\_preview!.nim}'),

# &#x20;                   const SizedBox(height: 6),

# &#x20;                   \_previewRow(Icons.class\_outlined, 'Kelas: ${\_preview!.kelas}'),

# &#x20;                 ],

# &#x20;               ),

# &#x20;             ),

# &#x20;             const SizedBox(height: 14),

# &#x20;             SizedBox(

# &#x20;               width: double.infinity,

# &#x20;               child: ElevatedButton.icon(

# &#x20;                 onPressed: \_tambahkanKeDaftar,

# &#x20;                 icon: const Icon(Icons.send\_rounded, color: Colors.white),

# &#x20;                 label: Text('Tambahkan ke Daftar',

# &#x20;                     style: GoogleFonts.poppins(

# &#x20;                         color: Colors.white,

# &#x20;                         fontWeight: FontWeight.w600,

# &#x20;                         fontSize: 15)),

# &#x20;                 style: ElevatedButton.styleFrom(

# &#x20;                   backgroundColor: Colors.green.shade700,

# &#x20;                   padding: const EdgeInsets.symmetric(vertical: 16),

# &#x20;                   shape: RoundedRectangleBorder(

# &#x20;                       borderRadius: BorderRadius.circular(14)),

# &#x20;                 ),

# &#x20;               ),

# &#x20;             ),

# &#x20;           ],

# &#x20;         ],

# &#x20;       ),

# &#x20;     ),

# &#x20;   );

# &#x20; }

# 

# &#x20; Widget \_buildField({

# &#x20;   required TextEditingController controller,

# &#x20;   required String label,

# &#x20;   required IconData icon,

# &#x20;   TextInputType keyboardType = TextInputType.text,

# &#x20; }) {

# &#x20;   return TextField(

# &#x20;     controller: controller,

# &#x20;     keyboardType: keyboardType,

# &#x20;     decoration: InputDecoration(

# &#x20;       labelText: label,

# &#x20;       labelStyle: GoogleFonts.poppins(fontSize: 13),

# &#x20;       prefixIcon: Icon(icon, color: const Color(0xFF1A56DB)),

# &#x20;       border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),

# &#x20;       focusedBorder: OutlineInputBorder(

# &#x20;         borderRadius: BorderRadius.circular(12),

# &#x20;         borderSide:

# &#x20;             const BorderSide(color: Color(0xFF1A56DB), width: 2),

# &#x20;       ),

# &#x20;       contentPadding:

# &#x20;           const EdgeInsets.symmetric(horizontal: 14, vertical: 14),

# &#x20;     ),

# &#x20;   );

# &#x20; }

# 

# &#x20; Widget \_previewRow(IconData icon, String text) {

# &#x20;   return Row(

# &#x20;     children: \[

# &#x20;       Icon(icon, size: 16, color: Colors.green.shade600),

# &#x20;       const SizedBox(width: 8),

# &#x20;       Text(text,

# &#x20;           style: GoogleFonts.poppins(

# &#x20;               fontSize: 13, color: Colors.green.shade800)),

# &#x20;     ],

# &#x20;   );

# &#x20; }

# }

# ```

# 

# \*\*6.\*\* Jalankan aplikasi dengan perintah berikut:

# 

# ```bash

# flutter run

# ```

# 

# Atau untuk menjalankan di emulator spesifik:

# 

# ```bash

# flutter run -d "sdk gphone64 x86 64"

# ```

# 

# \---

# 

# \### Output

# 

# \*\*Output 1 — Halaman Home (State Kosong)\*\*

# 

# Tampilan awal aplikasi saat belum ada data mahasiswa yang ditambahkan. Menampilkan banner "Sistem Data Mahasiswa" dengan badge "0 Data" dan pesan kosong informatif.

# 

# !\[Output 1 - Home Kosong](output1.png)

# 

# \---

# 

# \*\*Output 2 — Halaman Form Mahasiswa\*\*

# 

# Halaman form setelah data diisi (Nama: Syafanida Khakiki, NIM: 2311102005, Kelas: IF 11 01) dan tombol Simpan ditekan. Menampilkan preview data dalam card hijau dan tombol "Tambahkan ke Daftar".

# 

# !\[Output 2 - Form Mahasiswa](output2.png)

# 

# \---

# 

# \*\*Output 3 — Halaman Home (Setelah Data Ditambah)\*\*

# 

# Halaman Home setelah berhasil menambahkan data. Badge berubah menjadi "1 Data" dan daftar mahasiswa menampilkan kartu data Syafanida Khakiki beserta chip kelas.

# 

# !\[Output 3 - Home dengan Data](output3.png)

# 

# \---

# 

# \## 3. Penjelasan Kode

# 

# \### 3.1 Model Class `Mahasiswa`

# 

# Class `Mahasiswa` merepresentasikan struktur data seorang mahasiswa dengan tiga properti: `nama`, `nim`, dan `kelas`. Method `copyWith` digunakan untuk membuat objek baru berdasarkan objek yang sudah ada dengan beberapa nilai yang diubah, tanpa memodifikasi objek asli (immutability).

# 

# ```dart

# class Mahasiswa {

# &#x20; final String nama;

# &#x20; final String nim;

# &#x20; final String kelas;

# 

# &#x20; const Mahasiswa({required this.nama, required this.nim, required this.kelas});

# 

# &#x20; Mahasiswa copyWith({String? nama, String? nim, String? kelas}) {

# &#x20;   return Mahasiswa(

# &#x20;     nama:  nama  ?? this.nama,

# &#x20;     nim:   nim   ?? this.nim,

# &#x20;     kelas: kelas ?? this.kelas,

# &#x20;   );

# &#x20; }

# }

# ```

# 

# \---

# 

# \### 3.2 Navigasi dengan Pengiriman Data (push \& pop)

# 

# Navigasi pada aplikasi ini menggunakan pola \*\*push-and-return\*\*: `HomeScreen` membuka `FormScreen` menggunakan `Navigator.push()` sambil menunggu nilai kembalian (`await`). Saat pengguna menekan "Tambahkan ke Daftar", `FormScreen` memanggil `Navigator.pop(context, \_preview)` untuk mengembalikan objek `Mahasiswa` ke `HomeScreen`, yang kemudian menambahkannya ke daftar dengan `setState()`.

# 

# ```dart

# // HomeScreen — menunggu data kembali

# final Mahasiswa? mahasiswaBaru = await Navigator.push(

# &#x20; context,

# &#x20; MaterialPageRoute(builder: (\_) => const FormScreen()),

# );

# if (mahasiswaBaru != null) {

# &#x20; setState(() => \_daftarMahasiswa.add(mahasiswaBaru));

# }

# 

# // FormScreen — mengembalikan data

# Navigator.pop(context, \_preview);

# ```

# 

# \---

# 

# \### 3.3 StatefulWidget pada HomeScreen dan FormScreen

# 

# Kedua halaman menggunakan `StatefulWidget` karena memiliki state yang berubah. `HomeScreen` menyimpan `List<Mahasiswa> \_daftarMahasiswa` yang bertambah setiap kali data baru diterima. `FormScreen` menyimpan `\_preview` yang diperbarui saat tombol Simpan ditekan.

# 

# ```dart

# // HomeScreen

# final List<Mahasiswa> \_daftarMahasiswa = \[];

# 

# // FormScreen

# Mahasiswa? \_preview;

# 

# void \_simpan() {

# &#x20; setState(() {

# &#x20;   \_preview = Mahasiswa(

# &#x20;     nama: \_namaController.text.trim(), ...

# &#x20;   );

# &#x20; });

# }

# ```

# 

# \---

# 

# \### 3.4 Empty State dan ListView.builder

# 

# `HomeScreen` menampilkan dua kondisi berbeda berdasarkan isi `\_daftarMahasiswa`. Jika kosong, tampilkan widget empty state dengan ikon dan teks informatif. Jika ada data, tampilkan `ListView.builder` yang membangun kartu mahasiswa secara efisien dan lazy.

# 

# ```dart

# child: \_daftarMahasiswa.isEmpty

# &#x20;   ? Center(child: Column(...)) // Empty state

# &#x20;   : ListView.builder(

# &#x20;       itemCount: \_daftarMahasiswa.length,

# &#x20;       itemBuilder: (context, index) {

# &#x20;         final mhs = \_daftarMahasiswa\[index];

# &#x20;         return Container(...); // Kartu mahasiswa

# &#x20;       },

# &#x20;     ),

# ```

# 

# \---

# 

# \### 3.5 SnackBar sebagai Notifikasi

# 

# `SnackBar` ditampilkan dalam tiga kondisi: validasi gagal (merah), data berhasil disimpan (hijau), dan pengingat untuk simpan dahulu (oranye). Properti `behavior: SnackBarBehavior.floating` membuat SnackBar melayang di atas konten.

# 

# ```dart

# ScaffoldMessenger.of(context).showSnackBar(

# &#x20; SnackBar(

# &#x20;   content: Text('Data berhasil disimpan! ✅'),

# &#x20;   backgroundColor: Colors.green,

# &#x20;   behavior: SnackBarBehavior.floating,

# &#x20;   shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),

# &#x20; ),

# );

# ```

# 

# \---

# 

# \### 3.6 TextEditingController dan Dispose

# 

# Setiap `TextField` dikontrol oleh `TextEditingController`. Nilai dibaca melalui `.text` dan seluruh controller dibersihkan pada `dispose()` untuk menghindari memory leak.

# 

# ```dart

# final \_namaController = TextEditingController();

# 

# // Membaca nilai

# String nama = \_namaController.text.trim();

# 

# // Mereset field

# \_namaController.clear();

# 

# // Membersihkan resource

# @override

# void dispose() {

# &#x20; \_namaController.dispose();

# &#x20; \_nimController.dispose();

# &#x20; \_kelasController.dispose();

# &#x20; super.dispose();

# }

# ```

# 

# \---

# 

# \### 3.7 Google Fonts

# 

# Package `google\_fonts` digunakan untuk menerapkan font \*\*Poppins\*\* secara global melalui `ThemeData` dan digunakan langsung pada setiap widget `Text` untuk konsistensi tipografi di seluruh aplikasi.

# 

# ```dart

# // Global via ThemeData

# theme: ThemeData(

# &#x20; textTheme: GoogleFonts.poppinsTextTheme(),

# ),

# 

# // Per widget

# Text('Nama', style: GoogleFonts.poppins(fontWeight: FontWeight.w600)),

# ```

# 

# \---


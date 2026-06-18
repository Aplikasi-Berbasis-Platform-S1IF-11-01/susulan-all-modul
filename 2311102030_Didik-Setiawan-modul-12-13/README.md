

<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br>Aplikasi-Berbasis-Platform
</h1>
  <br />
  <h3>MODUL 12 & 13
 <br> IMPLEMENTASI PROVIDER DAN NOTIFIKASI PADA FLUTTER</h3>
  <br />
  <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F1.bp.blogspot.com%2F-vb7jyBjK-sM%2FXXfKp51LrjI%2FAAAAAAAACts%2FEjcXzlgZwSswNWXsBHMyX-6aav1mjA77QCPcBGAYYCw%2Fs1600%2FLogo_Telkom_University_potrait.png&f=1&nofb=1&ipt=9d030d54102ea96369d39fe491220e0536195abc8ee443279c1a420302206400" alt="Logo Telkom" width="300"> 
  <br /><br /><br />
  
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Didik Setiawan</strong><br>
    <strong>2311102030</strong><br>
    <strong>IF-11-REG-01</strong>
  </p>
  <br />
  
  <h3>Dosen Pengampu :</h3>
  <p><strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong></p>
  <br />
  
  <h4>Asisten Praktikum :</h4>
  <strong>Apri Pandu Wicaksono</strong> <br>
  <strong>Rangga Pradarrell Fathi</strong>
  <br />
  
  <h3>LABORATORIUM HIGH PERFORMANCE<br>FAKULTAS INFORMATIKA<br>UNIVERSITAS TELKOM PURWOKERTO<br>2026</h3>
</div>


# DASAR TEORI

Flutter merupakan framework open-source yang dikembangkan oleh Google untuk membangun aplikasi lintas platform menggunakan bahasa pemrograman Dart. Salah satu keunggulan Flutter adalah kemampuannya dalam mengelola state aplikasi secara efisien menggunakan berbagai pendekatan, salah satunya adalah **Provider**.

Provider merupakan package yang digunakan untuk menerapkan state management sehingga data dapat dibagikan dan diperbarui secara terpusat pada seluruh widget yang membutuhkan. Selain itu, Flutter juga mendukung implementasi **Local Notification** yang memungkinkan aplikasi memberikan pemberitahuan kepada pengguna secara langsung tanpa memerlukan koneksi internet.

Pada praktikum ini, Provider digunakan untuk mengelola nilai counter secara real-time, sedangkan Flutter Local Notifications digunakan untuk menampilkan notifikasi setiap kali nilai counter mengalami perubahan.

---

# Fitur Aplikasi

* Menampilkan nilai counter pada halaman utama
* Menggunakan Provider sebagai state management
* Mengimplementasikan ChangeNotifier untuk mengelola perubahan data
* Memperbarui tampilan secara otomatis ketika nilai counter berubah
* Menampilkan notifikasi lokal setiap kali tombol counter ditekan
* Menggunakan Consumer untuk mendengarkan perubahan state
* Menggunakan Material Design 3
* Interface sederhana dan responsif

---

# Package yang Digunakan

Tambahkan dependency berikut pada file `pubspec.yaml`:

```yaml
dependencies:
  flutter:
    sdk: flutter

  provider: ^6.1.2
  flutter_local_notifications: ^19.0.0
```

---

# Penjelasan Source Code

## 1. Import Package

```dart
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'counter_provider.dart';
```

Digunakan untuk mengakses widget Flutter, Provider sebagai state management, layanan notifikasi lokal, serta file provider yang mengelola data counter.

---

## 2. FlutterLocalNotificationsPlugin

```dart
final FlutterLocalNotificationsPlugin
flutterLocalNotificationsPlugin =
FlutterLocalNotificationsPlugin();
```

Membuat instance plugin yang digunakan untuk mengelola notifikasi lokal pada aplikasi.

---

## 3. Fungsi Main

```dart
void main() async
```

Merupakan titik awal aplikasi yang dijalankan pertama kali saat aplikasi dibuka.

Pada fungsi ini dilakukan:

* Inisialisasi Flutter Binding
* Inisialisasi sistem notifikasi lokal
* Permintaan izin notifikasi
* Menjalankan aplikasi menggunakan widget MyApp

---

## 4. WidgetsFlutterBinding

```dart
WidgetsFlutterBinding.ensureInitialized();
```

Digunakan untuk memastikan seluruh layanan Flutter telah siap sebelum menjalankan proses asynchronous.

---

## 5. Inisialisasi Notifikasi

```dart
flutterLocalNotificationsPlugin.initialize()
```

Digunakan untuk mengaktifkan layanan notifikasi lokal sebelum aplikasi digunakan.

---

## 6. Request Permission

```dart
requestNotificationsPermission()
```

Berfungsi meminta izin kepada pengguna agar aplikasi dapat menampilkan notifikasi, terutama pada Android 13 ke atas.

---

## 7. Class MyApp

```dart
class MyApp extends StatelessWidget
```

Merupakan widget utama yang mengatur konfigurasi aplikasi seperti tema, state management, dan halaman awal.

---

## 8. ChangeNotifierProvider

```dart
ChangeNotifierProvider(
```

Digunakan untuk menyediakan objek Provider sehingga dapat diakses oleh seluruh widget yang berada di bawahnya.

---

## 9. CounterProvider

```dart
class CounterProvider extends ChangeNotifier
```

Merupakan class yang bertugas mengelola state nilai counter.

Provider ini menyimpan:

* Nilai counter
* Fungsi penambahan nilai counter
* Notifikasi perubahan state

---

## 10. Variabel Counter

```dart
int _count = 0;
```

Digunakan untuk menyimpan nilai counter secara privat.

---

## 11. Getter Counter

```dart
int get count => _count;
```

Digunakan untuk memberikan akses pembacaan nilai counter dari luar class.

---

## 12. Fungsi Increment

```dart
void increment()
```

Berfungsi untuk menambah nilai counter sebanyak satu setiap kali tombol ditekan.

---

## 13. notifyListeners()

```dart
notifyListeners();
```

Digunakan untuk memberitahu seluruh widget yang mendengarkan Provider bahwa terjadi perubahan data sehingga tampilan dapat diperbarui secara otomatis.

---

## 14. MaterialApp

```dart
MaterialApp(
```

Widget utama Flutter yang digunakan untuk mengatur tema dan halaman awal aplikasi.

---

## 15. ThemeData

```dart
ThemeData(
```

Digunakan untuk menentukan tampilan global aplikasi dengan Material Design 3.

---

## 16. CounterPage

```dart
class CounterPage extends StatelessWidget
```

Merupakan halaman utama yang menampilkan nilai counter dan tombol untuk menambah nilai.

---

## 17. Consumer

```dart
Consumer<CounterProvider>(
```

Digunakan untuk mendengarkan perubahan state dari CounterProvider dan memperbarui tampilan secara otomatis.

---

## 18. Menampilkan Nilai Counter

```dart
counterProvider.count
```

Digunakan untuk mengambil nilai counter dari Provider dan menampilkannya pada layar.

---

## 19. ElevatedButton

```dart
ElevatedButton.icon(
```

Digunakan sebagai tombol utama untuk menambah nilai counter.

---

## 20. Provider.of()

```dart
Provider.of<CounterProvider>(
```

Digunakan untuk mengakses data dan fungsi yang terdapat pada CounterProvider.

---

## 21. Menambah Nilai Counter

```dart
counterProvider.increment();
```

Menjalankan fungsi increment untuk memperbarui nilai counter.

---

## 22. Fungsi Notifikasi

```dart
_showNotification()
```

Digunakan untuk menampilkan notifikasi setiap kali nilai counter berubah.

---

## 23. AndroidNotificationDetails

```dart
AndroidNotificationDetails(
```

Digunakan untuk menentukan konfigurasi notifikasi Android seperti channel, prioritas, dan tingkat kepentingan notifikasi.

---

## 24. NotificationDetails

```dart
NotificationDetails(
```

Menyimpan konfigurasi notifikasi yang akan digunakan saat notifikasi ditampilkan.

---

## 25. Menampilkan Notifikasi

```dart
flutterLocalNotificationsPlugin.show()
```

Digunakan untuk mengirim notifikasi ke perangkat pengguna.

Isi notifikasi:

```text
Counter Update
Nilai counter saat ini: [nilai counter]
```

---

# State Management Provider

## CounterProvider

Provider digunakan sebagai pusat pengelolaan data counter.

Fungsi utama:

* Menyimpan state counter
* Memperbarui nilai counter
* Memberikan notifikasi perubahan data ke widget terkait

Keuntungan penggunaan Provider:

* Kode lebih terstruktur
* Mudah dikelola
* Performa lebih baik dibanding setState pada skala aplikasi yang lebih besar

---

# Tampilan Aplikasi

## Halaman Utama

* AppBar
* Informasi nilai counter
* Tombol Tambah (+)
![Alt 1](https://raw.githubusercontent.com/didiksetia1/asset/2c3d00c859e4b78b4658a5e2a21fb4a34d1c375d/WhatsApp%20Image%202026-06-18%20at%2023.04.04.jpeg)



## Notifikasi

* Muncul setiap tombol ditekan
* Menampilkan nilai counter terbaru
 ![Alt 1](https://raw.githubusercontent.com/didiksetia1/asset/refs/heads/main/WhatsApp%20Image%202026-06-18%20at%2023.04.04%20(2).jpeg)
---

# Teknologi yang Digunakan

* Flutter
* Dart
* Provider
* Flutter Local Notifications
* Material Design 3

---

# Kesimpulan

Pada Praktik Modul 12 dan 13 berhasil dibuat aplikasi Flutter yang menerapkan state management menggunakan Provider serta notifikasi lokal menggunakan Flutter Local Notifications. Provider digunakan untuk mengelola perubahan nilai counter secara terpusat dan efisien, sedangkan notifikasi lokal memberikan informasi kepada pengguna setiap kali terjadi perubahan nilai counter. Implementasi ini menunjukkan bagaimana Flutter dapat mengelola state aplikasi dengan baik sekaligus berinteraksi dengan fitur sistem operasi melalui notifikasi lokal.

<h1 align="center">LAPORAN PRAKTIKUM</h1>
<h1 align="center">APLIKASI BERBASIS PLATFORM</h1>

<br>

<h2 align="center">MODUL 12 & 13</h2>
<h2 align="center">Implementasi Provider dan Notifikasi pada Flutter</h2>

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
### 1. Konsep Dasar State Management pada Flutter
Flutter menggunakan arsitektur antarmuka yang bersifat deklaratif, di mana tampilan (UI) selalu merepresentasikan kondisi data atau state pada suatu waktu tertentu. Ketika terdapat pembaruan state, Flutter akan merender ulang (rebuild) komponen UI agar sesuai dengan data terbaru. State management adalah pendekatan sistematis untuk mengelola, menyimpan, dan memperbarui data tersebut, terutama ketika data harus dibagikan dan diakses oleh banyak widget yang terpisah dalam aplikasi.

### 2. Provider Package pada Flutter
Provider adalah salah satu paket yang paling umum digunakan dan direkomendasikan untuk state management pada Flutter. Paket ini menyediakan cara yang sederhana dan efisien untuk mengelola state aplikasi tanpa perlu melakukan banyak boilerplate code (kode berulang). Provider berfungsi sebagai jembatan untuk menyampaikan data dari satu bagian pohon widget ke bagian lain, termasuk widget yang berada jauh di bawahnya dalam hirarki widget.
- ChangeNotifier: Sebuah kelas yang menyimpan nilai atau state aplikasi. Kelas ini menyediakan metode notifyListeners() yang berfungsi untuk memberikan sinyal kepada aplikasi bahwa telah terjadi perubahan data.
- ChangeNotifierProvider: Komponen yang bertugas untuk menyediakan (provide) instance dari ChangeNotifier ke dalam widget tree, sehingga data dapat diakses oleh komponen-komponen di bawahnya.
- Consumer: Komponen yang bertugas untuk mendengarkan perubahan data. Ketika notifyListeners() dipanggil, hanya widget yang dibungkus oleh Consumer yang akan dirender ulang, sehingga aplikasi tetap berjalan dengan performa yang optimal.

### 3. Mekanisme Notifikasi (Local dan Push Notification)
Notifikasi adalah fitur untuk menampilkan pesan singkat kepada pengguna di luar antarmuka utama aplikasi. Dalam konteks pengembangan Flutter, notifikasi umumnya dibagi menjadi dua jenis implementasi:
- Local Notification: Notifikasi yang dipicu dan dieksekusi sepenuhnya oleh sistem operasi di dalam perangkat pengguna tanpa memerlukan koneksi internet atau campur tangan server luar. Implementasi ini (umumnya menggunakan package flutter_local_notifications) sangat ideal untuk memberikan feedback langsung atas interaksi pengguna di dalam aplikasi, seperti pembaruan nilai counter.
- Firebase Cloud Messaging (FCM): Solusi push notification berbasis cloud dari Google. FCM digunakan ketika notifikasi harus dikirimkan dari server pusat ke perangkat pengguna secara real-time, baik saat aplikasi sedang berjalan (foreground), berada di latar belakang (background), maupun saat aplikasi ditutup (terminated).

## Source Code
```dart
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

// Inisialisasi plugin flutter_local_notifications secara global
final FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin =
    FlutterLocalNotificationsPlugin();

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // Konfigurasi inisialisasi untuk Android
  const AndroidInitializationSettings initializationSettingsAndroid =
      AndroidInitializationSettings('@mipmap/ic_launcher');

  const InitializationSettings initializationSettings = InitializationSettings(
    android: initializationSettingsAndroid,
  );

  // Inisialisasi plugin notifikasi
  await flutterLocalNotificationsPlugin.initialize(
      settings: initializationSettings);

  runApp(
    ChangeNotifierProvider(
      create: (context) => CounterProvider(),
      child: const MyApp(),
    ),
  );
}

// Provider: menyimpan dan mengelola state counter
class CounterProvider extends ChangeNotifier {
  int _counter = 0;

  CounterProvider() {
    _requestPermission(); // Minta izin notifikasi saat pertama kali dibuat
  }

  int get counter => _counter;

  // Meminta izin notifikasi pada Android 13+
  void _requestPermission() {
    flutterLocalNotificationsPlugin
        .resolvePlatformSpecificImplementation<
            AndroidFlutterLocalNotificationsPlugin>()
        ?.requestNotificationsPermission();
  }

  // Menambah nilai counter, memberitahu listener, lalu tampilkan notifikasi
  void increment() {
    _counter++;
    notifyListeners();
    _showNotification();
  }

  // Menampilkan notifikasi lokal dengan nilai counter terbaru
  Future<void> _showNotification() async {
    const AndroidNotificationDetails androidNotificationDetails =
        AndroidNotificationDetails(
      'counter_channel',
      'Counter Updates',
      channelDescription: 'Notification channel for counter updates',
      importance: Importance.max,
      priority: Priority.high,
      ticker: 'ticker',
    );

    const NotificationDetails notificationDetails =
        NotificationDetails(android: androidNotificationDetails);

    await flutterLocalNotificationsPlugin.show(
      id: 0,
      title: 'Counter Update',
      body: 'Nilai counter saat ini: $_counter',
      notificationDetails: notificationDetails,
    );
  }
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Counter & Notification',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
        useMaterial3: true,
      ),
      home: const CounterPage(),
    );
  }
}

class CounterPage extends StatelessWidget {
  const CounterPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Provider & Notification'),
        backgroundColor: Theme.of(context).colorScheme.inversePrimary,
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            const Text(
              'Tekan tombol untuk menambah counter:',
              style: TextStyle(fontSize: 16),
            ),
            const SizedBox(height: 10),
            // Consumer mendengarkan perubahan dari CounterProvider
            Consumer<CounterProvider>(
              builder: (context, counterProvider, child) {
                return Text(
                  '${counterProvider.counter}',
                  style: Theme.of(context).textTheme.headlineMedium?.copyWith(
                        fontWeight: FontWeight.bold,
                        color: Theme.of(context).colorScheme.primary,
                      ),
                );
              },
            ),
          ],
        ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          context.read<CounterProvider>().increment();
        },
        tooltip: 'Tambah',
        child: const Icon(Icons.add),
      ),
    );
  }
}
```

## Output 

#### Tampilan Awal Akses Aplikasi (permission) & Setelah Klik Button Plus
<img src="asset\output.jpeg" width="300"> <img src="asset\output1.jpeg" width="300">

#### Tampilan Notifikasi

<img src="asset\output3.jpeg" width="300">

Keterangan:

- Notifikasi muncul setiap kali counter bertambah.
- Isi notifikasi menampilkan nilai counter terbaru.

## Penjelasan Singkat
### 1. Cara kerja Provider pada aplikasi

Provider bekerja dengan pola **ChangeNotifier**. Berikut alur kerjanya pada aplikasi ini:

1. **Inisialisasi**: `ChangeNotifierProvider` dibungkus di atas `MyApp` di dalam fungsi `main()`. Ini menjadikan `CounterProvider` tersedia untuk seluruh widget di bawahnya dalam widget tree.

2. **Penyimpanan State**: Kelas `CounterProvider` (extends `ChangeNotifier`) menyimpan nilai `_counter` sebagai private variable. Nilai ini hanya bisa diakses dari luar melalui getter `counter`.

3. **Pembaruan State**: Ketika tombol `+` ditekan, fungsi `increment()` dipanggil melalui `context.read<CounterProvider>().increment()`. Di dalam `increment()`, nilai `_counter` ditambah 1, lalu `notifyListeners()` dipanggil untuk memberitahu semua widget yang sedang mendengarkan bahwa data telah berubah.

4. **Reaktivitas UI**: Widget `Consumer<CounterProvider>` yang membungkus `Text` nilai counter akan otomatis di-rebuild setiap kali `notifyListeners()` dipanggil, sehingga nilai yang tampil di layar selalu sinkron dengan data terbaru tanpa perlu `setState()`.

### 2. Cara kerja notifikasi yang digunakan.

Aplikasi ini menggunakan **Local Notification** melalui package `flutter_local_notifications`. Berikut alur kerjanya:

1. **Inisialisasi Plugin**: Di dalam `main()`, plugin diinisialisasi dengan `AndroidInitializationSettings` yang menentukan ikon notifikasi (menggunakan ikon launcher aplikasi). Plugin kemudian diinisialisasi menggunakan `flutterLocalNotificationsPlugin.initialize()`.

2. **Permintaan Izin**: Karena Android 13 (API 33) ke atas memerlukan izin eksplisit dari pengguna untuk menampilkan notifikasi, fungsi `_requestPermission()` dipanggil otomatis saat `CounterProvider` pertama kali dibuat. Fungsi ini memunculkan dialog izin sistem kepada pengguna.

3. **Konfigurasi Notifikasi**: Setiap notifikasi dikonfigurasi menggunakan `AndroidNotificationDetails` dengan:
   - `channelId` dan `channelName` sebagai identitas kanal notifikasi.
   - `importance: Importance.max` dan `priority: Priority.high` agar notifikasi muncul sebagai **heads-up notification** (pop-up di atas layar).

4. **Pengiriman Notifikasi**: Setiap kali `increment()` dipanggil, fungsi `_showNotification()` akan dieksekusi dan memanggil `flutterLocalNotificationsPlugin.show()` dengan pesan dinamis **"Nilai counter saat ini: X"** sesuai nilai counter terbaru. Notifikasi ini berjalan sepenuhnya di dalam perangkat tanpa memerlukan koneksi internet.

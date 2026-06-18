<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br>APLIKASI BERBASIS PLATFORM</h1>
  <br />
  <h3>MODUL 12 & 13<br> IMPLEMENTASI PROVIDER & NOTIFIKASI <br>(Aplikasi Counter & State Management)</h3>
  <br />
  <img src="assets/logo.png" alt="Logo" width="300"> 
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Deshan Rafif Alfarisi</strong><br>
    <strong>2311102326</strong><br>
    <strong>S1 IF-11-REG01</strong>
  </p>
  <br />
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
  </p>
  <br />
  <br />
    <h4>Asisten Praktikum :</h4>
    <strong> Apri Pandu Wicaksono </strong> <br>
    <strong>Rangga Pradarrell Fathi</strong>
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE
 <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026</h3>
</div>

---

## 1. Dasar Teori

### 1.1 Flutter
Flutter merupakan framework pengembangan antarmuka pengguna (UI) yang dikembangkan oleh Google dan bersifat open source. Framework ini memungkinkan pengembang membuat aplikasi yang dapat berjalan secara native pada berbagai platform, seperti Android, iOS, web, dan desktop, hanya dengan menggunakan satu basis kode yang sama.

### 1.2 Provider (State Management)
`provider` adalah salah satu package manajemen state yang banyak digunakan dalam Flutter karena sederhana dan mudah diimplementasikan. Package ini bekerja dengan memanfaatkan konsep InheritedWidget untuk mengelola dan mendistribusikan data ke berbagai widget dalam aplikasi. Dengan Provider, logika aplikasi dapat dipisahkan dari tampilan (UI), sehingga kode menjadi lebih terstruktur dan pemeliharaannya lebih mudah. Selain itu, hanya widget yang membutuhkan data tertentu yang akan diperbarui ketika terjadi perubahan state.

### 1.3 Flutter Local Notifications
`flutter_local_notifications` merupakan plugin Flutter yang digunakan untuk menampilkan notifikasi lokal langsung dari aplikasi. Berbeda dengan layanan notifikasi berbasis cloud seperti Firebase Cloud Messaging (FCM), plugin ini tidak memerlukan koneksi internet maupun server eksternal karena seluruh proses notifikasi dijalankan secara lokal pada perangkat pengguna.

### 1.4 ChangeNotifier & Provider.of / context.watch
Pada aplikasi ini digunakan kelas `ChangeNotifier` sebagai mekanisme untuk mengelola perubahan data di dalam `CounterProvider`. Kelas ini menyediakan fungsi `notifyListeners()` yang akan memberi tahu widget terkait ketika terjadi perubahan state. Untuk menangkap dan mendengarkan perubahan tersebut pada antarmuka pengguna, digunakan `context.watch<CounterProvider>()` atau `Provider.of<CounterProvider>(context)` yang secara otomatis memicu pembangunan ulang (rebuild) widget terkait ketika state counter mengalami pembaruan. Dengan cara ini, manajemen state berjalan secara efisien dan memisahkan logika bisnis dari komponen UI.

---

## 2. Implementasi Program

### 2.1 Deskripsi Aplikasi
Aplikasi **Counter App** yang dibuat oleh **Deshan Rafif Alfarisi** merupakan aplikasi mobile berbasis Flutter yang diimplementasikan untuk mendemonstrasikan konsep State Management menggunakan library `provider` serta pengintegrasian notifikasi lokal menggunakan `flutter_local_notifications`. Aplikasi ini dirancang dengan antarmuka bertema gelap (*dark mode*) yang modern dan estetik, menampilkan nilai counter di bagian tengah layar dengan aksen gradasi lingkaran yang memukau.

Aplikasi menyediakan tombol **Tambah** dengan ikon tambah. Ketika tombol ditekan, ia memanggil fungsi `increment()` pada `CounterProvider`. Logika ini bertugas memperbarui nilai counter dan secara otomatis memicu pembaruan antarmuka secara *real-time*. Selain itu, di saat yang sama aplikasi akan mengirimkan notifikasi lokal kepada pengguna di perangkat dengan Judul: **"Counter Update"** dan Pesan: **"Nilai counter saat ini: X"** (di mana X adalah nilai terbaru). Aplikasi ini membuktikan bagaimana manajemen state dan layanan latar belakang perangkat dapat bekerja selaras di dalam ekosistem Flutter.

---

## 3. Code & Penjelasan

### 3.1 `pubspec.yaml` — Menambahkan Dependensi

```yaml
dependencies:
  flutter:
    sdk: flutter

  # State Management
  provider: ^6.1.2

  # Local Notification
  flutter_local_notifications: ^17.2.4

  # Permission Handler (untuk Android 13+)
  permission_handler: ^11.3.1

  cupertino_icons: ^1.0.8
```

**Penjelasan:**
- `provider`: Library utama untuk state management di Flutter. Memudahkan pemisahan logika bisnis dari UI.
- `flutter_local_notifications`: Digunakan untuk menampilkan notifikasi lokal di perangkat Android dan iOS secara native tanpa perlu server eksternal.
- `permission_handler`: Digunakan untuk meminta izin akses fitur sistem seperti menampilkan notifikasi (`Permission.notification`) secara dinamis di runtime terutama untuk Android 13 ke atas.

---

### 3.2 Konfigurasi Android — `android/app/build.gradle`

```gradle
android {
    namespace "com.example.counter_notif_app"
    compileSdkVersion 34
    ndkVersion flutter.ndkVersion

    compileOptions {
        sourceCompatibility JavaVersion.VERSION_1_8
        targetCompatibility JavaVersion.VERSION_1_8
    }

    defaultConfig {
        applicationId "com.example.counter_notif_app"
        // flutter_local_notifications mensyaratkan minSdkVersion >= 21
        minSdkVersion 21
        targetSdkVersion 34
        versionCode flutterVersionCode.toInteger()
        versionName flutterVersionName
    }
}
```

**Penjelasan:**
- `minSdkVersion 21`: Pengaturan ini wajib dilakukan karena library `flutter_local_notifications` membutuhkan minimum Android SDK API Level 21 agar fungsionalitas notifikasi lokal dapat berjalan dengan lancar.
- `compileSdkVersion 34` & `targetSdkVersion 34`: Menargetkan Android 14 (API 34) untuk memastikan kompatibilitas penuh dengan sistem operasi Android modern beserta manajemen privasi/izin terbarunya.

---

### 3.3 Konfigurasi Izin Notifikasi — `AndroidManifest.xml`

```xml
<manifest xmlns:android="http://schemas.android.com/apk/res/android">

    <!-- Izin Internet (opsional, untuk FCM di masa depan) -->
    <uses-permission android:name="android.permission.INTERNET"/>

    <!-- Izin Notifikasi (Android 13 / API 33+) -->
    <uses-permission android:name="android.permission.POST_NOTIFICATIONS"/>

    <!-- Izin Vibrate untuk notifikasi -->
    <uses-permission android:name="android.permission.VIBRATE"/>

    <!-- Izin Wake Lock agar notifikasi bisa muncul saat layar mati -->
    <uses-permission android:name="android.permission.WAKE_LOCK"/>

    <!-- Izin Receive Boot Completed (opsional: jadwal notifikasi ulang setelah reboot) -->
    <uses-permission android:name="android.permission.RECEIVE_BOOT_COMPLETED"/>

    <application
        android:label="Counter App"
        android:name="${applicationName}"
        android:icon="@mipmap/ic_launcher">

        <activity
            android:name=".MainActivity"
            android:exported="true"
            android:launchMode="singleTop"
            android:taskAffinity=""
            android:theme="@style/LaunchTheme"
            android:configChanges="orientation|keyboardHidden|keyboard|screenSize|smallestScreenSize|locale|layoutDirection|fontScale|screenLayout|density|uiMode"
            android:hardwareAccelerated="true"
            android:windowSoftInputMode="adjustResize">

            <meta-data
              android:name="io.flutter.embedding.android.NormalTheme"
              android:resource="@style/NormalTheme"/>

            <intent-filter>
                <action android:name="android.intent.action.MAIN"/>
                <category android:name="android.intent.category.LAUNCHER"/>
            </intent-filter>
        </activity>

        <!-- flutter_local_notifications: BroadcastReceiver untuk scheduled notifications -->
        <receiver android:exported="false"
            android:name="com.dexterous.flutterlocalnotifications.ScheduledNotificationReceiver"/>
        <receiver android:exported="false"
            android:name="com.dexterous.flutterlocalnotifications.ScheduledNotificationBootReceiver">
            <intent-filter>
                <action android:name="android.intent.action.BOOT_COMPLETED"/>
                <action android:name="android.intent.action.MY_PACKAGE_REPLACED"/>
                <action android:name="android.intent.action.QUICKBOOT_POWERON"/>
                <action android:name="com.htc.intent.action.QUICKBOOT_POWERON"/>
            </intent-filter>
        </receiver>

        <meta-data
            android:name="flutterEmbedding"
            android:value="2"/>
    </application>
</manifest>
```

**Penjelasan:**
- `<uses-permission android:name="android.permission.POST_NOTIFICATIONS"/>`: Izin krusial yang diperkenalkan sejak Android 13 untuk meminta persetujuan pengguna sebelum aplikasi diizinkan mengirimkan notifikasi.
- `ScheduledNotificationReceiver` & `ScheduledNotificationBootReceiver`: Komponen receiver yang didaftarkan di manifest untuk memproses penayangan notifikasi lokal secara tepat waktu serta menjamin notifikasi terjadwal tetap aktif saat perangkat dinyalakan ulang (*reboot*).

---

### 3.4 State & Notification Manager — `counter_provider.dart`

Pada proyek ini, logika State Management dan inisialisasi Notifikasi diintegrasikan ke dalam satu Provider yang efisien dan reaktif.

```dart
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:permission_handler/permission_handler.dart';

class CounterProvider extends ChangeNotifier {
  int _counter = 0;

  final FlutterLocalNotificationsPlugin _notificationsPlugin =
      FlutterLocalNotificationsPlugin();

  int get counter => _counter;

  CounterProvider() {
    _initNotifications();
  }

  /// Inisialisasi plugin notifikasi lokal
  Future<void> _initNotifications() async {
    // Pengaturan Android
    const AndroidInitializationSettings androidSettings =
        AndroidInitializationSettings('@mipmap/ic_launcher');

    // Pengaturan iOS / macOS
    const DarwinInitializationSettings iosSettings =
        DarwinInitializationSettings(
      requestAlertPermission: true,
      requestBadgePermission: true,
      requestSoundPermission: true,
    );

    const InitializationSettings initSettings = InitializationSettings(
      android: androidSettings,
      iOS: iosSettings,
    );

    await _notificationsPlugin.initialize(initSettings);

    // Minta izin notifikasi (Android 13+)
    await _requestNotificationPermission();
  }

  /// Meminta izin notifikasi di Android 13+
  Future<void> _requestNotificationPermission() async {
    final status = await Permission.notification.status;
    if (!status.isGranted) {
      await Permission.notification.request();
    }
  }

  /// Menambah nilai counter sebanyak 1 dan menampilkan notifikasi
  Future<void> increment() async {
    _counter++;
    notifyListeners();
    await _showNotification(_counter);
  }

  /// Menampilkan notifikasi lokal dengan nilai counter terbaru
  Future<void> _showNotification(int value) async {
    const AndroidNotificationDetails androidDetails =
        AndroidNotificationDetails(
      'counter_channel_id',        // ID channel
      'Counter Notifications',     // Nama channel
      channelDescription: 'Notifikasi setiap kali nilai counter bertambah',
      importance: Importance.high,
      priority: Priority.high,
      icon: '@mipmap/ic_launcher',
      playSound: true,
      enableVibration: true,
      styleInformation: BigTextStyleInformation(''),
    );

    const DarwinNotificationDetails iosDetails = DarwinNotificationDetails(
      presentAlert: true,
      presentBadge: true,
      presentSound: true,
    );

    const NotificationDetails notificationDetails = NotificationDetails(
      android: androidDetails,
      iOS: iosDetails,
    );

    await _notificationsPlugin.show(
      0,                                  // ID notifikasi (0 = selalu replace)
      'Counter Update',                   // Judul notifikasi
      'Nilai counter saat ini: $value',   // Pesan notifikasi
      notificationDetails,
    );
  }
}
```

**Penjelasan:**
- `CounterProvider` bertindak sebagai `ChangeNotifier`. Variabel privat `_counter` menyimpan status nilai saat ini, dan metodenya `increment()` menaikkan nilainya lalu memanggil `notifyListeners()` untuk menyegarkan UI.
- `_initNotifications()` mengonfigurasi pengaturan inisialisasi awal untuk platform Android dan iOS/macOS dengan ikon bawaan `@mipmap/ic_launcher`.
- `_requestNotificationPermission()` memanfaatkan plugin `permission_handler` untuk memeriksa status izin notifikasi dan memicu dialog perizinan jika belum diberikan.
- `_showNotification(int value)` membangun objek detail notifikasi (seperti channel ID, nama channel, tingkat kepentingan tinggi, suara, dan getaran) lalu menampilkan notifikasi secara instan dengan pesan dinamis.

---

### 3.5 Root Entry Point — `main.dart`

```dart
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'providers/counter_provider.dart';
import 'screens/home_screen.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => CounterProvider(),
      child: MaterialApp(
        title: 'Counter App',
        debugShowCheckedModeBanner: false,
        theme: ThemeData(
          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFF6C63FF),
            brightness: Brightness.dark,
          ),
          useMaterial3: true,
          fontFamily: 'Roboto',
        ),
        home: const HomeScreen(),
      ),
    );
  }
}
```

**Penjelasan:**
- `WidgetsFlutterBinding.ensureInitialized()`: Menjamin seluruh binding framework Flutter telah siap sebelum mengeksekusi inisialisasi di tingkat dasar aplikasi.
- `ChangeNotifierProvider`: Membungkus widget `MaterialApp` agar instance `CounterProvider` dapat diakses dan digunakan di mana saja di dalam pohon widget (*widget tree*).
- `ThemeData`: Menerapkan tema gelap (*dark theme*) dengan warna utama ungu modern (`Color(0xFF6C63FF)`) dan font kustom Roboto untuk estetika yang lebih premium.

---

### 3.6 Tampilan Antarmuka Utama — `home_screen.dart`

```dart
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/counter_provider.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final counterProvider = context.watch<CounterProvider>();
    final size = MediaQuery.of(context).size;

    return Scaffold(
      backgroundColor: const Color(0xFF1A1A2E),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Center(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                // ── Header ──────────────────────────────────────────────
                const SizedBox(height: 40),
                const Text(
                  'Counter App',
                  style: TextStyle(
                    fontSize: 28,
                    fontWeight: FontWeight.bold,
                    color: Color(0xFFE0E0E0),
                    letterSpacing: 1.5,
                  ),
                ),
                const SizedBox(height: 8),
                const Text(
                  'Dengan Provider & Local Notification',
                  style: TextStyle(
                    fontSize: 13,
                    color: Color(0xFF9E9E9E),
                    letterSpacing: 0.5,
                  ),
                ),

                const SizedBox(height: 60),

                // ── Counter Card ─────────────────────────────────────────
                Container(
                  width: size.width * 0.65,
                  height: size.width * 0.65,
                  decoration: BoxDecoration(
                    shape: BoxShape.circle,
                    gradient: const LinearGradient(
                      colors: [Color(0xFF6C63FF), Color(0xFF3D5AF1)],
                      begin: Alignment.topLeft,
                      end: Alignment.bottomRight,
                    ),
                    boxShadow: [
                      BoxShadow(
                        color: const Color(0xFF6C63FF).withValues(alpha: 0.45),
                        blurRadius: 40,
                        spreadRadius: 5,
                      ),
                    ],
                  ),
                  child: Center(
                    child: AnimatedSwitcher(
                      duration: const Duration(milliseconds: 300),
                      transitionBuilder: (child, animation) => ScaleTransition(
                        scale: animation,
                        child: child,
                      ),
                      child: Text(
                        '${counterProvider.counter}',
                        key: ValueKey<int>(counterProvider.counter),
                        style: const TextStyle(
                          fontSize: 72,
                          fontWeight: FontWeight.w800,
                          color: Colors.white,
                          height: 1.0,
                        ),
                      ),
                    ),
                  ),
                ),

                const SizedBox(height: 24),

                // ── Label nilai counter ──────────────────────────────────
                Text(
                  'Nilai Counter: ${counterProvider.counter}',
                  style: const TextStyle(
                    fontSize: 16,
                    color: Color(0xFFB0B0C8),
                  ),
                ),

                const SizedBox(height: 56),

                // ── Tombol Tambah (+) ────────────────────────────────────
                GestureDetector(
                  onTap: () => counterProvider.increment(),
                  child: AnimatedContainer(
                    duration: const Duration(milliseconds: 150),
                    width: 180,
                    height: 60,
                    decoration: BoxDecoration(
                      gradient: const LinearGradient(
                        colors: [Color(0xFF6C63FF), Color(0xFF48C774)],
                        begin: Alignment.centerLeft,
                        end: Alignment.centerRight,
                      ),
                      borderRadius: BorderRadius.circular(30),
                      boxShadow: [
                        BoxShadow(
                          color: const Color(0xFF6C63FF).withValues(alpha: 0.4),
                          blurRadius: 20,
                          offset: const Offset(0, 8),
                        ),
                      ],
                    ),
                    child: const Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Icon(Icons.add_circle_outline,
                            color: Colors.white, size: 26),
                        SizedBox(width: 10),
                        Text(
                          'Tambah',
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 18,
                            fontWeight: FontWeight.w700,
                            letterSpacing: 0.8,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),

                const SizedBox(height: 40),

                // ── Info notifikasi ──────────────────────────────────────
                Container(
                  margin: const EdgeInsets.symmetric(horizontal: 32),
                  padding:
                      const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
                  decoration: BoxDecoration(
                    color: const Color(0xFF16213E),
                    borderRadius: BorderRadius.circular(12),
                    border: Border.all(
                      color: const Color(0xFF6C63FF).withValues(alpha: 0.3),
                    ),
                  ),
                  child: const Row(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Icon(Icons.notifications_active,
                          color: Color(0xFF6C63FF), size: 20),
                      SizedBox(width: 10),
                      Flexible(
                        child: Text(
                          'Notifikasi lokal akan muncul setiap\nnilai counter bertambah',
                          style: TextStyle(
                            color: Color(0xFF9E9E9E),
                            fontSize: 12,
                            height: 1.5,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 40),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
```

**Penjelasan:**
- `context.watch<CounterProvider>()`: Membaca state `CounterProvider` dan membuat widget mendengarkan perubahan data, sehingga setiap kali `notifyListeners()` dipanggil di provider, halaman ini akan menggambar ulang.
- `AnimatedSwitcher`: Digunakan untuk memberikan animasi transisi pemuaian (*ScaleTransition*) yang halus saat angka counter berubah.
- `GestureDetector` & `AnimatedContainer`: Tombol modifikasi yang memberikan efek responsif dengan warna gradien modern saat tombol ditekan.
- `SingleChildScrollView`: Digunakan untuk mencegah terjadinya *overflow* layar pada perangkat berukuran kecil atau ketika orientasi layar diputar.

---

## 4. Hasil Tampilan (*Output*)

### 1. Allow Notifications
<img src="assets/allow notificatom.jpeg" alt="Allow Notifications" width="300">

### 2. Tampilan Awal
<img src="assets/tampilan awal.jpeg" alt="Tampilan Awal" width="300">

### 3. Tambah Nilai Counter
<img src="assets/tambahnilaicounter.jpeg" alt="Tambah Nilai Counter" width="300">

### 4. Notifikasi 1
<img src="assets/notif 1.jpeg" alt="Notifikasi 1" width="300">

### 5. Notifikasi 2
<img src="assets/notif 2.jpeg" alt="Notifikasi 2" width="300">

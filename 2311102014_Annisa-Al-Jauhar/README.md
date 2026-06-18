<div align="center">

## LAPORAN PRAKTIKUM <br> APLIKASI BERBASIS PLATFORM

<br>

### MODUL 12 & 13
### MOBILE

<br>
<br>

<img src="logotelu.png" width="150">

<br>
<br>
<br>

**Disusun oleh:**

**Annisa Al Jauhar**  
**2311102014**

<br>

**KELAS PS1IF-11-REG01**

**Dosen: Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom**

<br><br>

## PROGRAM STUDI S1 TEKNIK INFORMATIKA <br> FAKULTAS INFORMATIKA <br> UNIVERSITAS TELKOM PURWOKERTO <br> 2026 <br><br>

</div>

---

## 1. Dasar Teori

Flutter adalah framework open-source dari Google untuk membangun aplikasi mobile, web, dan desktop dari satu codebase menggunakan bahasa Dart. Pada praktikum modul 12 dan 13 ini, beberapa konsep utama yang digunakan adalah sebagai berikut.

**Provider** adalah package state management pada Flutter yang memungkinkan pengelolaan state secara efisien dan terpisah dari UI. Provider bekerja dengan prinsip Inversion of Control, di mana widget UI dapat listen (mendengarkan) perubahan state dari kelas yang memperluas `ChangeNotifier`. Ketika nilai state berubah, metode `notifyListeners()` dipanggil, yang kemudian memicu widget `Consumer` atau `context.watch()` untuk membangun ulang (rebuild) tampilan secara otomatis.

**ChangeNotifier** adalah kelas bawaan dari Flutter yang berfungsi sebagai pemegang data (state). Pada praktikum ini, `CounterProvider` memperluas kelas ini untuk menyimpan nilai counter. Setiap kali metode `increment()`, `decrement()`, atau `reset()` dipanggil, nilai counter diubah dan `notifyListeners()` dieksekusi untuk memberitahu UI bahwa data telah berubah.

**flutter_local_notifications** adalah package Flutter yang digunakan untuk menampilkan notifikasi lokal pada perangkat tanpa membutuhkan koneksi internet atau server backend. Notifikasi dikonfigurasi menggunakan `AndroidNotificationDetails` yang mencakup channel ID, nama channel, tingkat kepentingan (importance), dan prioritas. Pada Android 8.0 (API 26) ke atas, notifikasi wajib memiliki channel. Notifikasi ditampilkan menggunakan metode `show()` dari instance `FlutterLocalNotificationsPlugin`.

**Permission (Izin Aplikasi)** pada Android adalah mekanisme keamanan agar aplikasi tidak sembarangan mengakses fitur sensitif perangkat. Pada praktikum ini, permission `POST_NOTIFICATIONS` wajib dideklarasikan di `AndroidManifest.xml` untuk menampilkan notifikasi lokal. Selain itu, mulai Android 13 (API 33), izin notifikasi juga harus diminta secara runtime (saat aplikasi berjalan) menggunakan metode `requestNotificationsPermission()`.

**minSdkVersion** adalah konfigurasi di file `build.gradle` yang menentukan versi Android minimum yang didukung oleh aplikasi. Package `flutter_local_notifications` mengharuskan `minSdkVersion` minimal 21 (Android 5.0 Lollipop) agar fitur notifikasi dan channel dapat berjalan dengan baik tanpa error kompilasi.

---

## 2. Hasil Praktikum

### Langkah-Langkah:

**1.** Buka Visual Studio Code dan buat project Flutter baru dengan nama `counter_notifikasi` menggunakan perintah berikut di terminal:

```
flutter create counter_notifikasi
cd counter_notifikasi
```

**2.** Tambahkan dependency `provider` dan `flutter_local_notifications` pada file `pubspec.yaml` di bagian `dependencies`:

```yaml
dependencies:
  flutter:
    sdk: flutter
  provider: ^6.1.2
  flutter_local_notifications: ^17.2.3
```

**3.** Jalankan `flutter pub get` di terminal untuk mengunduh package.

```
flutter pub get
```

**4.** Ubah `minSdk` menjadi 21 pada file `android/app/build.gradle.kts` di dalam blok `defaultConfig`:

```kotlin
defaultConfig {
    applicationId = "com.example.counter_notifikasi"
    minSdk = 21
    targetSdk = flutter.targetSdkVersion
    versionCode = flutter.versionCode
    versionName = flutter.versionName
}
```

**5.** Tambahkan permission yang diperlukan pada file `android/app/src/main/AndroidManifest.xml`, letakkan sebelum tag `<application`:

```xml
<uses-permission android:name="android.permission.POST_NOTIFICATIONS"/>
<uses-permission android:name="android.permission.RECEIVE_BOOT_COMPLETED"/>
<uses-permission android:name="android.permission.VIBRATE"/>
```

**6.** Buat file baru `lib/notification_service.dart` untuk menangani inisialisasi dan menampilkan notifikasi lokal, termasuk request izin runtime untuk Android 13+:

```dart
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

class NotificationService {
  static final NotificationService _instance = NotificationService._internal();
  factory NotificationService() => _instance;
  NotificationService._internal();

  final FlutterLocalNotificationsPlugin _plugin =
      FlutterLocalNotificationsPlugin();

  Future<void> init() async {
    const AndroidInitializationSettings android =
        AndroidInitializationSettings('@mipmap/ic_launcher');
    const DarwinInitializationSettings ios = DarwinInitializationSettings(
      requestAlertPermission: true,
      requestBadgePermission: true,
      requestSoundPermission: true,
    );
    const InitializationSettings settings =
        InitializationSettings(android: android, iOS: ios);
    await _plugin.initialize(settings);
    final AndroidFlutterLocalNotificationsPlugin? androidPlugin =
        _plugin.resolvePlatformSpecificImplementation<
            AndroidFlutterLocalNotificationsPlugin>();
    await androidPlugin?.requestNotificationsPermission();
  }

  Future<void> showCounterNotification(int counterValue) async {
    const AndroidNotificationDetails android = AndroidNotificationDetails(
      'counter_channel',
      'Counter Notifications',
      channelDescription: 'Notifikasi untuk update nilai counter',
      importance: Importance.high,
      priority: Priority.high,
      showWhen: true,
    );
    const DarwinNotificationDetails ios = DarwinNotificationDetails(
      presentAlert: true,
      presentBadge: true,
      presentSound: true,
    );
    const NotificationDetails details =
        NotificationDetails(android: android, iOS: ios);
    await _plugin.show(
      0,
      'Counter Update',
      'Nilai counter saat ini: $counterValue',
      details,
    );
  }
}
```

**7.** Buat file baru `lib/counter_provider.dart` untuk menyimpan state counter menggunakan `ChangeNotifier`:

```dart
import 'package:flutter/material.dart';

class CounterProvider extends ChangeNotifier {
  int _counter = 0;

  int get counter => _counter;

  void increment() {
    _counter++;
    notifyListeners();
  }

  void decrement() {
    if (_counter > 0) {
      _counter--;
      notifyListeners();
    }
  }

  void reset() {
    _counter = 0;
    notifyListeners();
  }
}
```

**8.** Buka `lib/main.dart`, hapus semua kode bawaan, lalu tambahkan kode berikut sebagai entry point aplikasi dengan implementasi UI bertema Pink dan Provider:

```dart
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'counter_provider.dart';
import 'notification_service.dart';
import 'home_page.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await NotificationService().init();
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => CounterProvider(),
      child: MaterialApp(
        title: 'Counter & Notifikasi',
        debugShowCheckedModeBanner: false,
        theme: ThemeData(
          colorScheme: ColorScheme.fromSeed(
            seedColor: const Color(0xFFE91E8C),
          ),
          useMaterial3: true,
        ),
        home: const HomePage(),
      ),
    );
  }
}
```

**9.** Hubungkan perangkat ke PC menggunakan kabel USB, aktifkan USB Debugging pada Developer Options di HP, lalu jalankan aplikasi dengan perintah:

```
flutter run
```

**10.** Saat pertama kali dijalankan, aplikasi akan meminta izin notifikasi. Pilih **Allow/Izinkan** agar notifikasi dapat muncul di sistem saat tombol ditekan.

### Output:


### 1. Tampilan Aplikasi
<table>
  <tr>
    <td align="center"><b>Tampilan Awal (Counter = 0)</b></td>
    <td align="center"><b>Saat Klik Tombol Tambah (+)</b></td>
  </tr>
  <tr>
    <td><img src="gambar0.jpeg" width="300"></td>
    <td><img src="gambar1.jpeg" width="300"></td>
  </tr>
</table>
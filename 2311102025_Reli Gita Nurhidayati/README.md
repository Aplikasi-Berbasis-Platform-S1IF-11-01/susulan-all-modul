<div align="center">

# LAPORAN PRAKTIKUM
# APLIKASI BERBASIS PLATFORM

<br>

### MODUL 12 & 13
### IMPLEMENTASI PROVIDER & NOTIFIKASI PADA FLUTTER

<br><br>

<img src="screenshots/Logo_Telkom.png" width="160">

<br><br>

**Disusun Oleh :**

Reli Gita Nurhidayati
2311102025
S1 IF-11-REG01

<br>

**Dosen Pengampu :**

Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom

<br>

**Asisten Praktikum :**

Apri Pandu Wicaksono
Rangga Pradarrell Fathi

<br><br>

**LABORATORIUM HIGH PERFORMANCE
FAKULTAS INFORMATIKA
TELKOM UNIVERSITY PURWOKERTO
2026**

</div>

<br>

---

## 1. Ringkasan Tugas

Tugas ini meminta dibuatnya aplikasi Flutter satu halaman yang menampilkan nilai counter beserta tombol untuk menambahkannya. Dua hal yang menjadi fokus penilaian adalah penggunaan **Provider** sebagai state management dan penggunaan **notifikasi lokal** yang muncul setiap kali nilai counter berubah, dengan format judul "Counter Update" dan isi pesan "Nilai counter saat ini: X".

## 2. Konsep yang Dipakai

Sebelum masuk ke kode, berikut konsep-konsep yang relevan dengan implementasi aplikasi ini:

- **flutter_local_notifications** — pustaka yang dipakai untuk menampilkan notifikasi langsung dari sistem operasi perangkat (tanpa server, beda dengan FCM). Notifikasi dikelompokkan dalam sebuah *notification channel* yang mengatur tingkat importance dan priority-nya. Pada Android 13 ke atas, izin `POST_NOTIFICATIONS` wajib diminta secara runtime lewat method `requestNotificationsPermission()`, sehingga izin ini juga ditambahkan di `AndroidManifest.xml` sebagai jaga-jaga.
- **ChangeNotifier** — kelas dasar dari Flutter sendiri (bukan dari package provider) yang punya kemampuan memberi tahu "pendengarnya" lewat `notifyListeners()` setiap kali ada perubahan data di dalamnya.
- **ChangeNotifierProvider** — widget pembungkus yang menyuntikkan satu instance ChangeNotifier ke seluruh widget tree di bawahnya, sehingga tidak perlu meneruskan data lewat parameter berlapis-lapis (menghindari *prop drilling*).
- **Consumer** — widget yang "mendengarkan" perubahan dari ChangeNotifier dan hanya membangun ulang bagian UI yang ada di dalam builder-nya saja, bukan seluruh halaman.

## 3. Struktur Project

```
counter_notifikasi/
├── lib/
│   ├── models/
│   │   └── counter_provider.dart    → logika state counter
│   ├── services/
│   │   └── notification_service.dart → logika notifikasi
│   └── main.dart                     → UI & inisialisasi
├── screenshots/
└── android/app/src/main/AndroidManifest.xml  → izin POST_NOTIFICATIONS
```

Pemisahan ke folder `models` dan `services` dilakukan agar logika data (state) dan logika notifikasi tidak bercampur dengan kode UI di `main.dart`, sehingga lebih mudah dibaca dan dikembangkan lebih lanjut.

## 4. Implementasi Kode

### 4.1 `lib/models/counter_provider.dart`

```dart
import 'package:flutter/foundation.dart';
import '../services/notification_service.dart';

class CounterProvider extends ChangeNotifier {
  int _counter = 0;

  int get counter => _counter;

  void increment() {
    _counter++;
    notifyListeners();
    NotificationService.showNotification(
      title: 'Counter Update',
      body: 'Nilai counter saat ini: $_counter',
    );
  }
}
```

Variabel `_counter` dibuat private (diawali underscore) supaya nilainya tidak bisa diubah sembarangan dari luar class, hanya bisa dibaca lewat getter `counter`. Satu-satunya jalan untuk mengubah nilainya adalah lewat method `increment()`. Di dalam method ini ada dua hal yang terjadi secara berurutan: pertama `notifyListeners()` dipanggil supaya semua `Consumer` yang terhubung tahu ada perubahan dan langsung rebuild, baru setelah itu `NotificationService.showNotification()` dipanggil untuk memunculkan notifikasinya. Urutan ini penting — UI duluan diperbarui, baru notifikasi ditampilkan.

### 4.2 `lib/services/notification_service.dart`

```dart
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

class NotificationService {
  static final FlutterLocalNotificationsPlugin _notifications =
      FlutterLocalNotificationsPlugin();

  static Future<void> init() async {
    const AndroidInitializationSettings androidSettings =
        AndroidInitializationSettings('@mipmap/ic_launcher');

    const InitializationSettings settings =
        InitializationSettings(android: androidSettings);

    await _notifications.initialize(settings: settings);

    await _notifications
        .resolvePlatformSpecificImplementation<AndroidFlutterLocalNotificationsPlugin>()
        ?.requestNotificationsPermission();
  }

  static Future<void> showNotification({
    required String title,
    required String body,
  }) async {
    const AndroidNotificationDetails androidDetails = AndroidNotificationDetails(
      'counter_channel',
      'Counter Notifications',
      channelDescription: 'Notifikasi update nilai counter',
      importance: Importance.high,
      priority: Priority.high,
    );

    const NotificationDetails details =
        NotificationDetails(android: androidDetails);

    await _notifications.show(
      id: 0,
      title: title,
      body: body,
      notificationDetails: details,
    );
  }
}
```

Semua method dibuat `static` karena aplikasi ini hanya butuh satu pengelola notifikasi saja sepanjang hidup aplikasi, jadi tidak perlu membuat instance baru setiap kali ingin memunculkan notifikasi. Method `init()` dipanggil sekali saja di awal (lihat `main.dart`) untuk menyiapkan ikon notifikasi dan meminta izin ke sistem. Method `showNotification()` membungkus konfigurasi channel Android (id channel, nama, level importance/priority) lalu memanggil `_notifications.show()` dengan parameter bernama (`id`, `title`, `body`, `notificationDetails`) — ini sesuai dengan API versi `flutter_local_notifications` 22.0.1 yang dipakai di project ini, di mana parameter-parameter tersebut wajib disebutkan namanya, tidak bisa lagi berurutan tanpa nama seperti versi-versi lama package ini.

### 4.3 `lib/main.dart`

```dart
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'models/counter_provider.dart';
import 'services/notification_service.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await NotificationService.init();
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => CounterProvider(),
      child: MaterialApp(
        title: 'Counter Provider & Notifikasi',
        theme: ThemeData(primarySwatch: Colors.blue),
        home: const CounterPage(),
      ),
    );
  }
}

class CounterPage extends StatelessWidget {
  const CounterPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Counter Provider & Notifikasi')),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Text('Nilai Counter:', style: TextStyle(fontSize: 20)),
            const SizedBox(height: 10),
            Consumer<CounterProvider>(
              builder: (context, counterProvider, child) {
                return Text(
                  '${counterProvider.counter}',
                  style: const TextStyle(fontSize: 60, fontWeight: FontWeight.bold),
                );
              },
            ),
          ],
        ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () => context.read<CounterProvider>().increment(),
        tooltip: 'Tambah',
        child: const Icon(Icons.add),
      ),
    );
  }
}
```

Ada tiga hal yang perlu diperhatikan di file ini. Pertama, `main()` dijadikan `async` dan memanggil `NotificationService.init()` sebelum `runApp()` dijalankan — ini perlu supaya plugin notifikasi sudah siap sebelum pengguna sempat menekan tombol manapun. Kedua, `ChangeNotifierProvider` ditaruh membungkus `MaterialApp`, bukan di dalamnya, supaya CounterProvider bisa diakses dari halaman manapun kalau nanti aplikasi ditambah halaman baru. Ketiga, ada perbedaan cara mengambil data Provider: bagian `Consumer<CounterProvider>` dipakai untuk menampilkan angka (karena bagian ini perlu rebuild setiap kali nilai berubah), sedangkan `context.read<CounterProvider>()` dipakai di tombol `FloatingActionButton` (karena di sini cuma perlu memanggil fungsi `increment()` sekali saat ditekan, tidak perlu ikut rebuild).

## 5. Hasil Uji Coba

Pengujian dilakukan langsung di perangkat Android fisik (Samsung Galaxy A21 / A217F) yang dihubungkan lewat USB debugging, bukan emulator.

**Kondisi awal — nilai counter masih 0:**

![Counter masih 0](screenshots/SS_COUNTER_NILAI_0.jpeg)

**Setelah tombol "+" ditekan satu kali — nilai counter naik jadi 1, dan notifikasi langsung muncul di status bar:**

![Counter jadi 1, notifikasi muncul](screenshots/SS_COUNTER_NILAI_1.jpeg)

Dari kedua screenshot terlihat bahwa perubahan nilai pada UI dan kemunculan notifikasi terjadi bersamaan saat tombol ditekan, sesuai dengan urutan kode pada method `increment()` di `CounterProvider`.


## 6. Kesimpulan

Provider terbukti memudahkan pengelolaan state counter tanpa harus memanggil `setState()` secara manual di widget, cukup dengan `notifyListeners()` di sisi model dan `Consumer` di sisi tampilan. Sementara itu, notifikasi lokal lewat `flutter_local_notifications` berhasil terintegrasi dengan baik untuk memberi tahu pengguna setiap kali nilai counter berubah, meski perlu penyesuaian konfigurasi Android (izin notifikasi dan core library desugaring) supaya bisa berjalan tanpa error di perangkat fisik.

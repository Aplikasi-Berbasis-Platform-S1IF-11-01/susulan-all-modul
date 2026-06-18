# Laporan Tugas Praktik Modul 12 & 13
## Implementasi Provider dan Notifikasi pada Flutter

---

### Cara Kerja Provider

Provider adalah package Flutter untuk **State Management** yang memungkinkan data dibagikan ke seluruh widget tree tanpa perlu melewatkan data secara manual antar widget.

**Implementasi pada aplikasi ini:**

1. **`CounterProvider`** (extends `ChangeNotifier`) — menyimpan nilai `_counter` dan menyediakan method `increment()`, `decrement()`, dan `reset()`. Setiap perubahan nilai memanggil `notifyListeners()` agar UI otomatis diperbarui.

2. **`ChangeNotifierProvider`** dibungkus di level `MyApp` sehingga seluruh halaman dapat mengakses provider.

3. **`Consumer<CounterProvider>`** digunakan di `HomePage` untuk membaca nilai counter dan merender ulang hanya bagian yang berubah, bukan seluruh halaman.

```
CounterProvider (ChangeNotifier)
    └── notifyListeners() → Consumer → rebuild UI
```

---

### Cara Kerja Notifikasi (Local Notification)

Aplikasi menggunakan package **`flutter_local_notifications`** untuk menampilkan notifikasi lokal tanpa memerlukan server/internet.

**Alur kerja:**

1. **Inisialisasi** — `NotificationService.init()` dipanggil saat `main()` untuk mendaftarkan channel notifikasi Android dan meminta izin (Android 13+).

2. **Trigger** — Setiap kali tombol **Tambah** atau **Kurang** ditekan, method `showCounterNotification(value)` dipanggil setelah nilai counter diperbarui.

3. **Notifikasi muncul** dengan:
   - **Judul:** `Counter Update`
   - **Pesan:** `Nilai counter saat ini: X`

**Channel Android:**
- Channel ID: `counter_channel`
- Importance: `High` (muncul sebagai heads-up notification)

---

### Dependensi yang Digunakan

| Package | Versi | Fungsi |
|---|---|---|
| `provider` | ^6.1.2 | State management |
| `flutter_local_notifications` | ^17.2.3 | Notifikasi lokal |

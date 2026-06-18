import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:flutter/material.dart';
import 'main.dart';

/// Service class yang mengelola semua logika notifikasi lokal
class NotificationService {
  // ── Konstanta ID dan Channel ─────────────────────────────────────────────
  static const int _notificationId = 1001;
  static const String _channelId = 'foto_channel';
  static const String _channelName = 'Notifikasi Foto';
  static const String _channelDesc = 'Channel untuk notifikasi setelah foto diambil';

  /// Meminta izin notifikasi (khusus Android 13+)
  static Future<void> requestPermission() async {
    final AndroidFlutterLocalNotificationsPlugin? androidPlugin =
    flutterLocalNotificationsPlugin.resolvePlatformSpecificImplementation<
        AndroidFlutterLocalNotificationsPlugin>();

    if (androidPlugin != null) {
      await androidPlugin.requestNotificationsPermission();
    }
  }

  /// Menampilkan notifikasi lokal setelah foto berhasil diambil/dipilih
  ///
  /// [source] menentukan asal foto: 'kamera' atau 'galeri'
  static Future<void> tampilkanNotifikasi({required String source}) async {
    // Detail notifikasi untuk Android
    const AndroidNotificationDetails androidDetails =
    AndroidNotificationDetails(
      _channelId,      // ID channel (unik per aplikasi)
      _channelName,    // Nama channel yang tampil di pengaturan HP
      channelDescription: _channelDesc,
      importance: Importance.high,      // Prioritas tinggi → muncul sebagai heads-up
      priority: Priority.high,
      ticker: 'Foto berhasil!',
      icon: '@mipmap/ic_launcher',
      color: Color(0xFF1565C0),
      enableLights: true,
      playSound: true,
    );

    // Detail notifikasi untuk iOS
    const DarwinNotificationDetails iOSDetails = DarwinNotificationDetails(
      presentAlert: true,
      presentBadge: true,
      presentSound: true,
    );

    // Gabungkan detail untuk semua platform
    const NotificationDetails notificationDetails = NotificationDetails(
      android: androidDetails,
      iOS: iOSDetails,
    );

    // Tentukan pesan sesuai sumber foto
    final String judul;
    final String pesan;

    if (source == 'kamera') {
      judul = '📸 Foto Berhasil Diambil!';
      pesan = 'Foto dari kamera telah berhasil diambil dan ditampilkan.';
    } else {
      judul = '🖼️ Foto Berhasil Dipilih!';
      pesan = 'Foto dari galeri telah berhasil dipilih dan ditampilkan.';
    }

    // Tampilkan notifikasi
    await flutterLocalNotificationsPlugin.show(
      _notificationId,   // ID notifikasi (jika sama, notifikasi lama diganti)
      judul,             // Judul notifikasi
      pesan,             // Isi pesan notifikasi
      notificationDetails,
      payload: source,   // Data tambahan yang dikirim ke onDidReceiveNotificationResponse
    );

    debugPrint('Notifikasi ditampilkan: $judul');
  }
}
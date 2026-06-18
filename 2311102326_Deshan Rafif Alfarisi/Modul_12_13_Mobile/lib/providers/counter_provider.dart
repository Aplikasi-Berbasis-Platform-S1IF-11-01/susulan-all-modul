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

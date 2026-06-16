// lib/services/fcm_service.dart

import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

// Handler background message (harus top-level function)
@pragma('vm:entry-point')
Future<void> firebaseMessagingBackgroundHandler(RemoteMessage message) async {
  print('Background message: ${message.messageId}');
}

class FcmService {
  static final FcmService _instance = FcmService._internal();
  factory FcmService() => _instance;
  FcmService._internal();

  final FirebaseMessaging _fcm = FirebaseMessaging.instance;
  final FlutterLocalNotificationsPlugin _localNotif =
      FlutterLocalNotificationsPlugin();

  // Ganti dengan Project ID Firebase kamu
  static const String _projectId = 'counter-fcm-app';

  // Ganti dengan Server Key dari Firebase Console
  // Project Settings > Cloud Messaging > Server key
  static const String _serverKey = '14aec44233e8794111c8e35f959195d0d7170b4a';

  Future<void> initialize() async {
    try {
      // Minta izin notifikasi
      await _fcm.requestPermission(alert: true, badge: true, sound: true);

      // Dapatkan FCM token perangkat (untuk testing)
      final token = await _fcm.getToken();
      print('FCM Token: $token');

      // Setup local notification untuk foreground
      await _initLocalNotification();

      // Handler saat app di foreground
      FirebaseMessaging.onMessage.listen(_handleForegroundMessage);

      // Handler background
      FirebaseMessaging.onBackgroundMessage(firebaseMessagingBackgroundHandler);
    } catch (e, stackTrace) {
      print('FCM service initialization failed: $e');
      print(stackTrace);
    }
  }

  Future<void> _initLocalNotification() async {
    const AndroidInitializationSettings androidSettings =
        AndroidInitializationSettings('@mipmap/ic_launcher');
    await _localNotif.initialize(
      const InitializationSettings(android: androidSettings),
    );
  }

  // Tampilkan notifikasi saat app sedang terbuka (foreground)
  void _handleForegroundMessage(RemoteMessage message) {
    final notification = message.notification;
    if (notification != null) {
      _localNotif.show(
        0,
        notification.title,
        notification.body,
        const NotificationDetails(
          android: AndroidNotificationDetails(
            'fcm_channel',
            'FCM Notifications',
            importance: Importance.high,
            priority: Priority.high,
          ),
        ),
      );
    }
  }

  // Tampilkan notifikasi lokal (tanpa perlu Firebase HTTP API)
  Future<void> sendCounterNotification(int counterValue) async {
    try {
      // Tampilkan notifikasi lokal langsung
      await _localNotif.show(
        counterValue, // ID unik untuk setiap notifikasi
        'Counter Update',
        'Nilai counter saat ini: $counterValue',
        NotificationDetails(
          android: AndroidNotificationDetails(
            'fcm_channel',
            'FCM Notifications',
            channelDescription: 'Notifikasi dari Counter App',
            importance: Importance.high,
            priority: Priority.high,
            enableVibration: true,
            playSound: true,
          ),
        ),
      );

      print('Notifikasi ditampilkan: Counter = $counterValue');
    } catch (e, stackTrace) {
      print('Failed to show local notification: $e');
      print(stackTrace);
    }
  }
}

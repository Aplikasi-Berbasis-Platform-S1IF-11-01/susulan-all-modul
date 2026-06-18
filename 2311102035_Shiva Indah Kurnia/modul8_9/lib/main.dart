import 'dart:io';

import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

final FlutterLocalNotificationsPlugin notificationsPlugin =
    FlutterLocalNotificationsPlugin();

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  const AndroidInitializationSettings androidSettings =
      AndroidInitializationSettings('@mipmap/ic_launcher');

  const InitializationSettings initializationSettings =
      InitializationSettings(
    android: androidSettings,
  );

  await notificationsPlugin.initialize(initializationSettings);

  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Kamera dan Notifikasi',
      home: const HomePage(),
    );
  }
}

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  File? imageFile;

  final ImagePicker picker = ImagePicker();

  Future<void> showNotification(String message) async {
    const AndroidNotificationDetails androidDetails =
        AndroidNotificationDetails(
      'foto_channel',
      'Foto Notification',
      importance: Importance.max,
      priority: Priority.high,
    );

    const NotificationDetails notificationDetails =
        NotificationDetails(android: androidDetails);

    await notificationsPlugin.show(
      0,
      'Berhasil',
      message,
      notificationDetails,
    );
  }

  Future<void> openCamera() async {
    final XFile? photo = await picker.pickImage(
      source: ImageSource.camera,
    );

    if (photo != null) {
      setState(() {
        imageFile = File(photo.path);
      });

      showNotification("Foto berhasil diambil dari kamera");
    }
  }

  Future<void> openGallery() async {
    final XFile? photo = await picker.pickImage(
      source: ImageSource.gallery,
    );

    if (photo != null) {
      setState(() {
        imageFile = File(photo.path);
      });

      showNotification("Foto berhasil dipilih dari galeri");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Tugas Kamera & Notifikasi"),
      ),
      body: Center(
        child: SingleChildScrollView(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [

              ElevatedButton(
                onPressed: openCamera,
                child: const Text("Buka Kamera"),
              ),

              const SizedBox(height: 10),

              ElevatedButton(
                onPressed: openGallery,
                child: const Text("Pilih dari Galeri"),
              ),

              const SizedBox(height: 20),

              imageFile != null
                  ? Image.file(
                      imageFile!,
                      height: 300,
                    )
                  : const Text("Belum ada foto"),
            ],
          ),
        ),
      ),
    );
  }
}
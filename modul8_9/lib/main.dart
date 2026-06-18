import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

final FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin =
    FlutterLocalNotificationsPlugin();

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  const AndroidInitializationSettings androidSettings =
      AndroidInitializationSettings('@mipmap/ic_launcher');

  const InitializationSettings settings =
      InitializationSettings(android: androidSettings);

  await flutterLocalNotificationsPlugin.initialize(settings);

  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: HomePage(),
    );
  }
}

class HomePage extends StatefulWidget {
  HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  File? imageFile;
  final ImagePicker picker = ImagePicker();

  Future<void> showNotif(String pesan) async {
    const AndroidNotificationDetails androidDetails =
        AndroidNotificationDetails(
      'channel_id',
      'channel_name',
      importance: Importance.max,
      priority: Priority.high,
    );

    const NotificationDetails notifDetails =
        NotificationDetails(android: androidDetails);

    await flutterLocalNotificationsPlugin.show(
      0,
      'Notifikasi',
      pesan,
      notifDetails,
    );
  }

  Future<void> ambilFotoKamera() async {
    final XFile? foto =
        await picker.pickImage(source: ImageSource.camera);

    if (foto != null) {
      setState(() {
        imageFile = File(foto.path);
      });

      await showNotif('Foto berhasil diambil dari kamera');
    }
  }

  Future<void> pilihGaleri() async {
    final XFile? foto =
        await picker.pickImage(source: ImageSource.gallery);

    if (foto != null) {
      setState(() {
        imageFile = File(foto.path);
      });

      await showNotif('Foto berhasil dipilih dari galeri');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Praktikum Kamera & Notifikasi'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(20),
        child: Column(
          children: [
            ElevatedButton(
              onPressed: ambilFotoKamera,
              child: const Text('Buka Kamera'),
            ),
            const SizedBox(height: 10),
            ElevatedButton(
              onPressed: pilihGaleri,
              child: const Text('Pilih dari Galeri'),
            ),
            const SizedBox(height: 20),
            Expanded(
              child: Center(
                child: imageFile == null
                    ? const Text('Belum ada foto')
                    : Image.file(imageFile!),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
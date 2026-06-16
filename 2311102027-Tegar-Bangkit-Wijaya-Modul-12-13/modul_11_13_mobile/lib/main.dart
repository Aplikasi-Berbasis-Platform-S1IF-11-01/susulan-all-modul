// lib/main.dart

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:firebase_core/firebase_core.dart';
import 'providers/counter_provider.dart';
import 'screens/home_screen.dart';
import 'services/fcm_service.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  bool firebaseReady = false;
  try {
    // Inisialisasi Firebase (WAJIB sebelum pakai service Firebase)
    await Firebase.initializeApp();
    firebaseReady = true;
  } catch (e, stackTrace) {
    // Jika Firebase gagal inisialisasi, tetap jalankan UI.
    // Ini membantu mencegah black screen saat ada masalah konfigurasi.
    // Lihat log untuk detail debugging.
    print('Firebase initialization failed: $e');
    print(stackTrace);
  }

  if (firebaseReady) {
    try {
      // Inisialisasi FCM
      await FcmService().initialize();
    } catch (e, stackTrace) {
      print('FCM initialization failed: $e');
      print(stackTrace);
    }
  }

  runApp(
    ChangeNotifierProvider(
      create: (_) => CounterProvider(),
      child: const MyApp(),
    ),
  );
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Tegar Counter App',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: const Color(0xFF4338CA)),
        useMaterial3: true,
      ),
      home: const HomeScreen(),
    );
  }
}

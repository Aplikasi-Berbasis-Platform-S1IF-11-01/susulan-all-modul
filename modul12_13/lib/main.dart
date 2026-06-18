import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

// =================================================================
// 1. NOTIFICATION SERVICE
// =================================================================
class NotificationService {
  static final FlutterLocalNotificationsPlugin _notificationsPlugin =
      FlutterLocalNotificationsPlugin();

  static Future<void> init() async {
    const AndroidInitializationSettings initializationSettingsAndroid =
        AndroidInitializationSettings('@mipmap/ic_launcher');

    const InitializationSettings initializationSettings =
        InitializationSettings(android: initializationSettingsAndroid);

    await _notificationsPlugin.initialize(initializationSettings);

    await _notificationsPlugin
        .resolvePlatformSpecificImplementation<
            AndroidFlutterLocalNotificationsPlugin>()
        ?.requestNotificationsPermission();
  }

  static Future<void> showNotification(int counterValue) async {
    const AndroidNotificationDetails androidDetails = AndroidNotificationDetails(
      'counter_channel_id',
      'Counter Updates',
      channelDescription: 'Memberitahu pengguna saat nilai counter berubah',
      importance: Importance.max,
      priority: Priority.high,
      showWhen: false,
      icon: '@mipmap/ic_launcher',
    );

    const NotificationDetails platformDetails =
        NotificationDetails(android: androidDetails);

    await _notificationsPlugin.show(
      0,
      'Counter Update',
      'Nilai counter saat ini: $counterValue',
      platformDetails,
    );
  }
}

// =================================================================
// 2. STATE MANAGEMENT
// =================================================================
class CounterProvider with ChangeNotifier {
  int _count = 0;
  int get count => _count;

  void increment() {
    _count++;
    notifyListeners();
    NotificationService.showNotification(_count);
  }

  void reset() {
    _count = 0;
    notifyListeners();
  }
}

// =================================================================
// 3. MAIN ENTRY POINT
// =================================================================
void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await NotificationService.init();

  runApp(
    ChangeNotifierProvider(
      create: (context) => CounterProvider(),
      child: const MyApp(),
    ),
  );
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Tugas Modul 12 & 13',
      theme: ThemeData(
        useMaterial3: true,
        fontFamily: 'Roboto',
      ),
      home: const CounterScreen(),
    );
  }
}

// =================================================================
// 4. UI SCREEN (TEMA PINK)
// =================================================================
class CounterScreen extends StatelessWidget {
  const CounterScreen({super.key});

  final Color primaryPink = const Color(0xFFE91E63);    // Pink cerah
  final Color secondaryRose = const Color(0xFF880E4F);  // Rose gelap

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFFFF0F5), // Lavender Blush
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 24.0, vertical: 16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  const Text('Counter', style: TextStyle(fontSize: 32, fontWeight: FontWeight.bold)),
                  Container(
                    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                    decoration: BoxDecoration(color: primaryPink.withOpacity(0.1), borderRadius: BorderRadius.circular(20)),
                    child: Row(
                      children: [
                        Icon(Icons.notifications_active, size: 16, color: primaryPink),
                        const SizedBox(width: 4),
                        Text('Aktif', style: TextStyle(color: primaryPink, fontWeight: FontWeight.bold)),
                      ],
                    ),
                  ),
                ],
              ),
              const Spacer(),
              Center(
                child: Container(
                  width: double.infinity,
                  padding: const EdgeInsets.symmetric(vertical: 48),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(32),
                    boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.04), blurRadius: 20, offset: const Offset(0, 10))],
                  ),
                  child: Column(
                    children: [
                      Text('NILAI SAAT INI', style: TextStyle(color: secondaryRose, fontWeight: FontWeight.w600, letterSpacing: 1.5)),
                      const SizedBox(height: 16),
                      Consumer<CounterProvider>(
                        builder: (context, provider, child) => Text(
                          '${provider.count}',
                          style: TextStyle(fontSize: 96, fontWeight: FontWeight.bold, color: primaryPink),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
              const Spacer(),
              Row(
                children: [
                  Expanded(
                    flex: 4,
                    child: OutlinedButton.icon(
                      onPressed: () => context.read<CounterProvider>().reset(),
                      style: OutlinedButton.styleFrom(
                        side: BorderSide(color: secondaryRose),
                        padding: const EdgeInsets.symmetric(vertical: 16),
                      ),
                      icon: Icon(Icons.refresh, color: secondaryRose),
                      label: Text('Reset', style: TextStyle(color: secondaryRose, fontWeight: FontWeight.bold)),
                    ),
                  ),
                  const SizedBox(width: 16),
                  Expanded(
                    flex: 6,
                    child: ElevatedButton.icon(
                      onPressed: () => context.read<CounterProvider>().increment(),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: primaryPink,
                        foregroundColor: Colors.white,
                        padding: const EdgeInsets.symmetric(vertical: 16),
                      ),
                      icon: const Icon(Icons.add),
                      label: const Text('Tambah', style: TextStyle(fontWeight: FontWeight.bold)),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 24),
            ],
          ),
        ),
      ),
    );
  }
}
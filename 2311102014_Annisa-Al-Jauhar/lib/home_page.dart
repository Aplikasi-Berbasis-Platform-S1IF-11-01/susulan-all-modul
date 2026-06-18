import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'counter_provider.dart';
import 'notification_service.dart';

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  static const Color primaryPink = Color(0xFFE91E8C);
  static const Color lightPink = Color(0xFFFCE4EC);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: lightPink,
      appBar: AppBar(
        backgroundColor: primaryPink,
        title: const Text(
          'Counter & Notifikasi',
          style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        centerTitle: true,
        elevation: 0,
      ),
      body: Consumer<CounterProvider>(
        builder: (context, counterProvider, child) {
          return Center(
            child: Padding(
              padding: const EdgeInsets.symmetric(horizontal: 32.0),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Text(
                    'Nilai Counter',
                    style: TextStyle(
                      fontSize: 18,
                      color: Color(0xFF880E4F),
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                  const SizedBox(height: 20),
                  Container(
                    width: 180,
                    height: 180,
                    decoration: BoxDecoration(
                      shape: BoxShape.circle,
                      gradient: const RadialGradient(
                        colors: [Color(0xFFF8BBD9), Color(0xFFF48FB1)],
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: primaryPink.withOpacity(0.3),
                          blurRadius: 20,
                          spreadRadius: 4,
                          offset: const Offset(0, 6),
                        ),
                      ],
                    ),
                    child: Center(
                      child: Text(
                        '${counterProvider.counter}',
                        style: const TextStyle(
                          fontSize: 64,
                          fontWeight: FontWeight.bold,
                          color: Color(0xFF880E4F),
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(height: 40),
                  SizedBox(
                    width: double.infinity,
                    height: 52,
                    child: ElevatedButton.icon(
                      onPressed: () async {
                        counterProvider.increment();
                        await NotificationService()
                            .showCounterNotification(counterProvider.counter);
                      },
                      style: ElevatedButton.styleFrom(
                        backgroundColor: primaryPink,
                        foregroundColor: Colors.white,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(30),
                        ),
                      ),
                      icon: const Icon(Icons.add_circle_outline),
                      label: const Text('Tambah',
                          style: TextStyle(fontSize: 16, fontWeight: FontWeight.w600)),
                    ),
                  ),
                  const SizedBox(height: 14),
                  SizedBox(
                    width: double.infinity,
                    height: 52,
                    child: OutlinedButton.icon(
                      onPressed: () async {
                        counterProvider.decrement();
                        await NotificationService()
                            .showCounterNotification(counterProvider.counter);
                      },
                      style: OutlinedButton.styleFrom(
                        foregroundColor: primaryPink,
                        side: const BorderSide(color: primaryPink, width: 2),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(30),
                        ),
                      ),
                      icon: const Icon(Icons.remove_circle_outline),
                      label: const Text('Kurang',
                          style: TextStyle(fontSize: 16, fontWeight: FontWeight.w600)),
                    ),
                  ),
                  const SizedBox(height: 14),
                  TextButton.icon(
                    onPressed: () => counterProvider.reset(),
                    style: TextButton.styleFrom(
                        foregroundColor: const Color(0xFF880E4F)),
                    icon: const Icon(Icons.refresh, size: 18),
                    label: const Text('Reset', style: TextStyle(fontSize: 15)),
                  ),
                  const SizedBox(height: 30),
                  Text(
                    'Setiap kali tombol ditekan, notifikasi lokal akan muncul\ndengan nilai counter terbaru.',
                    textAlign: TextAlign.center,
                    style: TextStyle(fontSize: 12, color: Colors.pink.shade300),
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }
}
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'counter_provider.dart';
import 'notification_service.dart';

// ─── PALETTE ────────────────────────────────────────────────
class Palette {
  static const Color bg = Color(0xFF0D1B2A);
  static const Color surface = Color(0xFF132233);
  static const Color card = Color(0xFF1A2F44);
  static const Color teal = Color(0xFF2EC4B6);
  static const Color mint = Color(0xFF80EAD3);
  static const Color coral = Color(0xFFFF6B6B);
  static const Color amber = Color(0xFFFFBF69);
  static const Color textPrimary = Color(0xFFF0F4F8);
  static const Color textSecondary = Color(0xFF8BA5BB);
  static const Color divider = Color(0xFF1F3448);
}

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  runApp(const MyApp());
}

// ─── APP ROOT ────────────────────────────────────────────────
class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (_) => CounterProvider(),
      child: MaterialApp(
        title: 'Counter App',
        debugShowCheckedModeBanner: false,
        theme: ThemeData(
          useMaterial3: true,
          brightness: Brightness.dark,
          scaffoldBackgroundColor: Palette.bg,
          colorScheme: const ColorScheme.dark(
            primary: Palette.teal,
            surface: Palette.surface,
          ),
        ),
        home: const HomePage(),
      ),
    );
  }
}

// ─── HOME PAGE ────────────────────────────────────────────────
class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Palette.bg,
      body: SafeArea(
        child: Consumer<CounterProvider>(
          builder: (context, provider, _) {
            return SingleChildScrollView(
              padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 20),
              child: Column(
                children: [
                  _buildHeader(),
                  const SizedBox(height: 32),
                  _buildCounterCard(provider),
                  const SizedBox(height: 28),
                  _buildControls(provider),
                  const SizedBox(height: 28),
                  _buildHistoryCard(provider),
                  const SizedBox(height: 16),
                  _buildFooter(),
                ],
              ),
            );
          },
        ),
      ),
    );
  }

  // ── HEADER ────────────────────────────────────────────────
  Widget _buildHeader() {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: const [
            Text(
              'COUNTER',
              style: TextStyle(
                fontSize: 11,
                fontWeight: FontWeight.w700,
                color: Palette.teal,
                letterSpacing: 4,
              ),
            ),
            SizedBox(height: 4),
            Text(
              'Dashboard',
              style: TextStyle(
                fontSize: 26,
                fontWeight: FontWeight.w800,
                color: Palette.textPrimary,
              ),
            ),
          ],
        ),
        Container(
          width: 44,
          height: 44,
          decoration: BoxDecoration(
            color: Palette.card,
            borderRadius: BorderRadius.circular(12),
            border: Border.all(color: Palette.divider),
          ),
          child: const Icon(
            Icons.notifications_outlined,
            color: Palette.teal,
          ),
        ),
      ],
    );
  }

  // ── COUNTER CARD ─────────────────────────────────────────────
  Widget _buildCounterCard(CounterProvider provider) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: Palette.card,
        borderRadius: BorderRadius.circular(28),
      ),
      child: Column(
        children: [
          Text(
            '${provider.counter}',
            style: const TextStyle(
              fontSize: 58,
              fontWeight: FontWeight.bold,
              color: Palette.textPrimary,
            ),
          ),
          const SizedBox(height: 8),
          const Text(
            'nilai saat ini',
            style: TextStyle(color: Palette.textSecondary),
          ),
          const SizedBox(height: 20),
          Text(
            'Riwayat: ${provider.history.length}',
            style: const TextStyle(color: Palette.teal),
          ),
        ],
      ),
    );
  }

  // ── CONTROLS ────────────────────────────────────────────────
  Widget _buildControls(CounterProvider provider) {
    return Row(
      children: [
        Expanded(
          child: ElevatedButton(
            onPressed: provider.decrement,
            child: const Text('Kurang'),
          ),
        ),
        const SizedBox(width: 10),
        Expanded(
          child: ElevatedButton(
            onPressed: provider.increment,
            child: const Text('Tambah'),
          ),
        ),
        const SizedBox(width: 10),
        Expanded(
          child: ElevatedButton(
            onPressed: provider.reset,
            child: const Text('Reset'),
          ),
        ),
      ],
    );
  }

  // ── HISTORY ────────────────────────────────────────────────
  Widget _buildHistoryCard(CounterProvider provider) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Palette.card,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            'Riwayat',
            style: TextStyle(
              color: Palette.textPrimary,
              fontWeight: FontWeight.bold,
            ),
          ),
          const SizedBox(height: 10),
          if (provider.history.isEmpty)
            const Text('Belum ada aktivitas',
                style: TextStyle(color: Palette.textSecondary))
          else
            ...provider.history.map(
              (e) => Text(
                e,
                style: const TextStyle(color: Palette.textSecondary),
              ),
            ),
        ],
      ),
    );
  }

  Widget _buildFooter() {
    return const Text(
      'Notifikasi lokal akan muncul saat tombol ditekan',
      textAlign: TextAlign.center,
      style: TextStyle(color: Palette.textSecondary, fontSize: 12),
    );
  }
}

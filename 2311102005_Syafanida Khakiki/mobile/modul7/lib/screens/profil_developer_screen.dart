// lib/screens/profil_developer_screen.dart
// Halaman Profil Developer – StatelessWidget

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ProfilDeveloperScreen extends StatelessWidget {
  const ProfilDeveloperScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Scaffold(
      backgroundColor: cs.background,
      appBar: AppBar(
        title: const Text('Profil Developer'),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_rounded),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            // ── Header Avatar ──
            _buildAvatarCard(cs),
            const SizedBox(height: 20),

            // ── Info Detail ──
            _buildInfoCard(cs),
            const SizedBox(height: 20),

            // ── Keahlian / Skills ──
            _buildSkillCard(cs),
            const SizedBox(height: 20),

            // ── Tentang Aplikasi ──
            _buildAboutApp(cs),
            const SizedBox(height: 40),
          ],
        ),
      ),
    );
  }

  // Widget kartu avatar / foto profil
  Widget _buildAvatarCard(ColorScheme cs) {
    return Container(
      padding: const EdgeInsets.all(28),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [cs.primary, cs.secondary],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(
            color: cs.primary.withOpacity(0.35),
            blurRadius: 14,
            offset: const Offset(0, 6),
          ),
        ],
      ),
      child: Column(
        children: [
          // Avatar inisial
          Container(
            width: 90,
            height: 90,
            decoration: BoxDecoration(
              color: Colors.white.withOpacity(0.2),
              shape: BoxShape.circle,
              border: Border.all(color: Colors.white, width: 3),
            ),
            alignment: Alignment.center,
            child: Text(
              'MR', // Inisial nama developer – ganti sesuai nama
              style: GoogleFonts.poppins(
                color: Colors.white,
                fontSize: 30,
                fontWeight: FontWeight.w700,
              ),
            ),
          ),
          const SizedBox(height: 14),
          Text(
            'Muhammad Rizky', // ← Ganti dengan nama Anda
            style: GoogleFonts.poppins(
              color: Colors.white,
              fontSize: 20,
              fontWeight: FontWeight.w700,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            'Mahasiswa Teknik Informatika',
            style: GoogleFonts.poppins(
              color: Colors.white70,
              fontSize: 13,
            ),
          ),
          const SizedBox(height: 12),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 6),
            decoration: BoxDecoration(
              color: Colors.white.withOpacity(0.18),
              borderRadius: BorderRadius.circular(20),
            ),
            child: Row(
              mainAxisSize: MainAxisSize.min,
              children: [
                const Icon(Icons.code_rounded,
                    color: Colors.white70, size: 16),
                const SizedBox(width: 6),
                Text(
                  'Flutter Developer',
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontSize: 12,
                    fontWeight: FontWeight.w500,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  // Widget kartu informasi detail
  Widget _buildInfoCard(ColorScheme cs) {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: cs.primary.withOpacity(0.07),
            blurRadius: 10,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _sectionTitle('Informasi Mahasiswa', Icons.info_outline_rounded, cs),
          const SizedBox(height: 16),
          _infoRow(Icons.badge_rounded, 'NIM', '22110001', cs),   // ← Ganti NIM
          _divider(),
          _infoRow(Icons.class_rounded, 'Kelas', 'TI-3A', cs),     // ← Ganti Kelas
          _divider(),
          _infoRow(Icons.school_rounded, 'Program Studi',
              'Teknik Informatika', cs),
          _divider(),
          _infoRow(Icons.account_balance_rounded, 'Universitas',
              'Universitas Xxx', cs),                               // ← Ganti
          _divider(),
          _infoRow(Icons.email_rounded, 'Email',
              'rizky@example.com', cs),                             // ← Ganti
        ],
      ),
    );
  }

  // Widget kartu keahlian
  Widget _buildSkillCard(ColorScheme cs) {
    final skills = [
      ('Flutter', Icons.phone_android_rounded, cs.secondary),
      ('Dart', Icons.code_rounded, const Color(0xFF00BCD4)),
      ('Firebase', Icons.local_fire_department_rounded, Colors.orange),
      ('Git', Icons.merge_type_rounded, const Color(0xFFF44336)),
      ('UI/UX', Icons.design_services_rounded, const Color(0xFF9C27B0)),
      ('REST API', Icons.api_rounded, const Color(0xFF4CAF50)),
    ];

    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: cs.primary.withOpacity(0.07),
            blurRadius: 10,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _sectionTitle('Keahlian', Icons.star_rounded, cs),
          const SizedBox(height: 14),
          Wrap(
            spacing: 10,
            runSpacing: 10,
            children: skills
                .map((s) => _SkillChip(label: s.$1, icon: s.$2, color: s.$3))
                .toList(),
          ),
        ],
      ),
    );
  }

  // Widget tentang aplikasi
  Widget _buildAboutApp(ColorScheme cs) {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: cs.secondary.withOpacity(0.08),
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: cs.secondary.withOpacity(0.3)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _sectionTitle('Tentang Aplikasi', Icons.apps_rounded, cs),
          const SizedBox(height: 12),
          Text(
            'Aplikasi Data Mahasiswa ini dibuat sebagai tugas praktik Modul 7 '
            'mata kuliah Pemrograman Mobile. Aplikasi ini mendemonstrasikan '
            'penggunaan StatefulWidget, StatelessWidget, Navigator, '
            'Google Fonts, dan berbagai komponen Material Design pada Flutter.',
            style: GoogleFonts.poppins(
              fontSize: 13,
              color: const Color(0xFF4A5568),
              height: 1.6,
            ),
          ),
          const SizedBox(height: 14),
          Row(
            children: [
              _appBadge('Flutter 3.x', Icons.flutter_dash, cs.secondary),
              const SizedBox(width: 10),
              _appBadge('Dart 3.x', Icons.code_rounded, cs.tertiary),
              const SizedBox(width: 10),
              _appBadge('Material 3', Icons.palette_rounded,
                  const Color(0xFF9C27B0)),
            ],
          ),
        ],
      ),
    );
  }

  // Helper widgets
  Widget _sectionTitle(String title, IconData icon, ColorScheme cs) {
    return Row(
      children: [
        Icon(icon, size: 20, color: cs.secondary),
        const SizedBox(width: 8),
        Text(
          title,
          style: GoogleFonts.poppins(
            fontSize: 15,
            fontWeight: FontWeight.w600,
            color: cs.primary,
          ),
        ),
      ],
    );
  }

  Widget _infoRow(IconData icon, String label, String value, ColorScheme cs) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 6),
      child: Row(
        children: [
          Icon(icon, size: 18, color: cs.secondary),
          const SizedBox(width: 12),
          Text(
            '$label:',
            style: GoogleFonts.poppins(
              fontSize: 13,
              color: const Color(0xFF6B7A99),
            ),
          ),
          const SizedBox(width: 8),
          Expanded(
            child: Text(
              value,
              style: GoogleFonts.poppins(
                fontSize: 13,
                fontWeight: FontWeight.w600,
                color: const Color(0xFF1A2A4A),
              ),
              textAlign: TextAlign.end,
            ),
          ),
        ],
      ),
    );
  }

  Widget _divider() {
    return const Divider(height: 1, color: Color(0xFFF0F0F0));
  }

  Widget _appBadge(String label, IconData icon, Color color) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      decoration: BoxDecoration(
        color: color.withOpacity(0.12),
        borderRadius: BorderRadius.circular(8),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, size: 13, color: color),
          const SizedBox(width: 4),
          Text(
            label,
            style: GoogleFonts.poppins(
              fontSize: 11,
              color: color,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }
}

// ── Chip keahlian (StatelessWidget) ──
class _SkillChip extends StatelessWidget {
  final String label;
  final IconData icon;
  final Color color;

  const _SkillChip(
      {required this.label, required this.icon, required this.color});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 7),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(10),
        border: Border.all(color: color.withOpacity(0.4)),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, size: 15, color: color),
          const SizedBox(width: 6),
          Text(
            label,
            style: GoogleFonts.poppins(
              fontSize: 12,
              color: color,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }
}

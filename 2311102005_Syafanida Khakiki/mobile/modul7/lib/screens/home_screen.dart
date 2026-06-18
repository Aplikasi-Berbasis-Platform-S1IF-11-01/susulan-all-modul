// lib/screens/home_screen.dart
// Halaman utama (Home) – StatefulWidget

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/mahasiswa.dart';
import 'form_mahasiswa_screen.dart';
import 'profil_developer_screen.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  // Daftar data mahasiswa yang sudah disimpan
  final List<Mahasiswa> _daftarMahasiswa = [];

  // Dipanggil setelah kembali dari FormMahasiswaScreen
  void _bukaFormMahasiswa() async {
    final hasil = await Navigator.push<Mahasiswa>(
      context,
      MaterialPageRoute(builder: (_) => const FormMahasiswaScreen()),
    );

    if (hasil != null) {
      setState(() {
        _daftarMahasiswa.add(hasil);
      });
    }
  }

  void _bukaProfil() {
    Navigator.push(
      context,
      MaterialPageRoute(builder: (_) => const ProfilDeveloperScreen()),
    );
  }

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Scaffold(
      backgroundColor: cs.background,
      appBar: AppBar(
        title: const Text('Data Mahasiswa'),
        actions: [
          IconButton(
            icon: const Icon(Icons.person_pin_rounded),
            tooltip: 'Profil Developer',
            onPressed: _bukaProfil,
          ),
        ],
      ),

      // ── FAB untuk tambah mahasiswa ──
      floatingActionButton: FloatingActionButton.extended(
        onPressed: _bukaFormMahasiswa,
        backgroundColor: cs.secondary,
        foregroundColor: Colors.white,
        icon: const Icon(Icons.add_rounded),
        label: Text(
          'Tambah Mahasiswa',
          style: GoogleFonts.poppins(fontWeight: FontWeight.w600),
        ),
      ),

      body: Column(
        children: [
          // ── Banner Header ──
          _buildHeader(cs),

          // ── Daftar Mahasiswa ──
          Expanded(
            child: _daftarMahasiswa.isEmpty
                ? _buildEmptyState(cs)
                : _buildList(cs),
          ),
        ],
      ),
    );
  }

  // Widget banner di bagian atas
  Widget _buildHeader(ColorScheme cs) {
    return Container(
      width: double.infinity,
      margin: const EdgeInsets.all(16),
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 18),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [cs.primary, cs.secondary],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: cs.primary.withOpacity(0.35),
            blurRadius: 12,
            offset: const Offset(0, 6),
          ),
        ],
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(12),
            decoration: BoxDecoration(
              color: Colors.white.withOpacity(0.2),
              borderRadius: BorderRadius.circular(12),
            ),
            child: const Icon(Icons.school_rounded,
                color: Colors.white, size: 36),
          ),
          const SizedBox(width: 14),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  'Selamat Datang!',
                  style: GoogleFonts.poppins(
                    color: Colors.white70,
                    fontSize: 13,
                  ),
                ),
                Text(
                  'Sistem Data\nMahasiswa',
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontSize: 20,
                    fontWeight: FontWeight.w700,
                    height: 1.2,
                  ),
                ),
              ],
            ),
          ),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
            decoration: BoxDecoration(
              color: Colors.white.withOpacity(0.2),
              borderRadius: BorderRadius.circular(20),
            ),
            child: Text(
              '${_daftarMahasiswa.length} Data',
              style: GoogleFonts.poppins(
                color: Colors.white,
                fontWeight: FontWeight.w600,
                fontSize: 13,
              ),
            ),
          ),
        ],
      ),
    );
  }

  // Tampilan kosong jika belum ada data
  Widget _buildEmptyState(ColorScheme cs) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Container(
            padding: const EdgeInsets.all(24),
            decoration: BoxDecoration(
              color: cs.primary.withOpacity(0.08),
              shape: BoxShape.circle,
            ),
            child: Icon(
              Icons.people_outline_rounded,
              size: 64,
              color: cs.primary.withOpacity(0.5),
            ),
          ),
          const SizedBox(height: 16),
          Text(
            'Belum ada data mahasiswa',
            style: GoogleFonts.poppins(
              color: const Color(0xFF6B7A99),
              fontSize: 16,
              fontWeight: FontWeight.w500,
            ),
          ),
          const SizedBox(height: 6),
          Text(
            'Tekan tombol di bawah untuk menambahkan',
            style: GoogleFonts.poppins(
              color: const Color(0xFFB0BAD3),
              fontSize: 13,
            ),
          ),
          const SizedBox(height: 80), // ruang untuk FAB
        ],
      ),
    );
  }

  // Daftar kartu mahasiswa
  Widget _buildList(ColorScheme cs) {
    return ListView.builder(
      padding: const EdgeInsets.fromLTRB(16, 0, 16, 100),
      itemCount: _daftarMahasiswa.length,
      itemBuilder: (context, index) {
        final mhs = _daftarMahasiswa[index];
        return _MahasiswaCard(
          mahasiswa: mhs,
          nomor: index + 1,
        );
      },
    );
  }
}

// ── Kartu Mahasiswa (StatelessWidget) ──
class _MahasiswaCard extends StatelessWidget {
  final Mahasiswa mahasiswa;
  final int nomor;

  const _MahasiswaCard({required this.mahasiswa, required this.nomor});

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: cs.primary.withOpacity(0.08),
            blurRadius: 8,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      child: Row(
        children: [
          // Nomor urut
          Container(
            width: 42,
            height: 42,
            decoration: BoxDecoration(
              color: cs.secondary.withOpacity(0.12),
              borderRadius: BorderRadius.circular(10),
            ),
            alignment: Alignment.center,
            child: Text(
              '$nomor',
              style: GoogleFonts.poppins(
                color: cs.secondary,
                fontWeight: FontWeight.w700,
                fontSize: 16,
              ),
            ),
          ),
          const SizedBox(width: 14),

          // Info mahasiswa
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  mahasiswa.nama,
                  style: GoogleFonts.poppins(
                    fontWeight: FontWeight.w600,
                    fontSize: 15,
                    color: const Color(0xFF1A2A4A),
                  ),
                ),
                const SizedBox(height: 4),
                Row(
                  children: [
                    const Icon(Icons.badge_outlined,
                        size: 14, color: Color(0xFF6B7A99)),
                    const SizedBox(width: 4),
                    Text(
                      mahasiswa.nim,
                      style: GoogleFonts.poppins(
                        fontSize: 13,
                        color: const Color(0xFF6B7A99),
                      ),
                    ),
                    const SizedBox(width: 12),
                    const Icon(Icons.class_outlined,
                        size: 14, color: Color(0xFF6B7A99)),
                    const SizedBox(width: 4),
                    Text(
                      mahasiswa.kelas,
                      style: GoogleFonts.poppins(
                        fontSize: 13,
                        color: const Color(0xFF6B7A99),
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),

          // Badge kelas
          Container(
            padding:
                const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
            decoration: BoxDecoration(
              color: cs.tertiary.withOpacity(0.12),
              borderRadius: BorderRadius.circular(8),
            ),
            child: Text(
              mahasiswa.kelas,
              style: GoogleFonts.poppins(
                color: cs.tertiary,
                fontWeight: FontWeight.w600,
                fontSize: 12,
              ),
            ),
          ),
        ],
      ),
    );
  }
}

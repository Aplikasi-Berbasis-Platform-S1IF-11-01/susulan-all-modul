import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ProfilPage extends StatelessWidget {
  const ProfilPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F5FF),
      appBar: AppBar(
        title: Text(
          'Profil Developer',
          style: GoogleFonts.poppins(
            fontWeight: FontWeight.bold,
            color: Colors.white,
          ),
        ),
        backgroundColor: const Color(0xFF6C63FF),
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(24),
        child: Column(
          children: [
            const SizedBox(height: 10),
            // Avatar
            Container(
              padding: const EdgeInsets.all(4),
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                gradient: const LinearGradient(
                  colors: [Color(0xFF6C63FF), Color(0xFF48CAE4)],
                ),
                boxShadow: [
                  BoxShadow(
                    color: const Color(0xFF6C63FF).withOpacity(0.4),
                    blurRadius: 15,
                    offset: const Offset(0, 6),
                  ),
                ],
              ),
              child: const CircleAvatar(
                radius: 52,
                backgroundColor: Color(0xFFEEF2FF),
                child: Icon(Icons.person, size: 56, color: Color(0xFF6C63FF)),
              ),
            ),
            const SizedBox(height: 20),

            // Nama
            Text(
              'Imelda Fajar Awalina Crisyanti',
              style: GoogleFonts.poppins(
                fontSize: 20,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 4),
            Text(
              '2311102004',
              style: GoogleFonts.poppins(
                fontSize: 14,
                color: Colors.grey[600],
              ),
            ),
            const SizedBox(height: 24),

            // Info Card
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(16),
                boxShadow: [
                  BoxShadow(
                    color: Colors.grey.withOpacity(0.1),
                    blurRadius: 10,
                    offset: const Offset(0, 4),
                  ),
                ],
              ),
              child: Column(
                children: [
                  _buildInfoRow(Icons.class_, 'Kelas', 'IF-11-01'),
                  const Divider(height: 24),
                  _buildInfoRow(Icons.school, 'Universitas', 'Universitas Telkom Purwokerto'),
                  const Divider(height: 24),
                  _buildInfoRow(Icons.book, 'Mata Kuliah', 'Aplikasi Berbasis Platform'),
                  const Divider(height: 24),
                  _buildInfoRow(Icons.layers, 'Modul', 'Modul 7 - Flutter Navigation'),
                ],
              ),
            ),
            const SizedBox(height: 24),

            // Badge
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
              decoration: BoxDecoration(
                gradient: const LinearGradient(
                  colors: [Color(0xFF6C63FF), Color(0xFF48CAE4)],
                ),
                borderRadius: BorderRadius.circular(30),
              ),
              child: Row(
                mainAxisSize: MainAxisSize.min,
                children: [
                  const Icon(Icons.code, color: Colors.white, size: 18),
                  const SizedBox(width: 8),
                  Text(
                    'Flutter Developer',
                    style: GoogleFonts.poppins(
                      color: Colors.white,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildInfoRow(IconData icon, String label, String value) {
    return Row(
      children: [
        Container(
          padding: const EdgeInsets.all(8),
          decoration: BoxDecoration(
            color: const Color(0xFFEEF2FF),
            borderRadius: BorderRadius.circular(10),
          ),
          child: Icon(icon, color: const Color(0xFF6C63FF), size: 20),
        ),
        const SizedBox(width: 14),
        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(label,
                style: GoogleFonts.poppins(fontSize: 11, color: Colors.grey)),
            Text(value,
                style: GoogleFonts.poppins(
                    fontSize: 14, fontWeight: FontWeight.w600)),
          ],
        ),
      ],
    );
  }
}
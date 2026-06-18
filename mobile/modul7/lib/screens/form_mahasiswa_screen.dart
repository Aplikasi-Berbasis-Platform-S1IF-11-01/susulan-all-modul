// lib/screens/form_mahasiswa_screen.dart
// Halaman Form Input Mahasiswa – StatefulWidget

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../models/mahasiswa.dart';

class FormMahasiswaScreen extends StatefulWidget {
  const FormMahasiswaScreen({super.key});

  @override
  State<FormMahasiswaScreen> createState() => _FormMahasiswaScreenState();
}

class _FormMahasiswaScreenState extends State<FormMahasiswaScreen> {
  // GlobalKey untuk validasi form
  final _formKey = GlobalKey<FormState>();

  // Controller untuk setiap field
  final _namaController = TextEditingController();
  final _nimController = TextEditingController();
  final _kelasController = TextEditingController();

  // Data yang sudah disimpan (ditampilkan setelah tombol Simpan ditekan)
  Mahasiswa? _dataTersimpan;

  @override
  void dispose() {
    _namaController.dispose();
    _nimController.dispose();
    _kelasController.dispose();
    super.dispose();
  }

  // ── Fungsi simpan data ──
  void _simpanData() {
    if (_formKey.currentState!.validate()) {
      final mahasiswaBaru = Mahasiswa(
        nama: _namaController.text.trim(),
        nim: _nimController.text.trim(),
        kelas: _kelasController.text.trim(),
      );

      setState(() {
        _dataTersimpan = mahasiswaBaru;
      });

      // Tampilkan SnackBar notifikasi berhasil
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Row(
            children: [
              const Icon(Icons.check_circle_rounded,
                  color: Colors.white, size: 20),
              const SizedBox(width: 10),
              Expanded(
                child: Text(
                  'Data ${mahasiswaBaru.nama} berhasil disimpan!',
                  style: GoogleFonts.poppins(
                    color: Colors.white,
                    fontWeight: FontWeight.w500,
                  ),
                ),
              ),
            ],
          ),
          backgroundColor: const Color(0xFF2E7D32),
          behavior: SnackBarBehavior.floating,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
          ),
          margin: const EdgeInsets.all(16),
          duration: const Duration(seconds: 3),
        ),
      );
    }
  }

  // ── Fungsi kirim data ke HomeScreen & pop ──
  void _kirimData() {
    if (_dataTersimpan != null) {
      Navigator.pop(context, _dataTersimpan);
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(
            'Simpan data terlebih dahulu sebelum mengirim.',
            style: GoogleFonts.poppins(color: Colors.white),
          ),
          backgroundColor: Colors.orange[700],
          behavior: SnackBarBehavior.floating,
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
          margin: const EdgeInsets.all(16),
        ),
      );
    }
  }

  // ── Reset form ──
  void _resetForm() {
    _formKey.currentState!.reset();
    _namaController.clear();
    _nimController.clear();
    _kelasController.clear();
    setState(() => _dataTersimpan = null);
  }

  @override
  Widget build(BuildContext context) {
    final cs = Theme.of(context).colorScheme;

    return Scaffold(
      backgroundColor: cs.background,
      appBar: AppBar(
        title: const Text('Form Mahasiswa'),
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
            // ── Judul seksi form ──
            _buildSectionLabel('Isi Data Mahasiswa', Icons.edit_note_rounded, cs),
            const SizedBox(height: 12),

            // ── Container Form ──
            Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(20),
                boxShadow: [
                  BoxShadow(
                    color: cs.primary.withOpacity(0.08),
                    blurRadius: 10,
                    offset: const Offset(0, 4),
                  ),
                ],
              ),
              child: Form(
                key: _formKey,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    // Field Nama
                    _buildTextField(
                      controller: _namaController,
                      label: 'Nama Lengkap',
                      hint: 'Contoh: Budi Santoso',
                      icon: Icons.person_rounded,
                      validator: (v) {
                        if (v == null || v.trim().isEmpty) {
                          return 'Nama tidak boleh kosong';
                        }
                        if (v.trim().length < 3) {
                          return 'Nama minimal 3 karakter';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 16),

                    // Field NIM
                    _buildTextField(
                      controller: _nimController,
                      label: 'NIM',
                      hint: 'Contoh: 22110001',
                      icon: Icons.badge_rounded,
                      keyboardType: TextInputType.number,
                      validator: (v) {
                        if (v == null || v.trim().isEmpty) {
                          return 'NIM tidak boleh kosong';
                        }
                        if (v.trim().length < 5) {
                          return 'NIM minimal 5 digit';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 16),

                    // Field Kelas
                    _buildTextField(
                      controller: _kelasController,
                      label: 'Kelas',
                      hint: 'Contoh: TI-3A',
                      icon: Icons.class_rounded,
                      validator: (v) {
                        if (v == null || v.trim().isEmpty) {
                          return 'Kelas tidak boleh kosong';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 24),

                    // Tombol aksi
                    Row(
                      children: [
                        // Reset
                        OutlinedButton.icon(
                          onPressed: _resetForm,
                          icon: const Icon(Icons.refresh_rounded, size: 18),
                          label: Text(
                            'Reset',
                            style: GoogleFonts.poppins(
                                fontWeight: FontWeight.w500),
                          ),
                          style: OutlinedButton.styleFrom(
                            foregroundColor: const Color(0xFF6B7A99),
                            side: const BorderSide(color: Color(0xFFCDD5E0)),
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                            padding: const EdgeInsets.symmetric(
                                horizontal: 16, vertical: 14),
                          ),
                        ),
                        const SizedBox(width: 12),

                        // Simpan
                        Expanded(
                          child: ElevatedButton.icon(
                            onPressed: _simpanData,
                            icon: const Icon(Icons.save_rounded, size: 18),
                            label: Text(
                              'Simpan',
                              style: GoogleFonts.poppins(
                                  fontWeight: FontWeight.w600),
                            ),
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
            ),

            // ── Preview Data Tersimpan ──
            if (_dataTersimpan != null) ...[
              const SizedBox(height: 24),
              _buildSectionLabel(
                  'Data Berhasil Disimpan', Icons.check_circle_rounded, cs,
                  color: const Color(0xFF2E7D32)),
              const SizedBox(height: 12),
              _buildPreviewCard(_dataTersimpan!, cs),
              const SizedBox(height: 16),
              ElevatedButton.icon(
                onPressed: _kirimData,
                icon: const Icon(Icons.send_rounded, size: 18),
                label: Text(
                  'Tambahkan ke Daftar',
                  style:
                      GoogleFonts.poppins(fontWeight: FontWeight.w600),
                ),
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF2E7D32),
                ),
              ),
            ],

            const SizedBox(height: 40),
          ],
        ),
      ),
    );
  }

  // Widget label seksi
  Widget _buildSectionLabel(String text, IconData icon, ColorScheme cs,
      {Color? color}) {
    return Row(
      children: [
        Icon(icon, size: 20, color: color ?? cs.secondary),
        const SizedBox(width: 8),
        Text(
          text,
          style: GoogleFonts.poppins(
            fontSize: 15,
            fontWeight: FontWeight.w600,
            color: color ?? cs.primary,
          ),
        ),
      ],
    );
  }

  // Widget text field dengan ikon
  Widget _buildTextField({
    required TextEditingController controller,
    required String label,
    required String hint,
    required IconData icon,
    TextInputType keyboardType = TextInputType.text,
    String? Function(String?)? validator,
  }) {
    return TextFormField(
      controller: controller,
      keyboardType: keyboardType,
      validator: validator,
      style: GoogleFonts.poppins(fontSize: 14),
      decoration: InputDecoration(
        labelText: label,
        hintText: hint,
        prefixIcon: Icon(icon, size: 20, color: const Color(0xFF6B7A99)),
      ),
    );
  }

  // Widget preview data tersimpan
  Widget _buildPreviewCard(Mahasiswa mhs, ColorScheme cs) {
    return Container(
      padding: const EdgeInsets.all(18),
      decoration: BoxDecoration(
        color: const Color(0xFFE8F5E9),
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: const Color(0xFFA5D6A7)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _previewRow(Icons.person_rounded, 'Nama', mhs.nama),
          const Divider(height: 20, color: Color(0xFFA5D6A7)),
          _previewRow(Icons.badge_rounded, 'NIM', mhs.nim),
          const Divider(height: 20, color: Color(0xFFA5D6A7)),
          _previewRow(Icons.class_rounded, 'Kelas', mhs.kelas),
        ],
      ),
    );
  }

  Widget _previewRow(IconData icon, String label, String value) {
    return Row(
      children: [
        Icon(icon, size: 18, color: const Color(0xFF2E7D32)),
        const SizedBox(width: 10),
        Text(
          '$label: ',
          style: GoogleFonts.poppins(
            fontSize: 13,
            color: const Color(0xFF4CAF50),
            fontWeight: FontWeight.w500,
          ),
        ),
        Expanded(
          child: Text(
            value,
            style: GoogleFonts.poppins(
              fontSize: 13,
              fontWeight: FontWeight.w600,
              color: const Color(0xFF1B5E20),
            ),
          ),
        ),
      ],
    );
  }
}

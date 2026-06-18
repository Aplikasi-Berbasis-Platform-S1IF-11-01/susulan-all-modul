import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'notification_service.dart';

/// Halaman utama aplikasi yang menampilkan:
/// - 2 tombol untuk mengambil foto (kamera & galeri)
/// - Tampilan foto hasil
/// - Informasi status
class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> with SingleTickerProviderStateMixin {
  // ── State Variables ──────────────────────────────────────────────────────
  File? _fotoTerpilih;         // File foto yang dipilih/diambil
  String _statusPesan = '';    // Pesan status untuk ditampilkan ke user
  bool _isLoading = false;     // Indikator loading saat proses foto
  String? _sumberFoto;         // Keterangan sumber: 'Kamera' atau 'Galeri'

  // Instance ImagePicker untuk mengakses kamera dan galeri
  final ImagePicker _imagePicker = ImagePicker();

  // AnimationController untuk animasi fade-in foto
  late AnimationController _animationController;
  late Animation<double> _fadeAnimation;

  @override
  void initState() {
    super.initState();
    // Setup animasi fade-in
    _animationController = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 500),
    );
    _fadeAnimation = CurvedAnimation(
      parent: _animationController,
      curve: Curves.easeIn,
    );

    // Minta izin notifikasi saat halaman pertama dibuka
    NotificationService.requestPermission();
  }

  @override
  void dispose() {
    _animationController.dispose();
    super.dispose();
  }

  // ── Fungsi Ambil Foto dari Kamera ────────────────────────────────────────
  Future<void> _ambilFotoDariKamera() async {
    setState(() {
      _isLoading = true;
      _statusPesan = 'Membuka kamera...';
    });

    try {
      // Membuka kamera menggunakan ImageSource.camera
      final XFile? foto = await _imagePicker.pickImage(
        source: ImageSource.camera,   // Sumber: kamera
        imageQuality: 85,             // Kualitas gambar 85% untuk menghemat memori
        maxWidth: 1920,               // Lebar maksimal gambar
        maxHeight: 1080,              // Tinggi maksimal gambar
      );

      if (foto != null) {
        setState(() {
          _fotoTerpilih = File(foto.path);  // Simpan file foto ke state
          _sumberFoto = 'Kamera';
          _statusPesan = '✅ Foto dari kamera berhasil diambil!';
          _isLoading = false;
        });

        // Jalankan animasi fade-in untuk foto
        _animationController.reset();
        _animationController.forward();

        // Tampilkan notifikasi lokal
        await NotificationService.tampilkanNotifikasi(source: 'kamera');
      } else {
        // User membatalkan pengambilan foto
        setState(() {
          _statusPesan = '⚠️ Pengambilan foto dibatalkan.';
          _isLoading = false;
        });
      }
    } catch (e) {
      setState(() {
        _statusPesan = '❌ Error: ${e.toString()}';
        _isLoading = false;
      });
    }
  }

  // ── Fungsi Pilih Foto dari Galeri ────────────────────────────────────────
  Future<void> _pilihFotoDariGaleri() async {
    setState(() {
      _isLoading = true;
      _statusPesan = 'Membuka galeri...';
    });

    try {
      // Membuka galeri menggunakan ImageSource.gallery
      final XFile? foto = await _imagePicker.pickImage(
        source: ImageSource.gallery,  // Sumber: galeri
        imageQuality: 85,
        maxWidth: 1920,
        maxHeight: 1080,
      );

      if (foto != null) {
        setState(() {
          _fotoTerpilih = File(foto.path);  // Simpan file foto ke state
          _sumberFoto = 'Galeri';
          _statusPesan = '✅ Foto dari galeri berhasil dipilih!';
          _isLoading = false;
        });

        // Jalankan animasi fade-in
        _animationController.reset();
        _animationController.forward();

        // Tampilkan notifikasi lokal
        await NotificationService.tampilkanNotifikasi(source: 'galeri');
      } else {
        setState(() {
          _statusPesan = '⚠️ Pemilihan foto dibatalkan.';
          _isLoading = false;
        });
      }
    } catch (e) {
      setState(() {
        _statusPesan = '❌ Error: ${e.toString()}';
        _isLoading = false;
      });
    }
  }

  // ── Fungsi Reset Foto ────────────────────────────────────────────────────
  void _resetFoto() {
    setState(() {
      _fotoTerpilih = null;
      _sumberFoto = null;
      _statusPesan = '';
    });
    _animationController.reset();
  }

  // ── Build UI ─────────────────────────────────────────────────────────────
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // ── AppBar ──────────────────────────────────────────────────────────
      appBar: AppBar(
        title: const Text(
          'Foto & Notifikasi',
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
        actions: [
          // Tombol reset (hanya muncul jika ada foto)
          if (_fotoTerpilih != null)
            IconButton(
              icon: const Icon(Icons.refresh),
              tooltip: 'Reset Foto',
              onPressed: _resetFoto,
            ),
        ],
      ),

      // ── Body ─────────────────────────────────────────────────────────────
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            // ── Header Card ───────────────────────────────────────────────
            _buildHeaderCard(),
            const SizedBox(height: 24),

            // ── Tombol-tombol Foto ────────────────────────────────────────
            _buildTombolSection(),
            const SizedBox(height: 24),

            // ── Pesan Status ──────────────────────────────────────────────
            if (_statusPesan.isNotEmpty) _buildStatusPesan(),
            if (_statusPesan.isNotEmpty) const SizedBox(height: 16),

            // ── Area Tampilan Foto ────────────────────────────────────────
            _buildAreaFoto(),

            const SizedBox(height: 20),

            // ── Info Identitas ────────────────────────────────────────────
            _buildInfoIdentitas(),
          ],
        ),
      ),
    );
  }

  // ── Widget: Header Card ──────────────────────────────────────────────────
  Widget _buildHeaderCard() {
    return Card(
      elevation: 3,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
      color: const Color(0xFF1565C0),
      child: const Padding(
        padding: EdgeInsets.all(20.0),
        child: Row(
          children: [
            Icon(Icons.camera_alt, color: Colors.white, size: 40),
            SizedBox(width: 16),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Tugas Praktikum',
                    style: TextStyle(
                      color: Colors.white70,
                      fontSize: 12,
                    ),
                  ),
                  Text(
                    'Modul 8-9: Notifikasi & API Perangkat Keras',
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
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

  // ── Widget: Bagian Tombol ────────────────────────────────────────────────
  Widget _buildTombolSection() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.stretch,
      children: [
        // Label section
        const Text(
          'Pilih Sumber Foto',
          style: TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.bold,
            color: Color(0xFF37474F),
          ),
          textAlign: TextAlign.center,
        ),
        const SizedBox(height: 16),

        // Row 2 tombol
        Row(
          children: [
            // ── Tombol 1: Kamera ───────────────────────────────────────
            Expanded(
              child: ElevatedButton.icon(
                onPressed: _isLoading ? null : _ambilFotoDariKamera,
                icon: const Icon(Icons.camera_alt, size: 22),
                label: const Text(
                  'Buka Kamera',
                  style: TextStyle(fontSize: 14, fontWeight: FontWeight.w600),
                ),
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF1565C0),
                  foregroundColor: Colors.white,
                  padding: const EdgeInsets.symmetric(vertical: 16),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                  elevation: 3,
                ),
              ),
            ),
            const SizedBox(width: 12),

            // ── Tombol 2: Galeri ──────────────────────────────────────
            Expanded(
              child: ElevatedButton.icon(
                onPressed: _isLoading ? null : _pilihFotoDariGaleri,
                icon: const Icon(Icons.photo_library, size: 22),
                label: const Text(
                  'Pilih Galeri',
                  style: TextStyle(fontSize: 14, fontWeight: FontWeight.w600),
                ),
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF2E7D32),
                  foregroundColor: Colors.white,
                  padding: const EdgeInsets.symmetric(vertical: 16),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                  elevation: 3,
                ),
              ),
            ),
          ],
        ),

        // Loading indicator
        if (_isLoading) ...[
          const SizedBox(height: 16),
          const LinearProgressIndicator(),
        ],
      ],
    );
  }

  // ── Widget: Pesan Status ─────────────────────────────────────────────────
  Widget _buildStatusPesan() {
    final bool isError = _statusPesan.contains('❌');
    final bool isWarning = _statusPesan.contains('⚠️');

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
      decoration: BoxDecoration(
        color: isError
            ? Colors.red.shade50
            : isWarning
            ? Colors.orange.shade50
            : Colors.green.shade50,
        borderRadius: BorderRadius.circular(10),
        border: Border.all(
          color: isError
              ? Colors.red.shade200
              : isWarning
              ? Colors.orange.shade200
              : Colors.green.shade200,
        ),
      ),
      child: Text(
        _statusPesan,
        style: TextStyle(
          fontSize: 13,
          color: isError
              ? Colors.red.shade700
              : isWarning
              ? Colors.orange.shade700
              : Colors.green.shade700,
          fontWeight: FontWeight.w500,
        ),
        textAlign: TextAlign.center,
      ),
    );
  }

  // ── Widget: Area Tampilan Foto ───────────────────────────────────────────
  Widget _buildAreaFoto() {
    if (_fotoTerpilih == null) {
      // Placeholder ketika belum ada foto
      return Container(
        width: double.infinity,
        height: 280,
        decoration: BoxDecoration(
          color: Colors.grey.shade100,
          borderRadius: BorderRadius.circular(16),
          border: Border.all(
            color: Colors.grey.shade300,
            width: 2,
            style: BorderStyle.solid,
          ),
        ),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(
              Icons.add_photo_alternate_outlined,
              size: 64,
              color: Colors.grey.shade400,
            ),
            const SizedBox(height: 12),
            Text(
              'Belum ada foto',
              style: TextStyle(
                fontSize: 16,
                color: Colors.grey.shade500,
                fontWeight: FontWeight.w500,
              ),
            ),
            const SizedBox(height: 4),
            Text(
              'Tekan tombol di atas untuk\nmengambil atau memilih foto',
              style: TextStyle(
                fontSize: 12,
                color: Colors.grey.shade400,
              ),
              textAlign: TextAlign.center,
            ),
          ],
        ),
      );
    }

    // Tampilan foto yang sudah dipilih dengan animasi fade-in
    return Column(
      children: [
        // Label sumber foto
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
          decoration: BoxDecoration(
            color: _sumberFoto == 'Kamera'
                ? const Color(0xFF1565C0)
                : const Color(0xFF2E7D32),
            borderRadius: BorderRadius.circular(20),
          ),
          child: Row(
            mainAxisSize: MainAxisSize.min,
            children: [
              Icon(
                _sumberFoto == 'Kamera' ? Icons.camera_alt : Icons.photo_library,
                color: Colors.white,
                size: 14,
              ),
              const SizedBox(width: 6),
              Text(
                'Sumber: $_sumberFoto',
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 12,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
        ),
        const SizedBox(height: 12),

        // Gambar dengan animasi FadeTransition
        FadeTransition(
          opacity: _fadeAnimation,
          child: ClipRRect(
            borderRadius: BorderRadius.circular(16),
            child: Image.file(
              _fotoTerpilih!,
              width: double.infinity,
              height: 320,
              fit: BoxFit.cover,
            ),
          ),
        ),
      ],
    );
  }

  // ── Widget: Info Identitas ───────────────────────────────────────────────
  Widget _buildInfoIdentitas() {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.grey.shade100,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: Colors.grey.shade300),
      ),
      child: const Column(
        children: [
          Text(
            'Imelda Fajar Awalina Crisyanti',
            style: TextStyle(
              fontWeight: FontWeight.bold,
              fontSize: 14,
              color: Color(0xFF1565C0),
            ),
          ),
          SizedBox(height: 4),
          Text(
            'NIM: 2311102004 | Kelas: IF-11-01',
            style: TextStyle(fontSize: 12, color: Colors.grey),
          ),
          Text(
            'Tugas Praktikum Modul 8-9',
            style: TextStyle(fontSize: 11, color: Colors.grey),
          ),
        ],
      ),
    );
  }
}
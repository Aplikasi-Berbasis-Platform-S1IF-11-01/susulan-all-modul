import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:image_picker/image_picker.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

final FlutterLocalNotificationsPlugin notificationsPlugin =
    FlutterLocalNotificationsPlugin();

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  SystemChrome.setSystemUIOverlayStyle(
    const SystemUiOverlayStyle(
      statusBarColor: Colors.transparent,
      statusBarIconBrightness: Brightness.light,
    ),
  );
  await initNotifications();
  runApp(const MyApp());
}

Future<void> initNotifications() async {
  const AndroidInitializationSettings androidSettings =
      AndroidInitializationSettings('@mipmap/ic_launcher');
  const InitializationSettings initSettings =
      InitializationSettings(android: androidSettings);
  await notificationsPlugin.initialize(initSettings);
}

Future<void> showNotification(String title, String message) async {
  const AndroidNotificationDetails androidDetails = AndroidNotificationDetails(
    'foto_channel',
    'Foto Notifikasi',
    channelDescription: 'Notifikasi setelah mengambil atau memilih foto',
    importance: Importance.high,
    priority: Priority.high,
  );
  const NotificationDetails details = NotificationDetails(android: androidDetails);
  await notificationsPlugin.show(0, title, message, details);
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Lensa',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        brightness: Brightness.dark,
        colorScheme: const ColorScheme.dark(
          primary: Color(0xFFE8C97A),
          surface: Color(0xFF141414),
        ),
        useMaterial3: true,
      ),
      home: const LensaPage(),
    );
  }
}

class LensaPage extends StatefulWidget {
  const LensaPage({super.key});

  @override
  State<LensaPage> createState() => _LensaPageState();
}

class _LensaPageState extends State<LensaPage> with TickerProviderStateMixin {
  File? _foto;
  String? _sumberFoto;
  final ImagePicker _picker = ImagePicker();
  bool _isLoading = false;

  late AnimationController _fadeController;
  late Animation<double> _fadeAnim;

  // Palette
  static const Color bg       = Color(0xFF0F0F0F);
  static const Color surface  = Color(0xFF1A1A1A);
  static const Color surface2 = Color(0xFF242424);
  static const Color gold     = Color(0xFFE8C97A);
  static const Color goldDim  = Color(0xFF5C4F2A);
  static const Color textHigh = Color(0xFFF0F0F0);
  static const Color textMid  = Color(0xFF9A9A9A);
  static const Color textLow  = Color(0xFF4A4A4A);

  @override
  void initState() {
    super.initState();
    _fadeController = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 600),
    );
    _fadeAnim = CurvedAnimation(parent: _fadeController, curve: Curves.easeOut);
  }

  @override
  void dispose() {
    _fadeController.dispose();
    super.dispose();
  }

  Future<void> _ambilDariKamera() async {
    setState(() => _isLoading = true);
    try {
      final XFile? hasil = await _picker.pickImage(
        source: ImageSource.camera,
        imageQuality: 85,
      );
      if (hasil != null) {
        _fadeController.reset();
        setState(() {
          _foto = File(hasil.path);
          _sumberFoto = 'Kamera';
          _isLoading = false;
        });
        _fadeController.forward();
        await showNotification('Foto Tersimpan', 'Foto dari kamera berhasil diambil.');
      } else {
        setState(() => _isLoading = false);
      }
    } catch (_) {
      setState(() => _isLoading = false);
    }
  }

  Future<void> _pilihDariGaleri() async {
    setState(() => _isLoading = true);
    try {
      final XFile? hasil = await _picker.pickImage(
        source: ImageSource.gallery,
        imageQuality: 85,
      );
      if (hasil != null) {
        _fadeController.reset();
        setState(() {
          _foto = File(hasil.path);
          _sumberFoto = 'Galeri';
          _isLoading = false;
        });
        _fadeController.forward();
        await showNotification('Foto Tersimpan', 'Foto dari galeri berhasil dipilih.');
      } else {
        setState(() => _isLoading = false);
      }
    } catch (_) {
      setState(() => _isLoading = false);
    }
  }

  void _hapusFoto() {
    setState(() {
      _foto = null;
      _sumberFoto = null;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: bg,
      body: SafeArea(
        child: Column(
          children: [
            _buildHeader(),
            Expanded(
              child: SingleChildScrollView(
                padding: const EdgeInsets.fromLTRB(20, 0, 20, 24),
                child: Column(
                  children: [
                    const SizedBox(height: 8),
                    _buildPhotoFrame(),
                    const SizedBox(height: 28),
                    _buildControlPanel(),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildHeader() {
    return Container(
      padding: const EdgeInsets.fromLTRB(24, 20, 24, 16),
      child: Row(
        children: [
          // Logo mark
          Container(
            width: 36,
            height: 36,
            decoration: BoxDecoration(
              color: gold,
              borderRadius: BorderRadius.circular(8),
            ),
            child: const Icon(Icons.camera_rounded, color: Colors.black, size: 20),
          ),
          const SizedBox(width: 14),
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: const [
              Text(
                'LENSA',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.w800,
                  color: textHigh,
                  letterSpacing: 4,
                ),
              ),
              Text(
                'foto studio',
                style: TextStyle(
                  fontSize: 11,
                  color: gold,
                  letterSpacing: 1.5,
                ),
              ),
            ],
          ),
          const Spacer(),
          if (_foto != null)
            GestureDetector(
              onTap: _hapusFoto,
              child: Container(
                padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                decoration: BoxDecoration(
                  border: Border.all(color: textLow),
                  borderRadius: BorderRadius.circular(20),
                ),
                child: const Row(
                  children: [
                    Icon(Icons.delete_outline_rounded, size: 14, color: textMid),
                    SizedBox(width: 4),
                    Text('Hapus', style: TextStyle(fontSize: 12, color: textMid)),
                  ],
                ),
              ),
            ),
        ],
      ),
    );
  }

  Widget _buildPhotoFrame() {
    return Container(
      width: double.infinity,
      height: 380,
      decoration: BoxDecoration(
        color: surface,
        borderRadius: BorderRadius.circular(4),
        border: Border.all(color: const Color(0xFF2A2A2A), width: 1),
      ),
      child: _isLoading
          ? const Center(
              child: CircularProgressIndicator(
                color: gold,
                strokeWidth: 2,
              ),
            )
          : _foto != null
              ? Stack(
                  fit: StackFit.expand,
                  children: [
                    FadeTransition(
                      opacity: _fadeAnim,
                      child: ClipRRect(
                        borderRadius: BorderRadius.circular(3),
                        child: Image.file(
                          _foto!,
                          fit: BoxFit.cover,
                        ),
                      ),
                    ),
                    // Source badge
                    Positioned(
                      bottom: 14,
                      left: 14,
                      child: Container(
                        padding: const EdgeInsets.symmetric(
                            horizontal: 10, vertical: 5),
                        decoration: BoxDecoration(
                          color: Colors.black.withOpacity(0.7),
                          borderRadius: BorderRadius.circular(4),
                        ),
                        child: Row(
                          children: [
                            Icon(
                              _sumberFoto == 'Kamera'
                                  ? Icons.camera_alt_rounded
                                  : Icons.photo_library_rounded,
                              size: 12,
                              color: gold,
                            ),
                            const SizedBox(width: 5),
                            Text(
                              _sumberFoto ?? '',
                              style: const TextStyle(
                                color: textHigh,
                                fontSize: 11,
                                letterSpacing: 0.5,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    // Corner brackets — signature element
                    _CornerBrackets(),
                  ],
                )
              : _buildEmptyState(),
    );
  }

  Widget _buildEmptyState() {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Container(
          width: 64,
          height: 64,
          decoration: BoxDecoration(
            border: Border.all(color: textLow, width: 1.5),
            borderRadius: BorderRadius.circular(50),
          ),
          child: const Icon(Icons.add_photo_alternate_outlined,
              size: 28, color: textLow),
        ),
        const SizedBox(height: 20),
        const Text(
          'Frame kosong',
          style: TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.w600,
            color: textMid,
            letterSpacing: 0.5,
          ),
        ),
        const SizedBox(height: 6),
        const Text(
          'Pilih sumber foto di bawah\nuntuk mulai',
          textAlign: TextAlign.center,
          style: TextStyle(
            fontSize: 13,
            color: textLow,
            height: 1.6,
          ),
        ),
        const SizedBox(height: 32),
        // Film strip decoration
        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: List.generate(
            7,
            (i) => Container(
              width: 10,
              height: 7,
              margin: const EdgeInsets.symmetric(horizontal: 2),
              decoration: BoxDecoration(
                color: i == 3 ? gold.withOpacity(0.4) : textLow.withOpacity(0.3),
                borderRadius: BorderRadius.circular(1),
              ),
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildControlPanel() {
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: surface,
        borderRadius: BorderRadius.circular(4),
        border: Border.all(color: const Color(0xFF2A2A2A)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            'SUMBER FOTO',
            style: TextStyle(
              fontSize: 10,
              letterSpacing: 2.5,
              color: textLow,
              fontWeight: FontWeight.w600,
            ),
          ),
          const SizedBox(height: 16),
          Row(
            children: [
              Expanded(
                child: _ShutterButton(
                  icon: Icons.camera_alt_rounded,
                  label: 'KAMERA',
                  sub: 'Ambil foto baru',
                  onTap: _ambilDariKamera,
                  isPrimary: true,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _ShutterButton(
                  icon: Icons.photo_library_rounded,
                  label: 'GALERI',
                  sub: 'Pilih dari album',
                  onTap: _pilihDariGaleri,
                  isPrimary: false,
                ),
              ),
            ],
          ),
          if (_foto != null) ...[
            const SizedBox(height: 16),
            const Divider(color: Color(0xFF2A2A2A), height: 1),
            const SizedBox(height: 14),
            Row(
              children: [
                const Icon(Icons.check_circle_outline_rounded,
                    size: 14, color: gold),
                const SizedBox(width: 6),
                Text(
                  'Foto dari $_sumberFoto berhasil dimuat',
                  style: const TextStyle(
                    fontSize: 12,
                    color: gold,
                    letterSpacing: 0.3,
                  ),
                ),
              ],
            ),
          ],
        ],
      ),
    );
  }
}

// ── Corner bracket overlay (signature) ──────────────────────────────────────
class _CornerBrackets extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    const c = Color(0xFFE8C97A);
    const w = 20.0;
    const t = 2.0;
    const pad = 12.0;

    return IgnorePointer(
      child: CustomPaint(
        painter: _BracketPainter(color: c, size: w, thickness: t, padding: pad),
      ),
    );
  }
}

class _BracketPainter extends CustomPainter {
  final Color color;
  final double size;
  final double thickness;
  final double padding;

  _BracketPainter({
    required this.color,
    required this.size,
    required this.thickness,
    required this.padding,
  });

  @override
  void paint(Canvas canvas, Size s) {
    final p = Paint()
      ..color = color
      ..strokeWidth = thickness
      ..style = PaintingStyle.stroke
      ..strokeCap = StrokeCap.square;

    // Top-left
    canvas.drawLine(Offset(padding, padding + size), Offset(padding, padding), p);
    canvas.drawLine(Offset(padding, padding), Offset(padding + size, padding), p);
    // Top-right
    canvas.drawLine(
        Offset(s.width - padding - size, padding), Offset(s.width - padding, padding), p);
    canvas.drawLine(
        Offset(s.width - padding, padding), Offset(s.width - padding, padding + size), p);
    // Bottom-left
    canvas.drawLine(
        Offset(padding, s.height - padding - size), Offset(padding, s.height - padding), p);
    canvas.drawLine(
        Offset(padding, s.height - padding), Offset(padding + size, s.height - padding), p);
    // Bottom-right
    canvas.drawLine(
        Offset(s.width - padding - size, s.height - padding),
        Offset(s.width - padding, s.height - padding),
        p);
    canvas.drawLine(
        Offset(s.width - padding, s.height - padding - size),
        Offset(s.width - padding, s.height - padding),
        p);
  }

  @override
  bool shouldRepaint(_BracketPainter o) => false;
}

// ── Shutter Button ───────────────────────────────────────────────────────────
class _ShutterButton extends StatefulWidget {
  final IconData icon;
  final String label;
  final String sub;
  final VoidCallback onTap;
  final bool isPrimary;

  const _ShutterButton({
    required this.icon,
    required this.label,
    required this.sub,
    required this.onTap,
    required this.isPrimary,
  });

  @override
  State<_ShutterButton> createState() => _ShutterButtonState();
}

class _ShutterButtonState extends State<_ShutterButton>
    with SingleTickerProviderStateMixin {
  late AnimationController _ctrl;
  late Animation<double> _scale;

  @override
  void initState() {
    super.initState();
    _ctrl = AnimationController(
        vsync: this, duration: const Duration(milliseconds: 100));
    _scale = Tween<double>(begin: 1.0, end: 0.95).animate(_ctrl);
  }

  @override
  void dispose() {
    _ctrl.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    const gold = Color(0xFFE8C97A);
    const surface2 = Color(0xFF242424);
    const textHigh = Color(0xFFF0F0F0);
    const textMid = Color(0xFF9A9A9A);

    return GestureDetector(
      onTapDown: (_) => _ctrl.forward(),
      onTapUp: (_) {
        _ctrl.reverse();
        widget.onTap();
      },
      onTapCancel: () => _ctrl.reverse(),
      child: ScaleTransition(
        scale: _scale,
        child: Container(
          padding: const EdgeInsets.symmetric(vertical: 18, horizontal: 14),
          decoration: BoxDecoration(
            color: widget.isPrimary ? gold : surface2,
            borderRadius: BorderRadius.circular(4),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Icon(
                widget.icon,
                size: 22,
                color: widget.isPrimary ? Colors.black : gold,
              ),
              const SizedBox(height: 10),
              Text(
                widget.label,
                style: TextStyle(
                  fontSize: 11,
                  fontWeight: FontWeight.w800,
                  letterSpacing: 2,
                  color: widget.isPrimary ? Colors.black : textHigh,
                ),
              ),
              const SizedBox(height: 2),
              Text(
                widget.sub,
                style: TextStyle(
                  fontSize: 11,
                  color: widget.isPrimary
                      ? Colors.black.withOpacity(0.55)
                      : textMid,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

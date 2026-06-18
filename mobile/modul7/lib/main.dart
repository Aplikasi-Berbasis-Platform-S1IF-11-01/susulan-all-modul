import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'screens/home_screen.dart';

void main() {
  runApp(const DataMahasiswaApp());
}

class DataMahasiswaApp extends StatelessWidget {
  const DataMahasiswaApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Data Mahasiswa',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        // ── Palet warna utama: biru navy + aksen biru cerah ──
        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFF1A3C6E),
          primary: const Color(0xFF1A3C6E),
          secondary: const Color(0xFF2979FF),
          tertiary: const Color(0xFF00BCD4),
          surface: const Color(0xFFF5F7FF),
          background: const Color(0xFFF0F4FF),
        ),
        useMaterial3: true,

        // ── Google Fonts: Poppins sebagai font utama ──
        textTheme: GoogleFonts.poppinsTextTheme(
          Theme.of(context).textTheme,
        ),

        // ── AppBar Theme ──
        appBarTheme: AppBarTheme(
          backgroundColor: const Color(0xFF1A3C6E),
          foregroundColor: Colors.white,
          elevation: 0,
          centerTitle: true,
          titleTextStyle: GoogleFonts.poppins(
            color: Colors.white,
            fontSize: 18,
            fontWeight: FontWeight.w600,
            letterSpacing: 0.5,
          ),
        ),

        // ── ElevatedButton Theme ──
        elevatedButtonTheme: ElevatedButtonThemeData(
          style: ElevatedButton.styleFrom(
            backgroundColor: const Color(0xFF2979FF),
            foregroundColor: Colors.white,
            padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 14),
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(12),
            ),
            textStyle: GoogleFonts.poppins(
              fontSize: 15,
              fontWeight: FontWeight.w600,
            ),
          ),
        ),

        // ── Input Decoration Theme ──
        inputDecorationTheme: InputDecorationTheme(
          filled: true,
          fillColor: Colors.white,
          contentPadding:
              const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: const BorderSide(color: Color(0xFFCDD5E0)),
          ),
          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: const BorderSide(color: Color(0xFFCDD5E0)),
          ),
          focusedBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide:
                const BorderSide(color: Color(0xFF2979FF), width: 2),
          ),
          labelStyle: GoogleFonts.poppins(
            color: const Color(0xFF6B7A99),
            fontSize: 14,
          ),
          hintStyle: GoogleFonts.poppins(
            color: const Color(0xFFB0BAD3),
            fontSize: 14,
          ),
        ),
      ),
      home: const HomeScreen(),
    );
  }
}

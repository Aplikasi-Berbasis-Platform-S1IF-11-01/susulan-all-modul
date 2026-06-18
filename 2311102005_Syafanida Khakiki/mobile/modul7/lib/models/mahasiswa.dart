// lib/models/mahasiswa.dart
// Model data untuk menyimpan informasi mahasiswa

class Mahasiswa {
  final String nama;
  final String nim;
  final String kelas;

  const Mahasiswa({
    required this.nama,
    required this.nim,
    required this.kelas,
  });

  // Salin objek dengan perubahan nilai tertentu
  Mahasiswa copyWith({String? nama, String? nim, String? kelas}) {
    return Mahasiswa(
      nama: nama ?? this.nama,
      nim: nim ?? this.nim,
      kelas: kelas ?? this.kelas,
    );
  }

  @override
  String toString() => 'Mahasiswa(nama: $nama, nim: $nim, kelas: $kelas)';
}

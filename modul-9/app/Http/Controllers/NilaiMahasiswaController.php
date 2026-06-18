<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaiMahasiswaController extends Controller
{
    // =============================================
    // DATA IDENTITAS PEMBUAT
    // Nama  : Imelda Fajar Awalina Crisyanti
    // NIM   : 2311102004
    // Kelas : IF-11-01
    // =============================================

    /**
     * Fungsi menghitung nilai akhir
     * Bobot: Tugas 30%, UTS 35%, UAS 35%
     */
    private function hitungNilaiAkhir(float $tugas, float $uts, float $uas): float
    {
        return ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
    }

    /**
     * Fungsi menentukan grade berdasarkan nilai akhir
     */
    private function tentukanGrade(float $nilaiAkhir): string
    {
        if ($nilaiAkhir >= 85) {
            return 'A';
        } elseif ($nilaiAkhir >= 75) {
            return 'B';
        } elseif ($nilaiAkhir >= 65) {
            return 'C';
        } elseif ($nilaiAkhir >= 55) {
            return 'D';
        } else {
            return 'E';
        }
    }

    /**
     * Fungsi menentukan status kelulusan
     */
    private function tentukanStatus(float $nilaiAkhir): string
    {
        return ($nilaiAkhir >= 60) ? 'LULUS' : 'TIDAK LULUS';
    }

    /**
     * Main method - tampilkan data mahasiswa
     */
    public function index()
    {
        // -----------------------------------------------
        // DATA MAHASISWA (Array Asosiatif)
        // -----------------------------------------------
        $dataMahasiswa = [
            [
                'nama'         => 'Imelda Fajar Awalina Crisyanti',
                'nim'          => '2311102004',
                'nilai_tugas'  => 88,
                'nilai_uts'    => 85,
                'nilai_uas'    => 90,
                'kelas'        => 'IF-11-01',
            ],
            [
                'nama'         => 'Aldi Firmansyah',
                'nim'          => '2311102015',
                'nilai_tugas'  => 75,
                'nilai_uts'    => 70,
                'nilai_uas'    => 72,
                'kelas'        => 'IF-11-01',
            ],
            [
                'nama'         => 'Siti Nurhaliza',
                'nim'          => '2311102027',
                'nilai_tugas'  => 60,
                'nilai_uts'    => 55,
                'nilai_uas'    => 58,
                'kelas'        => 'IF-11-01',
            ],
            [
                'nama'         => 'Budi Santoso',
                'nim'          => '2311102033',
                'nilai_tugas'  => 92,
                'nilai_uts'    => 95,
                'nilai_uas'    => 93,
                'kelas'        => 'IF-11-01',
            ],
            [
                'nama'         => 'Dewi Rahmawati',
                'nim'          => '2311102041',
                'nilai_tugas'  => 45,
                'nilai_uts'    => 50,
                'nilai_uas'    => 48,
                'kelas'        => 'IF-11-01',
            ],
        ];

        // -----------------------------------------------
        // PROSES DATA MENGGUNAKAN LOOP
        // -----------------------------------------------
        $hasilMahasiswa = [];
        $totalNilaiAkhir = 0;
        $nilaiTertinggi = 0;
        $mahasiswaTertinggi = '';

        foreach ($dataMahasiswa as $mhs) {
            // Hitung nilai akhir menggunakan function
            $nilaiAkhir = $this->hitungNilaiAkhir(
                $mhs['nilai_tugas'],
                $mhs['nilai_uts'],
                $mhs['nilai_uas']
            );

            // Tentukan grade & status
            $grade  = $this->tentukanGrade($nilaiAkhir);
            $status = $this->tentukanStatus($nilaiAkhir);

            // Kumpulkan hasil
            $hasilMahasiswa[] = [
                'nama'         => $mhs['nama'],
                'nim'          => $mhs['nim'],
                'kelas'        => $mhs['kelas'],
                'nilai_tugas'  => $mhs['nilai_tugas'],
                'nilai_uts'    => $mhs['nilai_uts'],
                'nilai_uas'    => $mhs['nilai_uas'],
                'nilai_akhir'  => round($nilaiAkhir, 2),
                'grade'        => $grade,
                'status'       => $status,
            ];

            // Akumulasi untuk statistik
            $totalNilaiAkhir += $nilaiAkhir;

            // Cek nilai tertinggi menggunakan operator perbandingan
            if ($nilaiAkhir > $nilaiTertinggi) {
                $nilaiTertinggi    = $nilaiAkhir;
                $mahasiswaTertinggi = $mhs['nama'];
            }
        }

        // Hitung rata-rata kelas
        $jumlahMahasiswa = count($hasilMahasiswa);
        $rataRataKelas   = $jumlahMahasiswa > 0
            ? round($totalNilaiAkhir / $jumlahMahasiswa, 2)
            : 0;

        // Hitung jumlah lulus & tidak lulus
        $jumlahLulus = count(array_filter(
            $hasilMahasiswa,
            fn($m) => $m['status'] === 'LULUS'
        ));

        return view('nilai.index', compact(
            'hasilMahasiswa',
            'rataRataKelas',
            'nilaiTertinggi',
            'mahasiswaTertinggi',
            'jumlahMahasiswa',
            'jumlahLulus'
        ));
    }
}
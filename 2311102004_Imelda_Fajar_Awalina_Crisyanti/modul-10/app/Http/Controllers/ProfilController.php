<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // Menampilkan halaman utama (index.html → index.blade.php)
    public function index()
    {
        return view('index');
    }

    // Pengganti data.php — mengembalikan data JSON
    public function getData()
    {
        $data = [
            ['nama' => 'Budi',    'pekerjaan' => 'Web Developer',  'lokasi' => 'Jakarta'],
            ['nama' => 'Sari',    'pekerjaan' => 'UI/UX Designer',  'lokasi' => 'Bandung'],
            ['nama' => 'Doni',    'pekerjaan' => 'Data Analyst',    'lokasi' => 'Surabaya'],
            ['nama' => 'Rina',    'pekerjaan' => 'Backend Engineer','lokasi' => 'Yogyakarta'],
            ['nama' => 'Farhan',  'pekerjaan' => 'DevOps Engineer', 'lokasi' => 'Medan'],
        ];

        // json() otomatis set header Content-Type: application/json
        return response()->json($data);
    }
}
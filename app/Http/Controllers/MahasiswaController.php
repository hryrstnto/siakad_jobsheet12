<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MahasiswaController extends Controller
{
    // Data mahasiswa ditaruh di sini agar bisa diakses oleh index() dan show()
    private array $mahasiswa = [
        ['nim' => '2401001', 'nama' => 'Ahmad Fauzi', 'angkatan' => 2024,
         'email' => 'ahmad.fauzi@contoh.ac.id', 'status' => 'Aktif'],
        ['nim' => '2401002', 'nama' => 'Siti Rahmawati', 'angkatan' => 2024,
         'email' => 'siti.rahmawati@contoh.ac.id', 'status' => 'Aktif'],
        ['nim' => '2301005', 'nama' => 'Budi Santoso', 'angkatan' => 2023,
         'email' => 'budi.santoso@contoh.ac.id', 'status' => 'Aktif'],
        ['nim' => '2301012', 'nama' => 'Dewi Lestari', 'angkatan' => 2023,
         'email' => 'dewi.lestari@contoh.ac.id', 'status' => 'Drop Out'],
        ['nim' => '2201020', 'nama' => 'Rizky Pratama', 'angkatan' => 2022, 
         'email' => 'rizky.pratama@contoh.ac.id', 'status' => 'Lulus'],
    ];

    public function index(): View
    {
        $kolom = [
            'nim' => 'NIM', 'nama' => 'Nama Lengkap',
            'angkatan' => 'Angkatan', 'email' => 'Email',
            'status' => 'Status',
        ];

        $mahasiswa = $this->mahasiswa;

        return view('mahasiswa.index', compact('kolom', 'mahasiswa'));
    }

    public function show($nim): View
    {
        // Cari data mahasiswa berdasarkan NIM
        $data = collect($this->mahasiswa)->firstWhere('nim', $nim);

        // Jika NIM tidak ditemukan, tampilkan halaman error 404
        if (!$data) {
            abort(404);
        }

        return view('mahasiswa.show', compact('data'));
    }
}
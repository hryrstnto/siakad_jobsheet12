<?php
// Nama    : HARY RISTANTO
// Kelas   : TIF-5C
// NIM     : 3202416102

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 1. Hitung jumlah total data langsung dari database
        $totalMahasiswa  = Mahasiswa::count();
        $totalDosen      = Dosen::count();
        $totalMataKuliah = MataKuliah::count();
        $totalKrsAktif   = Krs::whereIn('status', ['disetujui'])->count();

        // 2. Format array statistik menggunakan angka dinamis
        $statistik = [
            [
                'judul' => 'Mahasiswa',
                'jumlah' => number_format($totalMahasiswa, 0, ',', '.'),
                'ikon' => 'bi-mortarboard-fill',
                'warna' => 'primary',
            ],
            [
                'judul' => 'Dosen',
                'jumlah' => number_format($totalDosen, 0, ',', '.'),
                'ikon' => 'bi-person-badge-fill',
                'warna' => 'success',
            ],
            [
                'judul' => 'Mata Kuliah',
                'jumlah' => number_format($totalMataKuliah, 0, ',', '.'),
                'ikon' => 'bi-book-fill',
                'warna' => 'warning',
            ],
            [
                'judul' => 'KRS Aktif',
                'jumlah' => number_format($totalKrsAktif, 0, ',', '.'),
                'ikon' => 'bi-journal-check',
                'warna' => 'info',
            ],
        ];

        $kolomKrs = [
            'nim' => 'NIM',
            'nama' => 'Nama Mahasiswa',
            'sks' => 'SKS',
            'status' => 'Status',
        ];

        // 3. Ambil 5 data KRS terbaru dari database beserta relasi mahasiswanya
        $krsData = Krs::with('mahasiswa')->latest()->take(5)->get();

        $krsTerbaru = $krsData->map(function ($krs) {
            return [
                'nim' => $krs->mahasiswa->nim ?? '-',
                'nama' => $krs->mahasiswa->nama ?? '-',
                'sks' => 20, // Nilai default SKS atau sesuaikan dengan total SKS detail
                'status' => ucfirst($krs->status),
            ];
        })->toArray();

        // 4. Hitung persentase status KRS secara otomatis
        $totalKrs = Krs::count();
        $disetujui = Krs::where('status', 'disetujui')->count();
        $menunggu  = Krs::whereIn('status', ['draft', 'diajukan'])->count();
        $ditolak   = Krs::where('status', 'ditolak')->count();

        $persenDisetujui = $totalKrs > 0 ? round(($disetujui / $totalKrs) * 100) : 0;
        $persenMenunggu  = $totalKrs > 0 ? round(($menunggu / $totalKrs) * 100) : 0;
        $persenDitolak   = $totalKrs > 0 ? round(($ditolak / $totalKrs) * 100) : 0;

        $statusKrs = [
            ['label' => 'Disetujui', 'persen' => $persenDisetujui, 'warna' => 'success'],
            ['label' => 'Menunggu',  'persen' => $persenMenunggu,  'warna' => 'warning'],
            ['label' => 'Ditolak',   'persen' => $persenDitolak,   'warna' => 'danger'],
        ];

        return view('dashboard', compact(
            'statistik',
            'kolomKrs',
            'krsTerbaru',
            'statusKrs'
        ));
    }
}
<?php
// Nama    : Hary Ristanto
// Kelas   : TIF-5C
// NIM     : 3202416102
namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = Mahasiswa::take(10)->get();

        foreach ($mahasiswas as $mhs) {
            $krs = Krs::create([
                'mahasiswa_id'   => $mhs->id,
                'tahun_akademik' => '2026/2027',
                'semester'       => 'Ganjil',
                'status'         => 'draft',
            ]);

            $mataKuliahIds = MataKuliah::inRandomOrder()->limit(5)->pluck('id');
            $krs->mataKuliah()->attach($mataKuliahIds);
        }
    }
}

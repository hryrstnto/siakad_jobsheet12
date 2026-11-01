<?php
// Nama    : Hary Ristanto
// Kelas   : TIF-5C
// NIM     : 3202416102
namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dosen>
 */
class DosenFactory extends Factory
{
    public function definition(): array
    {
        $gelar = fake()->randomElement([
            'S.Kom., M.Kom.', 'S.T., M.T.', 'S.Kom., M.Eng.', 'S.Si., M.Cs.',
        ]);

        $nama = fake()->firstName() . ' ' . fake()->lastName();
    
    
        return [
        'nidn'    => fake()->unique()->numerify('00########'),
        'nama'    => $nama . ', ' . $gelar,
        'email'   => fake()->unique()->safeEmail(),
        'telepon' => fake()->numerify('08##########'),
        'alamat'  => fake()->address(),
        ];
    }
}
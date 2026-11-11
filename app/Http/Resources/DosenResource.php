<?php
// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
{
    /** Bentuk JSON satu dosen. Hanya kolom di sini yang dikirim ke klien. */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nidn' => $this->nidn,
            'nama' => $this->nama,
            'jabatan_fungsional' => $this->jabatan_fungsional,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'alamat' => $this->alamat,
            'dibuat_pada' => $this->created_at?->toIso8601String(),
            'diperbarui_pada' => $this->updated_at?->toIso8601String(),
        ];
    }
}

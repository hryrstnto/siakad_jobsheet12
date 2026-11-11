<?php
// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
namespace App\Http\Requests;

use App\Models\Dosen;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
{
    // Otorisasi ditangani middleware role:admin pada route.
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // null saat tambah (POST), model dosen saat ubah (PUT/PATCH)
        $id = $this->route('dosen')?->id;

        // PATCH: kolom yang tidak dikirim dilewati; POST dan PUT: WAJIB
        $wajib = $this->isMethod('PATCH') ? ['sometimes', 'required'] : ['required'];

        return [
            'nidn' => [...$wajib, 'string', 'max:20',
                Rule::unique(Dosen::class, 'nidn')->ignore($id)],
            'nama' => [...$wajib, 'string', 'max:120'],
            'jabatan_fungsional' => ['nullable', 'string',
                Rule::in(['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar'])],
            'email' => [...$wajib, 'email', 'max:120',
                Rule::unique(Dosen::class, 'email')->ignore($id)],
            'telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.max' => 'NIDN maksimal 20 karakter.',
            'nidn.unique' => 'NIDN sudah dipakai dosen lain.',
            'nama.required' => 'Nama dosen wajib diisi.',
            'nama.max' => 'Nama dosen maksimal 120 karakter.',
            'jabatan_fungsional.in' => 'Jabatan fungsional harus pilih salah satu.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 120 karakter.',
            'email.unique' => 'Email sudah dipakai dosen lain.',
            'telepon.max' => 'Nomor telepon maksimal 20 karakter.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
        ];
    }
}

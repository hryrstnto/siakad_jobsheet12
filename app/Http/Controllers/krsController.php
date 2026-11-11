<?php
// Nama    : HARY RISTANTO
// Kelas   : TIF-5C
// NIM     : 3202416102

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    public function index(): View
    {
        return view('krs.index');
    }

    public function data(): JsonResponse
    {
        $query = Krs::with('mahasiswa')->select(['id', 'mahasiswa_id', 'tahun_akademik', 'semester', 'status']);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (Krs $krs) {
                return view('krs._aksi', compact('krs'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        $mahasiswa = Mahasiswa::all();
        $mataKuliah = Matakuliah::all();

        return view('krs.create', [
            'krs'        => new Krs(),
            'mahasiswa'  => $mahasiswa,
            'mataKuliah' => $mataKuliah,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $krs = Krs::create($this->validated($request));

        if ($request->has('mata_kuliah_ids')) {
            $krs->mataKuliah()->sync($request->input('mata_kuliah_ids'));
        }

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil ditambahkan.');
    }

    public function show(Krs $krs): View
    {
        $krs->load('mahasiswa', 'mataKuliah');
        return view('krs.show', compact('krs'));
    }

    public function edit(Krs $krs): View
    {
        $mahasiswa = Mahasiswa::all();
        $mataKuliah = Matakuliah::all();
        $selectedMataKuliah = $krs->mataKuliah()->pluck('mata_kuliah.id')->toArray();

        return view('krs.edit', compact('krs', 'mahasiswa', 'mataKuliah', 'selectedMataKuliah'));
    }

    public function update(Request $request, Krs $krs): RedirectResponse
    {
        $krs->update($this->validated($request, $krs));

        if ($request->has('mata_kuliah_ids')) {
            $krs->mataKuliah()->sync($request->input('mata_kuliah_ids'));
        }

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    public function destroy(Krs $krs): JsonResponse
    {
        try {
            $krs->mataKuliah()->detach();
            $krs->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data KRS tidak dapat dihapus: masih terikat dengan data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data KRS berhasil dihapus.',
        ]);
    }

    public function cetak(Krs $krs): View
    {
        $krs->load(['mahasiswa', 'mataKuliah']);
        return view('krs.cetak', compact('krs'));
    }

    private function validated(Request $request, ?Krs $krs = null): array
    {
        return $request->validate([
            'mahasiswa_id'   => [
                'required',
                'exists:mahasiswa,id',
                Rule::unique('krs')->where(function ($query) use ($request) {
                    return $query->where('tahun_akademik', $request->tahun_akademik)
                                 ->where('semester', $request->semester);
                })->ignore($krs?->id),
            ],
            'tahun_akademik'   => ['required', 'string', 'max:9'],
            'semester'         => ['required', Rule::in(['Ganjil', 'Genap'])],
            'status'           => ['required', Rule::in(['draft', 'diajukan', 'disetujui', 'ditolak'])],
            'mata_kuliah_ids'   => ['nullable', 'array'],
            'mata_kuliah_ids.*' => ['exists:mata_kuliah,id'],
        ], [
            'mahasiswa_id.required'   => 'Mahasiswa wajib dipilih.',
            'mahasiswa_id.exists'     => 'Mahasiswa tidak valid.',
            'mahasiswa_id.unique'     => 'Mahasiswa ini sudah memiliki KRS pada Semester dan Tahun Akademik tersebut.',
            'tahun_akademik.required' => 'Tahun Akademik wajib diisi.',
            'tahun_akademik.max'      => 'Tahun Akademik maksimal 9 karakter.',
            'semester.required'       => 'Semester wajib dipilih.',
            'semester.in'             => 'Pilihan semester tidak valid.',
            'status.required'         => 'Status KRS wajib dipilih.',
            'status.in'               => 'Pilihan status tidak valid.',
        ]);
    }
}
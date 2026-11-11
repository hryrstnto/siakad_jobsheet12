<?php
// Nama    : HARY RISTANTO
// Kelas   : TIF-5C
// NIM     : 3202416102

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        return view('matakuliah.index');
    }

    public function data(): JsonResponse
    {
        $query = MataKuliah::query()->select(['id', 'kode_mk', 'nama_mk', 'sks']);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (MataKuliah $mata_kuliah) {
                // Alias penamaan atribut agar $mata_kuliah->nama pada _aksi.blade.php tidak error/null
                $mata_kuliah->nama = $mata_kuliah->nama_mk;
                
                return view('matakuliah._aksi', compact('mata_kuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('matakuliah.create', ['mata_kuliah' => new MataKuliah()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $mata_kuliah = MataKuliah::create($this->validated($request));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah ' . $mata_kuliah->nama_mk . ' berhasil ditambahkan.');
    }

    public function show(MataKuliah $mata_kuliah): View
    {
        return view('matakuliah.show', compact('mata_kuliah'));
    }

    public function edit(MataKuliah $mata_kuliah): View
    {
        return view('matakuliah.edit', compact('mata_kuliah'));
    }

    public function update(Request $request, MataKuliah $mata_kuliah): RedirectResponse
    {
        $mata_kuliah->update($this->validated($request, $mata_kuliah));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah ' . $mata_kuliah->nama_mk . ' berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mata_kuliah): JsonResponse
    {
        try {
            $mata_kuliah->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data mata kuliah tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data mata kuliah ' . $mata_kuliah->nama_mk . ' berhasil dihapus.',
        ]);
    }

    private function validated(Request $request, ?MataKuliah $mata_kuliah = null): array
    {
        return $request->validate([
            'kode_mk' => ['required', 'string', 'max:10',
                Rule::unique(MataKuliah::class, 'kode_mk')->ignore($mata_kuliah?->id)],
            'nama_mk' => ['required', 'string', 'max:100'],
            'sks'     => ['required', 'integer', 'min:1', 'max:8'],
        ], [
            'kode_mk.required' => 'Kode Mata Kuliah wajib diisi.',
            'kode_mk.max'      => 'Kode Mata Kuliah maksimal 10 karakter.',
            'kode_mk.unique'   => 'Kode Mata Kuliah sudah dipakai mata kuliah lain.',
            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'nama_mk.max'      => 'Nama mata kuliah maksimal 100 karakter.',
            'sks.required'     => 'SKS wajib diisi.',
            'sks.integer'      => 'SKS harus berupa angka.',
            'sks.min'          => 'Minimal 1 SKS.',
            'sks.max'          => 'Maksimal 8 SKS.',
        ]);
    }
}
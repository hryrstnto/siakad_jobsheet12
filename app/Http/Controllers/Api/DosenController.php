<?php

// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Http\Resources\DosenResource;
use App\Models\Dosen;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $param = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'sort' => ['nullable', Rule::in(['nidn', 'nama', 'email', 'jabatan_fungsional'])],
            'arah' => ['nullable', Rule::in(['asc', 'desc'])],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $dosen = Dosen::query()
            ->when($param['q'] ?? null, function ($query, $q) {
                $query->whereAny(['nidn', 'nama','jabatan_fungsional', 'email'], 'like', "%{$q}%");
            })
            ->orderBy($param['sort'] ?? 'nama', $param['arah'] ?? 'asc')
            ->orderBy('id')
            ->paginate($param['per_page'] ?? 10)
            ->withQueryString();

        return DosenResource::collection($dosen);
    }

    public function store(DosenRequest $request): JsonResponse
    {
        $dosen = Dosen::create($request->validated());

        return DosenResource::make($dosen)
            ->additional(['message' => 'Data dosen berhasil ditambahkan.'])
            ->response()
            ->setStatusCode(201)
            ->header('Location', route('api.v1.dosen.show', $dosen));
    }

    public function show(Dosen $dosen): DosenResource
    {
        return DosenResource::make($dosen);
    }

    public function update(DosenRequest $request, Dosen $dosen): DosenResource
    {
        $dosen->update($request->validated());

        return DosenResource::make($dosen)
            ->additional(['message' => 'Data dosen berhasil diperbarui.']);
    }

    public function destroy(Dosen $dosen): Response|JsonResponse
    {
        try {
            $dosen->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data dosen tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->noContent();
    }
}
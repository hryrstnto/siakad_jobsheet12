<?php

// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['required', 'string', 'max:100'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'device_name.required' => 'Nama perangkat wajib diisi.',
        ]);

        $user = User::where('email', $data['email'])->first();

        // pesan sama untuk email tidak terdaftar dan password salah
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $kedaluwarsa = now()->addHours(8);
        $token = $user->createToken($data['device_name'], ['*'], $kedaluwarsa);

        return response()->json([
            'message' => 'Login berhasil.',
            'token_type' => 'Bearer',
            'token' => $token->plainTextToken,
            'kedaluwarsa_pada' => $kedaluwarsa->toIso8601String(),
            'user' => $this->profil($user),
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->profil($request->user())]);
    }

    public function logout(Request $request): JsonResponse
    {
        // hanya token yang sedang dipakai yang dicabut
        $request->user()->currentToken()->delete();

        return response()->json(['message' => 'Logout berhasil. Token sudah dicabut.']);
    }

    private function profil(User $user): array
    {
        return [
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ];
    }
}
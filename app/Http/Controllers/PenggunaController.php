<?php
// NAMA    : HARY RISTANTO
// KELAS   : TIF-5C
// NIM     : 3202416102
namespace App\Http\Controllers;

use App\Models\User;
// use Carbon\Carbon;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'name' => 'Nama', 'email' => 'Email', 'role' => 'Peran', 'last_login_at' => 'Login Terakhir',
        ];

        // password tidak ikut diambil dari database
        $pengguna = User::orderBy('name')
            ->get(['name', 'email', 'role', 'last_login_at'])
            // ->map(function ($user) {
            //     return [
            //         'name'          => $user->name,
            //         'email'         => $user->email,
            //         'role'          => $user->role,
            //         'last_login_at' => $user->last_login_at 
            //             ? Carbon::parse($user->last_login_at)->diffForHumans()
            //             : 'Belum Pernah',
            //     ];
            // })
            ->toArray();

        return view('pengguna.index', compact('kolom', 'pengguna'));
    }
}

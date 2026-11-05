<!-- NAMA    : HARY RISTANTO
KELAS   : TIF-5C
NIM     : 3202416102 -->
@extends('layouts.app')

@section('title', '403 Forbidden')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center text-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <div class="card-body">
                    <i class="bi bi-shield-lock-fill text-danger display-1 mb-3"></i>
                    <h1 class="display-4 fw-bold text-danger">403</h1>
                    <h2 class="h4 fw-bold mb-2">Akses Ditolak</h2>
                    <p class="text-muted mb-4">
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                    </p>
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary px-4">
                        <i class="bi bi-house-door-fill me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

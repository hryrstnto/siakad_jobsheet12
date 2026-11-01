@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header judul="Detail Mahasiswa" deskripsi="Informasi lengkap mahasiswa." />

    <div class="card border-0 shadow-sm col-md-6">
        <div class="card-body">
            <h5 class="card-title fw-bold">{{ $data['nama'] }}</h5>
            <p class="card-text mb-1"><strong>NIM:</strong> {{ $data['nim'] }}</p>
            <p class="card-text mb-1"><strong>Email:</strong> {{ $data['email'] }}</p>
            <p class="card-text mb-1"><strong>Angkatan:</strong> {{ $data['angkatan'] }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $data['status'] }}</p>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>
@endsection

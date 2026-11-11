<!-- NAMA    : HARY RISTANTO
KELAS   : TIF-5C
NIM     : 3202416102 -->
@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
    <x-page-header judul="Detail Mata Kuliah" deskripsi="Informasi lengkap satu mata kuliah." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">{{ $mata_kuliah->nama_mk }}</div>
        <div class="card-body">
            <dl class="row mb-3">
                <dt class="col-sm-3">Kode Mata Kuliah</dt>
                <dd class="col-sm-9">{{ $mata_kuliah->kode_mk }}</dd>

                <dt class="col-sm-3">Nama Mata Kuliah</dt>
                <dd class="col-sm-9">{{ $mata_kuliah->nama_mk }}</dd>

                <dt class="col-sm-3">Jumlah SKS</dt>
                <dd class="col-sm-9">{{ $mata_kuliah->sks }} SKS</dd>
            </dl>

            <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('mata_kuliah.edit', $mata_kuliah) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Ubah
                </a>
            @endif
        </div>
    </div>
@endsection

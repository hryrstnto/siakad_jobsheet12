<!-- NAMA    : HARY RISTANTO
KELAS   : TIF-5C
NIM     : 3202416102 -->
@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
    <x-page-header judul="Detail KRS" deskripsi="Informasi lengkap Kartu Rencana Studi (KRS) mahasiswa." />

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-body fw-semibold">Informasi Mahasiswa</div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">ID Mahasiswa</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa_id ?? '-' }}</dd>

                <dt class="col-sm-3">NIM Mahasiswa</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa->nim ?? '-' }}</dd>
                
                <dt class="col-sm-3">Nama Mahasiswa</dt>
                <dd class="col-sm-9">{{ $krs->mahasiswa->nama ?? '-' }}</dd>

                <dt class="col-sm-3">Tahun Akademik</dt>
                <dd class="col-sm-9">{{ $krs->tahun_akademik }}</dd>

                <dt class="col-sm-3">Semester</dt>
                <dd class="col-sm-9">{{ $krs->semester }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-{{ $krs->status === 'disetujui' ? 'success' : ($krs->status === 'ditolak' ? 'danger' : 'warning') }}">
                        {{ ucfirst($krs->status) }}
                    </span>
                </dd>
            </dl>
        </div>
    </div>

    <!-- Tabel Detail Mata Kuliah yang Diambil -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-body fw-semibold">Daftar Mata Kuliah Diambil</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th class="text-center">SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($krs->mataKuliah as $index => $mk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><code>{{ $mk->kode ?? $mk->kode_mk ?? '-' }}</code></td>
                                <td>{{ $mk->nama ?? $mk->nama_mk ?? '-' }}</td>
                                <td class="text-center">{{ $mk->sks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada mata kuliah yang diambil pada KRS ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($krs->mataKuliah->isNotEmpty())
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="3" class="text-end">Total SKS:</td>
                                <td class="text-center">{{ $krs->mataKuliah->sum('sks') }}</td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('krs.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('krs.cetak', $krs) }}" target="_blank" class="btn btn-success">
            <i class="bi bi-printer"></i> Cetak KRS
        </a>
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('krs.edit', $krs) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Ubah
            </a>
        @endif
    </div>
@endsection
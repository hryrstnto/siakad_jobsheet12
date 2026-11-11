<!-- NAMA    : HARY RISTANTO 
KELAS   : TIF-5C
NIM     : 3202416102 -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak KRS - {{ $krs->mahasiswa->nim ?? 'KRS' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print { display: none !important; }
        }
        body { font-family: 'Times New Roman', Times, serif; }
    </style>
</head>
<body class="p-4" onload="window.print()">
    <div class="no-print mb-3">
        <button onclick="window.print()" class="btn btn-primary">Cetak Dokumen</button>
        <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
    </div>

    <div class="text-center mb-4 border-bottom pb-3">
        <h3 class="fw-bold mb-0">POLITEKNIK NEGERI PONTIANAK</h3>
        <h5 class="mb-0">JURUSAN TEKNIK ELEKTRO - D3 TEKNIK INFORMATIKA</h5>
        <p class="mb-0">KARTU RENCANA STUDI (KRS)</p>
    </div>

    <table class="table table-borderless mb-4">
        <tr>
            <td width="15%"><strong>NIM</strong></td>
            <td width="35%">: {{ $krs->mahasiswa->nim ?? '-' }}</td>
            <td width="20%"><strong>Tahun Akademik</strong></td>
            <td width="30%">: {{ $krs->tahun_akademik }}</td>
        </tr>
        <tr>
            <td><strong>Nama</strong></td>
            <td>: {{ $krs->mahasiswa->nama ?? '-' }}</td>
            <td><strong>Semester</strong></td>
            <td>: {{ $krs->semester }}</td>
        </tr>
    </table>

    <table class="table table-bordered align-middle">
        <thead class="table-light text-center">
            <tr>
                <th width="5%">No</th>
                <th width="20%">Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th width="10%">SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($krs->mataKuliah as $index => $mk)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $mk->kode ?? $mk->kode_mk }}</td>
                    <td>{{ $mk->nama ?? $mk->nama_mk }}</td>
                    <td class="text-center">{{ $mk->sks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada mata kuliah yang diambil.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="fw-bold">
            <tr>
                <td colspan="3" class="text-end">Total SKS:</td>
                <td class="text-center">{{ $krs->mataKuliah->sum('sks') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="row mt-5">
        <div class="col-6 text-center">
            <p>Mahasiswa,</p>
            <br><br><br>
            <p><strong>({{ $krs->mahasiswa->nama ?? '...................' }})</strong></p>
        </div>
        <div class="col-6 text-center">
            <p>Dosen Pembimbing Akademik,</p>
            <br><br><br>
            <p><strong>(..........................................)</strong></p>
        </div>
    </div>
</body>
</html>
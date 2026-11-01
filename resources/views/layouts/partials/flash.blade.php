<!-- NAMA    : HARY RISTANTO
KELAS   : TIF-5C
NIM     : 3202416102 -->
@foreach ([
    'success' => 'success',
    'error'   => 'danger',
    'warning' => 'warning',
    'info'    => 'info',
] as $kunci => $kelas)
    @if (session($kunci))
        <div class="alert alert-{{ $kelas }} alert-dismissible fade show" role="alert">
            {{ session($kunci) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
@endforeach
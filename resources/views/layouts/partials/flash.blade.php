<!-- NAMA    : HARY RISTANTO
KELAS   : TIF-5C
NIM     : 3202416102 -->
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/css/sweetalert2.min.css') }}">
<script src="{{ asset('vendor/sweetalert2/js/sweetalert2.all.min.js') }}"></script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    @foreach ([
        'success' => 'success',
        'error'   => 'error',
        'warning' => 'warning',
        'info'    => 'info',
    ] as $kunci => $ikon)
        @if (session($kunci))
            Toast.fire({
                icon: '{{ $ikon }}',
                title: @json(session($kunci))
            });
        @endif
    @endforeach
</script>
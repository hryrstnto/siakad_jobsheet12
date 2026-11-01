<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIAKAD') | {{ config('app.name') }}</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-body-tertiary">
    @include('layouts.partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.sidebar')

            <main class="col-lg-9 col-xl-10 px-3 px-md-4 py-4">
                @include('layouts.partials.flash')
                @yield('content')

                <footer class="text-center text-body-secondary small mt-5">
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                    - D3 Teknik Informatika
                </footer>
            </main>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    @stack('scripts')

    {{-- KODE BARU UNTUK TEMA TERANG/GELAP --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('btnThemeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const htmlElement = document.documentElement;

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                const currentTheme = htmlElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                htmlElement.setAttribute('data-bs-theme', newTheme);
                
                if (themeIcon) {
                    // Berganti antara ikon Matahari (mode gelap) dan Bulan (mode terang)
                    if (newTheme === 'dark') {
                        themeIcon.className = 'bi bi-sun-fill';
                    } else {
                        themeIcon.className = 'bi bi-moon-fill';
                    }
                }
            });
        }
    });
</script>
</body>
</html>
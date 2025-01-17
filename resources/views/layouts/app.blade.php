<!DOCTYPE html>
<html data-bs-theme-mode="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    function submitTopUp() {
        const amount = document.getElementById('amount').value;

        fetch("{{ route('topup.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ amount }),
        })
        .then(response => response.json())
        .then(data => {
            snap.pay(data.snapToken, {
                onSuccess: function() {
                    alert('Top up berhasil!');
                    location.reload();
                },
                onPending: function() {
                    alert('Menunggu pembayaran...');
                },
                onError: function() {
                    alert('Top up gagal!');
                }
            });
        });
    }
    function toggleDarkMode() {
        const html = document.documentElement;

        if (html.classList.contains('dark')) {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    }

    // Saat halaman dimuat, terapkan tema sesuai preferensi pengguna
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    });
</script>
    </body>
</html>

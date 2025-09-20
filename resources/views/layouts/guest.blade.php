<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Kepolisian')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-4">
                <img src="{{ asset('logo-polri.png') }}" alt="Logo Polisi" width="80">
                <h4 class="mt-3">@yield('header', 'Sistem Kepolisian')</h4>
            </div>

            @yield('content')
        </div>
    </div>
</body>
</html>

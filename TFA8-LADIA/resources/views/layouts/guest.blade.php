<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome') | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .panel { background: #fff; border-radius: 14px; padding: 2rem; box-shadow: 0 3px 18px rgba(25,35,50,.06); }
    </style>
</head>
<body>
<main class="container d-flex flex-column align-items-center justify-content-center min-vh-100 py-4">
    <a href="{{ url('/') }}" class="h3 fw-bold text-dark text-decoration-none mb-4">{{ config('app.name') }}</a>
    <div class="panel w-100" style="max-width: 460px">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @yield('content')
    </div>
</main>
</body>
</html>

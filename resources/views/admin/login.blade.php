<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Admin - PromoDiskon</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="page-auth">
        <div class="auth-wrapper">
            <div class="auth-card">
                <div class="auth-brand">PromoDiskon Admin</div>
                <p>Masuk untuk mengelola promo dan data produk.</p>

                @if ($errors->any())
                    <div class="alert danger">
                        <strong>Gagal login.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('admin.login.submit') }}" class="auth-form">
                    @csrf
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="admin@promo.local" required>

                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Masukkan password" required>

                    <button type="submit" class="btn btn-primary btn-full">Masuk</button>
                </form>
                <a class="btn btn-ghost btn-full" href="{{ route('home') }}">Kembali ke Beranda</a>
            </div>
        </div>
    </body>
</html>

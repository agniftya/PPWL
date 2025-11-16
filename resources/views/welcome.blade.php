<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TokoKu | Home</title>
    {{-- Inline CSS sangat dasar untuk tampilan minimalis --}}
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background-color: white; }
        .nav-container { padding: 10px 20px; }
        .nav-item { margin-right: 15px; }
        .brand { font-size: 1em; font-weight: bold; color: #696cff; text-decoration: none; }
        ul { list-style: disc; padding-left: 20px; }
        .login-link { margin-top: 10px; display: block; }
    </style>
</head>
<body>
    
    <div class="nav-container">
        {{-- NAMA TOKO --}}
        <a href="{{ route('home') }}" class="brand">TokoKu</a>
        
        {{-- MENU HOME & PRODUK --}}
        <ul>
            <li class="nav-item"><a href="{{ route('home') }}">Home</a></li>
            {{-- Menggunakan products.index untuk rute Produk Admin --}}
            <li class="nav-item"><a href="{{ route('products.index') }}">Produk</a></li> 
        </ul>

        {{-- LINK LOGIN/LOGOUT --}}
        <div class="login-register">
            @guest
                <a href="{{ route('login') }}" class="login-link">Login</a>
            @endguest
            
            @auth
                <a href="{{ route('dashboard') }}">Dashboard Admin</a>
                <form method="POST" action="{{ route('logout') }}" style="display:block;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#dc3545; cursor:pointer; padding: 0;">Logout</button>
                </form>
            @endauth
        </div>
    </div>
    
    {{-- Area Konten Utama (Dikosongkan) --}}
    <div style="padding: 20px;">
        @if (Auth::check() && Auth::user()->role === 'admin')
            {{-- Teks tambahan jika admin login --}}
        @endif
        {{-- Konten Utama Halaman --}}
    </div>

</body>
</html>
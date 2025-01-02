<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bildirimler - Çağlar Bağış Platformu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<style>
    nav ul li a i {
        padding: 5px;
    }
    nav ul li {
        padding: 5px;
    }
</style>
<body class="bg-gray-100">

<nav class="bg-green-600 text-white mt-0">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">

        <div class="text-lg font-bold">
            <a href="#" class="hover:text-green-200">Çağlar Bağış Platformu</a>
        </div>

        @php
            $unreadNotificationsCount = auth()->user() ? auth()->user()->notifications()->where('read', false)->count() : 0;
        @endphp

        <ul class="flex space-x-6">
            <li><a href="/" class="hover:text-green-200"><i class="fa-solid fa-house"></i>Ana Sayfa</a></li>
            <li><a href="/kampanyalar" class="hover:text-green-200"><i class="fa-solid fa-calendar-days"></i>Kampanyalar</a></li>
            <li><a href="/profile" class="hover:text-green-200"><i class="fa-solid fa-user"></i>Profil</a></li>
            <li><a href="/hakkimizda" class="hover:text-green-200"><i class="fa-solid fa-address-card"></i>Hakkımızda</a></li>
            <li><a href="/donations" class="hover:text-green-200"><i class="fa-solid fa-circle-dollar-to-slot"></i>Bağışlarım</a></li>
            <li class="relative">
                <a href="/notifications" class="hover:text-green-200">
                    <i class="fa-solid fa-bell"></i>
                    @if($unreadNotificationsCount > 0)
                        <span class="absolute top-0 right-0 rounded-full bg-red-600 text-white text-xs px-2 py-1">
                            {{ $unreadNotificationsCount }}
                        </span>
                    @endif
                </a>
            </li>
        </ul>

        <div class="flex items-center space-x-4">
            @auth
                <span class="font-semibold">Merhaba, {{ Auth::user()->name }}</span>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 px-4 py-2 rounded hover:bg-red-700">
                        Çıkış Yap
                    </button>
                </form>
            @else
                <a href="/login" class="bg-white text-green-600 px-4 py-2 rounded hover:bg-green-100">Oturum Aç</a>
                <a href="/register" class="bg-green-800 px-4 py-2 rounded hover:bg-green-700">Kaydol</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container mx-auto mt-8 p-4 bg-white rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-green-600 text-center mb-6">Bildirimler</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <ul class="space-y-4">
        @forelse($notifications as $notification)
            <li class="bg-white p-4 rounded-lg shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <strong class="text-lg text-green-600">{{ $notification->type }}</strong>
                        <p class="text-gray-700 mt-2">{{ $notification->message }}</p>
                    </div>


                </div>
            </li>
        @empty
            <li class="bg-white p-4 rounded-lg shadow-lg">
                <p class="text-gray-500">Hiç bildirim yok.</p>
            </li>
        @endforelse
    </ul>
</div>
</body>
</html>

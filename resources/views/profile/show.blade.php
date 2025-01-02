<!-- resources/views/user_profile/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim - {{ auth()->user()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<style>
    nav ul li{
        padding: 5px;
    }
    nav ul li a i{
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

<div class="max-w-4xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold text-center text-green-700 mb-8">Kullanıcı Profilim</h1>

    <div class="flex justify-center mb-6">
        <img src="{{ $profile->profile_picture ? asset('storage/' . $profile->profile_picture) : 'https://via.placeholder.com/150' }}" alt="Profil Resmi" class="w-32 h-32 rounded-full border-4 border-green-600 shadow-lg">
    </div>

    <div class="space-y-4">
        <p><strong class="text-green-600">Adı:</strong> {{ auth()->user()->name }}</p>
        <p><strong class="text-green-600">Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong class="text-green-600">Adres:</strong> {{ $profile->address ?? 'Belirtilmemiş' }}</p>
        <p><strong class="text-green-600">Telefon:</strong> {{ $profile->phone ?? 'Belirtilmemiş' }}</p>
        <p><strong class="text-green-600">Ülke:</strong> {{ $profile->country ?? 'Belirtilmemiş' }}</p>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('profile.edit') }}" class="text-white bg-green-600 px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300">Profili Düzenle</a>
    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampanyalar - Çağlar Bağış Platformu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

<style>
    nav ul li a i {
        padding: 5px;
    }

    nav ul li {
        padding: 5px;
    }
</style>


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

<div class="container mx-auto mt-8 text-center">
    <h1 class="text-4xl font-bold text-green-700">Tüm Kampanyalar</h1>
    <p class="text-gray-700 mt-4">Bağış yapabileceğiniz kampanyaları keşfedin.</p>
</div>

<div class="container mx-auto mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @foreach ($campaigns as $campaign)
        <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-green-600">{{ $campaign->title }}</h3>
            <p class="text-gray-700 mt-2">{{ \Illuminate\Support\Str::limit($campaign->description, 50) }}</p>
            <p class="text-gray-500 mt-2">Hedef Tutar: {{ number_format($campaign->goal_amount, 2) }} TL</p>
            <p class="text-gray-500 mt-2">
                Son Tarih:
                @if ($campaign->end_date)
                    {{ \Carbon\Carbon::parse($campaign->end_date)->format('d-m-Y') }}
                @else
                    Belli Değil
                @endif
            </p>
            <a href="{{route('campaigns.show', $campaign->id)}}" class="mt-4 inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300 ease-in-out">Kampanyayı Görüntüle</a>
        </div>
    @endforeach


</div>
<footer class="bg-green-600 text-white mt-8 py-6">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">

        <div class="text-center md:text-left">
            <h3 class="text-2xl font-bold">Çağlar Bağış Platformu</h3>
            <p class="mt-2 text-sm">Dünyayı daha iyi bir yer haline getirmek için birlikte çalışıyoruz. Yardım elinizi uzatın!</p>
        </div>

        <div class="mt-6 md:mt-0 flex space-x-4">
            <a href="#" class="text-white hover:text-green-200">
                <i class="fab fa-facebook-square text-2xl"></i>
            </a>
            <a href="#" class="text-white hover:text-green-200">
                <i class="fab fa-twitter-square text-2xl"></i>
            </a>
            <a href="#" class="text-white hover:text-green-200">
                <i class="fab fa-instagram text-2xl"></i>
            </a>
            <a href="#" class="text-white hover:text-green-200">
                <i class="fab fa-linkedin text-2xl"></i>
            </a>
        </div>

        <div class="mt-6 md:mt-0 text-center md:text-right">
            <p><a href="#" class="hover:text-green-200">Hakkımızda</a></p>
            <p><a href="#" class="hover:text-green-200">İletişim</a></p>
            <p><a href="#" class="hover:text-green-200">Gizlilik Politikası</a></p>
        </div>
    </div>
</footer>
</body>

</html>

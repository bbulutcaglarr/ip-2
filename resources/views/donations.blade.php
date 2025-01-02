<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bağışlarım - Çağlar Bağış Platformu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<style>
    nav ul li{
        padding: 5px;
    }
    nav ul li a i{
        padding: 5px;
    }
</style>
<nav class="bg-green-600 text-white mt-0">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-lg font-bold">
            <a href="/welcome" class="hover:text-green-200">Çağlar Bağış Platformu</a>
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

<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold text-green-700">Bağışlarım</h1>

    @if(session('success'))
        <div class="bg-green-100 p-4 mt-4 text-green-700 rounded-lg border border-green-400">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="mt-8">
        @foreach($donations as $donation)
            <div class="mt-6 p-4 bg-gray-100 rounded-lg shadow-sm">
                <div class="font-semibold">Bağış Tutarı: {{ number_format($donation->amount, 2) }} TL</div>
                <div class="text-gray-500">Bağış Tarihi: {{ $donation->created_at->format('d-m-Y') }}</div>
                <div class="mt-2 text-gray-500">Ödeme Yöntemi: {{ $donation->payment_method }}</div>

                @if($donation->refunds && $donation->refunds->isEmpty())
                    <form action="/donations/{{$donation->id}}/refund" method="POST" class="mt-4 space-y-4">
                        @csrf
                        <div>
                            <label for="reason" class="block text-gray-700 font-semibold">İade Sebebi:</label>
                            <textarea id="reason" name="reason" class="w-full p-4 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" rows="4" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition duration-300">Bağış İade Et</button>
                        </div>
                    </form>
                @else
                    <div class="mt-2 text-yellow-500">Bu bağış için iade yapılmış.</div>
                @endif
            </div>
        @endforeach
    </div>
</div>

</body>
</html>

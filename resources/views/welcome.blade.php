<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa - Çağlar Bağış Platformu</title>
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

    /* Slider'ı belirli bir yüksekliğe ayarlıyoruz */
    #slider {
        height: 700px; /* Yüksekliği 600px olarak ayarlıyoruz */
        overflow: hidden;
    }

    /* Slider içerisine eklenen resimleri uyumlu hale getiriyoruz */
    #slider-content {
        display: flex;
        height: 100%;
        width: 100%;
    }

    #slider-content img {
        object-fit: cover; /* Görselleri uygun şekilde kesmek için */
        object-position: center; /* Resmi ortalıyoruz */
        height: 100%; /* Yüksekliği %100 */
        width: 100%; /* Genişliği %100 */
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

<div class="container mx-auto text-center">

    <div id="slider" class="relative">
        <div id="slider-content" class="flex transition-transform duration-500">
            <div class="min-w-full relative">
                <img src="https://www.investopedia.com/thmb/hvCs7nGRZ539vKETw1KIHvk2HzM=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/GettyImages-1173117669-baa23a3889054f828aebc58f9de136b6.jpg" alt="Slider 1" class="w-full">
                <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white bg-black bg-opacity-50">
                    <h1 class="text-4xl font-bold">Hoş Geldiniz!</h1>
                    <p class="mt-2">Bağış yaparak dünyayı daha iyi bir yer haline getirebilirsiniz.</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="https://etisanvakfi.org.tr/images/etisan-bagis-yap.jpg" alt="Slider 2" class="w-full">
                <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white bg-black bg-opacity-50">
                    <h1 class="text-4xl font-bold">Kampanyalara Katılın</h1>
                    <p class="mt-2">Toplum için harekete geçin ve yardım elinizi uzatın.</p>
                </div>
            </div>
            <div class="min-w-full relative">
                <img src="https://hazarhukuk.com.tr/wp-content/uploads/2022/02/ELBIRLIGI-MULKIYETI-NEDIR-ELBIRLIGI-MULKIYETIN-OZELLIKLERI.jpg" alt="Slider 3" class="w-full">
                <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white bg-black bg-opacity-50">
                    <h1 class="text-4xl font-bold">Birlikte Güçlüyüz</h1>
                    <p class="mt-2">Hedeflerimize ulaşmak için sizin desteğinize ihtiyacımız var.</p>
                </div>
            </div>
        </div>
    </div>

    <button id="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-green-600 text-white px-2 py-1 rounded-full hover:bg-green-700">
        ‹
    </button>
    <button id="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-green-600 text-white px-2 py-1 rounded-full hover:bg-green-700">
        ›
    </button>
</div>

<div class="mt-8">
    <h2 class="text-2xl font-bold text-green-600">Popüler Kampanyalar</h2>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($campaigns as $campaign)
            <div class="border p-4 rounded-lg shadow-lg bg-white">
                <h2 class="text-xl font-bold text-green-600">{{ $campaign->title }}</h2>
                <p class="mt-2 text-gray-600">{{ Str::limit($campaign->description, 100) }}</p>
                <p class="mt-2 text-green-500">Hedef: {{ number_format($campaign->goal_amount, 2) }} TL</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 text-center">
        <a href="/kampanyalar" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
            Tüm Kampanyaları Görüntüle
        </a>
    </div>
</div>

@if(session('success'))
    <div class="p-4 mb-4 bg-green-200 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sliderContent = document.getElementById('slider-content');
        const nextButton = document.getElementById('next');
        const prevButton = document.getElementById('prev');

        let index = 0;

        nextButton.addEventListener('click', () => {
            if (index < sliderContent.children.length - 1) {
                index++;
                sliderContent.style.transform = `translateX(-${index * 100}%)`;
            }
        });

        prevButton.addEventListener('click', () => {
            if (index > 0) {
                index--;
                sliderContent.style.transform = `translateX(-${index * 100}%)`;
            }
        });
    });
</script>
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

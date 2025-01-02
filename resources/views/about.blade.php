<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımızda - Çağlar Bağış Platformu</title>
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

<div class="container mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold text-green-700 text-center">Hakkımızda</h1>

    <p class="text-gray-700 mt-6 text-xl leading-relaxed">
        Çağlar Bağış Platformu, insanların gönüllü olarak ihtiyaç sahiplerine bağış yapmalarını sağlayan bir çevrimiçi platformdur.
        Platformumuz, yardımseverlikleri daha erişilebilir ve etkili hale getirmeyi hedeflemektedir.
    </p>

    <h2 class="text-2xl font-semibold mt-8 text-green-600">Misyonumuz</h2>
    <p class="text-gray-700 mt-4 text-lg">
        Çağlar Bağış Platformu olarak, insanların küçük katkılarla büyük farklar yaratabileceğine inanıyoruz. Misyonumuz, herkesin
        eşit fırsatlara sahip olabilmesi için yardım alabileceği, destek bulabileceği ve projelere katkıda bulunabileceği
        bir alan sunmaktır.
    </p>

    <h2 class="text-2xl font-semibold mt-8 text-green-600">Nasıl Çalışır?</h2>
    <p class="text-gray-700 mt-4 text-lg">
        Platformumuzda, herkes toplumsal sorunlara çözüm üretmek isteyen projelere bağış yapabilir. Kampanyalarımız,
        her türlü insani yardım ve sosyal sorumluluk projelerinin desteklenmesine olanak sağlar. Katkıda bulunmak isteyen
        kullanıcılar, güvenli ödeme yöntemleriyle bağışlarını kolayca gerçekleştirebilir.
    </p>

    <h2 class="text-2xl font-semibold mt-8 text-green-600">Desteklediğimiz Alanlar</h2>
    <ul class="list-disc list-inside mt-4 text-gray-700">
        <li>Sağlık Yardımları</li>
        <li>Eğitim Projeleri</li>
        <li>Doğa ve Çevre Koruma</li>
        <li>Yoksullukla Mücadele</li>
        <li>Hayvan Hakları</li>
    </ul>

    <h2 class="text-2xl font-semibold mt-8 text-green-600">Bizimle İletişime Geçin</h2>
    <p class="text-gray-700 mt-4">
        Sorularınız, önerileriniz veya geri bildirimleriniz için bizimle iletişime geçebilirsiniz. Size yardımcı olmak için
        buradayız!<br>
        E-posta: <a href="mailto:info@bagisplatformu.com" class="text-blue-500">info@bagisplatformu.com</a><br>
        Telefon: <span class="text-blue-500">(123) 456-7890</span>
    </p>

    <div class="mt-12 bg-gray-50 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-red-600">Bir Kampanyayı Bildir</h2>
        <form action="{{ route('campaigns.report', $campaign->id) }}" method="POST" class="mt-4">
            @csrf
            <div class="mt-4">
                <textarea name="reason" rows="4" class="w-full p-4 border border-gray-300 rounded-lg" placeholder="Bildirinin nedenini yazın..." required></textarea>
                @error('reason')
                <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition duration-300">Bildir</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>

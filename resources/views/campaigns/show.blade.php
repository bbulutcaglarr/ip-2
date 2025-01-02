<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->title }} - Kampanya Detayı</title>
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
<nav class="bg-green-600 text-white">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="text-lg font-bold">
            <a href="#" class="hover:text-green-200">Çağlar Bağış Platformu</a>
        </div>


        <ul class="flex space-x-6">
            <li><a href="/" class="hover:text-green-200"><i class="fa-solid fa-house"></i>Ana Sayfa</a></li>
            <li><a href="/kampanyalar" class="hover:text-green-200"><i class="fa-solid fa-calendar-days"></i>Kampanyalar</a></li>
            <li><a href="/profile" class="hover:text-green-200"><i class="fa-solid fa-user"></i>Profil</a></li>
            <li><a href="/hakkimizda" class="hover:text-green-200"><i class="fa-solid fa-address-card"></i>Hakkımızda</a></li>
            <li><a href="/donations" class="hover:text-green-200"><i class="fa-solid fa-circle-dollar-to-slot"></i>Bağışlarım</a></li>
            <li class="relative">
                <a href="/notifications" class="hover:text-green-200">
                    <i class="fa-solid fa-bell"></i>
                    @isset($unreadNotificationsCount)
                        @if($unreadNotificationsCount > 0)
                            <span class="absolute top-0 right-0 rounded-full bg-red-600 text-white text-xs px-2 py-1">
                            {{ $unreadNotificationsCount }}
                        </span>
                        @endif
                    @endisset
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

    <h1 class="text-4xl font-bold text-green-700">{{ $campaign->title }}</h1>
    <p class="text-gray-700 mt-4">{{ $campaign->description }}</p>
    <p class="mt-2 text-green-500">Hedef Tutar: <span class="font-semibold">{{ number_format($campaign->goal_amount, 2) }} TL</span></p>
    <p class="mt-2 text-gray-500">Toplam Bağış: <span class="font-semibold">{{ number_format($total_donations, 2) }} TL</span></p>
    <p class="mt-2 text-gray-500">Son Tarih: <span class="font-semibold">{{ $campaign->end_date ? $campaign->end_date : 'Belli Değil' }}</span></p>


    @auth
        <form action="{{route('campaigns.donate')}}" method="POST" class="mt-8 space-y-4">
            @csrf
            <input type="hidden" name="id" value="{{ $campaign->id }}">
            <div>
                <label for="amount" class="block text-gray-700 font-semibold">Bağış Miktarı (TL):</label>
                <input type="number" id="amount" name="amount" class="w-full p-4 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" min="1" required>
                @error('amount')
                <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="payment_method" class="block text-gray-700 font-semibold">Ödeme Yöntemi:</label>
                <select id="payment_method" name="payment_method" class="w-full p-4 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                    <option value="Kredi Kartı">Kredi Kartı</option>
                    <option value="Banka Transferi">Banka Transferi</option>
                    <option value="PayPal">PayPal</option>
                </select>
                @error('payment_method')
                <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-300">Bağış Yap</button>
                <button type="submit" formaction="/kampanyalar" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-300">Kampanyayı Kaydet</button>
            </div>
        </form>
    @else
        <p class="mt-4 text-center text-gray-500">Bağış yapmak için lütfen <a href="/login" class="text-blue-500 underline">giriş yapın</a>.</p>
    @endauth


    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-green-600">Yorumlar</h2>
        @foreach ($campaign->comments as $comment)
            <div class="mt-4 p-4 bg-gray-100 rounded-lg shadow-sm">
                <div class="font-semibold">{{ $comment->user->name }} <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span></div>
                <p class="mt-2 text-gray-700">{{ $comment->content }}</p>
            </div>
        @endforeach


        @auth
            <form action="{{ route('campaigns.addComment', $campaign->id) }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="content" class="block text-gray-700 font-semibold">Yorum Yap:</label>
                    <textarea id="content" name="content" class="w-full p-4 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" rows="4" required></textarea>
                    @error('content')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-300">Yorum Yap</button>
                </div>
            </form>
        @else
            <p class="mt-4 text-center text-gray-500">Yorum yapabilmek için <a href="/login" class="text-blue-500 underline">giriş yapın</a>.</p>
        @endauth
    </div>
    @if(session('donation_success'))
        <div class="bg-white p-6 rounded-lg shadow-lg mt-8">
            <h3 class="text-xl font-semibold text-green-600">Bağışınız Başarılı!</h3>
            <p class="mt-2 text-gray-700">Bağışınız başarıyla tamamlandı. Lütfen geri bildirimde bulunun.</p>

            <form action="/campaigns/{{$campaign->id}}/feedback" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label for="message" class="block text-gray-700 font-semibold">Mesajınız:</label>
                    <textarea id="message" name="message" class="w-full p-4 mt-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" rows="4" placeholder="Mesajınızı yazın..." required></textarea>
                    @error('message')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="rating" class="block text-gray-700 font-semibold">Puan (1-5 Yıldız):</label>
                    <div class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" id="rating{{ $i }}" name="rating" value="{{ $i }}" class="hidden" required>
                            <label for="rating{{ $i }}" class="cursor-pointer text-yellow-500 text-2xl">&#9733;</label>
                        @endfor
                    </div>
                    @error('rating')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-300">Geri Bildirim Gönder</button>
                </div>
            </form>
        </div>
    @endif
</div>
<script>

    document.querySelectorAll('input[name="rating"]').forEach((star) => {
        star.addEventListener('change', function() {

            document.querySelectorAll('input[name="rating"]').forEach((input) => {
                input.previousElementSibling.classList.remove('text-yellow-500');
                input.previousElementSibling.classList.add('text-gray-300');
            });

            for (let i = 1; i <= this.value; i++) {
                document.getElementById('rating' + i).previousElementSibling.classList.add('text-yellow-500');
            }
        });
    });
</script>

</body>
</html>

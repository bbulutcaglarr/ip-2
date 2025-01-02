<!-- resources/views/user_profile/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Düzenle - {{ auth()->user()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold text-center text-green-700 mb-8">Profilinizi Düzenleyin</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- PUT methodunu belirtmek için kullanılır -->

        <div class="mb-6">
            <label for="profile_picture" class="block text-green-600 font-semibold mb-2">Profil Resmi</label>
            <input type="file" name="profile_picture" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" accept="image/*">
            @error('profile_picture')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <label for="address" class="block text-green-600 font-semibold mb-2">Adres</label>
            <input type="text" name="address" value="{{ $profile->address }}" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('address')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <label for="phone" class="block text-green-600 font-semibold mb-2">Telefon</label>
            <input type="text" name="phone" value="{{ $profile->phone }}" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('phone')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-6">
            <label for="country" class="block text-green-600 font-semibold mb-2">Ülke</label>
            <select name="country" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">Ülke Seçin</option>
                @foreach ($countries as $key => $value)
                    <option value="{{ $value }}" {{ $profile->country == $value ? 'selected' : '' }}>
                        {{ $key }}
                    </option>
                @endforeach
            </select>
            @error('country')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>


        <div class="mt-8 text-center">
            <button type="submit" class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition duration-300">Profili Güncelle</button>
        </div>
    </form>

</div>

</body>
</html>

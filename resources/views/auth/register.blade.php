<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaydol</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8">
                <h2 class="text-3xl font-bold text-center text-green-600 mb-8">Kayıt Ol</h2>
                <form action="/register" method="POST" class="grid grid-cols-2 gap-6">
                    @csrf

                    <div class="col-span-2 sm:col-span-1">
                        <label for="name" class="block text-lg font-medium text-gray-700">Ad Soyad</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-lg"
                               required>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="email" class="block text-lg font-medium text-gray-700">E-posta</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-lg"
                               required>
                    </div>


                    <div class="col-span-2 sm:col-span-1">
                        <label for="password" class="block text-lg font-medium text-gray-700">Şifre</label>
                        <input type="password" name="password" id="password"
                               class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-lg"
                               required>
                    </div>


                    <div class="col-span-2 sm:col-span-1">
                        <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Şifre (Tekrar)</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-lg"
                               required>
                    </div>

                    <div class="col-span-2">
                        <label for="address" class="block text-lg font-medium text-gray-700">Adres</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-lg">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="phone" class="block text-lg font-medium text-gray-700">Telefon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                               class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-lg">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="country" class="block text-lg font-medium text-gray-700">Ülke</label>
                        <select name="country" id="country" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-lg" required>
                            <option value="">Ülke Seçin</option>
                            @foreach ($countries as $key => $value)
                                <option value="{{ $value }}" {{ old('country') == $value ? 'selected' : '' }}>
                                    {{ $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <button type="submit"
                                class="w-full bg-green-600 text-white py-3 px-6 rounded-md shadow-sm text-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Kaydol
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>
</html>

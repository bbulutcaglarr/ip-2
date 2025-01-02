<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oturum Aç</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<form method="POST" action="/login" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
    @csrf
    <h1 class="text-2xl font-bold mb-4">Oturum Aç</h1>
    <div class="mb-4">
        <label for="email" class="block text-gray-700">E-posta</label>
        <input type="email" id="email" name="email" class="border border-gray-300 p-2 w-full rounded" required>
    </div>
    <div class="mb-4">
        <label for="password" class="block text-gray-700">Şifre</label>
        <input type="password" id="password" name="password" class="border border-gray-300 p-2 w-full rounded" required>
    </div>
    @if($errors->any())
        <p class="text-red-600">{{ $errors->first() }}</p>
    @endif
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Giriş Yap</button>
</form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Learning System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-indigo-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl border border-indigo-100 overflow-hidden">
        <div class="bg-indigo-600 p-8 text-white text-center">
            <h1 class="text-3xl font-bold">Selamat Datang</h1>
            <p class="text-indigo-100 mt-2">Silakan masuk ke akun Anda</p>
        </div>
        
        <form action="{{ route('login') }}" method="POST" class="p-8">
            @csrf
            
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-lg text-sm border border-red-100">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition"
                        placeholder="nama@email.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition">
                    Masuk Sekarang
                </button>
            </div>

            <div class="mt-8 text-center text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Daftar di sini</a>
            </div>
        </form>
    </div>
</body>
</html>

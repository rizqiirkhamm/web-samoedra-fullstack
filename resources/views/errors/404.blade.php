<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found - Rumah Samoedra</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-8 md:px-0">
    <div class="flex flex-col items-center justify-center py-20">
        <img src="{{ asset('images/assets/ikan2.svg') }}" alt="404 Not Found" class="md:w-56 md:h-56 w-44 h-44 animate-float">
        <h1 class="text-4xl md:text-7xl font-bold text-[#3E5467] mb-4">Error 404</h1>
        <h2 class="text-[#E8A26A] font-semibold text-xl md:text-2xl mb-4">Oops! Halaman tidak ditemukan</h2>
        <p class="text-[#A2A2BD] font-medium text-center max-w-md mb-8">Sepertinya kamu tersesat di lautan Samoedra.<br>Kembali ke halaman utama dan temukan petualanganmu!</p>
        <a href="/" class="inline-block px-8 py-3 bg-[#3E5467] text-white rounded-full font-medium hover:bg-[#BDBDCB] transition-all duration-300">Kembali ke Beranda</a>
    </div>
</body>
</html>
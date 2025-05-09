<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Samoedra Admin</title>
    <link rel="icon" href="{{ asset('images/assets/logo-doang.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a7c59 0%, #0a3d2e 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
            color: #333;
            overflow: hidden;
        }
        .login-container {
            display: flex;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            backdrop-filter: blur(10px);
        }
        .login-image {
            flex: 1;
            background: linear-gradient(135deg, #2ca76e 0%, #1a7c59 100%);
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .login-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            transform: rotate(45deg);
            animation: shimmer 8s infinite;
        }
        @keyframes shimmer {
            0% { transform: rotate(45deg) translateX(-100%); }
            50% { transform: rotate(45deg) translateX(100%); }
            100% { transform: rotate(45deg) translateX(-100%); }
        }
        .login-form {
            flex: 1;
            padding: 60px;
            background: transparent;
        }
       Hypothesis: The logo-container should be centered with a subtle animation
        .logo-container {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeIn 1s ease-in-out;
        }
        .logo-container img {
            max-width: 200px;
            margin-bottom: 25px;
            transition: transform 0.3s;
        }
        .logo-container img:hover {
            transform: scale(1.05);
        }
        h1 {
            font-weight: 700;
            color: #1a7c59;
            margin-bottom: 35px;
            font-size: 30px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-control {
            height: 55px;
            border-radius: 10px;
            border: 1px solid #ccc;
            padding-left: 20px;
            margin-bottom: 25px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.7);
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #2ca76e;
            box-shadow: 0 0 0 0.25rem rgba(44, 167, 110, 0.2);
            background: white;
        }
        .login-btn {
            background: #2ca76e;
            border: none;
            height: 55px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 17px;
            margin-top: 15px;
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
        }
        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }
        .login-btn:hover::before {
            left: 100%;
        }
        .login-btn:hover {
            background: #1a7c59;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(44, 167, 110, 0.3);
        }
        .auth-message h3 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 25px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .auth-message p {
            font-size: 16px;
            opacity: 0.95;
            line-height: 1.7;
            margin-bottom: 35px;
        }
        .form-label {
            font-weight: 500;
            color: #444;
            margin-bottom: 10px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        .remember-me input {
            margin-right: 12px;
            accent-color: #2ca76e;
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #2ca76e;
            z-index: 10;
            transition: color 0.3s;
        }
        .toggle-password:hover {
            color: #1a7c59;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                margin: 30px;
                border-radius: 15px;
            }
            .login-image {
                padding: 40px;
            }
            .login-form {
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-image d-none d-md-flex">
            <div class="auth-message text-center">
                <h3>Selamat Datang di Sistem Admin Samoedra</h3>
                <p>Masuk ke dashboard untuk mengelola data dan konten website Samoedra.</p>
            </div>
        </div>
        <div class="login-form">
            <div class="logo-container">
                <img src="{{ asset('images/assets/samoedra_logo.png') }}" alt="Samoedra Logo">
                <h1>Login Admin</h1>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email Anda">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-container">
                        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                        <i class="toggle-password fas fa-eye-slash" onclick="togglePassword()"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Ingat Saya</label>
                </div>

                <button type="submit" class="btn login-btn btn-primary w-100">
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const rememberCheckbox = document.getElementById('remember_me');
            const loginForm = document.querySelector('form');

            if (localStorage.getItem('savedEmail')) {
                emailInput.value = localStorage.getItem('savedEmail');
                passwordInput.value = localStorage.getItem('savedPassword') || '';
                rememberCheckbox.checked = true;
            }

            loginForm.addEventListener('submit', function() {
                if (rememberCheckbox.checked) {
                    localStorage.setItem('savedEmail', emailInput.value);
                    localStorage.setItem('savedPassword', passwordInput.value);
                } else {
                    localStorage.removeItem('savedEmail');
                    localStorage.removeItem('savedPassword');
                }
            });
        });
    </script>
</body>
</html>
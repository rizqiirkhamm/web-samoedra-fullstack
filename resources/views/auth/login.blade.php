<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Samoedra Admin') }}</title>
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
            background: linear-gradient(135deg, #0a4d8c 0%, #0a2e52 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .login-container {
            display: flex;
            max-width: 900px;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .login-image {
            flex: 1;
            background: linear-gradient(135deg, #125d9e 0%, #0b3d6f 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .login-form {
            flex: 1;
            padding: 50px;
            background: white;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-container img {
            max-width: 180px;
            margin-bottom: 20px;
        }
        h1 {
            font-weight: 700;
            color: #0a4d8c;
            margin-bottom: 30px;
            font-size: 28px;
        }
        .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding-left: 15px;
            margin-bottom: 20px;
            font-size: 15px;
        }
        .form-control:focus {
            border-color: #0a4d8c;
            box-shadow: 0 0 0 0.2rem rgba(10, 77, 140, 0.15);
        }
        .login-btn {
            background: #0a4d8c;
            border: none;
            height: 50px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin-top: 10px;
            transition: all 0.3s;
        }
        .login-btn:hover {
            background: #083b6a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(10, 77, 140, 0.2);
        }
        .auth-message h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .auth-message p {
            font-size: 15px;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .remember-me input {
            margin-right: 10px;
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #0a4d8c;
            z-index: 10;
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                margin: 20px;
            }
            .login-image {
                padding: 30px;
            }
            .login-form {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-image d-none d-md-flex">
            <div class="auth-message text-center">
                <h3>Selamat Datang di Sistem Admin</h3>
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
        // Function untuk toggle password visibility
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

        // Script untuk menyimpan dan mengisi data login
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const rememberCheckbox = document.getElementById('remember_me');
            const loginForm = document.querySelector('form');

            // Cek apakah ada data tersimpan
            if (localStorage.getItem('savedEmail')) {
                emailInput.value = localStorage.getItem('savedEmail');
                passwordInput.value = localStorage.getItem('savedPassword') || '';
                rememberCheckbox.checked = true;
            }

            // Simpan data saat form disubmit
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

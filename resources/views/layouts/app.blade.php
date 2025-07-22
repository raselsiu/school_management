<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $schoolNameEN }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="icon" type="image/x-icon" href="{{ asset('uploads/favicon.png') }}">

    <style>
        a.navbar-brand img {
            margin-top: -10px !important;
        }

        .card-header {
            padding: 4px 21px;
            font-size: 24px;
            padding: 5px 15px !important;
        }

        /* Login Form Beautiful Styling */

        /* Background and container styling */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(120, 119, 198, 0.2) 0%, transparent 50%);
            animation: floatBackground 20s ease-in-out infinite alternate;
            z-index: -1;
        }

        @keyframes floatBackground {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            100% {
                transform: translateY(-20px) rotate(2deg);
            }
        }



        /* Card styling with glassmorphism effect */
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1),
                0 10px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 55px rgba(0, 0, 0, 0.15),
                0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Header styling */
        .card-header {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            padding: 25px 30px;
            font-size: 28px;
            font-weight: 600;
            color: #ffffff;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* Body styling */
        .card-body {
            padding: 40px 30px;
        }

        /* Form styling */
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 16px;
            color: #333;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25),
                0 6px 12px rgba(0, 0, 0, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control.is-invalid {
            border-color: #e74c3c;
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
        }

        /* Label styling */
        .col-form-label {
            font-weight: 600;
            color: #ffffff;
            font-size: 16px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Button styling */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 40px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }

        /* Error message styling */
        .invalid-feedback {
            color: #ff6b6b;
            font-weight: 500;
            margin-top: 8px;
            padding-left: 20px;
            position: relative;
        }

        .invalid-feedback::before {
            content: '⚠';
            position: absolute;
            left: 0;
            top: 0;
        }

        /* Row spacing */
        .row.mb-3 {
            margin-bottom: 25px !important;
        }

        /* Input focus animations */
        .form-control {
            position: relative;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .container {
                padding-top: 40px;
                padding-bottom: 40px;
            }

            .card-body {
                padding: 30px 20px;
            }

            .card-header {
                padding: 20px;
                font-size: 24px;
            }

            .col-form-label {
                text-align: left !important;
                margin-bottom: 10px;
            }
        }

        /* Additional fancy effects */
        .card {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Input placeholder styling */
        .form-control::placeholder {
            color: #999;
            opacity: 0.8;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="margin: 0;padding:0">
                    <img src="{{ asset('uploads/favicon.png') }}" alt="logo"
                        width="30">&nbsp;&nbsp;{{ $schoolNameEN }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>

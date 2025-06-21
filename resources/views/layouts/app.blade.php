<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background: #f8f9fa;
        }
        
        /* Modern Navigation Styles */
        .modern-navbar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #3498db 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: none;
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0;
        }
        
        .navbar-container {
            padding: 18px 0;
        }
        
        .modern-navbar .navbar-brand {
            transition: all 0.3s ease;
            padding: 0;
        }
        
        .modern-navbar .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .modern-navbar .navbar-brand img {
            height: 60px;
            width: auto;
            filter: brightness(1.1) drop-shadow(0 2px 8px rgba(0, 0, 0, 0.2));
            transition: all 0.3s ease;
        }
        
        .modern-navbar .navbar-brand img:hover {
            filter: brightness(1.2) drop-shadow(0 4px 12px rgba(0, 0, 0, 0.3));
        }
        
        .modern-navbar .navbar-toggler {
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }
        
        .modern-navbar .navbar-toggler:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }
        
        .modern-navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 20px;
            height: 20px;
        }
        
        .modern-navbar .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            padding: 12px 15px;
            margin: 0 3px;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }
        
        /* Ensure navbar items stay right-aligned */
        .modern-navbar .navbar-nav {
            margin-left: auto !important;
        }
        
        .modern-navbar .navbar-collapse {
            flex-grow: 0 !important;
        }
        
        .modern-navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .modern-navbar .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .modern-navbar .navbar-nav .nav-link:hover::before {
            left: 100%;
        }
        
        .modern-navbar .navbar-nav .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .modern-navbar .navbar-nav .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        
        .modern-navbar .dropdown-menu {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            padding: 15px 0;
            margin-top: 10px;
        }
        
        .modern-navbar .dropdown-item {
            color: #2c3e50;
            font-weight: 500;
            padding: 12px 25px;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }
        
        .modern-navbar .dropdown-item:hover {
            background: linear-gradient(135deg, #1e3c72 0%, #3498db 100%);
            color: white;
            transform: translateX(5px);
        }
        
        .modern-navbar .dropdown-divider {
            border-color: #e1e8ed;
            margin: 10px 20px;
        }
        
        .modern-navbar .dropdown-toggle::after {
            margin-left: 8px;
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 700;
            font-size: 14px;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Ensure proper sticky footer layout */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .modern-navbar .navbar-collapse {
                background: rgba(0, 0, 0, 0.1);
                border-radius: 12px;
                padding: 20px;
                margin-top: 15px;
                backdrop-filter: blur(10px);
            }
            
            .modern-navbar .navbar-nav .nav-link {
                margin: 5px 0;
                text-align: center;
                white-space: normal;
            }
            
            .modern-navbar .dropdown-menu {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }
        }
        
        @media (max-width: 576px) {
            .navbar-container {
                padding: 15px 0;
            }
            
            .modern-navbar .navbar-brand img {
                height: 45px;
            }
            
            .modern-navbar .navbar-nav .nav-link {
                font-size: 12px;
                padding: 10px 12px;
                white-space: normal;
            }
        }
        
        /* Fix for very small screens */
        @media (max-width: 1200px) {
            .modern-navbar .navbar-nav .nav-link {
                font-size: 12px;
                padding: 12px 12px;
                letter-spacing: 0.2px;
            }
        }
    </style>

    <!-- Scripts -->
    @stack('scripts')

    <link rel="shortcut icon" sizes="192x192" href="{{ url('images/favicon6.ico') }}">
</head>
<body>
    <div class="main-wrapper">
        <!-- Modern Navigation -->
        <nav class="navbar navbar-expand-lg modern-navbar">
            <div class="container navbar-container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ url('images/logo/logo2.png') }}" alt="Big Rewa">
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fa fa-sign-in"></i> Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fa fa-user-plus"></i> Register
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('home*') ? 'active' : '' }}" href="{{ url('/home') }}">
                                    <i class="fa fa-home"></i> Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('google-inbox*') ? 'active' : '' }}" href="{{ url('/google-inbox') }}">
                                    <i class="fa fa-inbox"></i> Gmail
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('g-send-mail*') ? 'active' : '' }}" href="{{ url('/g-send-mail') }}">
                                    <i class="fa fa-paper-plane"></i> Sent Mails
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('template*') ? 'active' : '' }}" href="{{ url('/template') }}">
                                    <i class="fa fa-file-text"></i> Templates
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('statistics*') ? 'active' : '' }}" href="{{ route('statistics') }}">
                                    <i class="fa fa-bar-chart"></i> Statistics
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="user-avatar">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/smtp-configure') }}">
                                            <i class="fa fa-cog"></i> SMTP Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/company-info') }}">
                                            <i class="fa fa-building"></i> Company Info
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/extra-mail-field') }}">
                                            <i class="fa fa-plus-square"></i> Extra Fields
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fa fa-sign-out"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4 content-wrapper">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    @yield('customscripts')
</body>
</html>


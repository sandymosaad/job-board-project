<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
        .alert {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        } */

        .card-img-side {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
            float: left;
            position: absolute;
            top: 10px;
            right: 10px;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
            background: #fafafa;
        }

        .card-title {
            font-family: 'Lora', serif;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .card-subtitle {
            font-family: 'Roboto', sans-serif;
            font-size: 1.1rem;
            color: #666;
            font-style: italic;
        }

        .card-text {
            font-family: 'Roboto', sans-serif;
            font-size: 0.9rem;
            color: #333;
        }

        .card-footer {
            padding: 10px 20px;
            background: #f1f1f1;
            border-top: 1px solid #ddd;
            font-family: 'Roboto', sans-serif;
            font-size: 0.8rem;
            color: #777;
        }

        .form-background {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            font-family: 'Roboto', sans-serif;
        }

        .form-background label {
            font-family: 'Lora', serif;
            font-weight: bold;
        }

        .form-background .form-control {
            font-family: 'Roboto', sans-serif;
        }

        .form-background .form-check-label {
            font-family: 'Lora', serif;
        }

        .form-background .alert {
            font-family: 'Roboto', sans-serif;
        }

        .form-background button {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">Xcompany</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                            @if (Auth::user()->type === 'admin')
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.pending-posts') }}">Pending Posts</a></li>
                                
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.usermanagement') }}">User Management</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" href="/home">Statistics</a></li> -->
                         
                            @endif
                            @if (Auth::user()->type === 'employer')
                            <li class="nav-item">
                                <a class="nav-link" href="/posts/create">Create Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('posts.index', ['status' => 'approved']) }}">Approved
                                    Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('posts.index', ['status' => 'pending']) }}">Pending Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('posts.index', ['status' => 'rejected']) }}">Rejected
                                    Posts </a>
                            </li>
    
                            @endif
                            @if (Auth::user()->type === 'candidate')
  

                                <li class="nav-item"><a class="nav-link" href="{{route('profile.index')}}">Profile</a></li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            <li class="nav-item">
                                <form class="d-flex" method="post" action="{{ route('posts.search') }}">
                                    @csrf
                                    <input class="form-control me-2" type="search" placeholder="Search" name="search" value="{{ request('search') }}">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('sub-navbar')

        <main class="py-4">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @yield('main')
            @yield('content')
        </main>
    </div>
</body>

</html>

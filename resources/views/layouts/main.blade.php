<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




    <!-- Styles -->

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">My App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item active">
                            <a class="nav-link  btn-outline-success" href='/'>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  btn-outline-success" href='/contact'>Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  btn-outline-success" href='/products'>Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  btn-outline-success" href='/products/create'>Product add</a>
                        </li>

                        <li class="nav-item">
                            <form action='/logout' method="POST">
                                @csrf
                                <a href="/logout" class='nav-link'
                                    onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link  btn-outline-success" href='/sell'>Sell</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  btn-outline-success" href='/login'>Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  btn-outline-success" href='/register'>Register</a>
                        </li>
                    @endguest
                </ul>
                <form class="form-inline my-2 my-lg-0 mr-3">
                    <input class="form-control mr-sm-3" type="search" placeholder="Search" aria-label="Search">
                </form>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                    class="badge text-bg-danger">{{ count((array) session('cart')) }}</span>
            </div>
        </nav>

    </header>

    @yield('content')
    <footer class="fixed-bottom bg-dark text-light text-center">
        Footer 2024
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>

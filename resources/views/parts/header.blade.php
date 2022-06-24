<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item mx-2">
            <a id="login" class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item mx-2">
            <a id="register" class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
        @endguest
        @auth
        <li class="nav-item dropdown me-5">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <span class="dropdown-item"><input class="logout-button" type="submit" value="Logout"></span>
                    </form>
                </li>
            </ul>
        </li>
        @endauth
    </ul>
</nav>
<!-- /.navbar -->
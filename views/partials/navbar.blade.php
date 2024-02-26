<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <i class="bi bi-camera"></i>Gallery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'link-danger' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/notif">Notification</a>
                    </li>
                @endauth
                <li class="nav-item dropdown">
                    @auth
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard*') ? 'link-danger' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile | Create
                        </a>
                    @else
                        <a class="nav-link dropdown-toggle {{ Request::is('login') || Request::is('register') ? 'link-danger' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login Or Signup
                        </a>
                    @endauth
                    <ul class="dropdown-menu">

                        @auth
                            <li><a class="dropdown-item" href="#"> {{ auth()->user()->nama_lengkap }} </a></li>
                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="/login">Login</a></li>
                            <li><a class="dropdown-item" href="/register">Sign In</a></li>
                        @endauth
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Gallery | @yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="stylesheet" href="{{ asset('icon/css/fontawesome.min.css') }}">

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">




</head>

<body>


    <header data-bs-theme="dark">
        @include('partials.navbar')
    </header>

    <main>

        <section class="mt-5" id="dashboard">
            <div class="sidebar bg-dark">
                <div class="sidebar-nav">
                    <a href="/dashboard" class="{{ Request::is('dashboard') ? 'link-danger' : '' }}">Dashboard</a>
                    <a href="/dashboard/album" class="{{ Request::is('*album*') ? 'link-danger' : '' }}">Album</a>
                    <a href="/dashboard/foto" class="{{ Request::is('*foto*') ? 'link-danger' : '' }}">Photos</a>
                </div>
            </div>
            <div class="album py-5 " id="album">


                <div class="content ">

                    @yield('content')



                </div>

            </div>

        </section>



    </main>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="/js/dashboard.js"></script>
    <script src="{{ asset('icon/js/all.min.js') }}"></script>

</body>

</html>

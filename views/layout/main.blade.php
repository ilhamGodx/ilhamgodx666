<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Album example · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">

    <link rel="stylesheet" href="{{ asset('icon/css/fontawesome.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="/css/style.css">



    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


</head>

<body>


    <header data-bs-theme="dark">
        @include('partials.navbar')
    </header>
    @if (Request::is('login') || Request::is('register') || Request::is('notif'))
        <section class="py-3 text-center container">
            <div class="row py-lg-5">

            </div>
        </section>
    @else
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h2 class="text-center mb-3">{{ $title }}</h2>
                    <form action="/posts" method="get" class="d-flex" role="search">
                        @if (request('author'))
                            <input type="hidden" name="author" value="{{ request('author') }}">
                        @endif
                        <input class="form-control me-2 border-1 border-black " name="search" type="search"
                            placeholder="Search" value="{{ request('search') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                </div>
            </div>
        </section>
    @endif

    <main>


        <div class="album py-2 bg-body-tertiary">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">

                    @yield('content')


                </div>
            </div>
        </div>

    </main>
    @if (Request::is('register') || Request::is('login') || Request::is('notif'))
    @else
        @include('partials.footer')
    @endif

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('icon/js/all.min.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ultra&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-primary-nav sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('assets/img/avatar/icon-logo.png') }}" style="size: 30px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item {{ Request::is('landing') ? 'active' : '' }} mr-4">
                        <a class="nav-link" href="{{ url('/landing') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::is('wisata') ? 'active' : '' }} mr-4">
                        <a class="nav-link" href="{{ url('/wisata') }}">Wisata</a>
                    </li>
                    <li class="nav-item {{ Request::is('contact-us') ? 'active' : '' }} mr-4">
                        <a class="nav-link" href="{{ url('/contact-us') }}">Contact Us</a>
                    </li>
                    <li class="nav-item {{ Request::is('about-us') ? 'active' : '' }} mr-4">
                        <a class="nav-link" href="{{ url('/landing') }}#about-section">About Us</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto navbar-button">
                    @if (!auth()->user())
                        <li class="nav-item">
                            <a class="px-4 py-1 btn mr-2 btn-login" href="/log-in">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="px-4 py-1 btn btn-regis" href="/register">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user text-primary authVerifikasi">
                                @if (Auth::user()->profile && Auth::user()->profile->foto != '')
                                    <img alt="image" src="{{ Storage::url(Auth::user()->profile->foto) }}"
                                        class="rounded-circle mr-1" style="width: 35px; height: 35px;">
                                @else
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                        class="rounded-circle mr-1" style="width: 35px; height: 35px;">
                                @endif
                                <div class="d-sm-none d-lg-inline-block" style="color: #070D59">
                                    Hai, {{ auth()->user()->name }}
                                </div>
                            </a>
                            <hr class="hr-navbar" style="display: none;">
                            <div class="dropdown-menu dropdown-menu-right">
                                @if (Auth::user()->hasRole('user'))
                                    <a href="/profile-user" class="dropdown-item has-icon">
                                        <i class="far fa-user mx-1 mr-2"></i> Profile
                                    </a>
                                @endif
                                @if (Auth::user()->hasRole('super-admin'))
                                    <a href="/profile-user" class="dropdown-item has-icon">
                                        <i class="far fa-user mx-1 mr-2"></i> Profile
                                    </a>
                                @endif
                                @if (auth()->user()->hasRole('user'))
                                    <a href="/transaksi-user" class="dropdown-item has-icon">
                                        <i class="fas fa-exchange-alt mx-1 mr-2"></i> Transaksi
                                    </a>
                                    <a href="/reservasi-user" class="dropdown-item has-icon">
                                        <i class="far fa-calendar-check mx-1 mr-2"></i> Status Reservasi
                                    </a>
                                @endif
                                <hr class="my-0" style="background-color: rgba(249, 249, 249, 0.2);">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt mx-1 mr-2"></i> Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <section>
        <footer class="myfooter text-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <a href="#" class="footer-site-logo d-block mb-4"><img src="{{ asset('assets/img/avatar/foot-logo.png') }}" class="img-fluid"></a>
                        <p class="footer-text">Kami adalah platform inovatif yang <br> menyediakan informasi destinasi wisata yang <br> berada di Desa Wringinsongo.</p>
                    </div>
    
                    <div class="col-md-6">
                        <h5 class="kontak-km">Kontak Kami</h5>
                        <ul class="list-unstyled contact-list">
                            <li><a href="#" class="foot1 text-white">wringinsongo.tumpang@malangkab.go.id</a></li>
                            <li><a href="#" class="foot2 text-white">Jl. Glanggang Raya, Sumberringin, Wringinsongo, Kec. Tumpang, Kabupaten Malang</a></li>
                            <li><a href="#" class="foot3 text-white">kode pos : 65156</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    



    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/assets/js/page/modules-sweetalert.js"></script>

    <script src="/assets/js/stisla.js"></script>

    <!-- Template JS Files -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="asset('assets/js/tooltip.js')"></script>

    <script>
        // Inisialisasi dropdown
        $(document).ready(function() {
            RegisterCapcha();
        });

        function Dropdown() {
            $('.dropdown-toggle').dropdown();

            // Additional styling using script
            $('.dropdown-username').css('font-weight', 'bold');
            $('.dropdown-menu .dropdown-item').hover(function() {
                $(this).css('background-color', '#f8f9fa').css('color', '#007bff');
            }, function() {
                $(this).css('background-color', '').css('color', '');
            });
        }
    </script>
    {{-- @stack('customScript') --}}
</body>

</html>

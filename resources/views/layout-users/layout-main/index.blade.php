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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
                    <li class="nav-item {{ Request::is('landing') ? 'active' : '' }}">
                        <a class="nav-link link-navbar" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item {{ Request::is('wisata') ? 'active' : '' }}">
                        <a class="nav-link link-navbar" href="{{ url('/wisata') }}">Wisata</a>
                    </li>
                    <li class="nav-item {{ Request::is('contact-us') ? 'active' : '' }}">
                        <a class="nav-link link-navbar" href="{{ url('/contact-us') }}">Contact Us</a>
                    </li>
                    <li class="nav-item {{ Request::is('about-us') ? 'active' : '' }}">
                        <a class="nav-link link-navbar" href="{{ url('/') }}#about-section">About Us</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto navbar-button">
                    @if (!auth()->user())
                        <li class="nav-item nav-prof">
                            <a class="px-4 py-1 btn mr-2 btn-login" href="/log-in">Login</a>
                        </li>
                        <li class="nav-item nav-prof">
                            <a class="px-4 py-1 btn btn-regis" href="/register">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle nav-link-lg nav-link-user authVerifikasi"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (auth()->check() && auth()->user()->profile && auth()->user()->profile->profile_image)
                                    <img src="{{ Storage::url(auth()->user()->profile->profile_image) }}"
                                        style="width: 35px; height: 35px;" class="rounded-circle mr-1">
                                @else
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                        class="rounded-circle mr-1" style="width: 35px; height: 35px;">
                                @endif
                                <div class="d-sm-none d-lg-inline-block nav-prof" style="color: #000000">
                                    Hai,
                                    {{ strlen(auth()->user()->name) > 6 ? ucfirst(strtolower(substr(auth()->user()->name, 0, 6))) . '..' : ucfirst(strtolower(auth()->user()->name)) }}
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @if (Auth::user()->hasRole('user'))
                                    <a href="/profile-user" class="dropdown-item has-icon nav-prof">
                                        <i class="far fa-user mx-1 mr-2"></i> Profile
                                    </a>
                                @endif
                                @if (Auth::user()->hasRole('super-admin'))
                                    <a href="/profile-user" class="dropdown-item has-icon nav-prof">
                                        <i class="far fa-user mx-1 mr-2"></i> Profile
                                    </a>
                                @endif
                                @if (auth()->user()->hasRole('user'))
                                    <a href="/transaksi-user" class="dropdown-item has-icon nav-prof">
                                        <i class="fas fa-exchange-alt mx-1 mr-2"></i> Transaksi
                                    </a>
                                    <a href="/reservasi-user" class="dropdown-item has-icon nav-prof">
                                        <i class="far fa-calendar-check mx-1 mr-2"></i> Status Reservasi
                                    </a>
                                @endif
                                <hr class="my-0" style="background-color: rgba(249, 249, 249, 0.2);">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="dropdown-item has-icon text-danger nav-prof">
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
                    <div class="col-md-3">
                        <a href="#" class="footer-site-logo d-block mb-4"><img
                                src="{{ asset('assets/img/avatar/foot-logo.png') }}" class="img-fluid"></a>
                        <p class="footer-text">Kami adalah platform inovatif yang menyediakan informasi destinasi
                            wisata yang berada di Desa Wringinsongo.</p>
                    </div>

                    <div class="col-md-4">
                        <h5 class="kontak-km">Kontak Kami</h5>
                        <ul class="list-unstyled contact-list">
                            <li><a href="#" class="foot1 text-white">wringinsongo.tumpang@malangkab.go.id</a>
                            </li>
                            <li><a href="#" class="foot2 text-white">Jl. Glanggang Raya, Sumberingin,
                                    Wringinsongo, Kecamatan Tumpang, Kabupaten Malang</a></li>
                            <li><a href="#" class="foot3 text-white">kode pos : 65156</a></li>
                        </ul>
                    </div>
                    <div class="col-md-5 foot-mapland">
                        <iframe style="line-height: 1px; height: 100%; width: 100%;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7899.560742001325!2d112.74192151372598!3d-7.9941460594679565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62f6242f74193%3A0xec28cbb1957c0d90!2sWringinsongo%2C%20Tumpang%2C%20Malang%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1711298927487!5m2!1sen!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </footer>
    </section>


    @stack('customScript')
    <!-- General JS Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>

    <!-- JS Libraies -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/assets/js/page/modules-sweetalert.js"></script>

    <!-- Template JS Files -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="asset('assets/js/tooltip.js')"></script>

    <script>
        // Inisialisasi dropdown
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <script>
        AOS.init();
    </script>
</body>

</html>

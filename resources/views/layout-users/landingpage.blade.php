@extends('layout-users.layout-main.index')
@section('content')

    <style>
        .deskripsi-wrg {
            background-image: url('{{ asset('assets/img/avatar/pemancingan.png') }}');
            background-size: cover;
        }

        .land-map {
            max-width: 100%;
            border: 0;
            margin-top: 16px;
            height: 208px;
        }
    </style>

    <section class="mb-2">
        <div id="carouselExampleDark" class="carousel carousel-dark slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{ asset('assets/img/avatar/dummy1.png') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="tittle-carausel">Wringinsongo</h1>
                        <p class="p-carausel">Desa Wringinsongo: Meretas Jejak Alam yang Memikat, Menyambut Petualangan
                            Tak Terlupakan.</p>
                        <a href="{{ url('/') }}#list-wisata" class="btn btn-corrousell">Lihat Selengkapnya</a>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('assets/img/avatar/dummy5.png') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="tittle-carausel">Wringinsongo</h1>
                        <p class="p-carausel">Di Tengah Hijauan Alam, Desa Wringinsongo Menawarkan Keunikan Wisata yang
                            Mengasyikkan.</p>
                        <a href="{{ url('/') }}#list-wisata" class="btn btn-corrousell">Lihat Selengkapnya</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/avatar/dummy4.png') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="tittle-carausel">Wringinsongo</h1>
                        <p class="p-carausel">Jelajahi Pesona Alam yang Mempesona: Desa Wringinsongo, Destinasi
                            Tersembunyi yang Mengagumkan.</p>
                        <a href="{{ url('/') }}#list-wisata" class="btn btn-corrousell">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section data-aos="fade-up" class="mb-3">
        <div class="py-5" style="height: 100%;">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-md-10 mx-auto">
                        <h3 class="text-center title-choose" style="color: #000000;">WHY CHOOSE US
                        </h3>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-md-3">
                        <div class="card border-primary mb-2 card-wringinsongo-view-mobile">
                            <div class="card-body text-center">
                                <i class="fas fa-info-circle text-primary fa-3x mb-4"></i>
                                <h5 class="card-title title-ct d-block mx-2">INFORMASI LENGKAP</h5>
                                <p class="card-text text-center">
                                    Menyajikan platform yang memiliki informasi yang lengkap mengenai destinasi wisata.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-primary mb-2 card-wringinsongo-view-mobile">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary fa-3x mb-4"></i>
                                <h5 class="card-title title-ct d-block mx-2">LOKASI WISATA</h5>
                                <p class="card-text text-center">
                                    Menyertakan Lokasi Wisata yang mempermudah wisatawan yang ingin berkunjung.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-primary mb-2 card-wringinsongo-view-mobile">
                            <div class="card-body text-center">
                                <i class="fas fa-lightbulb text-primary fa-3x mb-4"></i>
                                <h5 class="card-title title-ct d-block mx-2">PENGALAMAN BARU</h5>
                                <p class="card-text text-center">
                                    Memberikan pengalaman baru bagi wisatawan dengan menambahkan fitur virtual tour.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-primary mb-2 card-wringinsongo-view-mobile">
                            <div class="card-body text-center">
                                <i class="fas fa-brain text-primary fa-3x mb-4"></i>
                                <h5 class="card-title title-ct d-block mx-2">INOVATIF</h5>
                                <p class="card-text text-center">
                                    Menyajikan platfom inovatif dalam mempromosikan destinasi wisata desa Wringinsongo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about-section" class="bg-about" data-aos="fade-up">
        <div class="container py-5">
            <h1 class="titl-about">ABOUT US</h1>
            <div class="row h-200 justify-content-center">
                <div class="col-md-3 d-flex justify-content-center align-items-center mb-2">
                    <div class="img-container equal-height-img">
                        <img src="{{ asset('assets/img/avatar/kolam.jpg') }}" alt="Gambar 1">
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="img-container hero-height position-relative mb-2">
                        <img src="{{ asset('assets/img/avatar/right.png') }}" alt="Gambar 2">
                        {{-- <a href="#" class="play-btn" data-toggle="modal" data-target="#videoModal">
                            <button class="btn btn-play" data-bs-toggle="modal" data-bs-target="#videoModal">
                                <i class="fas fa-play-circle fa-3x"></i>
                            </button>
                        </a> --}}
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center align-items-center mb-2">
                    <div class="img-container equal-height-img">
                        <img src="{{ asset('assets/img/avatar/candi.jpg') }}" alt="Gambar 3">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="description-abt">
                        <div class="col-md-12 d-flex justify-content-center align-items-center deskripsi-wrg">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-fluid img-about-desc"
                                        src="{{ asset('assets/img/avatar/balai.png') }}" alt="Trulli">
                                </div>
                                <div class="col-md-9">
                                    <h1 class="about-h">DESA WRINGINSONGO</h1>
                                    <p class="about-p">Desa Wringinsongo, terletak di Kecamatan Tumpang, Kabupaten
                                        Malang,
                                        adalah sebuah surga tersembunyi dengan potensi wisata menjanjikan. Keasrian
                                        alamnya
                                        menyajikan pemandian alami yang jernih, dikelilingi pepohonan rindang,
                                        menciptakan
                                        suasana yang menyejukkan dan damai. Lebih dari sekedar keindahan alam, desa ini
                                        juga
                                        menawarkan kekayaan kuliner, dengan sajian lezat dari produk lokal. Destinasi
                                        ini tidak
                                        hanya meningkatkan kesejahteraan ekonomi lokal, tetapi juga memperkuat komunitas
                                        dan
                                        melestarikan budaya. Ayo, jelajahi dan nikmati Desa Wringinsongo, tempat dimana
                                        pemandangan indah dan pengalaman memperkaya jiwa berpadu sempurna.</p>
                                </div>
                                {{-- <div class="col-md-4">
                                        <iframe class="land-map"
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11575.18917064869!2d112.73856472969604!3d-7.99359457883066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62f6242f74193%3A0xec28cbb1957c0d90!2sWringinsongo%2C%20Kec.%20Tumpang%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1710736935981!5m2!1sid!2sid"
                                            frameborder="0" allowfullscreen="" aria-hidden="false"
                                            tabindex="0"></iframe>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="about-p">Desa Wringinsongo, terletak di Kecamatan Tumpang, Kabupaten
                                            Malang,
                                            adalah sebuah surga tersembunyi dengan potensi wisata menjanjikan. Keasrian
                                            alamnya
                                            menyajikan pemandian alami yang jernih, dikelilingi pepohonan rindang,
                                            menciptakan
                                            suasana yang menyejukkan dan damai. Lebih dari sekedar keindahan alam, desa ini
                                            juga
                                            menawarkan kekayaan kuliner, dengan sajian lezat dari produk lokal. Destinasi
                                            ini tidak
                                            hanya meningkatkan kesejahteraan ekonomi lokal, tetapi juga memperkuat komunitas
                                            dan
                                            melestarikan budaya. Ayo, jelajahi dan nikmati Desa Wringinsongo, tempat dimana
                                            pemandangan indah dan pengalaman memperkaya jiwa berpadu sempurna.</p>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal Video -->
    {{-- <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel">Video Tour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ratio ratio-16x9">
                            <iframe id="youtubeVideo" class="embed-responsive-item"
                                src="https://www.youtube.com/embed/E6z5MQUGO2g?start=18&end=240&autoplay=1" allowfullscreen
                                allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    <!-- Akhir Video -->

    <section id="list-wisata" data-aos="fade-up" class="mt-3">
        <div class="container">
            <h3 class="text-center title-land-wis">REKOMENDASI DESTINASI WISATA</h3>
            <div class="row mb-4">
                @if (isset($tours))
                    <div class="row">
                        @foreach ($tours as $tour)
                            <div class="col-md-3">
                                <a href="{{ url('/detail-wisata/' . $tour->id) }}">
                                    <div class="card-lswisata mb-4">
                                        <img src="{{ asset('storage/' . $tour->profile_tour) }}" class="img-fluid"
                                            alt="Wisata Image">
                                        <div class="wisata-infox">
                                            <h5 class="land-wisata-tiitle">{{ strtoupper($tour->name) }}</h5>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center">{{ $message }}</p>
                @endif
            </div>
        </div>
    </section>

    <script>
        const mapFrame = document.getElementById('map');
        mapFrame.addEventListener('load', () => {
            mapFrame.contentDocument.addEventListener('click', () => {

                mapFrame.contentWindow.postMessage('{"event":"command","func":"setZoom","args":22}', '*');
            });
        });
    </script>
@endsection

@extends('layout-users.layout-main.index')
@section('content')
    <style>
        .custom-bg {
            background-image: url('{{ asset('assets/img/avatar/bg-lan.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 670px;
        }
    </style>
    <section>
        <section class="custom-bg">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-8 col-sm-12">
                        <h1 class="welcome-title">Selamat Datang di </br><span class="wringin">Wringin</span><span
                                class="songo">songo</span></h1>
                        <p class="welcome-fill">Tempat Wisata Tersembunyi yang Penuh Keindahan dan Keasrian Alam.</p>
                        <form action="/search" method="GET" class="search-form text-center">
                            <div class="input-group mb-3 justify-content-center">
                                <input type="text" class="form-control land" placeholder="Cari destinasi wisata..."
                                    name="search" style="max-width: 60%;">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="py-5" style="height: 100%;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <h3 class="text-center mt-4 font-weight-bold" style="color: #000000;">Kenapa harus Desa <span
                                    class="wringin2">Wringin</span><span class="songo2">songo</span>
                            </h3>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-md-3">
                            <div class="card border-primary mb-2 card-wringinsongo-view-mobile">
                                <div class="card-body text-center">
                                    <i class="fas fa-info-circle text-primary fa-3x mb-4"></i>
                                    <h5 class="card-title font-weight-bold d-block mx-2">Informasi Lengkap</h5>
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
                                    <h5 class="card-title font-weight-bold d-block mx-2">Lokasi Wisata</h5>
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
                                    <h5 class="card-title font-weight-bold d-block mx-2">Pengalaman Baru</h5>
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
                                    <h5 class="card-title font-weight-bold d-block mx-2">Inovatif</h5>
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

        <section id="about-section" class="bg-about">
            <div class="container py-5">
                <div class="row align-items">
                    <div class="col-lg-5 col-md-4 col-sm-12">
                        <img class="img-fluid landing" src="{{ asset('assets/img/avatar/balai.png') }}" alt="Trulli">
                    </div>
                    <div class="col-lg-7 col-md-8 col-sm-12">
                        <h1 class="about-h">Desa Wringinsongo</h1>
                        <p class="about-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit
                            rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna
                            vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis
                            justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed
                            tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor
                            finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu
                            nisi auctor finibus. Sed tristique urna vel malesuada fringilla.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="land-wisata">
            <div class="container">
                <h3 class="text-center mt-4 font-weight-bold title-land-wis" style=" ">Rekomendasi Destinasi Wisata <span
                        class="wringin3">Wringin</span><span class="songo3">songo</span>
                </h3>
                <div class="row">
                    <div class="col-md-3 mx-auto">
                        <div class="card-wisata">
                            <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid" alt="Wisata Image">
                            <div class="wisata-info">
                                <h2 class="wisata-title">Nama Wisata</h2>
                                <p class="wisata-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                    quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor
                                    finibus.</p>
                                <a href="#" class="btn btn-detailwisata">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mx-auto">
                        <div class="card-wisata">
                            <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid" alt="Wisata Image">
                            <div class="wisata-info">
                                <h2 class="wisata-title">Nama Wisata</h2>
                                <p class="wisata-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                    quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor
                                    finibus.</p>
                                <a href="#" class="btn btn-detailwisata">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mx-auto">
                        <div class="card-wisata">
                            <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid" alt="Wisata Image">
                            <div class="wisata-info">
                                <h2 class="wisata-title">Nama Wisata</h2>
                                <p class="wisata-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
                                    quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor
                                    finibus.</p>
                                <a href="#" class="btn btn-detailwisata">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </section>
@endsection

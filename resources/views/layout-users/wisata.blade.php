@extends('layout-users.layout-main.index')
@section('content')
<section class="search">
    <div class="container">
        <div class="card-search-wisata">
            <div class="card-body">
                <h1 class="title-wisata">Cari wisata sesuai kebutuhanmu</h1>
                <div class="search-column">
                    <form action="#" class="search-form" method="GET">
                        <div class="search-input-container">
                            <div class="search-icon">
                                <i class="material-icons">cast_for_education</i>
                            </div>
                            <input type="text" name="wisata" placeholder="Cari destinasi wisata" class="search-input">
                            <button type="submit" class="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="list-wisata">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card-wisata">
                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid" alt="Wisata Image">
                    <div class="wisata-info">
                        <h2 class="wisata-title">Nama Wisata</h2>
                        <p class="wisata-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies.</p>
                        <a href="#" class="btn btn-detailwisata">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mx-auto">
                <div class="card-wisata">
                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid" alt="Wisata Image">
                    <div class="wisata-info">
                        <h2 class="wisata-title">Nama Wisata</h2>
                        <p class="wisata-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies.</p>
                        <a href="#" class="btn btn-detailwisata">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card-wisata">
                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid" alt="Wisata Image">
                    <div class="wisata-info">
                        <h2 class="wisata-title">Nama Wisata</h2>
                        <p class="wisata-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies.</p>
                        <a href="#" class="btn btn-detailwisata">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mx-auto">
                <div class="card-wisata">
                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid" alt="Wisata Image">
                    <div class="wisata-info">
                        <h2 class="wisata-title">Nama Wisata</h2>
                        <p class="wisata-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies. Suspendisse potenti. Sed non sem eu nisi auctor finibus. Sed tristique urna vel malesuada fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis justo a elit rhoncus ultricies.</p>
                        <a href="#" class="btn btn-detailwisata">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@extends('layout-users.layout-main.index')

@section('content')
    <style>
        .card-title {
            text-align: center;
        }

        .checked {
            color: orange;
        }

        .detwis-desk {
            text-align: justify;
            margin-right: 15px;
        }

        .btn-res-tick {
            background-color: #265073 !important;
            color: #ffffff;
            border: none;
            border-radius: 15px;
        }

        .btn-mapsl {
            background-color: #265073 !important;
            color: #ffffff;
            border: none;
            border-radius: 15px;
        }

        .btn-mapsl:hover,
        .btn-mapsl:active {
            background-color: #1F3C88 !important;
            color: #ffffff !important;
            border-radius: 15px;
        }

        .btn-res-tick:hover,
        .btn-res-tick:active {
            background-color: #1F3C88 !important;
            color: #ffffff !important;
            border-radius: 15px;
        }

        .img-hover-container {
            position: relative;
            overflow: hidden;
        }

        .icon-virtual-tour {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            color: #ffffff;
            background-color: #00000050;
            border-radius: 50%;
            padding: 10px;
            box-sizing: content-box;
            transition: transform 0.3s ease, background-color 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-virtual-tour:hover {
            background-color: #0000009d;
        }

        .img-hover-container:hover .icon-virtual-tour {
            transform: translate(-50%, -50%) scale(1);
        }

        .img-hover-zoom {
            transition: transform 0.3s ease, filter 0.3s ease;
            height: 400px;
            width: 100%;
            border-radius: 20px;
            padding: 15px;
            object-fit: cover;
        }

        .img-hover-zoom:hover {
            transform: scale(1.03);
            filter: brightness(95%);
        }

        .link-wisata {
            color: #265073;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
            position: relative;
            display: inline-block;
        }

        .link-wisata::after {
            content: '';
            display: block;
            margin-top: 2px;
            width: 0;
            height: 2px;
            background-color: #EE6F57;
            transition: width 0.3s ease-in-out;
        }

        .link-wisata:hover::after {
            width: 100%;
        }

        .carousel-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border: 2px solid #00000017;
        }

        .card-title-underline {
            border-bottom: 2px solid #265073;
            width: 100%;
            margin: 0 auto;
            margin-top: -10px;
        }

        .facility-card {
            position: relative;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #265073;
            transition: transform 0.3s ease;
            transform-origin: top;
            transform: scaleY(0);
            z-index: 0;
        }

        .facility-card:hover .overlay {
            transform: scaleY(1);
        }

        .facility-card .card-title,
        .facility-card .card-text,
        .facility-card i.material-icons {
            position: relative;
            z-index: 1;
            color: inherit;
        }

        .facility-card:hover .card-title,
        .facility-card:hover .card-text,
        .facility-card:hover i.material-icons {
            color: white;
        }
    </style>
    <div class="container py-5">
        <p class="links-wisata"><a href="/wisata" class="link-wisata">WISATA </a> / DETAIL WISATA</p>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-5 img-hover-container">
                            <img src="{{ Storage::url($tour->profile_tour) }}" class="card-img img-hover-zoom"
                                alt="Detail Wisata">
                            <a href="#" class="icon-virtual-tour">
                                <span class="material-icons">360</span>
                            </a>
                            <div class="text-center mb-2" data-aos="fade-down">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <div class="text-center mb-3">
                                <a href="{{ $tour->maps }}" class="btn btn-mapsl" target="_blank">Maps Lokasi</a>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h2 class="card-title mt-2 mb-3 text-center dw-tittle" data-aos="fade-right">{{ strtoupper($tour->name) }}</h2>
                                <p class="detwis-desk mb-2">{!! $tour->description !!}</p>
                                <div class="row">
                                    @if ($tour->type === 'wisata bertiket')
                                        <div class="col-md-6 order-md-last">
                                            <p class="mb-2">Harga Tiket:
                                                {{ $tour->harga_tiket ? 'Rp.' . number_format($tour->harga_tiket, 0, ',', '.') : 'Rp. -' }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-sm mb-4">
                                                <button class="btn btn-secondary" type="button" id="btnMinus">-</button>
                                                <input type="text" class="form-control text-center" id="ticketCount"
                                                    value="1" style="max-width: 50px;">
                                                <button class="btn btn-secondary" type="button" id="btnPlus">+</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if ($tour->type === 'wisata bertiket')
                                    <div class="text-center mb-2">
                                        <button type="button" class="btn btn-res-tick">Reservasi Tiket</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div id="carouselExampleControls" class="carousel slide mt-4" data-bs-ride="carousel" data-aos="slide-up">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset('assets/img/avatar/dummy1.jpg') }}" class="d-block w-100"
                                        alt="Gambar 1">
                                </div>
                                <div class="col">
                                    <img src="{{ asset('assets/img/avatar/dummy2.jpg') }}" class="d-block w-100"
                                        alt="Gambar 2">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset('assets/img/avatar/dummy3.jpg') }}" class="d-block w-100"
                                        alt="Gambar 3">
                                </div>
                                <div class="col">
                                    <img src="{{ asset('assets/img/avatar/dummy4.jpg') }}" class="d-block w-100"
                                        alt="Gambar 4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <div class="row justify-content-center mt-4 mb-3" data-aos="fade-up">
                    @if ($tour->history)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-1 mb-4 text-center dw-sj-tittle">SEJARAH</h4>
                                    <div class="card-title-underline mb-3"></div>
                                    <p class="card-text text-justify px-3 mb-3">{!! $tour->history !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


                <div class="row justify-content-center" data-aos="fade-up">
                    <div class="col-md-4 mb-1">
                        <div class="card facility-card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2 dw-fas-tittle">FASILITAS TOILET</h5>
                                <i class="material-icons mb-2" style="font-size: 35px">wc</i>
                                <p class="card-text">{{ $tour->fasilitas_km }}</p>
                            </div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div class="card facility-card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2 dw-fas-tittle">FASILITAS TEMPAT MAKAN</h5>
                                <i class="material-icons mb-2" style="font-size: 35px">restaurant</i>
                                <p class="card-text">{{ $tour->fasilitas_tm }}</p>
                            </div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-1">
                        <div class="card facility-card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2 dw-fas-tittle">FASILITAS TEMPAT IBADAH</h5>
                                <i class="material-icons mb-2" style="font-size: 35px">location_city</i>
                                <p class="card-text">{{ $tour->fasilitas_ti }}</p>
                            </div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-4 mb-3" data-aos="fade-up">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <button class="btn btn-control-prev" type="button"
                                        data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <h4 class="card-title m-0">Testimoni</h4>
                                    <button class="btn btn-control-next" type="button"
                                        data-bs-target="#testimonialCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="card-title-underline mb-3"></div>
                                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="row justify-content-center mt-3">
                                                <div class="col-md-5">
                                                    <div class="card testimonial-card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">John Doe</h5>
                                                            <p class="card-text text-center">Lorem ipsum dolor sit amet,
                                                                consectetur adipiscing elit. Mauris vehicula nisi sed lorem
                                                                dapibus, sed rutrum odio tristique.</p>
                                                            <div class="text-center mt-3">
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card testimonial-card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Jane Smith</h5>
                                                            <p class="card-text text-center">Ut venenatis erat ac odio
                                                                sollicitudin, vitae mattis ipsum fermentum. Integer quis
                                                                arcu nec turpis ultricies commodo.</p>
                                                            <div class="text-center mt-3">
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- New Testimonial 1 -->
                                        <div class="carousel-item">
                                            <div class="row justify-content-center mt-3">
                                                <div class="col-md-5">
                                                    <div class="card testimonial-card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Alice Johnson</h5>
                                                            <p class="card-text text-center">Pellentesque habitant morbi
                                                                tristique senectus et netus et malesuada fames ac turpis
                                                                egestas. Vestibulum tortor quam.</p>
                                                            <div class="text-center mt-3">
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card testimonial-card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Michael Brown</h5>
                                                            <p class="card-text text-center">Donec eu libero sit amet quam
                                                                egestas semper. Aenean ultricies mi vitae est. Mauris
                                                                placerat eleifend leo.</p>
                                                            <div class="text-center mt-3">
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- New Testimonial 2 -->
                                        <div class="carousel-item">
                                            <div class="row justify-content-center mt-3">
                                                <div class="col-md-5">
                                                    <div class="card testimonial-card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Evelyn Walker</h5>
                                                            <p class="card-text text-center">Lorem ipsum dolor sit amet,
                                                                consectetur adipiscing elit. Vivamus lacinia odio vitae
                                                                vestibulum vestibulum.</p>
                                                            <div class="text-center mt-3">
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card testimonial-card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">David Clark</h5>
                                                            <p class="card-text text-center">Sed non quam. In vel mi sit
                                                                amet augue congue elementum. Morbi in ipsum sit amet pede
                                                                facilisis laoreet.</p>
                                                            <div class="text-center mt-3">
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnMinus = document.getElementById('btnMinus');
            const btnPlus = document.getElementById('btnPlus');
            const ticketCount = document.getElementById('ticketCount');

            btnMinus.addEventListener('click', function() {
                let count = parseInt(ticketCount.value);
                if (count > 1) {
                    ticketCount.value = count - 1;
                }
            });

            btnPlus.addEventListener('click', function() {
                let count = parseInt(ticketCount.value);
                ticketCount.value = count + 1;
            });
        });
    </script>
@endsection

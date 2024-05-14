@extends('layout-users.layout-main.index')
@section('title', 'Wringinsongo')
@section('content')
    <style>
        .carousel-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border: 2px solid #00000017;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #kurangTiket {
            margin-right: 0px;
        }

        #tambahTiket {
            margin-right: 140px;
        }

        @media (max-width: 768px) {

            .header-img-top {
                height: 300px;
                margin-top: -80px;
            }

            .d-flex {
                flex-direction: row;
                justify-content: space-between;
            }

            #jumlahTiket {
                margin: 0 10px;
            }
        }
    </style>
    <section>
        <div class="bg-default header-navb">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="d-flex justify-content-between">
                            <div class="col-md-9 d-flex justify-content-start">
                                <h2 class="head-tittle-dw pt-4" data-aos="fade-right">{{ strtoupper($tour->name) }}</h2>
                            </div>
                            <div class="col-md-3 d-flex justify-content-end">
                                <a href="{{ $tour->maps }}" class="btn maps-icn" target="_blank" data-aos="fade-left">
                                    <i class="fas fa-map-marker-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="image-container">
                <img src="{{ Storage::url($tour->profile_tour) }}" class="header-img-top mb-2" alt="Detail Wisata">
                <a href="{{ url('/virtual-tour/' . $tour->id) }}" class="icon-virtual-tour">
                    <span class="material-icons">360</span>
                </a>
            </div>
            <div class="text-center mb-1" data-aos="fade-down">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $averageRating)
                        <span class="fa fa-star checked"></span>
                    @elseif ($i - 0.5 == $averageRating)
                        <span class="fas fa-star-half-alt checked"></span>
                    @else
                        <span class="far fa-star"></span>
                    @endif
                @endfor
            </div>
        </div>
    </section>

    <section class="mt-3">
        <div class="container">
            @if ($tour->type !== 'wisata tidak bertiket')
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <form method="POST" action="{{ route('reservation.store', $tour->id) }}">
                                    @csrf
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-6 text-end">Harga Tiket:</div>
                                        <div class="col-6 text-start">
                                            {{ $tour->harga_tiket ? 'Rp.' . number_format($tour->harga_tiket, 0, ',', '.') : 'Rp. -' }}
                                            /orang</div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-6 text-end">Jumlah Tiket:</div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button class="btn btn-secondary" id="kurangTiket">-</button>
                                                <span id="jumlahTiket">1</span>
                                                <input type="hidden" name="jumlah_tiket" id="inputJumlahTiket"
                                                    value="1">
                                                <button class="btn btn-secondary" id="tambahTiket">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-6 text-end">
                                            <label for="tanggalKunjungan" class="form-label">Tanggal Kunjungan:</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="date" class="form-control" id="tanggalKunjungan"
                                                name="tanggal_kunjungan" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-12">
                                            @if (Auth::check())
                                                <button type="submit" class="btn reserv-tiket">Reservasi Tiket</button>
                                            @else
                                                <a href="{{ url('/log-in') }}" class="btn reserv-tiket">Reservasi Tiket</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="mb-5" data-aos="fade-up">
        <div class="container">
            <div class="row mt-3">
                <div class="col">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="deskripsi-tab" data-bs-toggle="tab"
                                data-bs-target="#deskripsi" type="button" role="tab" aria-controls="deskripsi"
                                aria-selected="true">DESKRIPSI</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sejarah-tab" data-bs-toggle="tab" data-bs-target="#sejarah"
                                type="button" role="tab" aria-controls="sejarah" aria-selected="false">SEJARAH</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="deskripsi" role="tabpanel"
                            aria-labelledby="deskripsi-tab">
                            <p>{!! $tour->description !!}</p>
                        </div>
                        <div class="tab-pane fade" id="sejarah" role="tabpanel" aria-labelledby="sejarah-tab">
                            <p>{!! $tour->history ? $tour->history : 'Tidak terdapat sejarah!' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide mt-4" data-bs-ride="carousel" data-aos="slide-up">
                <div class="carousel-inner">
                    @foreach ($tour->subimages->chunk(2) as $chunkIndex => $imageChunk)
                        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($imageChunk as $subimage)
                                    <div class="col-md-6">
                                        <img src="{{ Storage::url($subimage->subimages) }}" class="d-block w-100 mb-2"
                                            alt="...">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($tour->subimages->count() > 2)
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
                @endif
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-md-4 mb-1">
                    <div class="card facility-card">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-2 dw-fas-tittle">FASILITAS TOILET</h5>
                            <i class="material-icons mb-2" style="font-size: 30px">wc</i>
                            <p class="card-text">{{ $tour->fasilitas_km }}</p>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="card facility-card">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-2 dw-fas-tittle">FASILITAS TEMPAT MAKAN</h5>
                            <i class="material-icons mb-2" style="font-size: 30px">restaurant</i>
                            <p class="card-text">{{ $tour->fasilitas_tm }}</p>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </div>
                <div class="col-md-4 mb-1">
                    <div class="card facility-card">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-2 dw-fas-tittle">FASILITAS TEMPAT IBADAH</h5>
                            <i class="material-icons mb-2" style="font-size: 30px">location_city</i>
                            <p class="card-text">{{ $tour->fasilitas_ti }}</p>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="container">
            <h2 class="text-center mb-4 tesp-dw">TESTIMONI PENGUNJUNG</h2>
            <div id="testimoniList">
                @include('partials.testimonials', ['testimonials' => $testimonials])
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tambahBtn = document.getElementById('tambahTiket');
            const kurangBtn = document.getElementById('kurangTiket');
            const displayJumlahTiket = document.getElementById('jumlahTiket');
            const inputJumlahTiket = document.getElementById('inputJumlahTiket');

            tambahBtn.addEventListener('click', function() {
                let jumlah = parseInt(displayJumlahTiket.innerText);
                jumlah++;
                displayJumlahTiket.innerText = jumlah;
                inputJumlahTiket.value = jumlah;
            });

            kurangBtn.addEventListener('click', function() {
                let jumlah = parseInt(displayJumlahTiket.innerText);
                if (jumlah > 1) {
                    jumlah--;
                    displayJumlahTiket.innerText = jumlah;
                    inputJumlahTiket.value = jumlah;
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('#testimoniList .pagination a');
            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    fetchTestimonials(this.href);
                });
            });
        });

        function fetchTestimonials(url) {
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTestimonials = doc.querySelector('#testimoniList');
                    document.querySelector('#testimoniList').innerHTML = newTestimonials.innerHTML;
                    const newLinks = document.querySelectorAll('#testimoniList .pagination a');
                    newLinks.forEach(link => {
                        link.addEventListener('click', function(event) {
                            event.preventDefault();
                            fetchTestimonials(this.href);
                        });
                    });
                });
        }
    </script>
@endsection

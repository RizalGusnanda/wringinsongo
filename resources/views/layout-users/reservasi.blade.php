@extends('layout-users.layout-main.index')
@section('content')
    <main class="bg-light">
        <div class="col-md-6 mx-auto text-center ">
            <h1 class="font-weight-bold contact-header">Reservasi User</h1>
        </div>
        <section class="centered-section-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-10 col-sm-6">

                        <div class="bg-primary-section card py-1 card-profile1 mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-widget-description m-4">
                                        <h5
                                            class="card-title font-weight-bold d-block mx-2 profile-title-card1 text-center">
                                            Sortir</h5>
                                        <div class="sortir">
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str">Semua</button>
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str">Aktif</button>
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str">Selesai</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5
                                                class="card-title font-weight-bold d-block mx-2 profile-title-card4 text-center">
                                                Data Transaksi</h5>
                                        </div>
                                        <div class="card-body dt-res" data-aos="fade-right">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 d-flex justify-content-center">
                                                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid"
                                                        alt="Foto Tiket" style="max-width: 70%; height: auto;">
                                                </div>
                                                <div class="col-md-8 rs-ws">
                                                    <h5 class="card-title-res">Wisata Wringinsongo</h5>
                                                    <div class="row dt-ws">
                                                        <div class="col-8">
                                                            <p class="card-kod-res">
                                                                <i class="fas fa-id-card"></i> CV3J7K88
                                                            </p>
                                                            <p class="card-date-res">
                                                                <i class="far fa-calendar-alt"></i> 12 September 2024
                                                            </p>
                                                            <p class="card-tick-res">
                                                                <i class="fas fa-ticket-alt"></i> 5 tiket
                                                            </p>
                                                        </div>
                                                        <div class="col-4 text-right btn-test">
                                                            <a href="/testimoni" class="btn btn-testimoni">Testimoni</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body dt-res" data-aos="fade-right">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 d-flex justify-content-center">
                                                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid"
                                                        alt="Foto Tiket" style="max-width: 70%; height: auto;">
                                                </div>
                                                <div class="col-md-8 rs-ws">
                                                    <h5 class="card-title-res">Wisata Wringinsongo</h5>
                                                    <div class="row dt-ws">
                                                        <div class="col-8">
                                                            <p class="card-kod-res">
                                                                <i class="fas fa-id-card"></i> CV3J7K88
                                                            </p>
                                                            <p class="card-date-res">
                                                                <i class="far fa-calendar-alt"></i> 12 September 2024
                                                            </p>
                                                            <p class="card-tick-res">
                                                                <i class="fas fa-ticket-alt"></i> 5 tiket
                                                            </p>
                                                        </div>
                                                        <div class="col-4 text-right btn-test">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body dt-res" data-aos="fade-right">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 d-flex justify-content-center">
                                                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid"
                                                        alt="Foto Tiket" style="max-width: 70%; height: auto;">
                                                </div>
                                                <div class="col-md-8 rs-ws">
                                                    <h5 class="card-title-res">Wisata Wringinsongo</h5>
                                                    <div class="row dt-ws">
                                                        <div class="col-8">
                                                            <p class="card-kod-res">
                                                                <i class="fas fa-id-card"></i> CV3J7K88
                                                            </p>
                                                            <p class="card-date-res">
                                                                <i class="far fa-calendar-alt"></i> 12 September 2024
                                                            </p>
                                                            <p class="card-tick-res">
                                                                <i class="fas fa-ticket-alt"></i> 5 tiket
                                                            </p>
                                                        </div>
                                                        <div class="col-4 text-right btn-test">
                                                            <a href="/testimoni" class="btn btn-testimoni">Testimoni</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body dt-res" data-aos="fade-right">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 d-flex justify-content-center">
                                                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid"
                                                        alt="Foto Tiket" style="max-width: 70%; height: auto;">
                                                </div>
                                                <div class="col-md-8 rs-ws">
                                                    <h5 class="card-title-res">Wisata Wringinsongo</h5>
                                                    <div class="row dt-ws">
                                                        <div class="col-8">
                                                            <p class="card-kod-res">
                                                                <i class="fas fa-id-card"></i> CV3J7K88
                                                            </p>
                                                            <p class="card-date-res">
                                                                <i class="far fa-calendar-alt"></i> 12 September 2024
                                                            </p>
                                                            <p class="card-tick-res">
                                                                <i class="fas fa-ticket-alt"></i> 5 tiket
                                                            </p>
                                                        </div>
                                                        <div class="col-4 text-right btn-test">
                                                            <a href="/testimoni" class="btn btn-testimoni">Testimoni</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body dt-res" data-aos="fade-right">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 d-flex justify-content-center">
                                                    <img src="{{ asset('assets/img/avatar/balai.png') }}" class="img-fluid"
                                                        alt="Foto Tiket" style="max-width: 70%; height: auto;">
                                                </div>
                                                <div class="col-md-8 rs-ws">
                                                    <h5 class="card-title-res">Wisata Wringinsongo</h5>
                                                    <div class="row dt-ws">
                                                        <div class="col-8">
                                                            <p class="card-kod-res">
                                                                <i class="fas fa-id-card"></i> CV3J7K88
                                                            </p>
                                                            <p class="card-date-res">
                                                                <i class="far fa-calendar-alt"></i> 12 September 2024
                                                            </p>
                                                            <p class="card-tick-res">
                                                                <i class="fas fa-ticket-alt"></i> 5 tiket
                                                            </p>
                                                        </div>
                                                        <div class="col-4 text-right btn-test">
                                                            <a href="/testimoni" class="btn btn-testimoni">Testimoni</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@extends('layout-users.layout-main.index')
@section('content')
    <main class="bg-light halaman-transaksi">
        <div class="col-md-6 mx-auto text-center ">
            <h1 class="font-weight-bold contact-header">Transaksi User</h1>
        </div>

        <section class="centered-section-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-10 col-sm-6">

                        <div class="bg-primary-section card py-1 card-profile-tr mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-widget-description m-4">
                                        <h5
                                            class="card-title font-weight-bold d-block mx-2 profile-title-card1 text-center">
                                            Sortir</h5>
                                        <div class="sortir">
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str">Semua</button>
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str">Belum
                                                Terbayar</button>
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str">Sudah
                                                Terbayar</button>
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
                                        <div class="card-body">

                                            <div class="col-md-12" data-aos="fade-right">
                                                <div class="card tr-crd">
                                                    <div class="card-body">
                                                        <h5 class="card-title tr-wisata"> Wisata Wringinsongo</h5>
                                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-exclamation-circle fa-2x text-warning mr-2"></i>
                                                                <span class="status-text">Belum Terbayar</span>
                                                            </div>
                                                            <button class="btn btn-byr">Bayar</button>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5 tr-jdl">
                                                                <p class="card-text tr-at"><strong>Atas Nama</strong></p>
                                                                <p class="card-text tr-tgl"><strong>Tanggal Kunjungan</strong></p>
                                                                <p class="card-text tr-jml"><strong>Jumlah Tiket</strong></p>
                                                                <p class="card-text tr-tb"><strong>Total Biaya</strong></p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="card-text tr-at">: Rojali</p>
                                                                <p class="card-text tr-tgl">: 24 Agustus 2024</p>
                                                                <p class="card-text tr-jml">: 5 tiket</p>
                                                                <p class="card-text tr-tb">: Rp. 100.000</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" data-aos="fade-right">
                                                <div class="card tr-crd">
                                                    <div class="card-body">
                                                        <h5 class="card-title tr-wisata"> Wisata Wringinsongo</h5>
                                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-check-circle fa-2x text-success mr-2"></i>
                                                                <span class="status-text2">Sudah Terbayar</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5 tr-jdl">
                                                                <p class="card-text tr-at"><strong>Atas Nama</strong></p>
                                                                <p class="card-text tr-tgl"><strong>Tanggal Kunjungan</strong></p>
                                                                <p class="card-text tr-jml"><strong>Jumlah Tiket</strong></p>
                                                                <p class="card-text tr-tb"><strong>Total Biaya</strong></p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="card-text tr-at">: Rojali</p>
                                                                <p class="card-text tr-tgl">: 24 Agustus 2024</p>
                                                                <p class="card-text tr-jml">: 5 tiket</p>
                                                                <p class="card-text tr-tb">: Rp. 100.000</p>
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

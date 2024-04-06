@extends('layout-users.layout-main.index')
@section('content')
    <main class="bg-light halaman-transaksi">
        <div class="col-md-6 mx-auto text-center ">
            <h1 class="font-weight-bold contact-header">Transaksi Pembayaran</h1>
        </div>

        <section class="centered-section-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-10 col-sm-6">

                        <div class="bg-primary-section card py-1 card-profile-tr mb-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class=" mb-4">
                                        <div class="card-header">
                                            <h5 class="card-title font-weight-bold d-block mx-2 profile-title-card4 text-center">Pembayaran</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="col-md-12" data-aos="fade-right">
                                                <div class="card tr-crd">
                                                    <div class="card-body">
                                                        <h5 class="card-title tr-wisata"> {{ $cart->name_tour }}</h5>
                                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                                            <div class="d-flex align-items-center">
                                                                <i
                                                                    class="fas fa-exclamation-circle fa-2x text-warning mr-2"></i>
                                                                <span class="status-text">Belum Terbayar</span>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5 tr-jdl">
                                                                <p class="card-text tr-at"><strong>Atas Nama</strong></p>
                                                                <p class="card-text tr-tgl"><strong>Tanggal
                                                                        Kunjungan</strong></p>
                                                                <p class="card-text tr-jml"><strong>Jumlah Tiket</strong>
                                                                </p>
                                                                <p class="card-text tr-tb"><strong>Total Biaya</strong></p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="card-text tr-at">: {{ $cart->name }}</p>
                                                                <p class="card-text tr-tgl">: {{ $cart->date }}</p>
                                                                <p class="card-text tr-jml">: {{ $cart->tickets_count }}</p>

                                                                <p class="card-text tr-tb">:
                                                                    Rp.{{ number_format($cart->total_price, 0, ',') }}</p>
                                                            </div>
                                                        </div>

                                                        <h6 class="card-title text-center mt-3">Pilih Metode Pembayaran</h6>
                                                        <div class="col-12">
                                                            @foreach ($channels as $channel)
                                                                <form action="{{ route('cart.store') }}" method="POST">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        @csrf
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $cart->id }}">
                                                                        <input type="hidden" name="method"
                                                                            value="{{ $channel->code }}">

                                                                        <div class="card">
                                                                            <img src="{{ asset('assets/img/bank/' . $channel->code . '.png') }}"
                                                                                style="width: 25%; height: 100px; padding: 15px;"
                                                                                class="card-img-top equal-image"
                                                                                alt="{{ $channel->name }}">
                                                                            <div class="card-body text-center"
                                                                                style="padding: 0px;">
                                                                                <p class="card-text"
                                                                                    style="color: #000000; font-size: 14px; margin-top: -60px;">
                                                                                    {{ $channel->name }}</p>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary"
                                                                                    style="margin-left: 550px; margin-top: -80px">Bayar</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </form>
                                                            @endforeach
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
        </section>


    </main>
@endsection

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
                                    <div class="profile-widget-description mx-4 mt-4">
                                        <h5
                                            class="card-title font-weight-bold d-block mx-2 profile-title-card1 text-center">
                                            Sortir
                                        </h5>
                                        <div class="sortir">
                                            <a href="/reservasi-user"
                                                class="btn btn-primary btn-block mb-2 btn-custom-str">Semua</a>
                                            <a href="/reservasi-user?status=aktif"
                                                class="btn btn-primary btn-block mb-2 btn-custom-str">Aktif</a>
                                            <a href="/reservasi-user?status=selesai"
                                                class="btn btn-primary btn-block mb-2 btn-custom-str">Selesai</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <h5
                                            class="card-title font-weight-bold d-block mt-4 mx-2 mb-3 profile-title-card4 text-center">
                                            Data Reservasi
                                        </h5>

                                        @if ($reservasi->isEmpty())
                                            <div class="alert alert-warning text-center mx-4" role="alert">
                                                @if (request()->query('status', 'all') == 'all')
                                                    Belum terdapat data reservasi.
                                                @else
                                                    Tidak ada reservasi ditemukan untuk filter
                                                    "{{ request()->query('status') }}".
                                                @endif
                                            </div>
                                        @else
                                            @foreach ($reservasi as $cart)
                                                <div class="container px-3 mb-2">
                                                    <div class="card-body dt-res">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-4 d-flex justify-content-center">
                                                                <img src="{{ Storage::url($cart->tour->profile_tour) }}"
                                                                    class="mage-reser" alt="Foto Tiket">
                                                            </div>
                                                            <div class="col-md-8 rs-ws">
                                                                <h5 class="card-title-res">{{ $cart->tour->name }}</h5>
                                                                <div class="row dt-ws">
                                                                    <div class="col-8">
                                                                        <p class="card-kod-res">
                                                                            <i class="fas fa-id-card"></i>
                                                                            {{ $cart->payments->order_id }}
                                                                        </p>
                                                                        <p class="card-date-res">
                                                                            <i class="far fa-calendar-alt"></i>
                                                                            {{ \Carbon\Carbon::parse($cart->ticket->date)->locale('id')->isoFormat('D MMMM YYYY') }}
                                                                        </p>
                                                                        <p class="card-tick-res">
                                                                            <i class="fas fa-ticket-alt"></i>
                                                                            {{ $cart->ticket->tickets_count }} tiket
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-4 text-right btn-test">
                                                                        @if ($cart->status_confirm === 'success' && !$cart->hasTestimonial)
                                                                            <a href="/testimoni?id_tour={{ $cart->tour->id }}&id_cart={{ $cart->id }}"
                                                                                class="btn btn-testimoni">Testimoni</a>
                                                                        @elseif ($cart->status_confirm === 'success' && $cart->hasTestimonial)
                                                                            <button class="btn btn-success px-3"
                                                                                style="border-radius: 20px;">Selesai</button>
                                                                        @else
                                                                            <button class="btn btn-warning px-3 text-white"
                                                                                style="border-radius: 20px;"
                                                                                onclick="window.location.href='{{ route('reservasi.detail', ['order_id' => $cart->payments->order_id]) }}'">
                                                                                Lihat Detail
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $reservasi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
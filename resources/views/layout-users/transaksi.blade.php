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
                            @if (session('success'))
                                <script>
                                    window.onload = function() {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: '{{ session('success') }}',
                                            icon: 'success',
                                            confirmButtonText: 'Close'
                                        })
                                    }
                                </script>
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-widget-description px-4 mt-4">
                                        <h5
                                            class="card-title font-weight-bold d-block mx-2 profile-title-card1 text-center">
                                            Sortir</h5>
                                        <div class="sortir">
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str sort-btn"
                                                onclick="window.location.href='?sort=all'">Semua</button>
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str sort-btn"
                                                onclick="window.location.href='?sort=pending'">Belum Terbayar</button>
                                            <button class="btn btn-primary btn-block mb-2 btn-custom-str sort-btn"
                                                onclick="window.location.href='?sort=success'">Sudah Terbayar</button>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-4 px-4">
                                        <div class="mt-4 mb-3">
                                            <h5
                                                class="card-title font-weight-bold d-block mx-2 profile-title-card4 text-center">
                                                Data Transaksi</h5>
                                        </div>
                                        <div class="container">
                                            @if ($cart->isEmpty())
                                                <div class="alert alert-warning text-center" role="alert">
                                                    @if (request()->query('sort', 'all') == 'all')
                                                        Belum terdapat data transaksi.
                                                    @else
                                                        Tidak ada transaksi ditemukan untuk filter
                                                        "{{ request()->query('sort') }}".
                                                    @endif
                                                </div>
                                            @else
                                                @foreach ($cart as $key => $cat)
                                                    <div class="col-md-12 transaction-card"
                                                        data-status="{{ $cat->status }}">
                                                        <div class="card tr-crd">
                                                            <div class="card-body">
                                                                <h5 class="card-title tr-wisata"> {{ $cat->name_tour }}</h5>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mt-3">
                                                                    @if ($cat->status == 'success')
                                                                        <div class="d-flex align-items-center">
                                                                            <i
                                                                                class="fas fa-check-circle fa-2x text-success mr-2"></i>
                                                                            <span class="status-text2">Sudah Terbayar</span>
                                                                        </div>
                                                                    @else
                                                                        <div class="d-flex align-items-center">
                                                                            <i
                                                                                class="fas fa-exclamation-circle fa-2x text-warning mr-2"></i>
                                                                            <span class="status-text">Belum Terbayar</span>
                                                                        </div>
                                                                        <button class="btn btn-byr"
                                                                            data-cart-id="{{ $cat->cardId }}"
                                                                            data-total-price="{{ $cat->total_price }}"
                                                                            data-first-name="{{ $profile->name }}"
                                                                            data-email="{{ $profile->email }}"
                                                                            data-phone-number="{{ $profile->phone_number }}">Bayar</button>
                                                                    @endif
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-5 tr-jdl">
                                                                        <p class="card-text tr-at"><strong>Atas
                                                                                Nama</strong></p>
                                                                        <p class="card-text tr-tgl"><strong>Tanggal
                                                                                Kunjungan</strong></p>
                                                                        <p class="card-text tr-jml"><strong>Jumlah
                                                                                Tiket</strong></p>
                                                                        <p class="card-text tr-tb"><strong>Total
                                                                                Biaya</strong></p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p class="card-text tr-at">: {{ $cat->name }}</p>
                                                                        <p class="card-text tr-tgl">:
                                                                            {{ \Carbon\Carbon::parse($cat->date)->locale('id')->isoFormat('D MMMM YYYY') }}
                                                                        </p>
                                                                        <p class="card-text tr-jml">:
                                                                            {{ $cat->tickets_count }}</p>
                                                                        <p class="card-text tr-tb">:
                                                                            {{ $cat->total_price }}
                                                                        </p>
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
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-6 d-flex justify-content-center">
                                {{ $cart->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="snap-container"></div>
    </main>
@endsection
@push('customScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.querySelectorAll('.btn-byr').forEach(button => {
            button.addEventListener('click', function() {
                const cartId = this.getAttribute('data-cart-id');
                const totalPrice = this.getAttribute('data-total-price');
                const firstName = this.getAttribute('data-first-name');
                const email = this.getAttribute('data-email');
                const phoneNumber = this.getAttribute('data-phone-number');

                fetch('/payment/initiate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            first_name: firstName,
                            email: email,
                            phone: phoneNumber,
                            amount: totalPrice,
                            cart_id: cartId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            window.snap.pay(data.token, {
                                onSuccess: function(result) {
                                    console.log('Payment success:', result);
                                    updateTransactionStatus(result);
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                },
                                onPending: function(result) {
                                    console.log('Payment pending:', result);
                                },
                                onError: function(result) {
                                    console.error('Payment error:', result);
                                }
                            });
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        function updateTransactionStatus(paymentResult) {
            fetch('/payment/callback', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(paymentResult)
                })
                .then(response => response.json())
                .then(data => console.log('Transaction status updated:', data))
                .catch(error => console.error('Failed to update transaction status:', error));
        }
    </script>
@endpush
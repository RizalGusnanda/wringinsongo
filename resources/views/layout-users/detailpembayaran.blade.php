@extends('layout-users.layout-main.index')
@section('content')
    <section class="transaksi">
        <div class="container">
            <div class="col-md-6 mx-auto text-center ">
                <h3 class="font-weight-bold contact-header">Intruksi Pembayaran</h3>
                <p>Mohon untuk melakukan pembayaran sesuai dengan instruksi yang tersedia.</p>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted mb-3">Detail Transaksi</h6>
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3 class="mb-1">Rp. {{ number_format($detail->amount) }}</h3>
                                </div>
                                <div class="col-6 text-center">
                                    <h6 class="{{ $detail->status === 'UNPAID' ? 'text-danger' : '' }}">
                                        {{ $detail->status === 'UNPAID' ? 'Belum Terbayar' : $detail->status }}
                                    </h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted mb-3">Intruksi</h6>
                            @foreach ($detail->instructions as $trans)
                                <div id="instruction{{ $loop->index }}">
                                    <h5>
                                        <button class="btn btn-bankst" type="button" data-toggle="collapse"
                                            data-target="#collapse{{ $loop->index }}" aria-expanded="false"
                                            aria-controls="collapse{{ $loop->index }}">
                                            {{ $trans->title }}
                                        </button>
                                    </h5>
                                    <div class="collapse" id="collapse{{ $loop->index }}">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($trans->steps as $step)
                                                <li class="list-group-item">{{ $loop->iteration }}. {!! $step !!}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll('.btn');

            buttons.forEach((button) => {
                button.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    const collapse = document.querySelector(target);

                    collapse.classList.toggle('show');

                    buttons.forEach((otherButton) => {
                        if (otherButton !== button) {
                            const otherTarget = otherButton.getAttribute('data-target');
                            const otherCollapse = document.querySelector(otherTarget);
                            otherCollapse.classList.remove('show');
                        }
                    });
                });
            });
        });
    </script>
@endsection

@extends('layout-users.layout-main.index')
@section('content')
    <section class="transaksi">
        <!-- Header -->
        <div class="container">
            <div class="row my-4">
                <div class="col-auto">
                    <a href="#" class="btn btn-light"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="col">
                    <h5 class="mb-0">Pembayaran</h5>
                </div>
            </div>
        </div>

        <!-- Detail Transaksi -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted mb-3">Transaction Detail</h6>
                            <h3 class="mb-4">Rp. {{ number_format($detail->amount) }}</h3>
                            <span class="badge badge-danger">{{ $detail->status }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-uppercase text-muted mb-3">Instruction</h6>
                            @foreach ($detail->instructions as $trans)
                                <div id="instruction{{ $loop->index }}" class="collapse show">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapse{{ $loop->index }}" aria-expanded="true"
                                            aria-controls="collapse{{ $loop->index }}">
                                            {{ $trans->title }}
                                        </button>
                                    </h5>
                                    <div id="collapse{{ $loop->index }}" class="collapse show"
                                        aria-labelledby="instruction{{ $loop->index }}" data-parent="#accordionExample">
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
@endsection
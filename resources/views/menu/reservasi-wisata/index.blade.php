<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="filterModalLabel">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="text-dark mb-2">Pembayaran</h6>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="filter_status" id="successRadio"
                        value="success" {{ request('filter_status') == 'success' ? 'checked' : '' }}>
                    <label class="form-check-label text-dark" for="successRadio">
                        Success
                    </label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" name="filter_status" id="pendingRadio"
                        value="pending" {{ request('filter_status') == 'pending' ? 'checked' : '' }}>
                    <label class="form-check-label text-dark" for="pendingRadio">
                        Pending
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Batal</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-block" onclick="applyFilter()">Filter</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header mb-0">
            <h1>Reservasi Tiket</h1>
        </div>
        <div class="section-body">
            <div class="row align-items-center">
                <div class="col-md-6 text-left py-0">
                    <h2 class="section-title">Reservasi Management</h2>
                </div>
                <div class="col-md-6 text-right py-0">
                    <i class="fas fa-sliders-h text-primary" data-toggle="modal" data-target="#filterModal"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Menu Item List</h4>
                            <div class="card-header-action">
                                <a class="btn btn-info btn-primary active search-toggle">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Pembayaran</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('reservasi-wisata.index') }}">
                                    <div class="form-row align-items-end">
                                        <div class="form-group col-md-10">
                                            <label for="name">Nama User / Nama Wisata</label>
                                            <input type="text" name="search" class="form-control" id="searchInput"
                                                placeholder="Masukkan Nama User atau Nama Wisata"
                                                value="{{ request('search') }}">
                                        </div>
                                        <div class="form-group col-md-2 d-flex justify-content-start">
                                            <button class="btn btn-primary mr-2" type="submit">Submit</button>
                                            <a class="btn btn-secondary search-toggle" href="#">Cancel</a>
                                        </div>
                                    </div>
                                    <input type="hidden" name="filter_status" value="{{ request('filter_status') }}">
                                </form>
                            </div>
                            @if ($reservations->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    Data reservasi tidak ditemukan.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tbody>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama User</th>
                                                <th>Nama Wisata</th>
                                                <th>Harga Tiket</th>
                                                <th>Total Tiket</th>
                                                <th>Total Pembayaran</th>
                                                <th>Tanggal Kunjungan</th>
                                                <th>status</th>
                                            </tr>
                                            @foreach ($reservations as $index => $reservation)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $reservation->user_name }}</td>
                                                    <td>{{ $reservation->tour_name }}</td>
                                                    <td>{{ 'Rp. ' . number_format($reservation->harga_tiket, 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $reservation->tickets_count }}</td>
                                                    <td>{{ 'Rp. ' . number_format($reservation->total_price, 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($reservation->date)->translatedFormat('d F Y') ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        @if ($reservation->status == 'success')
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-check-circle"></i> Success
                                                            </span>
                                                        @elseif ($reservation->status == 'pending')
                                                            <span class="badge badge-warning">
                                                                <i class="fas fa-hourglass-half"></i> Pending
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary">
                                                                <i class="fas fa-question-circle"></i> Unknown
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $reservations->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('customScript')
    <script>
        $(document).ready(function() {
            $('.search-toggle').click(function() {
                $('.show-search').toggle();
            });
        });

        function applyFilter() {
            let filterStatus = document.querySelector('input[name="filter_status"]:checked').value;
            let searchForm = document.getElementById('search');
            let url = new URL(searchForm.action);
            url.searchParams.set('filter_status', filterStatus);
            window.location.href = url.href;
        }
    </script>
@endpush

@push('customStyle')
    <style>
        .modal-dialog-right {
            position: fixed;
            right: 50;
            top: 0;
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
@endpush

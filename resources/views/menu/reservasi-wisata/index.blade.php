@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Reservasi Tiket</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Reservasi Management</h2>
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
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="name">Nama User / Nama Wisata</label>
                                            <input type="text" name="search" class="form-control" id="searchInput"
                                                placeholder="Masukkan Nama User atau Nama Wisata">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <a class="btn btn-secondary search-toggle" href="#">Cancel</a>
                                    </div>
                                </form>
                            </div>
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
    </script>
@endpush

@push('customStyle')
@endpush

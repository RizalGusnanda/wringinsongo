@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Superadmin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ '/dashboard' }}">Dashboard</a></div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Dashboard Superadmin</h4>
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>  --}}

        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaksi Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama User</th>
                                            <th>Nama Wisata</th>
                                            <th>Tanggal Kunjungan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestTransactions as $index => $transaction)
                                            <tr class="text-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $transaction->user_name }}</td>
                                                <td>{{ $transaction->tour_name }}</td>
                                                <td>{{ $transaction->date }}</td>
                                                <td>
                                                    @if ($transaction->status == 'success')
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-check-circle"></i> Success
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            <i class="fas fa-hourglass-half"></i> Pending
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-right py-2">
                            <a href="{{ route('reservasi-wisata.index') }}"
                                style="font-weight: 600; color: #11468F; text-decoration: none;">Selengkapnya<i
                                    class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Tempat Wisata Tertop</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($topThreeTours as $tour)
                            <div class="card bg-primary text-white mb-2">
                                <div class="card-body d-flex align-items-center" style="padding-top: 5px; padding-bottom: 5px;">
                                    <i class="fas fa-map-marker-alt mr-5" style="font-size: 2em;"></i>
                                    <div>
                                        <h5 class="card-title">{{ $tour->name }}</h5>
                                        <p class="card-text">Jumlah Pesanan: {{ $tour->tickets_count }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card px-3 py-2">
                    <canvas id="monthlyTicketsSoldChart"></canvas>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('customScript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('monthlyTicketsSoldChart').getContext('2d');
        var monthlyTicketsSoldChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyLabels) !!},
                datasets: [{
                    label: 'Jumlah Tiket Terjual',
                    data: {!! json_encode($monthlyTicketsSold) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 5
                        }
                    }]
                }
            }
        });
    </script>
@endpush

@push('customStyle')
@endpush

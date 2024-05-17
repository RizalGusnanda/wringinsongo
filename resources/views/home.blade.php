@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Superadmin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{'/dashboard'}}">Dashboard</a></div>
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total User</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalUsersWithRole }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Wisata</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalTours }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalTransactions }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pendapatan</h4>
                        </div>
                        <div class="card-body">
                            Rp. {{ number_format($totalRevenue, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tempat Wisata Tertop</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($topThreeTours as $tour)
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body d-flex align-items-center">
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
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>User Transaksi Terbanyak</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($topThreeUsers as $user)
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body d-flex align-items-center">
                                    <i class="fas fa-user mr-5" style="font-size: 2em;"></i>
                                    <div>
                                        <h5 class="card-title">{{ $user->name }}</h5>
                                        <p class="card-text">Jumlah Transaksi: {{ $user->transactions_count }}</p>
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
                    <canvas id="monthlyTransactionsChart"></canvas>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('customScript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('monthlyTransactionsChart').getContext('2d');
        var monthlyTransactionsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyLabels) !!},
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: {!! json_encode($monthlyTransactions) !!},
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
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }]
                }
            }
        });
    </script>
@endpush

@push('customStyle')
@endpush

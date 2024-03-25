@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Superadmin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div>
        </div>
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
                            {{$totalUsersWithRole}}
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
                            1,201
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
                            Rp.47.000.000
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-6 col-md-6 col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Tempat Wisata Tertop</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myPengajar" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Wisatawan Top Order</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Jumlah Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($siswas as $key => $siswa)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $siswa->name }}</td>
                                            <td>{{ $siswa->email }}</td>
                                            <td>{{ $siswa->pembayarans_count }}</td>
                                            <td>{{ $siswa->latest_transaction ?? 'N/A' }}</td>

                                        </tr>
                                    @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Dashboard Superadmin</h4>
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>  --}}
        <div class="section-body">

        </div>
    </section>
@endsection

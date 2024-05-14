@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pendapatan Wisata</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Pendapatan Management</h2>
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Pendapatan Wisata List</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('pendapatan-wisata.export', request()->query()) }}">Eksport Pendapatan</a>
                                <a class="btn btn-info btn-primary active search-toggle">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Wisata</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('pendapatan-wisata.index') }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Menu Item</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Menu Item Name">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <a class="btn btn-secondary" href="">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Wisata</th>
                                            <th>harga tiket</th>
                                            <th>total tiket</th>
                                            <th>total pendapatan</th>
                                        </tr>
                                        @foreach ($tours as $tour)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $tour->name }}</td>
                                                <td>{{ 'Rp. ' . number_format($tour->harga_tiket, 0, ',', '.') }}</td>
                                                <td>{{ $tour->carts->sum('total_tickets') }}</td>
                                                <td>{{ 'Rp. ' . number_format($tour->carts->sum('total_pendapatan'), 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $tours->links() }}
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

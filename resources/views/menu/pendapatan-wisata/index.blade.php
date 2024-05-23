@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pendapatan Wisata</h1>
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
                                <a class="btn btn-icon icon-left btn-primary"
                                    href="{{ route('pendapatan-wisata.export', request()->query()) }}">Eksport
                                    Pendapatan</a>
                                <a class="btn btn-info btn-primary active search-toggle">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Wisata</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('pendapatan-wisata.index') }}">
                                    <div class="form-row align-items-end">
                                        <div class="form-group col-md-10">
                                            <label for="role">Search Wisata</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Search Wisata">
                                        </div>
                                        <div class="form-group col-md-2 d-flex justify-content-start">
                                            <button class="btn btn-primary mr-2" type="submit">Submit</button>
                                            <a class="btn btn-secondary" href="{{ route('pendapatan-wisata.index') }}">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if ($tours->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    Data wisata tidak tersedia.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tbody class="text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Wisata</th>
                                                <th>Harga Tiket</th>
                                                <th>Total Tiket</th>
                                                <th>Total Pendapatan</th>
                                            </tr>
                                            @foreach ($tours as $tour)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $tour->name }}</td>
                                                    <td>{{ 'Rp. ' . number_format($tour->harga_tiket, 0, ',', '.') }}</td>
                                                    <td>{{ $tour->carts->sum('total_tickets') }}</td>
                                                    <td>{{ 'Rp. ' . number_format($tour->carts->sum('total_pendapatan'), 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $tours->links() }}
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
    </script>
@endpush

@push('customStyle')
@endpush

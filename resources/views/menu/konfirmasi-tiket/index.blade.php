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
                <h6 class="text-dark mb-2">Tanggal Kedatangan</h6>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="filter_status" id="nowRadio" value="now"
                        {{ request('filter_status') == 'now' ? 'checked' : '' }}>
                    <label class="form-check-label text-dark" for="nowRadio">
                        Hari ini
                    </label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" name="filter_status" id="allRadio" value="all"
                        {{ request('filter_status') == 'all' ? 'checked' : '' }}>
                    <label class="form-check-label text-dark" for="allRadio">
                        Semua
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Batal</button>
                    </div>
                    <div class="col-md-6 mb-2">
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
        <div class="section-header">
            <h1>Konfirmasi Tiket</h1>
        </div>
        <div class="section-body">
            <div class="row align-items-center">
                <div class="col-md-6 text-left py-0">
                    <h2 class="section-title">Tiket Management</h2>
                </div>
                <div class="col-md-6 text-right py-0">
                    <i class="fas fa-sliders-h text-primary" data-toggle="modal" data-target="#filterModal"></i>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-12">
                    @include('layouts.alert')
                </div> --}}
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Tiket List</h4>
                            <div class="card-header-action">
                                {{-- <a class="btn btn-icon icon-left btn-primary" href="">Eksport Rekap Pembayaran</a> --}}
                                {{-- <a class="btn btn-info btn-primary active import">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                Import Menu Item</a>
                            <a class="btn btn-info btn-primary active" href="{{ route('menu-item.export') }}">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                                Export Menu Item</a> --}}
                                <a class="btn btn-info btn-primary active search-toggle">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Tiket
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <div class="show-import" style="display: none">
                                <div class="custom-file">
                                    <form action="{{ route('menu-item.import') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <label class="custom-file-label" for="file-upload">Choose File</label>
                                        <input type="file" id="file-upload" class="custom-file-input" name="import_file">
                                        <br /> <br />
                                        <div class="footer text-right">
                                            <button class="btn btn-primary">Import File</button>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('konfirmasi-tiket.index') }}">
                                    <div class="form-row align-items-end">
                                        <div class="form-group col-md-10">
                                            <label for="search">Search</label>
                                            <input type="text" name="search" class="form-control" id="search"
                                                placeholder="Search berdasarkan user atau wisata atau kode pembayaran"
                                                value="{{ request()->get('search') }}">
                                        </div>
                                        <div class="form-group col-md-2 d-flex justify-content-start">
                                            <button class="btn btn-primary mr-2" type="submit">Submit</button>
                                            <a class="btn btn-secondary search-toggle"
                                                href="{{ route('konfirmasi-tiket.index') }}">Reset</a>
                                        </div>
                                    </div>
                                    {{-- <div class="text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('konfirmasi-tiket.index') }}">Reset</a>
                                    </div> --}}
                                </form>
                            </div>
                            @if ($carts->isEmpty())
                                <div class="alert alert-danger" role="alert">
                                    Data tiket tidak tersedia.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tbody>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Pembayaran</th>
                                                <th>Nama User</th>
                                                <th>Nama Wisata</th>
                                                <th>Tanggal Kedatangan</th>
                                                <th>Total Tiket</th>
                                                <th>Status Konfirmasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                            @foreach ($carts as $index => $cart)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $cart->payments->order_id ?? 'N/A' }}</td>
                                                    <td>{{ $cart->ticket->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $cart->tour->name ?? 'N/A' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($cart->ticket->date)->translatedFormat('d F Y') ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ $cart->ticket->tickets_count ?? 'N/A' }}</td>
                                                    <td>
                                                        @if ($cart->status_confirm == 'success')
                                                            <span class="badge badge-success">
                                                                <i class="fas fa-check-square"></i> Sudah Berkunjung
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary">
                                                                <i class="fas fa-exclamation-circle"></i> Belum Berkunjung
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($cart->status_confirm == 'pending')
                                                            <form
                                                                action="{{ route('konfirmasi-tiket.confirm', $cart->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    class="btn btn-primary">Konfirmasi</button>
                                                            </form>
                                                        @else
                                                            <span class="btn btn-white confirms">Confirmed</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $carts->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <style>
        .confirms {
            color: white !important;
        }
    </style>
@endsection

@push('customScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        @endif

        $(document).ready(function() {
            $('.search-toggle').click(function() {
                $('.show-search').toggle();
            });
        });

        function applyFilter() {
            let filterStatus = document.querySelector('input[name="filter_status"]:checked').value;
            let url = new URL(window.location.href);
            url.searchParams.set('filter_status', filterStatus);
            window.location.href = url.toString();
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

@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Konfirmasi Tiket</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Tiket Management</h2>
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
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="search">Search</label>
                                            <input type="text" name="search" class="form-control" id="search"
                                                placeholder="Search berdasarkan user atau wisata atau kode pembayaran"
                                                value="{{ request()->get('search') }}">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('konfirmasi-tiket.index') }}">Reset</a>
                                    </div>
                                </form>
                            </div>
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
                                                <td>Rp. {{ number_format($cart->total_price, 0, ',', '.') }}</td>
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
                                                        <form action="{{ route('konfirmasi-tiket.confirm', $cart->id) }}"
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

        document.querySelector('.search-toggle').addEventListener('click', function() {
            document.querySelector('.show-search').style.display = 'block';
        });
    </script>
@endpush

@push('customStyle')
@endpush

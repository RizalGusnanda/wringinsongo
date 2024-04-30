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
                <div class="col-12">
                    @include('layouts.alert')
                </div>
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
                                <a class="btn btn-info btn-primary active search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    Search Tiket</a>
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
                                <form id="search" method="GET" action="">
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
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Id Pembayaran</th>
                                            <th>Nama User</th>
                                            <th>Nama Wisata</th>
                                            <th>Tanggal Kedatangan</th>
                                            <th>total tiket</th>
                                            <th>status</th>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

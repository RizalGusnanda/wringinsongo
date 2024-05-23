@extends('layouts.app')

@section('content')
    <section class="section">
        <style>
            .modal.show {
                z-index: 1050 !important;
            }

            .modal-header.bg-primary {
                background-color: #265073 !important;
                color: #fff !important;
            }

            .modal-content {
                border-radius: 0.5rem;
            }

            .list-group-item {
                border: none;
                padding: 0.5rem 1rem;
            }

            .list-group-item+.list-group-item {
                margin-top: 0.25rem;
            }

            .list-group-item:first-child {
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
            }

            .list-group-item:last-child {
                border-bottom-left-radius: 0.5rem;
                border-bottom-right-radius: 0.5rem;
            }

            .modal-header .close {
                color: #fff;
                text-shadow: none;
                opacity: 1;
            }

            .search-input-container {
                display: flex;
                align-items: center;
                border: 2px solid #265073;
                border-radius: 30px;
                overflow: hidden;
            }

            .search-input-container .form-control {
                border: none;
                border-radius: 0;
                box-shadow: none;
            }

            .search-input-container .form-control:focus {
                box-shadow: none;
                border: none;
            }

            .search-input-container .btn {
                border: none;
                border-radius: 0;
                background-color: #265073;
                color: white;
            }

            .search-input-container .btn:hover {
                background-color: darken(#007bff, 5%);
            }

            .search-input-container .form-control::placeholder {
                color: #ccc;
            }

            .search-input-container .form-control:focus::placeholder {
                color: transparent;
            }
        </style>
        <div class="section-header">
            <h1>Menu Wisata</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Wisata Management</h2>
            {{-- <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div> --}}

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Wisata List</h4>
                            {{-- <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary"
                                    href="{{ route('menu-wisata.create') }}">Create
                                    New Wisata</a>
                                <a class="btn btn-info btn-primary active import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import dataName</a>
                                <a class="btn btn-info btn-primary active" href="{{ route('menu-group.export') }}">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export dataName</a>
                                <a class="btn btn-info btn-primary active search"> <i class="fa fa-search"
                                        aria-hidden="true"></i> Search Wisata</a>
                            </div> --}}
                            <div class="card-header-action">
                                <div class="row w-100 no-gutters justify-content-between">
                                    <div class="col-auto mr-2">
                                        <a class="btn btn-icon icon-left btn-primary mb-3"
                                            href="{{ route('menu-wisata.create') }}">Create New Wisata</a>
                                        {{-- <a class="btn btn-info btn-primary active import mb-3">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            Import Wisata</a> --}}
                                    </div>
                                    <div class="col">
                                        <div class="search-input-container">
                                            <form action="{{ route('menu-wisata.index') }}" method="GET"
                                                class="w-100 d-flex">
                                                <input type="text" class="form-control flex-grow-1"
                                                    placeholder="Cari nama wisata..." name="search"
                                                    value="{{ request()->get('search') }}">
                                                <button class="btn btn-primary" style="margin-top: 0px;" type="submit"><i
                                                        class="fas fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <div class="show-import mb-4" style="display: none">
                                <div class="custom-file">
                                    <form action="{{ route('menu-wisata.import') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <label class="custom-file-label" for="file-upload">Choose file</label>
                                        <input type="file" id="file-upload" class="custom-file-input" name="import_file"
                                            accept=".xlsx, .xls">
                                        <br><br>
                                        <button class="btn btn-primary">Import File</button>
                                    </form>
                                </div>
                            </div> --}}
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Group</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Group Name">
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
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Profile Wisata</th>
                                            <th>Nama Wisata</th>
                                            <th>Jenis Wisata</th>
                                            <th>Maps</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($tours as $tour)
                                            <tr>
                                                <td class="text-center">
                                                    {{ ($tours->currentPage() - 1) * $tours->perPage() + $loop->index + 1 }}
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <img src="{{ asset('storage/' . $tour->profile_tour) }}"
                                                        alt="Profile Tour"
                                                        style="width: 200px; height: 150px; object-fit: cover;">
                                                </td>
                                                <td class="text-center">{{ $tour->name }}</td>
                                                <td class="text-center">{!! $tour->type !!}</td>
                                                <td class="text-center">{!! $tour->maps !!}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('menu-wisata.show', $tour->id) }}"
                                                            class="btn btn-success mr-2">Show</a>
                                                        <a href="{{ route('menu-wisata.edit', $tour->id) }}"
                                                            class="btn btn-warning mr-2">Edit</a>
                                                        <form action="{{ route('menu-wisata.destroy', $tour->id) }}"
                                                            method="POST" id="deleteForm{{ $tour->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger delete-btn"
                                                                data-id="{{ $tour->id }}">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <div class="alert alert-danger" role="alert">
                                                        Destinasi Wisata tidak ditemukan.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {!! $tours->appends(['search' => request()->query('search')])->links() !!}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });

            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });

        $(document).ready(function() {
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikannya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteForm' + id).submit();
                    }
                });
            });
        });

        @if ($message = Session::get('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ $message }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
                showCloseButton: true
            });
        @endif
        @if ($message = Session::get('danger'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ $message }}',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top-end',
                timerProgressBar: true,
                showCloseButton: true
            });
        @endif
    </script>
@endpush

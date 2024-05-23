@extends('layout-users.layout-main.index')
@section('content')
    <section class="search">
        <div class="container">
            <div class="card-search-wisata">
                <div class="card-body">
                    <h1 class="title-wisata">Cari destinasi wisata sesuai keinginanmu</h1>
                    <div class="search-column">
                        <form action="{{ url('/wisata') }}" class="search-form" method="GET">
                            <div class="search-input-container">
                                <div class="search-icon">
                                    <i class="material-icons">cast_for_education</i>
                                </div>
                                <input type="text" name="wisata" placeholder="Cari destinasi wisata"
                                    class="search-input" value="{{ $search ?? '' }}">
                                <button type="submit" class="search-button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="list-wisata">
        <div class="container">
            <div class="col-12 d-flex justify-content-end mb-3">
                <i class="fas fa-sliders-h" style="color: #265073;" data-bs-toggle="modal"
                    data-bs-target="#filterModal"></i>
            </div>
            @if (isset($error))
                <div class="alert alert-danger text-center" role="alert">
                    {{ $error }}
                </div>
            @endif
            <div class="row">
                @if ($tours->isEmpty())
                    <div class="alert alert-danger text-center" role="alert">
                        Destinasi wisata belum ditambahkan!
                    </div>
                @else
                    @foreach ($tours as $tour)
                        <div class="col-md-12 mx-auto" data-aos="fade-right">
                            <div class="card-wisata d-flex">
                                <img src="{{ Storage::url($tour->profile_tour) }}" class="img-wisata" alt="Wisata Image">
                                <div class="wisata-info">
                                    <div class="row">
                                        <div class="md-3">
                                            <h4 class="wisata-title">{{ strtoupper($tour->name) }}</h4>
                                        </div>
                                        <div class="md-9">
                                            <p class="wisata-description">{!! strlen($tour->description) > 260 ? substr($tour->description, 0, 260) . '...' : $tour->description !!}</p>
                                        </div>
                                    </div>
                                    <a href="{{ url('/detail-wisata/' . $tour->id) }}" class="btn btn-detailwisata">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        @if ($tours->total() > 5)
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            @if ($tours->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tours->previousPageUrl() }}" tabindex="-1"
                                        aria-disabled="true">Previous</a>
                                </li>
                            @endif

                            @foreach ($tours->getUrlRange(1, $tours->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $tours->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($tours->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tours->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        @endif
    </section>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-right" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="filterModalLabel">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-dark mb-2">Abjad</h6>
                    <form action="{{ url('/wisata') }}" method="GET">
                        <input type="hidden" name="wisata" value="{{ $search }}">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sort" id="ascendingRadio"
                                value="ascending" {{ request('sort') == 'ascending' ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="ascendingRadio">A-Z</label>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="sort" id="descendingRadio"
                                value="descending" {{ request('sort') == 'descending' ? 'checked' : '' }}>
                            <label class="form-check-label text-dark" for="descendingRadio">Z-A</label>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary w-100 mb-1"
                                    data-bs-dismiss="modal">Batal</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-100 mb-1">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .modal-dialog-right {
            position: fixed;
            right: 125px !important;
            top: 80px !important;
            bottom: 0;
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .modal-dialog-right {
                right: 10px !important;
                top: 110px !important;
            }
        }
    </style>
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

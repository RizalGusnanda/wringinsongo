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
            @if (isset($error))
                <div class="alert alert-warning text-center" role="alert">
                    {{ $error }}
                </div>
            @endif
            <div class="row">
                @if ($tours->isEmpty())
                    <div class="alert alert-warning text-center" role="alert">
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
                                    <a href="/detail-wisata/{{ $tour->id }}" class="btn btn-detailwisata">Lihat
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
@endsection

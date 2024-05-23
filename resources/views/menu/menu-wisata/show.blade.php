@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Wisata</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Detail Wisata</h4>
            </div>
            <div class="card-body">
                <h5 class="mb-3">{{ $tour->name }}</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <img src="{{ asset('storage/' . $tour->profile_tour) }}" alt="Profile Wisata"
                                style="width: 100%; height: auto; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="maps">Maps</label>
                            <p><a href="{{ $tour->maps }}" target="_blank">{{ $tour->maps }}</a></p>
                        </div>
                        <div class="form-group">
                            <label for="type">Jenis Wisata</label>
                            <p>{{ $tour->type }}</p>
                        </div>
                        <div class="form-group">
                            <label for="harga_tiket">Harga Tiket</label>
                            <p>{{ $tour->harga_tiket ? 'Rp. ' . number_format($tour->harga_tiket, 0, ',', '.') : '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row text-center mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fasilitas_km">Fasilitas Kamar Mandi</label>
                                <p>
                                    <span class="badge {{ $tour->fasilitas_km == 'Fasilitas Tersedia' ? 'badge-primary' : 'badge-info' }}">
                                        {{ $tour->fasilitas_km }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fasilitas_tm">Fasilitas Tempat Makan</label>
                                <p>
                                    <span class="badge {{ $tour->fasilitas_tm == 'Fasilitas Tersedia' ? 'badge-primary' : 'badge-info' }}">
                                        {{ $tour->fasilitas_tm }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fasilitas_ti">Fasilitas Tempat Ibadah</label>
                                <p>
                                    <span class="badge {{ $tour->fasilitas_ti == 'Fasilitas Tersedia' ? 'badge-primary' : 'badge-info' }}">
                                        {{ $tour->fasilitas_ti }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" class="form-control" rows="4" readonly style="height: 100%;">{{ strip_tags($tour->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="additional_images">Gambar Pendukung</label>
                    <div class="d-flex flex-wrap additional-image-preview">
                        @foreach ($tour->subimages as $image)
                            <div class="p-2 image-preview-wrapper mb-1">
                                <div class="img-thumbnail">
                                    <img src="{{ asset('storage/' . $image->subimages) }}"
                                        style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="history">Sejarah</label>
                    <textarea id="description" class="form-control" rows="4" readonly style="height: 100%;">{{ strip_tags($tour->history) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="virtual_tours">Gambar Virtual Tour</label>
                    <div class="d-flex flex-wrap virtual-image-preview">
                        @foreach ($tour->virtualTours as $virtualTour)
                            <div class="p-2 image-preview-wrapper mb-1">
                                <div class="img-vt">
                                    <img src="{{ asset('storage/' . $virtualTour->virtual_tours) }}"
                                        style="width: 100%; height: 200px">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a class="btn btn-secondary" href="{{ route('menu-wisata.index') }}">Kembali</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customStyle')
@endpush
@push('customScript')
@endpush

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
                <div class="form-group">
                    <label for="name">Nama Wisata</label>
                    <p>{{ $tour->name }}</p>
                </div>
                <div class="form-group">
                    <label for="profile_tour">Profile Wisata</label><br>
                    <img src="{{ asset('storage/' . $tour->profile_tour) }}"
                        alt="Profile Wisata" style="width: 200px; height: 150px; object-fit: cover;">
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <p>{!! $tour->description !!}</p>
                </div>
                <div class="form-group">
                    <label for="additional_images">Gambar Pendukung</label>
                    <div class="d-flex flex-wrap additional-image-preview">
                        @foreach ($tour->subimages as $image)
                            <div class="p-2 image-preview-wrapper">
                                <div class="img-thumbnail">
                                    <img src="{{ asset('storage/' . $image->subimages) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="history">Sejarah</label>
                    <p>{!! $tour->history !!}</p>
                </div>
                <div class="form-group">
                    <label for="virtual_tours">Gambar Virtual Tour</label>
                    <div class="d-flex flex-wrap virtual-image-preview">
                        @foreach ($tour->virtualTours as $virtualTour)
                            <div class="p-2 image-preview-wrapper">
                                <div class="img-vt">
                                    <img src="{{ asset('storage/' . $virtualTour->virtual_tours) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="fasilitas_km">Fasilitas Kamar Mandi</label>
                    <p>{{ $tour->fasilitas_km }}</p>
                </div>
                <div class="form-group">
                    <label for="fasilitas_tm">Fasilitas Tempat Makan</label>
                    <p>{{ $tour->fasilitas_tm }}</p>
                </div>
                <div class="form-group">
                    <label for="fasilitas_ti">Fasilitas Tempat Ibadah</label>
                    <p>{{ $tour->fasilitas_ti }}</p>
                </div>
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
                <div class="card-footer text-right">
                    <a class="btn btn-secondary" href="{{ route('menu-wisata.index') }}">Back</a>
                </div>
            </div>
        </div>
    </section>
@endsection

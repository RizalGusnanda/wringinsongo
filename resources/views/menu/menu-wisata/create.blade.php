@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Menu Wisata</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Create Wisata</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('menu-wisata.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Wisata</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Masukkan Nama Wisata" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="profile_tour">Profile Wisata</label>
                            <input type="file" class="form-control-file @error('profile_tour') is-invalid @enderror"
                                id="profile_tour" name="profile_tour" accept="image/*"
                                onchange="previewImage(event, 'profilePreview')">
                            @error('profile_tour')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <img id="profilePreview" src="#" alt="Profile Preview"
                                style="display: none; width: 250px; height: 250px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control summernote @error('description') is-invalid @enderror" id="description" name="description"
                            rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="form-group row">
                        <div class="col-md-4">
                            <label for="image1">Gambar 1</label>
                            <input type="file" class="form-control-file @error('image1') is-invalid @enderror"
                                id="image1" name="image1" accept="image/*" onchange="previewImage(event, 'preview1')">
                            @error('image1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <img id="preview1" src="#" alt="Preview"
                                style="display: none; width: 250px; height: 250px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="image2">Gambar 2</label>
                            <input type="file" class="form-control-file @error('image2') is-invalid @enderror"
                                id="image2" name="image2" accept="image/*" onchange="previewImage(event, 'preview2')">
                            @error('image2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <img id="preview2" src="#" alt="Preview"
                                style="display: none; width: 250px; height: 250px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="image3">Gambar 3</label>
                            <input type="file" class="form-control-file @error('image3') is-invalid @enderror"
                                id="image3" name="image3" accept="image/*" onchange="previewImage(event, 'preview3')">
                            @error('image3')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <img id="preview3" src="#" alt="Preview"
                                style="display: none; width: 250px; height: 250px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="image4">Gambar 4</label>
                            <input type="file" class="form-control-file @error('image4') is-invalid @enderror"
                                id="image4" name="image4" accept="image/*" onchange="previewImage(event, 'preview4')">
                            @error('image4')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <img id="preview4" src="#" alt="Preview"
                                style="display: none; width: 250px; height: 250px;">
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label for="history">Sejarah</label>
                        <textarea class="form-control summernote @error('history') is-invalid @enderror" id="history" name="history"
                            rows="3">{{ old('history') }}</textarea>
                        @error('history')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="facilities">Fasilitas</label>
                        <div class="form-group">
                            <label for="fasilitas_km">Kamar Mandi</label>
                            <select class="form-control @error('fasilitas_km') is-invalid @enderror" id="fasilitas_km"
                                name="fasilitas_km">
                                <option value="">Pilih Opsi</option>
                                <option value="Fasilitas Tersedia">Ada</option>
                                <option value="Fasilitas Tidak Tersedia">Tidak</option>
                            </select>
                            @error('fasilitas_km')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fasilitas_tm">Tempat Makanan</label>
                            <select class="form-control @error('fasilitas_tm') is-invalid @enderror" id="fasilitas_tm"
                                name="fasilitas_tm">
                                <option value="">Pilih Opsi</option>
                                <option value="Fasilitas Tersedia">Ada</option>
                                <option value="Fasilitas Tidak Tersedia">Tidak</option>
                            </select>
                            @error('fasilitas_tm')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fasilitas_ti">Tempat Ibadah</label>
                            <select class="form-control @error('fasilitas_ti') is-invalid @enderror" id="fasilitas_ti"
                                name="fasilitas_ti">
                                <option value="">Pilih Opsi</option>
                                <option value="Fasilitas Tersedia">Ada</option>
                                <option value="Fasilitas Tidak Tersedia">Tidak</option>
                            </select>
                            @error('fasilitas_ti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="maps">Lokasi</label>
                        <input type="text" class="form-control @error('maps') is-invalid @enderror" id="maps"
                            name="maps" placeholder="Lokasi Map" value="{{ old('maps') }}">
                        @error('maps')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Jenis Wisata</label>
                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                            <option value="">Pilih Jenis Wisata</option>
                            <option value="wisata tidak bertiket">Wisata Tidak Bertiket</option>
                            <option value="wisata bertiket">Wisata Bertiket</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group" id="harga_tiket_wrapper">
                        <label for="harga_tiket	">Harga Tiket</label>
                        <input type="text" class="form-control @error('harga_tiket') is-invalid @enderror"
                            id="harga_tiket" name="harga_tiket" placeholder="Masukkan Harga Tiket"
                            value="{{ old('harga_tiket') }}">
                        @error('harga_tiket')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-secondary" href="{{ route('menu-wisata.index') }}">Cancel</a>
            </div>
            </form>
        </div>

    </section>
    <script>
        .row {
            display: flex;
            flex - wrap: wrap;
        }

        .col - md - 6 {
            flex: 0 0 50 % ;
            max - width: 50 % ;
            padding - right: 15 px;
            padding - left: 15 px;
        }

        input[type = "file"] {
            width: 100 % ;
        }

        img {
            display: block;
            margin: auto;
        }
    </script>
    <script>
        function previewImage(event, previewId) {
            const input = event.target;
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const typeSelect = document.getElementById("type");
            const hargaTiketWrapper = document.getElementById("harga_tiket_wrapper");

            typeSelect.addEventListener("change", function() {
                if (this.value === "wisata bertiket") {
                    hargaTiketWrapper.style.display = "block";
                    document.getElementById("harga_tiket").setAttribute("required",
                    true);
                } else {
                    hargaTiketWrapper.style.display = "none";
                    document.getElementById("harga_tiket").removeAttribute(
                    "required");
                }
            });

            if (typeSelect.value === "wisata bertiket") {
                hargaTiketWrapper.style.display = "block";
                document.getElementById("harga_tiket").setAttribute("required",
                true);
            } else {
                hargaTiketWrapper.style.display = "none";
                document.getElementById("harga_tiket").removeAttribute(
                "required");
            }
        });

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                callbacks: {
                    onBlur: function() {
                        $(this).val($(this).summernote('code'));
                    }
                }
            });
        });
    </script>
@endsection

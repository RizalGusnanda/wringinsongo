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
                        <div class="invalid-feedback" id="name-error"></div>
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
                    <div class="form-group">
                        <label for="additional_images">Gambar Pendukung</label>
                        <div id="additionalImagesContainer"></div>
                        <button type="button" id="addImageBtn" class="btn btn-primary">Tambah Gambar</button>
                    </div>
                    <div id="imagePreviewContainer" class="mt-2 mb-3"></div>

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
                            value="{{ old('harga_tiket') }}" onkeydown="return onlyNumbers(event)"
                            oninvalid="this.setCustomValidity('Harga wisata harus diisi')"
                            oninput="setCustomValidity('')">
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
@endsection

@push('customScript')
    <script>
        $(".summernote").summernote({
            styleWithSpan: false,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
        });

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

        function onlyNumbers(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if ((charCode < 48 || charCode > 57) && (charCode > 31)) {
                return false;
            }
            return true;
        }

        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var name = $(this).val();
                if (name.length > 2) {
                    $.ajax({
                        url: '{{ route('check-tour-name') }}',
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'name': name
                        },
                        success: function(data) {
                            if (data.exists) {
                                $('#name').addClass('is-invalid');
                                $('#name-error').text(
                                    'Nama wisata sudah ada. Silakan pilih nama lain.');
                            } else {
                                $('#name').removeClass('is-invalid');
                                $('#name-error').text('');
                            }
                        }
                    });
                }
            });
        });

        function previewAdditionalImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = document.createElement("img");
                    imgElement.src = e.target.result;
                    imgElement.style.width = "250px";
                    imgElement.style.height = "250px";
                    imgElement.style.marginRight = "10px";
                    imgElement.classList.add("img-preview");

                    var container = document.getElementById("imagePreviewContainer");
                    container.appendChild(imgElement);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#addImageBtn').on('click', function() {
            var index = $('.additional-image-input').length;
            var newInputGroup = $(`
                <div class="input-group mb-3" id="inputGroup${index}">
                    <input type="file" class="form-control additional-image-input" name="additional_images[]" accept="image/*" onchange="previewAdditionalImage(this, ${index})">
                    <div class="input-group-append">
                        <button class="btn btn-danger remove-image" type="button" onclick="removeInput(${index})">Hapus</button>
                    </div>
                </div>
            `);
            $('#additionalImagesContainer').append(newInputGroup);
        });

        window.previewAdditionalImage = function(input, index) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgId = 'previewImg' + index;
                    var existingImg = document.getElementById(imgId);
                    if (!existingImg) {
                        var imgElement = document.createElement('img');
                        imgElement.id = imgId;
                        imgElement.src = e.target.result;
                        imgElement.style.width = '200px';
                        imgElement.style.height = '200px';
                        imgElement.style.marginRight = '10px';
                        imgElement.classList.add('img-preview');
                        document.getElementById('imagePreviewContainer').appendChild(imgElement);
                    } else {
                        existingImg.src = e.target.result;
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        };

        window.removeInput = function(index) {
            $('#inputGroup' + index).remove();
            $('#previewImg' + index).remove();
        };
    </script>
@endpush

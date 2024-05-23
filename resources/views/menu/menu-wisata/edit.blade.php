@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Wisata</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Edit Data Wisata</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('menu-wisata.update', $tour->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Wisata</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Masukkan Nama Wisata" value="{{ old('name', $tour->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="profile_tour">Profile Wisata</label>
                        <input type="file" class="form-control-file mb-2" id="profile_tour" name="profile_tour"
                            accept="image/*" onchange="previewImage(event, 'profilePreview')">
                        @if ($tour->profile_tour)
                            <img id="profilePreview" src="{{ asset('storage/' . $tour->profile_tour) }}"
                                alt="Profile Wisata" style="width: 200px; height: 150px; object-fit: cover;">
                        @else
                            <img id="profilePreview" src="#" alt="Profile Wisata"
                                style="display: none; width: 200px; height: 150px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control summernote @error('description') is-invalid @enderror" id="description" name="description"
                            rows="3">{{ old('description', $tour->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="additional_images">Gambar Pendukung</label>
                        <div class="d-flex flex-wrap additional-image-preview" id="additionalImagesContainer">
                            @foreach ($tour->subimages as $index => $image)
                                <div class="p-2 image-preview-wrapper" id="inputGroup{{ $index }}">
                                    <div class="img-thumbnail">
                                        <img src="{{ asset('storage/' . $image->subimages) }}">
                                        <button class="btn btn-danger remove-image specific-remove" type="button"
                                            onclick="removeExistingImage('{{ $index }}', '{{ $image->id }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="addImageBtn" class="btn btn-primary mt-2 mb-2">Tambah Gambar</button>
                        <div id="imagePreviewContainer" class="d-flex flex-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label for="history">Sejarah</label>
                        <textarea class="form-control summernote @error('history') is-invalid @enderror" id="history" name="history"
                            rows="3">{{ old('history', $tour->history) }}</textarea>
                        @error('history')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="virtual_tour">Gambar Virtual Tour</label>
                        <div class="d-flex flex-wrap virtual-image-preview" id="virtualToursContainer">
                            @foreach ($tour->virtualTours as $index => $virtualTour)
                                <div class="p-2 image-preview-wrapper" id="virtualTourGroup{{ $index }}">
                                    <div class="img-vt">
                                        <img src="{{ asset('storage/' . $virtualTour->virtual_tours) }}">
                                        <button class="btn btn-danger remove-image virtual-remove" type="button"
                                            onclick="removeExistingVirtualTourImage('{{ $index }}', '{{ $virtualTour->id }}')">
                                            <i class="fas fa-times"></i>
                                        </button>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="addVirtualTourBtn" class="btn btn-primary mt-2 mb-2">Tambah
                            Gambar</button>
                        <div id="virtualPreviewContainer" class="d-flex flex-wrap"></div>
                    </div>
                    <div class="form-group">
                        <label for="fasilitas_km">Fasilitas Kamar Mandi</label>
                        <select class="form-control @error('fasilitas_km') is-invalid @enderror" id="fasilitas_km"
                            name="fasilitas_km">
                            <option value="Fasilitas Tersedia" {{ $tour->fasilitas_km == 'Fasilitas Tersedia' ? 'selected' : '' }}>Ada</option>
                            <option value="Fasilitas Tidak Tersedia" {{ $tour->fasilitas_km == 'Fasilitas Tidak Tersedia' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('fasilitas_km')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fasilitas_tm">Fasilitas Tempat Makan</label>
                        <select class="form-control @error('fasilitas_tm') is-invalid @enderror" id="fasilitas_tm"
                            name="fasilitas_tm">
                            <option value="Fasilitas Tersedia" {{ $tour->fasilitas_tm == 'Fasilitas Tersedia' ? 'selected' : '' }}>Ada</option>
                            <option value="Fasilitas Tidak Tersedia" {{ $tour->fasilitas_tm == 'Fasilitas Tidak Tersedia' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('fasilitas_tm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fasilitas_ti">Fasilitas Tempat Ibadah</label>
                        <select class="form-control @error('fasilitas_ti') is-invalid @enderror" id="fasilitas_ti"
                            name="fasilitas_ti">
                            <option value="Fasilitas Tersedia" {{ $tour->fasilitas_ti == 'Fasilitas Tersedia' ? 'selected' : '' }}>Ada</option>
                            <option value="Fasilitas Tidak Tersedia" {{ $tour->fasilitas_ti == 'Fasilitas Tidak Tersedia' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('fasilitas_ti')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="maps">Maps</label>
                        <input type="text" class="form-control @error('maps') is-invalid @enderror" id="maps"
                            name="maps" value="{{ old('maps', $tour->maps) }}">
                        @error('maps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="type">Jenis Wisata</label>
                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                            <option value="">Pilih Jenis Wisata</option>
                            <option value="wisata tidak bertiket"
                                {{ $tour->type == 'wisata tidak bertiket' ? 'selected' : '' }}>Wisata Tidak Bertiket
                            </option>
                            <option value="wisata bertiket" {{ $tour->type == 'wisata bertiket' ? 'selected' : '' }}>
                                Wisata
                                Bertiket</option>
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
                            value="{{ old('harga_tiket', $tour->harga_tiket) }}">
                        @error('harga_tiket')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-secondary" href="{{ route('menu-wisata.index') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <style>
        .additional-image-preview .img-thumbnail {
            position: relative;
            width: 200px;
            height: 200px;
            overflow: hidden;
        }

        .additional-image-preview .img-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .additional-image-preview .specific-remove {
            display: none;
            opacity: 0.8;
            position: absolute;
            top: 7px;
            left: 6px;
        }

        .additional-image-preview .img-thumbnail:hover .specific-remove {
            display: block;
        }

        .additional-image-preview .specific-remove i {
            color: white;
        }

        .virtual-image-preview .img-vt {
            position: relative;
            width: 70%;
            overflow: hidden;
            margin: 5px;
        }

        .virtual-image-preview .img-vt img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .virtual-image-preview .virtual-remove {
            display: none;
            opacity: 0.8;
            position: absolute;
            top: 3px;
            left: 3px;
        }

        .virtual-image-preview .img-vt:hover .virtual-remove {
            display: block;
        }

        .virtual-image-preview .virtual-remove i {
            color: white;
        }
    </style>
@endsection
@push('customScript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            var file = event.target.files[0];
            if (file.size > 5120000) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ukuran gambar terlalu besar, maksimal ukuran gambar adalah 5MB.'
                });
                event.target.value = "";
                var output = document.getElementById(previewId);
                output.src = '';
                output.style.display = 'none';
            } else {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var output = document.getElementById(previewId);
                    output.src = reader.result;
                    output.style.display = 'block';
                }
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

        $('#addImageBtn').on('click', function() {
            var index = $('.additional-image-input').length;
            var newInputGroup = $(`
        <div class="input-group mb-3" id="inputGroupNew${index}">
            <input type="file" class="form-control additional-image-input" name="additional_images[]" accept="image/*" onchange="previewAdditionalImage(this, 'inputGroupNew${index}')">
            <div class="input-group-append">
                <button class="btn btn-danger remove-image" type="button" onclick="removeInput('inputGroupNew${index}')">Hapus</button>
            </div>
        </div>
    `);
            $('#additionalImagesContainer').append(newInputGroup);
        });

        function previewAdditionalImage(input, groupId) {
            var file = input.files[0];
            if (file.size > 5242880) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ukuran gambar terlalu besar, maksimal ukuran gambar pendukung adalah 5MB.'
                });
                input.value = "";
            } else {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgElement = document.createElement("img");
                    imgElement.src = e.target.result;
                    imgElement.style.width = "200px";
                    imgElement.style.height = "200px";
                    imgElement.style.marginRight = "10px";
                    imgElement.classList.add("img-preview");
                    var container = document.getElementById('imagePreviewContainer');
                    container.appendChild(imgElement);
                }
                reader.readAsDataURL(file);
            }
        }

        function removeInput(groupId) {
            var inputGroup = document.getElementById(groupId);
            if (inputGroup) {
                inputGroup.remove();
            }
            var imgPreview = document.getElementById('preview' + groupId);
            if (imgPreview) {
                imgPreview.remove();
            }
        }

        function removeExistingImage(index, imageId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (imageId) {
                        $.ajax({
                            url: '{{ route('menu-wisata.delete-image') }}',
                            type: 'POST',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'id': imageId
                            },
                            success: function(data) {
                                console.log('Image removed');
                                var inputGroup = document.getElementById('inputGroup' + index);
                                if (inputGroup) {
                                    inputGroup.remove();
                                }

                                Swal.fire(
                                    'Terhapus!',
                                    'Gambar Anda telah dihapus.',
                                    'success'
                                );
                            }
                        });
                    } else {
                        var inputGroup = document.getElementById('inputGroup' + index);
                        if (inputGroup) {
                            inputGroup.remove();
                        }
                    }
                }
            });
        }

        $('#addVirtualTourBtn').on('click', function() {
            var index = $('.virtual-tour-input').length;
            var newInputGroup = $(`
        <div class="input-group mb-3" id="virtualTourGroupNew${index}">
            <input type="file" class="form-control virtual-tour-input" name="virtual_tour[]" accept="image/*" onchange="previewVirtualImage(this, 'virtualTourGroupNew${index}')">
            <div class="input-group-append">
                <button class="btn btn-danger remove-image" type="button" onclick="removePreviewVirtualTourInput('virtualTourGroupNew${index}')">Hapus</button>
            </div>
        </div>
    `);
            $('#virtualToursContainer').append(newInputGroup);
        });

        function previewVirtualImage(input, groupId) {
            var file = input.files[0];
            if (file.size > 15728640) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ukuran gambar terlalu besar, maksimal ukuran gambar virtual tour adalah 15MB.'
                });
                input.value = "";
            } else {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var existingImg = document.getElementById('preview' + groupId);
                    if (existingImg) {
                        existingImg.src = e.target.result;
                    } else {
                        var imgElement = document.createElement("img");
                        imgElement.src = e.target.result;
                        imgElement.style.width = "400px";
                        imgElement.style.height = "auto";
                        imgElement.classList.add("img-preview");
                        imgElement.style.marginRight = "10px";
                        imgElement.style.marginBottom = "10px";
                        imgElement.id = 'preview' + groupId;
                        var container = document.getElementById('virtualPreviewContainer');
                        container.appendChild(imgElement);
                    }
                }
                reader.readAsDataURL(file);
            }
        }

        function removeExistingVirtualTourImage(index, imageId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('menu-wisata.delete-virtual-tour-image') }}',
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': imageId
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                $('#virtualTourGroup' + index).remove();
                                Swal.fire('Terhapus!', 'Gambar virtual tour Anda telah dihapus.',
                                    'success');
                            } else {
                                Swal.fire('Gagal!', data.message, 'error');
                            }
                        },
                        error: function(error) {
                            Swal.fire('Gagal!', 'Terjadi kesalahan, gambar tidak terhapus.', 'error');
                        }
                    });
                }
            });
        }


        function removePreviewVirtualTourInput(groupId) {
            var imgPreview = document.getElementById('preview' + groupId);
            if (imgPreview) {
                imgPreview.remove();
            }
            var inputGroup = document.getElementById(groupId);
            if (inputGroup) {
                inputGroup.remove();
            }
        }
    </script>
@endpush

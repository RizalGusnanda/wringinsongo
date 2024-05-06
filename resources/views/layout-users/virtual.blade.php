@extends('layout-users.layout-main.index')

@section('content')
    <div class="container">
        <h2 class="text-center mt-4 mb-3">Virtual Tour</h2>
        @if ($tourVirtuals->isEmpty())
            <div class="containnr text-center mt-5 mb-5" role="alert">
                <h6 class="text-danger mb-3">Maaf, Virtual Tour Belum Tersedia!</h6>
                <p class="px-2 text-justify">Kami sedang dalam proses menyempurnakan virtual tour untuk destinasi ini agar
                    Anda bisa menikmati keindahan destinasi secara virtual. Sementara itu, mungkin Anda ingin menjelajahi <a
                        href="/wisata" class="custom-link">destinasi lain</a> yang sudah tersedia di situs kami? Terima kasih
                    telah mengunjungi!
                    Datang kembali nanti untuk melihat update terbaru atau <a href="/contact-us" class="custom-link">hubungi
                        kami</a> jika Anda
                    memiliki pertanyaan atau saran.</p>
            </div>
        @else
            <div class="virtual-tour">
                <div id="containers" class="big-images"></div>
                <div class="small-images mt-2 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                            <button id="prevButton" class="btn btn-primary btn-rounded"><i
                                    class="fas fa-chevron-left"></i></button>
                        </div>
                        @foreach ($tourVirtuals as $index => $tourVirtual)
                            <div class="col-md-2 col-sm-6 img-thumbnail mx-1 {{ $index >= 2 ? 'd-none' : '' }}">
                                <img src="{{ asset('storage/' . $tourVirtual->virtual_tours) }}" alt="Virtual Tour Image"
                                    class="img-fluid small-image"
                                    onclick="changePanorama('{{ asset('storage/' . $tourVirtual->virtual_tours) }}')">
                            </div>
                        @endforeach
                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                            <button id="nextButton" class="btn btn-primary btn-rounded"><i
                                    class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('customScript')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r105/three.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('js/panolens.js') }}"></script>
        <style>
            .containnr {
                border-radius: 15px;
                box-shadow: 0 10px 40px 0 rgba(51, 73, 94, 0.15);
                padding: 20px;
                border: 1px solid #dc3545;
            }

            .custom-link {
                color: #dc3545;
                text-decoration: none;
            }

            .big-images {
                width: 100%;
                height: 500px;
            }

            .small-image {
                height: 100px;
                width: 100%;
            }

            .btn-rounded {
                border-radius: 50px;
                background-color: #007bff;
                color: white;
                transition: background-color 0.3s, transform 0.3s;
            }

            .btn-rounded:hover {
                background-color: #0056b3;
                transform: scale(1.05);
            }

            .small-images .row {
                display: flex;
                align-items: center;
            }

            @media (min-width: 320px) and (max-width: 767px) {
                .small-image {
                    height: 50px;
                    width: 100%;
                }

                .big-images {
                    width: 100%;
                    height: 300px;
                }

                .small-images .row .col-md-1,
                .small-images .row .col-md-2 {
                    flex: 1 0 23%;
                    max-width: 25%;
                    display: flex;
                    justify-content: center;
                    padding-left: 5px !important;
                    padding-right: 5px !important;
                }

                .small-images .img-thumbnail {
                    display: flex;
                    justify-content: center;
                }
            }
        </style>
        <script>
            $(document).ready(function() {
                var viewer = new PANOLENS.Viewer({
                    container: document.querySelector('#containers'),
                    output: 'console'
                });

                var currentPanorama;

                function changePanorama(imageUrl) {
                    if (currentPanorama) {
                        viewer.remove(currentPanorama);
                    }
                    var panorama = new PANOLENS.ImagePanorama(imageUrl);
                    viewer.add(panorama);
                    viewer.setPanorama(panorama);
                    currentPanorama = panorama;
                }

                if ($('.img-thumbnail img').length > 0) {
                    changePanorama($('.img-thumbnail img').first().attr('src'));
                }

                function showImages(index) {
                    $('.img-thumbnail').addClass('d-none');
                    for (var i = index; i < index + imagesPerPage && i < imageCount; i++) {
                        $('.img-thumbnail').eq(i).removeClass('d-none');
                    }
                }

                var currentIndex = 0;
                var imagesPerPage = 2;
                var imageCount = $('.img-thumbnail img').length;

                $('#prevButton').click(function() {
                    if (currentIndex > 0) {
                        currentIndex -= imagesPerPage;
                        currentIndex = Math.max(0, currentIndex);
                        showImages(currentIndex);
                    }
                });

                $('#nextButton').click(function() {
                    if (currentIndex + imagesPerPage < imageCount) {
                        currentIndex += imagesPerPage;
                        currentIndex = Math.min(currentIndex, imageCount - imagesPerPage);
                        showImages(currentIndex);
                    }
                });

                $('.small-image').click(function() {
                    var imageUrl = $(this).attr('src');
                    changePanorama(imageUrl);
                });

                if (imageCount <= 0) {
                    $('#containers').hide();
                } else {
                    showImages(0);
                }
            });
        </script>
    @endpush
@endsection

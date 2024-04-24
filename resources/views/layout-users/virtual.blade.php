@extends('layout-users.layout-main.index')
@section('content')
    <div class="container">
        <h2 class="text-center mt-4 mb-3">Virtual Tour</h2>
        <div class="virtual-tour">
            <div class="big-image" id="containers">

            </div>
            <div class="small-images mt-2 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button id="prevButton" class="btn btn-primary btn-rounded"><i
                                class="fas fa-chevron-left"></i></button>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <img src="{{ asset('assets/img/avatar/dummy1.png') }}" alt="Small Image 1"
                            class="img-fluid small-image">
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <img src="{{ asset('assets/img/avatar/dummy2.png') }}" alt="Small Image 2"
                            class="img-fluid small-image">
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <img src="{{ asset('assets/img/avatar/dummy3.png') }}" alt="Small Image 3"
                            class="img-fluid small-image">
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <img src="{{ asset('assets/img/avatar/dummy4.png') }}" alt="Small Image 4"
                            class="img-fluid small-image">
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <img src="{{ asset('assets/img/avatar/dummy1.png') }}" alt="Small Image 5"
                            class="img-fluid small-image">
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <img src="{{ asset('assets/img/avatar/dummy2.png') }}" alt="Small Image 6"
                            class="img-fluid small-image">
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <img src="{{ asset('assets/img/avatar/dummy3.png') }}" alt="Small Image 7"
                            class="img-fluid small-image">
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <img src="{{ asset('assets/img/avatar/dummy4.png') }}" alt="Small Image 8"
                            class="img-fluid small-image">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button id="nextButton" class="btn btn-primary btn-rounded"><i
                                class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
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
            justify-content: space-between;
            align-items: center;
        }
    </style>
    @push('customScript')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/100/three.min.js"
            integrity="sha512-PWicXuUyNjtNOMD07lPzvfU0LyteTrsmBfs1NhVAMFGnWI1v9HF4XmIHPJDbG59Yp/Q9EIvPlD4PXB5TA18mMg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/panolens.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
        <script>
            var panorama, viewer, container, infospot;

            var lookAtPosition = new THREE.Vector3(4871.39, 1088.07, -118.41);

            var infospotPosition = new THREE.Vector3(3136.06, 1216.30, -3690.14);

            container = document.querySelector('#containers');

            panorama = new PANOLENS.ImagePanorama(
                'https://pchen66.github.io/Panolens/examples/asset/textures/equirectangular/tunnel.jpg');
            panorama.addEventListener('enter-fade-start', function() {
                viewer.tweenControlCenter(lookAtPosition, 0);
            });

            infospot = new PANOLENS.Infospot(350, PANOLENS.DataImage.Info);
            infospot.position.copy(infospotPosition);
            panorama.add(infospot);

            viewer = new PANOLENS.Viewer({
                output: 'console',
                container: container
            });
            viewer.add(panorama);
        </script>
        <script>
            $(document).ready(function() {
                var container = $('#containers');

                function initializePanorama() {
                    container.empty();
                    container.css({
                        width: '100%',
                        height: '500px'
                    });

                    var panorama = new PANOLENS.ImagePanorama(
                        'https://pchen66.github.io/Panolens/examples/asset/textures/equirectangular/tunnel.jpg');
                    var viewer = new PANOLENS.Viewer({
                        output: 'console',
                        container: container[0]
                    });
                    viewer.add(panorama);

                    console.log("Panorama and viewer initialized.");
                }

                initializePanorama();

                var currentIndex = 0;
                var maxIndex = $(".small-images .row .col-md-2").length - 4;

                function showImages() {
                    $(".small-images .row .col-md-2").hide();
                    $(".small-images .row .col-md-2").slice(currentIndex, currentIndex + 4).show();
                }

                $("#prevButton").click(function() {
                    if (currentIndex > 0) {
                        currentIndex--;
                        showImages();
                    }
                });

                $("#nextButton").click(function() {
                    if (currentIndex < maxIndex) {
                        currentIndex++;
                        showImages();
                    }
                });

                showImages();
            });
        </script>
    @endpush
@endsection

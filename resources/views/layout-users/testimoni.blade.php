@extends('layout-users.layout-main.index')
@section('content')
    <main class="bg-light">
        <div class="col-md-8 mx-auto text-center">
            <h1 class="font-weight-bold contact-header mb-4">Testimoni</h1>
        </div>
        <section class="centered-section-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">

                        <div class="card shadow-lg rounded-lg p-4 mb-4">
                            <div class="card-body">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <h5 class="text-center">Nama Wisata</h5>
                                        <label for="testimoni" class="font-weight-bold">Testimoni</label>
                                        <textarea class="form-control" id="testimoni" name="testimoni" rows="4" required></textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="rating" class="font-weight-bold">Rating</label>
                                        <div class="emoji-rating">
                                            <input type="radio" id="rating1" name="rating" value="1">
                                            <label for="rating1">⭐</label>
                                            <input type="radio" id="rating2" name="rating" value="2">
                                            <label for="rating2">⭐⭐</label>
                                            <input type="radio" id="rating3" name="rating" value="3">
                                            <label for="rating3">⭐⭐⭐</label>
                                            <input type="radio" id="rating4" name="rating" value="4">
                                            <label for="rating4">⭐⭐⭐⭐</label>
                                            <input type="radio" id="rating5" name="rating" value="5">
                                            <label for="rating5">⭐⭐⭐⭐⭐</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-testim">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-4" id="testimonialCards">
                            @foreach ($wisataTidakBertiket as $wisata)
                                @if ($loop->iteration % 3 == 1)
                        </div>
                        <div class="row mt-4">
                            @endif
                            <div class="col-md-4 text-center">
                                <div class="card card-same-height">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $wisata->name }}</h5>
                                        <p class="card-text card-description">
                                            {{ \Illuminate\Support\Str::words($wisata->description, 20, '...') }}</p>
                                        <a href="#" class="btn btn-primary btn-addts card-button"
                                            onclick="showTestimonialForm('{{ $wisata->name }}')">Tambah Testimoni</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        var testimonialAdded = {};

        function showTestimonialForm(destination) {
            if (!testimonialAdded[destination]) {
                var testimonialCardHTML = `
                    <div class="col-md-12" id="testimonialCard_${destination}">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">${destination}</h5>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="testimoni_${destination}" class="font-weight-bold">Testimoni</label>
                                        <textarea class="form-control" id="testimoni_${destination}" name="testimoni_${destination}" rows="4" required></textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="rating_${destination}" class="font-weight-bold">Rating</label>
                                        <div class="emoji-rating">
                                            <input type="radio" id="rating1_${destination}" name="rating_${destination}" value="1">
                                            <label for="rating1_${destination}">⭐</label>
                                            <input type="radio" id="rating2_${destination}" name="rating_${destination}" value="2">
                                            <label for="rating2_${destination}">⭐⭐</label>
                                            <input type="radio" id="rating3_${destination}" name="rating_${destination}" value="3">
                                            <label for="rating3_${destination}">⭐⭐⭐</label>
                                            <input type="radio" id="rating4_${destination}" name="rating_${destination}" value="4">
                                            <label for="rating4_${destination}">⭐⭐⭐⭐</label>
                                            <input type="radio" id="rating5_${destination}" name="rating_${destination}" value="5">
                                            <label for="rating5_${destination}">⭐⭐⭐⭐⭐</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-testimsc">Submit</button>
                                        <button type="button" class="btn btn-secondary btn-xcls" onclick="closeTestimonialForm('${destination}')">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `;

                document.getElementById('testimonialCards').innerHTML += testimonialCardHTML;
                testimonialAdded[destination] = true;
            } else {
                alert("Anda sudah menambahkan testimonial untuk destinasi ini.");
            }
        }

        function closeTestimonialForm(destination) {
            var testimonialCard = document.getElementById('testimonialCard_' + destination);
            testimonialCard.remove();
            testimonialAdded[destination] = false;
        }
    </script>

    <style>
        .card-same-height {
            height: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card-button {
            margin-top: auto;
        }

        .card-description {
            margin-top: 10px;
        }
    </style>
@endsection

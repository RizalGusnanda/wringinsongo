@extends('layout-users.layout-main.index')

@section('content')
    <main class="bg-light">
        <div class="col-md-8 mx-auto text-center">
            <h1 class="font-weight-bold contact-header mb-4">Testimoni</h1>
        </div>
        <section class="centered-section-1">
            <div class="container">
                <div class="row justify-content-center">
                    @if ($selectedTour)
                        <div class="col-lg-10 col-md-10 col-sm-12 mb-4">
                            <div class="card shadow-lg rounded-lg p-4">
                                <div class="card-body">
                                    <h5 class="text-center">{{ $selectedTour->name }}</h5>
                                    @if (!$selectedTour->testimonis->isEmpty())
                                        <div class="alert alert-success" role="alert">
                                            Anda sudah memberikan testimoni untuk wisata ini.
                                        </div>
                                    @else
                                        <form action="{{ url('/testimoni/store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_tour" value="{{ $selectedTour->id }}">
                                            <input type="hidden" name="id_cart" value="{{ $id_cart }}">
                                            @include('components.testimonial-form')
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-10 col-md-10 col-sm-12">
                        <div class="card shadow-lg rounded-lg p-4">
                            <div class="card-body">
                                <h5 class="text-center mb-4">Wisata Tidak Bertiket</h5>
                                <div id="testimonialCards" class="row">
                                    @foreach ($wisataTidakBertiket as $wisata)
                                        <div class="col-md-3 text-center mb-3">
                                            <div class="card card-same-height">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $wisata->name }}</h5>
                                                    @if (!$wisata->hasTestimonial)
                                                        <button
                                                            onclick="showTestimonialForm('{{ $wisata->id }}', '{{ $wisata->name }}', '{{ $id_cart }}')"
                                                            class="btn btn-primary btn-addts">Tambah Testimoni</button>
                                                    @else
                                                        <div class="alert alert-success" role="alert">
                                                            Anda sudah memberikan testimoni untuk wisata ini.
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showTestimonialForm(id, name, id_cart) {
            var container = document.getElementById('testimonialCards');
            if (!document.getElementById('form_' + id)) {
                var form = `
            <div class="col-md-12" id="form_${id}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">${name}</h5>
                        <form action="{{ url('/testimoni/store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_tour" value="${id}">
                            <input type="hidden" name="id_cart" value="${id_cart}">
                            @include('components.testimonial-form')
                        </form>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger btn-xcls" onclick="closeTestimonialForm('${id}')">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            `;
                container.innerHTML += form;
            }
        }

        function closeTestimonialForm(id) {
            var formElement = document.getElementById('form_' + id);
            if (formElement) {
                formElement.remove();
            }
        }

        @if (session('success'))
            window.onload = function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            }
        @endif
    </script>
@endsection

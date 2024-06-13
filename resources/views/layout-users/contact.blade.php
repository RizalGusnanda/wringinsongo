@extends('layout-users.layout-main.index')
@section('title', 'Wringinsongo')
@section('content')
    <main class="bg-light">
        <section>
            <div class="col-md-12">
                <div class="col-md-6 mx-auto text-center ">
                    <h3 class="font-weight-bold contact-header">HUBUNGI KAMI</h3>
                    <p>Silahkan tinggalkan pesan Anda, pada kolom yang tersedia.</p>
                </div>
                <form action="{{ url('/contact-us/send') }}" method="post">
                    @csrf
                    <div class="col-md-10 my-5 mx-auto bg-white p-5 card-contact">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group form-group-margin">
                                    <label for="name" class="label-title">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" placeholder="Masukkan nama lengkap Anda"
                                        style="border-radius: 15px;" value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-group-margin">
                                    <label for="email" class="label-title">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Masukkan alamat email Anda"
                                        style="border-radius: 15px;" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group form-group-margin">
                                    <label for="message" class="label-title">Pesan</label>
                                    <textarea class="form-control form-message @error('pesan') is-invalid @enderror" id="pesan" name="pesan"
                                        rows="4" placeholder="Pesan yang ingin disampaikan...">{{ old('pesan') }}</textarea>
                                    @error('pesan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5 mx-auto img-contact">
                                <img class="img-fluid my-3" src="{{ asset('assets/img/avatar/contact.jpg') }}">
                            </div>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-send px-5">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = "{{ session('success') }}";
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: successMessage,
                    confirmButtonText: 'OK'
                });
            }

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengirim pesan!',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endsection

@push('customScript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
@endpush

@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Profile Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile Admin</div>
            </div>
        </div>
        <h2 class="section-title">Profile Superadmin</h2>

        <div class="row">
            <div class="col-12">
                @include('layouts.alert')
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 rounded-4 border-top border-top-custom-color"
                        style="border-width: 2px !important;">
                        <div class="col-md-12 text-center">
                            <h5 class="text-align-center mt-4">Foto Profile</h5>
                        </div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded-circle mb-2"
                                src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt=""
                                style="width: 150px; height: 150px;" id="preview">

                            <h5 class="mt-2 mb-2">Superadmin Wringinsongo</h5>
                            <div class="profile-widget-description text-center mr-1 ml-1">
                                Superadmins have the ability to add, edit, and delete content in the travel information
                                system. This includes information about travel destinations, guide articles, travel tips,
                                and travel-related news. They ensure that the content remains relevant, accurate, and
                                engaging for users.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-4 rounded-4 border-top border-top-custom-color"
                        style="border-width: 2px !important;">
                        <div class="col-md-12 text-center">
                            <h5 class="text-align-center mt-4 mb-1">Detail Akun</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input class="form-control" id="inputUsername" type="text" name="username"
                                    value="{{ auth()->user()->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Alamat Email</label>
                                <input class="form-control" id="inputEmailAddress" type="email" name="email"
                                    value="{{ auth()->user()->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPassword">Password Sekarang</label>
                                <input class="form-control" id="inputPassword" type="password" name="password_current">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputNewPassword">Password Baru</label>
                                <input class="form-control" id="inputNewPassword" type="password" name="password_new">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputConfirmPassword">Konnfirmasi Password Baru</label>
                                <input class="form-control" id="inputConfirmPassword" type="password"
                                    name="password_confirm">
                            </div>

                            <div class="text-center mt-4">
                                <button class="btn rounded-pill btn-primary" type="submit">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

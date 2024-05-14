<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} - Register</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section full-screen-section">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6 col-sm-6 col-lg-6 full-height-card pl-0 pr-0">
                    <div class="regist-kr">
                        <div class="card-body">
                            <div class="col mt-5">
                                <img src="{{ asset('assets/img/avatar/cuate.png') }}" class="img-register">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 full-height-card pl-0 pr-0">
                    <div class="regist-kn">
                        <div class="card-body">
                            <div class="col mt-5 welcome-text px-4">
                                <h3 class="ctn-register">Registrasi</h3>
                            </div>
                            <div class="input-container px-4">
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="first_name">Nama Lengkap</label>
                                        <input id="first_name" type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Masukkan Nama Lengkap" autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="Masukkan Alamat Email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="d-block">Password</label>
                                        <div class="input-group">
                                            <input id="password" type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan Password" data-indicator="pwindicator">
                                            <div class="input-group-append">
                                                <div class="input-group-text toggle-password">
                                                    <i class="fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password_confirmation" class="d-block">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input id="password_confirmation" type="password"
                                                name="password_confirmation" class="form-control"
                                                placeholder="Masukkan Konfirmasi Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text toggle-password-confirm">
                                                    <i class="fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block btn-responsive">
                                            Registrasi
                                        </button>
                                    </div>
                                </form>
                                <div class="text-muted text-center mb-2">
                                    <a class="text-link">Sudah punya akun?</a> <a href="/log-in"
                                        class="text-link-register">MASUK</a>
                                </div>
                                <div class="simple-footer pb-4">
                                    Copyright &copy; 2024 Desa Wringinsongo
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('user_type').value = role;
            var cards = document.getElementsByClassName('role-card');
            for (var i = 0; i < cards.length; i++) {
                cards[i].classList.remove('active');
            }
            document.getElementById(role + '-card').classList.add('active');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector(".toggle-password");
            const passwordInput = document.getElementById("password");

            togglePassword.addEventListener("click", function() {
                toggleInputType(passwordInput, this);
            });

            const togglePasswordConfirm = document.querySelector(".toggle-password-confirm");
            const passwordConfirmInput = document.getElementById("password_confirmation");

            togglePasswordConfirm.addEventListener("click", function() {
                toggleInputType(passwordConfirmInput, this);
            });

            function toggleInputType(inputField, toggleIcon) {
                if (inputField.type === "password") {
                    inputField.type = "text";
                    toggleIcon.innerHTML = '<i class="fa fa-eye"></i>';
                } else {
                    inputField.type = "password";
                    toggleIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
                }
            }
        });
    </script>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="../assets/js/page/auth-register.js"></script>

</body>
</html>

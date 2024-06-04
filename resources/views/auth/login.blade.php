<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} - Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <script async defer src="https://eu.altcha.org/js/latest/altcha.min.js" type="module"></script>

</head>

<body>
    <div id="app">
        <section class="section full-screen-section">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6 col-sm-6 col-lg-6 full-height-card pl-0 pr-0">
                    <div class="bag-kr">
                        <div class="card-body">
                            <div class="col mt-5">
                                <img src="{{ asset('assets/img/avatar/cuate.png') }}" class="img-login">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 full-height-card pl-0 pr-0">
                    <div class="bag-kn">
                        <div class="card-body">
                            <div class="col mt-5 heading-text px-4">
                                <h3 class="ctn-login">Selamat datang di Desa <img
                                        src="{{ asset('assets/img/avatar/log-wringinsongo.png') }}" class="img-seldt">
                                </h3>
                            </div>
                            <div class="col mt-2 welcome-text px-4">
                                <p>Temukan destinasi wisata terbaik disini</p>
                            </div>
                            <div class="input-container px-4 mt-4">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('login') }}" method="POST" class="needs-validation"
                                    novalidate="">
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukkan Alamat Email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="/forgot-password" class="text-small">
                                                    Lupa kata sandi?
                                                </a>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan password anda"
                                                style="border-right: none; border-radius: 15px 0px 0px 15px;">
                                            <div class="input-group-append">
                                                <div class="input-group-text toggle-password" id="password-toggle"
                                                    style="border-left: none; border-radius: 0px 15px 15px 0px; background-color: #e8f0fe; border: 1px solid #ccc; color: #000000;">
                                                    <i class="fa fa-eye-slash"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div
                                        style="background-color: #333;
                            color: #fff;
                            padding: 20px;
                            border-radius: 15px;
                            max-width: 300px;
                            margin: auto;">
                                        <altcha-widget
                                            challengeurl="https://eu.altcha.org/api/v1/challenge?apiKey=ckey_01bd6030348126fad9cdb22d5007"
                                            style=" --altcha-color-border: pink;
                                    --altcha-color-icon: pink;
                                    --altcha-color-checkbox: pink;
                                    --altcha-border-width: 3px;
                                    --altcha-border-radius: 15px;
                                    display: block;
                                    margin: auto;"></altcha-widget>
                                    </div>
                                    <div class="form-group mb-4">
                                        <button type="submit" class="btn btn-responsive" tabindex="4">
                                            Masuk
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center mb-2">
                                    <a class="text-link">Belum punya akun?</a> <a href="/register"
                                        class="text-link-register">REGISTRASI</a>
                                </div>
                                <div class="simp-foot">
                                    Copyright &copy; 2024 Desa Wringinsongo
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script async defer src="proxy.php" type="module"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.querySelector(".toggle-password");
            const passwordInput = document.querySelector("input[name='password']");
            const passwordToggleWrapper = document.querySelector("#password-toggle");

            togglePassword.addEventListener("click", function() {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    togglePassword.innerHTML = '<i class="fa fa-eye"></i>';
                } else {
                    passwordInput.type = "password";
                    togglePassword.innerHTML = '<i class="fa fa-eye-slash"></i>';
                }
                passwordInput.classList.add("password-focused");
            });

            passwordInput.addEventListener("focus", function() {
                passwordToggleWrapper.style.borderColor = "#808eec";
                this.classList.add("password-focused");
            });

            passwordInput.addEventListener("blur", function() {
                passwordToggleWrapper.classList.remove("password-toggle-focus");
                passwordToggleWrapper.classList.add("password-toggle-blur");
            });
        });
    </script>
</body>

</html>
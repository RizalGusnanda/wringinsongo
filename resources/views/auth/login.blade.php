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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <style>
        .card-body {
            height: 100vh;
            width: 100%;
            overflow: auto;
        }

        .heading-text h3 {
            margin-left: 30px;
        }

        .welcome-text {
            padding-left: 50px;
            font-size: 14px;
            color: #1F3C88;
            margin-bottom: -10px;
        }

        .rounded-input {
            border-radius: 15px;
        }

        .welcome-text {
            padding-left: 50px;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            gap: 0px;
            margin-top: 20px;
            margin-left: 50px;
            margin-right: 50px;
        }

        .input-container input[type="email"],
        .input-container input[type="password"] {
            border-radius: 15px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .text-link {
            color: #6C757D;

        }

        .text-link-register {
            color: #EE6F57;

        }

        .btn.btn-lg {
            padding: 0.55rem 1.5rem;
            font-size: 12px;

        }

        .input-container button {
            border-radius: 15px;
            padding: 10px;
        }

        .btn-responsive {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        .password-focused {
            border-color: #808eec !important;
        }

        @media (max-width: 767px) {
            .full-height-card {
                height: auto;
            }

            .full-screen-card {
                height: auto;
            }

            .card-body {
                height: auto;
                overflow: visible;
            }

            .heading-text h3 {
                font-size: 16px;
                margin-left: 0px;
            }

            .full-height-card img {
                width: 100%;
            }

            .welcome-text {
                padding-left: 10px;
                padding-right: 20px;
                font-size: 12px;
            }

            .input-container {
                margin: 20px 10px;
            }

            .input-container input[type="email"],
            .input-container input[type="password"] {
                border-radius: 10px;
                padding: 8px;
                border: 1px solid #ccc;
            }

            .btn.btn-lg {
                padding: 0.45rem 1.25rem;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section full-screen-section p-0">
            <div class="row d-flex justify-content-between m-0">
                <div class="col-md-6 col-sm-6 col-lg-6 full-height-card">
                    <div style="background-color: rgba(31, 60, 136, 0.90);">
                        <div class="card-body">
                            <div class="col mt-1">
                                <img src="{{ asset('assets/img/avatar/Wringinsongo.png') }}" alt=""
                                    srcset="" style="width: 35%">
                            </div>
                            <div class="col mt-5">
                                <img src="{{ asset('assets/img/avatar/cuate.png') }}" alt="" srcset=""
                                    style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-6 full-height-card">
                    <div style="background-color:#ffffff;">
                        <div class="card-body">
                            <div class="col mt-5 heading-text">
                                <h3 style="color: #000000">Selamat datang di desa <img
                                        src="{{ asset('assets/img/avatar/Wringinsongo.png') }}" alt=""
                                        srcset="" style="width: 35%;"></h3>
                            </div>
                            <div class="col mt-4 welcome-text">
                                <p>Temukan destinasi wisata terbaik disini</p>
                            </div>

                            <div class="input-container">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form action="{{ route('login') }}" method="POST" class="needs-validation"
                                    novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Masukkan Alamat Email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
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
                                    <div class="form-group" style="margin-bottom: -20px;">
                                        <button type="submit" class="btn btn-lg btn-block btn-responsive"
                                            tabindex="4"
                                            style="background-color: rgba(31, 60, 136, 0.90); color: #fff;">
                                            Masuk
                                        </button>
                                    </div>
                                </form>
                                <div class="mt-5 text-center" style="margin-bottom: -30px;">
                                    <a class="text-link">Belum punya akun?</a> <a href="/register"
                                        class="text-link-register">REGISTRASI</a>
                                </div>
                                <div class="simple-footer">
                                    Copyright &copy; 2024 Design By Muchamad Rizal Gusnanda Atmaja
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

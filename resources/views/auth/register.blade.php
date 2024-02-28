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
            font-size: 24px;
            color: #000000;
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

        .input-container input[type="text"],
        .input-container input[type="email"],
        .input-container input[type="password"] {
            border-radius: 15px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .text-link {
            color: #1F3C88;
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

            .input-container input[type="name"],
            .input-container input[type="email"],
            .input-container input[type="password"],
            .input-container .input[type="password_confirmation"] {
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
                    <div style="background-color:rgba(31, 60, 136, 0.90);">
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
                    <div style="background-color:#fff;">
                        <div class="card-body">
                            <div class="col mt-5 welcome-text">
                                <h3 style="color: #000000">Registrasi</h3>
                            </div>

                            <div class="input-container">
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf

                                    <div class="form-group" style="margin-bottom: 15px;">
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

                                    <div class="form-group" style="margin-bottom: 15px;">
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

                                    <div class="form-group" style="margin-bottom: 15px;">
                                        <label for="password" class="d-block">Password</label>
                                        <div class="input-group">
                                            <input id="password" type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Masukkan Password" data-indicator="pwindicator">
                                            <div class="input-group-append">
                                                <div class="input-group-text toggle-password" style="cursor: pointer; border-radius: 0px 15px 15px 0px; border: 1px solid #ccc; color: #000000;">
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

                                    <div class="form-group" style="margin-bottom: 15px;">
                                        <label for="password_confirmation" class="d-block">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input id="password_confirmation" type="password"
                                                name="password_confirmation" class="form-control"
                                                placeholder="Masukkan Konfirmasi Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text toggle-password-confirm"
                                                    style="cursor: pointer; border-radius: 0px 15px 15px 0px; border: 1px solid #ccc; color: #000000;">
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

                                    <div class="form-group" style="margin-bottom: -15px;">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block btn-responsive"
                                            style="background-color: rgba(31, 60, 136, 0.90); color: #fff;">
                                            Registrasi
                                        </button>
                                    </div>
                                </form>
                                <div class="mt-5 text-muted text-center" style="margin-bottom: -35px;">
                                    <a class="text-link">Sudah punya akun?</a> <a href="/login"
                                        class="text-link-register">MASUK</a>
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

    <script>
        // Script to handle role selection
        function selectRole(role) {
            document.getElementById('user_type').value = role;
            var cards = document.getElementsByClassName('role-card');
            for (var i = 0; i < cards.length; i++) {
                cards[i].classList.remove('active');
            }
            document.getElementById(role + '-card').classList.add('active');
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Handle toggle for password field
            const togglePassword = document.querySelector(".toggle-password");
            const passwordInput = document.getElementById("password");

            togglePassword.addEventListener("click", function() {
                toggleInputType(passwordInput, this);
            });

            // Handle toggle for confirm password field
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

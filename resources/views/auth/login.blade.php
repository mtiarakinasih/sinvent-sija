<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/shop-solid.svg')}}">
    <link rel="icon" type="image/svg" href="{{asset('img/shop-solid.svg')}}">
    <title>Login - Sistem Inventory</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12"></div>
        </div>
    </div>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <small class="mb-0">Masukkan email dan kata sandi untuk akses Sistem Inventory SIJA</small>
                                </div>
                                <div class="card-body">
                                    <form class="user" method="POST" action="{{ route('login.submit') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="email" value="{{ old('email') }}">
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" id="passwordField">
                                            <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        @if($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <button class="btn bg-gradient-dark btn-primary btn-lg w-100 mt-4 mb-0" type="submit">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Belum punya akun?
                                        <a href="register" class="text-dark font-weight-bolder">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('/assets/img/sign up.jpg'); background-size: cover; background-color: black;">
                                <span class="mask opacity-6" style="background-color: black;"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Great companies are built on great products"</h4>
                                <p class="text-white position-relative"><b>– Elon Musk</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        // Password toggle visibility
        const passwordField = document.getElementById('passwordField');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                togglePassword.classList.remove('fa-eye');
                togglePassword.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                togglePassword.classList.remove('fa-eye-slash');
                togglePassword.classList.add('fa-eye');
            }
        });
    </script>
    <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
</body>

</html>

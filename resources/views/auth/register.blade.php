<!--
=========================================================
* Argon Dashboard 3 - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/shop-solid.svg')}}">
  <link rel="icon" type="image/svg" href="{{asset('img/shop-solid.svg')}}">
  <title>
    Register-Sistem Inventory 
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('/assets/img/invent.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
            <p class="text-lead text-white">Daftar akun baru untuk menggunakan Sistem Inventory SIJA</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
  <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
      <div class="card z-index-0">
        <div class="card-body">
          <form class="user" action="{{ route('register') }}" method="POST">
            @csrf <!-- Token CSRF untuk melindungi form -->
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" name="first_name" id="exampleFirstName" placeholder="First Name" value="{{ old('first_name') }}">
                @error('first_name')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" name="last_name" id="exampleLastName" placeholder="Last Name" value="{{ old('last_name') }}">
                @error('last_name')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="form-group">
              <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address" value="{{ old('email') }}">
              @error('email')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0 position-relative">
                <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password">
                <i id="togglePassword" class="fas fa-eye" onclick="togglePasswordVisibility('exampleInputPassword', 'togglePassword')" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 1;"></i>
            @error('password')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="col-sm-6 position-relative">
                <input type="password" class="form-control form-control-user" name="password_confirmation" id="exampleRepeatPassword" placeholder="Repeat Password">
                <i id="toggleRepeatPassword" class="fas fa-eye" onclick="togglePasswordVisibility('exampleRepeatPassword', 'toggleRepeatPassword')" style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 1;"></i>
            </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn bg-gradient-dark btn-primary btn-lg w-100 my-4 mb-2">Sign up</button>
            </div>
            <p class="text-center text-sm mt-3 mb-0">Sudah punya akun? <a href="login" class="text-dark font-weight-bolder">Sign in</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    function togglePasswordVisibility(inputId, iconId) {
    const passwordField = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);

    if (passwordField.type === 'password') {
        passwordField.type = 'text'; // Ubah tipe input jadi text (password terlihat)
        toggleIcon.classList.remove('fa-eye'); // Ganti ikon mata terbuka
        toggleIcon.classList.add('fa-eye-slash'); // Ganti ke ikon mata tertutup
    } else {
        passwordField.type = 'password'; // Kembalikan tipe input jadi password (password tersembunyi)
        toggleIcon.classList.remove('fa-eye-slash'); // Ganti ikon mata tertutup
        toggleIcon.classList.add('fa-eye'); // Ganti ke ikon mata terbuka
    }
}



  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>

</html>
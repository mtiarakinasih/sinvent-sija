<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/shop-solid.svg')}}">
  <link rel="icon" type="image/svg" href="{{asset('assets/img/shop-solid.svg')}}">
  <title>Sistem Inventory SIJA</title>
  
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Argon Dashboard CSS -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-dark position-absolute w-100"></div>
  
  <!-- Sidebar -->
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
    <i class="fa-solid fa-shop" style="font-size: 26px;"></i>  <!-- Ganti dengan ikon yang diinginkan -->
    <span class="ms-1 font-weight-bold">Sinvent Tim-12</span>
</a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="dashboard">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-house text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li> 
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Inventory</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);" onclick="toggleDropdown('barangDropdownIcon')">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-box-open text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Barang</span>
            <i class="fas fa-chevron-down ms-auto" id="barangDropdownIcon"></i>
          </a>
          <ul class="navbar-nav" id="barangDropdown" style="display: none; padding-left: 30px;">
            <li class="nav-item"><a class="nav-link" href="{{ route('barang.index') }}">Daftar Barang</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('barangmasuk.index') }}">Barang Masuk</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('barangkeluar.index') }}">Barang Keluar</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kategori">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-table-list text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Logout</h6>
        </li>
        <li class="nav-item">
  <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
      <i class="fas fa-sign-out-alt text-dark text-sm opacity-10"></i>
    </div>
    <span class="nav-link-text ms-1">Logout</span>
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
  </form>
</li>

      </ul>
    </div>
  </aside>
  
  <!-- Main content -->
  <main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
     
    <!-- Content Section -->
    <div class="container mt-4">
      <div class="row">
        <!-- Main Content Column -->
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
    </div>
  </main>

  <!-- Core JS Files -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>

  <!-- Sidebar Dropdown Script -->
  <script>
    function toggleDropdown(iconId) {
      var dropdown = document.getElementById("barangDropdown");
      var icon = document.getElementById(iconId);
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
      icon.classList.toggle("fa-chevron-up");
      icon.classList.toggle("fa-chevron-down");
    }
  </script>
</body>

</html>

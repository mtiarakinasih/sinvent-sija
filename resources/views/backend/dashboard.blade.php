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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />
  <title>
    Sistem Inventory SIJA
  </title>
  <style>
    #greeting {
            color: white; /* Mengubah warna teks menjadi putih */
            font-size: 3em;
            font-weight: bold;
        }
 </style>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- FullCalendar CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<style>
  #calendar {
    background-color: #f8f9fa; /* Light grey background to match theme */
    color: #343a40; /* Dark text color */
    padding: 15px;
    border-radius: 8px;
  }
  .fc-toolbar {
    color: #343a40; /* Dark color for the toolbar */
  }
  .navbar-nav .dropdown-toggle .text-white {
    font-size: 1.1rem; /* Increase font size */
    font-weight: bold;
    margin-right: 8px; /* Space between username and profile picture */
  }

  /* Adjust profile image size */
  .navbar-nav .img-profile {
    width: 35px; /* Adjusted size for better balance */
    height: 35px;
    object-fit: cover; /* Ensures image keeps shape within container */
  }

  /* Align dropdown */
  .navbar-nav .dropdown-menu {
    right: 0;
    left: auto;
    transform: translateX(-10%); /* Adjust dropdown alignment */
  }
  /* Reduce padding for dropdown items */
.dropdown-menu .dropdown-item {
  padding: 8px 12px; /* Decrease padding to make it more compact */
  font-size: 14px; /* Adjust font size if needed */
}

/* Adjust the height of the dropdown menu */
.dropdown-menu {
  padding: 5px; /* Reduce the overall padding */
  min-width: 120px; /* Adjust width if you want a more compact width */
  max-height: 150px; /* Set a maximum height if needed */
}

/* Optional: Adjust icon spacing */
.dropdown-item i {
  margin-right: 8px; /* Decrease margin to make it tighter */
}

</style>

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-dark position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
    <i class="fa-solid fa-shop" style="font-size: 26px;"></i>  <!-- Ganti dengan ikon yang diinginkan -->
    <span class="ms-1 font-weight-bold">Sinvent Tim-12</span>
</a>

    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
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


        <script>
          function toggleDropdown(iconId) {
            var dropdown = document.getElementById("barangDropdown");
            var icon = document.getElementById(iconId);
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            icon.classList.toggle("fa-chevron-up");
            icon.classList.toggle("fa-chevron-down");
          }
        </script>

        <li class="nav-item">
          <a class="nav-link " href="kategori">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-table-list text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav justify-content-end">
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle d-flex align-items-center"  id="userDropdown" role="button"
       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img class="img-profile rounded-circle me-2" src="{{ asset('assets/img/undraw_profile.svg') }}" alt="User Profile Image">
      <span class="d-none d-lg-inline text-white small">{{ Auth::user()->name }}</span>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
      </a>
    </div>
  </li>
</ul>


<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Siap untuk Keluar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Pilih 'Logout' di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">KEMBALI</button>
        <a href="{{ route('logout') }}" class="btn btn-primary"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          LOGOUT
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>



<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
  <div class="row">
    <h1 id="greeting"></h1>
  </div>

  <!-- Chart and Calendar Section (2 columns) -->
  <div class="row mt-4">
  <!-- Chart with 7-column width -->
  <div class="row">
    <!-- Chart Column -->
    <div class="col-lg-7 mb-lg-0 mb-4">
    <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize text-center">Diagram Kategori Barang</h6>
            <p class="text-sm mb-0 text-center">Grafik jumlah kategori barang di jurusan SIJA.</p>
        </div>
        <div class="card-body d-flex justify-content-center align-items-center p-3" style="height: 300px;">
            @if($categories->isEmpty())
                <p>No data available to display in the chart.</p>
            @else
                <canvas id="chart-category" class="chart-canvas" style="width: 100%; max-width: 300px; height: auto;"></canvas>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('chart-category');
        if (ctx) {
            const categoryChart = new Chart(ctx, {
                type: 'pie', // or 'bar'
                data: {
                    labels: {!! json_encode($categories->pluck('kategori')->toArray()) !!},
                    datasets: [{
                        data: {!! json_encode($categories->pluck('jumlah')->toArray()) !!}, // Menggunakan jumlah asli
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'], // Tambah warna jika diperlukan
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });
        }
    });
</script>



    <!-- Calendar Column -->
    <div class="col-lg-5">
        <div class="card card-carousel overflow-hidden h-100 p-0">
            <div id="calendar" class="h-100" style="height: 200px;"></div>
        </div>
    </div>
</div>      
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
              <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
              <script>
        // Menampilkan tahun saat ini
        document.write(`
    <div style="text-left: center;">
        © ${new Date().getFullYear()} Sinvent Tim-12
    </div>
`);


        // Salam berdasarkan waktu
        const username = "{{ Auth::user()->name }}"; 
        const currentHour = new Date().getHours();
        let greetingMessage;

        if (currentHour >= 5 && currentHour < 10) {
            greetingMessage = `Selamat Pagi, ${username}!`;
        } else if (currentHour >= 10 && currentHour < 15) {
            greetingMessage = `Selamat Siang, ${username}!`;
        } else if (currentHour >= 15 && currentHour < 18) {
            greetingMessage = `Selamat Sore, ${username}!`;
        } else {
            greetingMessage = `Selamat Malam, ${username}!`;
        }
        // Menampilkan greeting pada elemen dengan id "greeting"
        document.getElementById('greeting').textContent = greetingMessage;
    </script>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
  <!-- jQuery (jika belum ada) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- FullCalendar JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>


<div id="calendar"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev today',
        center: 'title',
        right: 'next'
      },
      editable: true,
      events: []  // Empty events for now; can be dynamically loaded as needed
    });
  });

</script>

</body>

</html>
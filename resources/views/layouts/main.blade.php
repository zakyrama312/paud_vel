{{-- @extends('layouts.navbar') --}}
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Paud Islam Qurrota'ayun</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('/')}}assets/images/logos/favicon.ico" />
  <link rel="stylesheet" href="{{ asset('/')}}assets/css/styles.min.css" />
  <link rel="stylesheet" href="{{ asset('/')}}assets/css/mystyle.css" />
  <link rel="stylesheet" href="{{ asset('/')}}assets/datatables/datatables.min.css" />
  <link rel="stylesheet" href="{{ asset('/') }}assets/datatables/Buttons-2.4.2/css/buttons.bootstrap.min.css">
    <!-- atau -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/datatables/Buttons-2.4.2/css/buttons.bootstrap4.min.css">
     <!-- Tambahkan CSS Select2 -->
     <link rel="stylesheet" href="{{ asset('/') }}assets/select2/select2.min.css" />
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"> --}}



</head>
<style>
    /* CSS untuk mengatur posisi ikon panah */
.sidebar-link .toggle-arrow {
    float: right;
    transition: transform 0.3s ease;
}

/* CSS untuk mengubah arah panah saat dropdown dibuka */
.sidebar-link[aria-expanded="true"] .toggle-arrow {
    transform: rotate(180deg);
}

.dataTables_length {
    margin-left: -30px;
    margin-top: 15px;
}

.dt-buttons {
    /* margin-left: 15px; */
}

.dataTables_filter{
    color: black;
}

.select2-container {
    z-index: 9999 !important; /* Atur z-index lebih tinggi dari modal */
}

.select2-container .select2-results__option {
    color: #000; /* Warna teks di dropdown menjadi hitam */
}
.table-responsive {
    overflow: auto; /* Masih memungkinkan scroll */
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
}

.table-responsive::-webkit-scrollbar {
    display: none; /* Safari and Chrome */
}

@media print {
    tfoot .total-label {
        display: none;
    }
}

.dt-button-collection {
    display: none;
}

tfoot .total-label {
    display: inline;
}

</style>
<body >
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
     <aside class="left-sidebar" >
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            {{-- <img src="{{ asset('/')}}assets/images/logos/dark-logo.svg" width="180" alt="" /> --}}
            <img src="{{ asset('/')}}assets/images/logos/paud.png" width="180" alt="">
            {{-- <h3 class="brand">Paud Vel</h3> --}}
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" >
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Beranda</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('dashboard') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
             <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Laporan</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('infaq') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-books"></i>
                </span>
                <span class="hide-menu">Harian Infaq</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pembayaran') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-books"></i>
                </span>
                <span class="hide-menu">Pembayaran Biaya</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pengeluaran') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-books"></i>
                </span>
                <span class="hide-menu">Pengeluaran Dana</span>
              </a>
            </li>

            @if(Auth::user()->role == 'admin')

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Menu</span>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('siswa') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Siswa</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('kelas') }}" aria-ed="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Kelas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('jenis') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-check"></i>
                </span>
                <span class="hide-menu">Jenis Infaq</span>
              </a>
            </li> --}}
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pembukuan') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-books"></i>
                </span>
                <span class="hide-menu">Pembukuan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('penggajian') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-books"></i>
                </span>
                <span class="hide-menu">Penggajian</span>
              </a>
            </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('guru') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-wallpaper"></i>
                    </span>
                    <span class="hide-menu">Guru</span>
                </a>
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('pengguna') }}" aria-expanded="false">
                    <span>
                    <i class="ti ti-wallpaper"></i>
                    </span>
                    <span class="hide-menu">Pengguna</span>
                </a>
                </li>

            @endif


          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper" >
      <!--  Header Start -->
      <header class="app-header" >
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                {{-- <i class="ti ti-bell-ringing"></i> --}}
                {{-- <div class="notification bg-primary rounded-circle"></div> --}}
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav" >
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              {{-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> --}}
              <li style="color: black">
                {{ Auth::user()->name }}
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('/')}}assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a> --}}
                    <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container" >
        <!--  Row 1 -->
        <div class="row" >
          <div class="col-lg-12 d-flex align-items-strech" >
            <div class="card card-content w-100"  >
              @yield('content')
            </div>
          </div>
        </div>
        {{-- <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a></p>
        </div> --}}
      </div>
    </div>
  </div>
  @extends('layouts.footer')

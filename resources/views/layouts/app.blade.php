<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/asset/logo_kemenag.png') }}" type="image/x-icon">


    
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    {{-- datatable cdn --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}

    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    {{-- leaflet js --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/style.css', 'resources/css/slick.css','resources/css/slick-theme.css','resources/js/slick.min.js', 'resources/js/slick.js', 'resources/css/leaflet-search.css' ])


    {{-- link asset --}}

</head>
{{-- <body>
  <div id="app">
      <nav class="navbar  navbar-expand-md navbar-light bg-white shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  {{ config('app.name', 'Laravel') }}
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav me-auto">

                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ms-auto">
                      <!-- Authentication Links -->
                      @guest
                          @if (Route::has('login'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                              </li>
                          @endif

                          @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                              </li>
                          @endif
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }}
                              </a>

                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                      {{ __('Logout') }}
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                      @csrf
                                  </form>
                              </div>
                          </li>
                      @endguest
                  </ul>
              </div>
          </div>
      </nav>

      <main class="py-4">
          @yield('content')
      </main>
  </div>
</body> --}}

@yield('css')



<body id="body-pd">
    @if (!(Route::is('login') || Route::is('register')))
        <header class="header shadow-sm" id="header">
            <div class="header_toggle">
                <i class="bx bx-menu" id="header-toggle"></i>
            </div>
            @guest
                  
                        @if (Route::has('login'))
                        <div class="me-2 ms-auto ">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                        </div>
                    @endif
    
                    @if (Route::has('register'))
                        <div class="me-0 ms-0">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                        </div>
                    @endif
                   
            @else
                <span class="me-2 d-none d-lg-inline text-secondary text-decoration-none ms-auto text-capitalize">
                    {{ Auth::user()->name }}
                </span>
                <div class="dropdown-center ">

                    <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="header_img">
                            @php
                                $photoProfil = Auth::user()->photo_profil;
                            @endphp

                            @if (!$photoProfil)
                                <!-- Tampilkan avatar default -->
                                <img src="{{ asset('images/profile_photos/default.jpg') }}" alt="Avatar Default">
                            @else
                                <!-- Tampilkan foto profil pengguna -->
                                <img src="{{ asset('images/profile_photos/' . $photoProfil) }}" alt="Foto Profil Pengguna">
                            @endif

                        </div>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in ms-auto"
                        aria-labelledby="userDropdown">
                        @if(Auth::User()->user_role == "admin")
                        <a class="dropdown-item" href="{{ route('admin.profile', ['id' => Auth::user()->id]) }}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            {{ 'Profil' }}
                        </a>
                        @elseif(Auth::User()->user_role == "updater")
                        <a class="dropdown-item" href="{{ route('updater.profile', ['id' => Auth::user()->id]) }}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            {{ 'Profil' }}
                        </a>
                        @elseif(Auth::User()->user_role == "viewer")
                        <a class="dropdown-item" href="{{ route('viewer.profile', ['id' => Auth::user()->id]) }}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            {{ 'Profil' }}
                        </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                            {{ 'Keluar' }}
                        </a>
                    </div>
                </div>
            @endguest
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                @if(!Auth::User())
                <div>
                    <a href="" class="nav_logo text-decoration-none">
                            <img src="{{ asset('images/asset/logo_kemenag.png') }}" alt="logo kemanag" style="width: 25px" >
                            <span class="nav_logo-name text-capitalize">Guest</span>
                    </a>
                    <div class="nav_list">
                        <a href="{{ route('guest.map_view') }}" class="nav_link text-decoration-none {{ request()->is('guest/map_view*') ? 'active' : '' }}">
                            <i class="bx bx-map-alt nav_icon"></i>
                            <span class="nav_name">{{ 'Peta Pesantren' }}</span>
                        </a>

                        <a href="{{ route('guest.data_ponpes') }}" class="nav_link text-decoration-none {{ request()->is('guest/data_ponpes*') ? 'active' : '' }}">
                            <i class="bx bx-buildings nav_icon"></i>
                            <span class="nav_name">{{ 'Data Pesantren' }}</span>
                        </a>


                        <a href="{{ route('guest.data_statistik') }}" class="nav_link text-decoration-none {{ request()->is('guest/data_statistik*') ? 'active' : '' }}"">
                            <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                            <span class="nav_name">{{ 'Statistik Pesantren' }}</span>
                        </a>

                    </div>
                </div>
                @elseif(Auth::User()->user_role == "admin")
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="nav_logo text-decoration-none">
                            <img src="{{ asset('images/asset/logo_kemenag.png') }}" alt="logo kemanag" style="width: 25px" >
                            <span class="nav_logo-name text-capitalize">{{ Auth::User()->user_role }}</span>
                    </a>
                    <div class="nav_list">
                        <a href="{{ route('admin.dashboard') }}" class="nav_link text-decoration-none {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                            <i class="bx bx-grid-alt nav_icon"></i>
                            <span class="nav_name">{{ 'Dashboard' }}</span>
                        </a>
                        <a href="{{ route('admin.map_view') }}" class="nav_link text-decoration-none {{ request()->is('admin/map_view*') ? 'active' : '' }}">
                            <i class="bx bx-map-alt nav_icon"></i>
                            <span class="nav_name">{{ 'Peta Pesantren' }}</span>
                        </a>

                        <a href="{{ route('admin.data_ponpes') }}" class="nav_link text-decoration-none {{ request()->is('admin/data_ponpes*') ? 'active' : '' }}">
                            <i class="bx bx-buildings nav_icon"></i>
                            <span class="nav_name">{{ 'Data Pesantren' }}</span>
                        </a>

                        <a href="{{ route('admin.data_account') }}" class="nav_link text-decoration-none {{ request()->is('admin/data_account*') ? 'active' : '' }}">
                            <i class="bx bxs-user-account nav_icon"></i>
                            <span class="nav_name">{{ 'Akun Pengguna' }}</span>
                        </a>

                        <a href="{{ route('admin.data_statistik') }}" class="nav_link text-decoration-none {{ request()->is('admin/data_statistik*') ? 'active' : '' }}"">
                            <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                            <span class="nav_name">{{ 'Statistik Pesantren' }}</span>
                        </a>

                        <a href="{{ route('admin.data_report') }}" class="nav_link text-decoration-none {{ request()->is('admin/data_report*') ? 'active' : '' }}"">
                            <i class="bx bxs-report nav_icon"></i>
                            <span class="nav_name">{{ 'Pelaporan' }}</span>
                        </a>

                    </div>
                </div>
                @elseif(Auth::User()->user_role == "updater")
                <div>
                    <a href="{{ route('updater.dashboard', ['id' => Auth::User()->id]) }}" class="nav_logo text-decoration-none">
                            <img src="{{ asset('images/asset/logo_kemenag.png') }}" alt="logo kemanag" style="width: 25px" >
                            <span class="nav_logo-name text-capitalize">{{ Auth::User()->user_role }}</span>
                    </a>
                    <div class="nav_list">
                        <a href="{{ route('updater.dashboard', ['id' => Auth::User()->id]) }}" class="nav_link text-decoration-none {{ request()->is('updater/dashboard*') ? 'active' : '' }}">
                            <i class="bx bx-grid-alt nav_icon"></i>
                            <span class="nav_name">{{ 'Dashboard' }}</span>
                        </a>
                        <a href="{{ route('updater.ponpes_view',['id'=>Auth::User()->id]) }}" class="nav_link text-decoration-none {{ request()->is('updater/ponpes_view*') ? 'active' : '' }}">
                            <i class="bx bx-buildings nav_icon"></i>
                            <span class="nav_name">{{ 'Data Pesantren' }}</span>
                        </a>

                    </div>
                </div>

                @elseif(Auth::User()->user_role == "viewer")
                <div>
                    <a href="" class="nav_logo text-decoration-none">
                            <img src="{{ asset('images/asset/logo_kemenag.png') }}" alt="logo kemanag" style="width: 25px" >
                            <span class="nav_logo-name text-capitalize">viewer</span>
                    </a>
                    <div class="nav_list">
                        <a href="{{ route('viewer.map_view') }}" class="nav_link text-decoration-none {{ request()->is('viewer/map_view*') ? 'active' : '' }}">
                            <i class="bx bx-map-alt nav_icon"></i>
                            <span class="nav_name">{{ 'Peta Pesantren' }}</span>
                        </a>

                        <a href="{{ route('viewer.data_ponpes') }}" class="nav_link text-decoration-none {{ request()->is('viewer/data_ponpes*') ? 'active' : '' }}">
                            <i class="bx bx-buildings nav_icon"></i>
                            <span class="nav_name">{{ 'Data Pesantren' }}</span>
                        </a>


                        <a href="{{ route('viewer.data_statistik') }}" class="nav_link text-decoration-none {{ request()->is('viewer/data_statistik*') ? 'active' : '' }}"">
                            <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                            <span class="nav_name">{{ 'Statistik Pesantren' }}</span>
                        </a>

                        <a href="{{ route('viewer.data_report', ['id'=>Auth::User()->id]) }}" class="nav_link text-decoration-none {{ request()->is('viewer/data_report*') ? 'active' : '' }}"">
                            <i class="bx bxs-report nav_icon"></i>
                            <span class="nav_name">{{ 'Riwayat Laporan' }}</span>
                        </a>


                    </div>
                </div>
          
                @endif
            </nav>
        </div>
    @endif
    <div class="container ">
        @yield('content')
    </div>

   



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>


  <!-- Footer -->
  <footer class="footer border-top border-secondary mt-5 py-3">
    <div class="container text-center">
      <span>&copy; 2023 Nama Perusahaan. All rights reserved.</span>
    </div>
  </footer>
  <!-- End Footer -->

</body>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js"></script>





<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId);

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener("click", () => {
                    // show navbar
                    nav.classList.toggle("show-side");
                    // change icon
                    toggle.classList.toggle("bx-x");
                    // add padding to body
                    bodypd.classList.toggle("body-pd");
                    // add padding to header
                    headerpd.classList.toggle("body-pd");
                });
            }
        };

        showNavbar("header-toggle", "nav-bar", "body-pd", "header");

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll(".nav_link");

        function colorLink() {
            if (linkColor) {
                linkColor.forEach((l) => l.classList.remove("active"));
                this.classList.add("active");
            }
        }
        linkColor.forEach((l) => l.addEventListener("click", colorLink));

        // Your code to run since DOM is loaded and ready
    });
</script>
@stack('javascript')

</html>

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
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/style.css', 'resources/css/slick.css', 'resources/css/slick-theme.css', 'resources/js/slick.min.js', 'resources/js/slick.js', 'resources/css/leaflet-search.css'])


    {{-- link asset --}}

</head>

@yield('css')



<body id="body-pd">

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
                    @if (Auth::User()->user_role == 'admin kemenag')
                        <a class="dropdown-item" href="{{ route('admin_kemenag.profile', ['id' => Auth::user()->id]) }}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            {{ 'Profil' }}
                        </a>
                    @elseif(Auth::User()->user_role == 'admin pesantren')
                        <a class="dropdown-item" href="{{ route('admin_pesantren.profile', ['id' => Auth::user()->id]) }}">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            {{ 'Profil' }}
                        </a>
                    @elseif(Auth::User()->user_role == 'pelapor')
                        <a class="dropdown-item" href="{{ route('pelapor.profile', ['id' => Auth::user()->id]) }}">
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
            @if (!Auth::User())
                <div>
                    <a href="" class="nav_logo text-decoration-none">
                        <img src="{{ asset('images/asset/logo_kemenag.png') }}" alt="logo kemanag" style="width: 25px">
                        <span class="nav_logo-name text-capitalize">Pengujung</span>
                    </a>

                    <div class="nav_list">
                        <a href="{{ route('pengunjung.map_view') }}"
                            class="nav_link text-decoration-none
                            {{ request()->is('pengunjung/map_view*') ||
                            request()->is('pengunjung/map_category*') ||
                            request()->is('pengunjung/maps_facility*') ||
                            request()->is('pengunjung/maps_schools*') ||
                            request()->is('pengunjung/map_takhasus*')
                                ? 'active'
                                : '' }}">
                            <i class="bx bx-map-alt nav_icon"></i>
                            <span class="nav_name">{{ 'Peta Pesantren' }}</span>
                        </a>


                        <a href="{{ route('pengunjung.madin.map_view') }}"
                            class="nav_link text-decoration-none
                                {{ request()->is('pengunjung/madin/map_view*') || request()->is('pengunjung/madin/map_facility*')
                                    ? 'active'
                                    : '' }}">
                            <i class="bx bxs-map-alt nav_icon"></i>
                            <span class="nav_name">{{ 'Peta Madin & TPQ' }}</span>
                        </a>



                        <a href="{{ route('pengunjung.data_ponpes') }}"
                            class="nav_link text-decoration-none
                            {{ request()->is('pengunjung/data_ponpes*') || request()->is('pengunjung/data_madin*') ? 'active' : '' }}">
                            <i class="bx bx-buildings nav_icon"></i>
                            <span class="nav_name">{{ 'Ponpes & Madin' }}</span>
                        </a>



                        <a href="{{ route('pengunjung.data_statistik') }}"
                            class="nav_link text-decoration-none {{ request()->is('pengunjung/data_statistik*') ? 'active' : '' }}">
                            <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                            <span class="nav_name">{{ 'Statistik' }}</span>
                        </a>

                        <a href="/pengunjung/panduan"
                            class="nav_link text-decoration-none {{ request()->is('pengunjung/panduan*') ? 'active' : '' }}">
                            <i class='bx bx-info-circle nav_icon'></i>
                            <span class="nav_name">{{ 'Panduan Sistem' }}</span>
                        </a>


                    </div>
                </div>
            @elseif(Auth::User()->user_role == 'admin kemenag')
                <div>
                    <a href="{{ route('admin_kemenag.dashboard') }}" class="nav_logo text-decoration-none">
                        <img src="{{ asset('images/asset/logo_kemenag.png') }}" alt="logo kemanag"
                            style="width: 25px">
                        <span class="nav_logo-name text-capitalize">{{ Auth::User()->user_role }}</span>
                    </a>
                    <div class="nav_list">
                        <a href="{{ route('admin_kemenag.dashboard') }}"
                            class="nav_link text-decoration-none {{ request()->is('admin kemenag/dashboard*') ? 'active' : '' }}">
                            <i class="bx bx-grid-alt nav_icon"></i>
                            <span class="nav_name">{{ 'Dashboard' }}</span>
                        </a>

                        <div class="nav_list">
                            <a href="{{ route('admin_kemenag.map_view') }}"
                                class="nav_link text-decoration-none
                            {{ request()->is('admin kemenag/map_view*') ||
                            request()->is('admin kemenag/map_category*') ||
                            request()->is('admin kemenag/maps_facility*') ||
                            request()->is('admin kemenag/maps_schools*') ||
                            request()->is('admin kemenag/map_takhasus*')
                                ? 'active'
                                : '' }}">
                                <i class="bx bx-map-alt nav_icon"></i>
                                <span class="nav_name">{{ 'Peta Pesantren' }}</span>
                            </a>


                            <a href="{{ route('admin_kemenag.madin.map_view') }}"
                                class="nav_link text-decoration-none
                                {{ request()->is('admin kemenag/madin/map_view*') || request()->is('admin kemenag/madin/maps_facility*')
                                    ? 'active'
                                    : '' }}">
                                <i class="bx bxs-map-alt nav_icon"></i>
                                <span class="nav_name">{{ 'Peta Madin & TPQ' }}</span>
                            </a>



                            <a href="{{ route('admin_kemenag.data_ponpes') }}"
                                class="nav_link text-decoration-none
                            {{ request()->is('admin kemenag/data_ponpes*') || request()->is('admin kemenag/data_madin*') ? 'active' : '' }}">
                                <i class="bx bx-buildings nav_icon"></i>
                                <span class="nav_name">{{ 'Ponpes & Madin' }}</span>
                            </a>


                            <a href="{{ route('admin_kemenag.data_sdm_ponpes') }}"
                                class="nav_link text-decoration-none {{ request()->is('admin kemenag/ponpes/data_sdm*') || request()->is('admin kemenag/madin/data_sdm*') ? 'active' : '' }}">
                                <i class="fas fa-table nav_icon"></i>
                                <span class="nav_name">{{ 'Data SDM' }}</span>
                            </a>



                            <a href="{{ route('admin_kemenag.data_admin_pesantren') }}"
                                class="nav_link text-decoration-none {{ request()->is('admin kemenag/data_admin_pesantren*') || request()->is('admin kemenag/madin/data_admin_madin*') || request()->is('admin kemenag/data_pelapor*') ? 'active' : '' }}">
                                <i class="bx bxs-user-account nav_icon"></i>
                                <span class="nav_name">{{ 'Data Akun' }}</span>
                            </a>




                            <a href="{{ route('admin_kemenag.data_report') }}"
                                class="nav_link text-decoration-none {{ request()->is('admin kemenag/data_report*') || request()->is('admin kemenag/madin/data_report*') ? 'active' : '' }}">
                                <i class="bx bxs-report nav_icon"></i>
                                <span class="nav_name">{{ 'Pelaporan' }}</span>
                            </a>

                            <a href="{{ route('admin_kemenag.data_statistik') }}"
                                class="nav_link text-decoration-none {{ request()->is('admin kemenag/data_statistik*') ? 'active' : '' }}">
                                <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                                <span class="nav_name">{{ 'Statistik' }}</span>
                            </a>

                            <a href="/admin kemenag/panduan"
                                class="nav_link text-decoration-none {{ request()->is('admin kemenag/panduan*') ? 'active' : '' }}">
                                <i class='bx bx-info-circle nav_icon'></i>
                                <span class="nav_name">{{ 'Panduan Sistem' }}</span>
                            </a>

                        </div>
                    </div>
                @elseif(Auth::User()->user_role == 'admin pesantren')
                    <div>
                        <a href="{{ route('admin_pesantren.dashboard', ['id' => Auth::User()->id]) }}"
                            class="nav_logo text-decoration-none">
                            <img src="{{ asset('images/asset/logo_kemenag.png') }}" alt="logo kemanag"
                                style="width: 25px">
                            <span class="nav_logo-name text-capitalize">{{ Auth::User()->user_role }}</span>
                        </a>
                        <div class="nav_list">
                            <a href="{{ route('admin_pesantren.dashboard', ['id' => Auth::User()->id]) }}"
                                class="nav_link text-decoration-none {{ request()->is('admin pesantren/dashboard*') ? 'active' : '' }}">
                                <i class="bx bx-grid-alt nav_icon"></i>
                                <span class="nav_name">{{ 'Dashboard' }}</span>
                            </a>
                            <a href="{{ route('admin_pesantren.ponpes_view', ['id' => Auth::User()->id]) }}"
                                class="nav_link text-decoration-none {{ request()->is('admin pesantren/ponpes_view*') ? 'active' : '' }}">
                                <i class="bx bx-buildings nav_icon"></i>
                                <span class="nav_name">{{ 'Daftar Pesantren' }}</span>
                            </a>

                            <a href="/admin pesantren/panduan"
                                class="nav_link text-decoration-none {{ request()->is('admin pesantren/panduan*') ? 'active' : '' }}">
                                <i class='bx bx-info-circle nav_icon'></i>
                                <span class="nav_name">{{ 'Panduan Sistem' }}</span>
                            </a>

                        </div>
                    </div>
                @elseif(Auth::User()->user_role == 'pelapor')
                    <div>
                        <a href="" class="nav_logo text-decoration-none">
                            <img src="{{ asset('images/asset/logo_kemenag.png') }}" alt="logo kemanag"
                                style="width: 25px">
                            <span class="nav_logo-name text-capitalize">pelapor</span>
                        </a>
                        <div class="nav_list">

                            <a href="{{ route('pelapor.map_view') }}"
                                class="nav_link text-decoration-none
                                {{ request()->is('pelapor/map_view*') ||
                                request()->is('pelapor/map_category*') ||
                                request()->is('pelapor/maps_facility*') ||
                                request()->is('pelapor/maps_schools*') ||
                                request()->is('pelapor/map_takhasus*')
                                    ? 'active'
                                    : '' }}">
                                <i class="bx bx-map-alt nav_icon"></i>
                                <span class="nav_name">{{ 'Peta Pesantren' }}</span>
                            </a>


                            <a href="{{ route('pelapor.madin.map_view') }}"
                                class="nav_link text-decoration-none
                                    {{ request()->is('pelapor/madin/map_view*') || request()->is('pelapor/madin/map_facility*') ? 'active' : '' }}">
                                <i class="bx bxs-map-alt nav_icon"></i>
                                <span class="nav_name">{{ 'Peta Madin & TPQ' }}</span>
                            </a>



                            <a href="{{ route('pelapor.data_ponpes') }}"
                                class="nav_link text-decoration-none
                                {{ request()->is('pelapor/data_ponpes*') || request()->is('pelapor/data_madin*') ? 'active' : '' }}">
                                <i class="bx bx-buildings nav_icon"></i>
                                <span class="nav_name">{{ 'Ponpes & Madin' }}</span>

                                <a href="{{ route('pelapor.data_statistik') }}"
                                    class="nav_link text-decoration-none {{ request()->is('pelapor/data_statistik*') ? 'active' : '' }}"">
                                    <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                                    <span class="nav_name">{{ 'Statistik' }}</span>
                                </a>

                                <a href="{{ route('pelapor.ponpes.data_report', ['id' => Auth::User()->id]) }}"
                                    class="nav_link text-decoration-none {{ request()->is('pelapor/ponpes/data_report*') || request()->is('pelapor/madin/data_report*') ? 'active' : '' }}"">
                                    <i class="bx bxs-report nav_icon"></i>
                                    <span class="nav_name">{{ 'Riwayat Laporan' }}</span>
                                </a>

                                <a href="/pelapor/panduan"
                                    class="nav_link text-decoration-none {{ request()->is('pelapor/panduan*') ? 'active' : '' }}"">
                                    <i class='bx bx-info-circle nav_icon'></i>
                                    <span class="nav_name">{{ 'Panduan Sistem' }}</span>
                                </a>


                        </div>
                    </div>
            @endif
        </nav>
    </div>

    <div class="section" style="min-height: 570px">
        @yield('content')
    </div>





    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin keluar?</h5>
                    <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Keluar') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- button back top --}}

    <button
        class="btn btn-sm btn-secondary opacity-75 rounded-circle position-fixed bottom-0 end-0 translate-middle d-none"
        onclick="scrollToTop()" id="back-to-up">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </button>
    {{-- end button back top --}}

    <!-- Footer -->
    <footer class="footer border-top border-secondary mt-5 py-3">
        <div class="container text-center">
            <span>&copy; 2023 Kementrian Agama Kabupaten Batang</span>
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


<script>
    window.onscroll = () => {
        toggleTopButton();
    }

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function toggleTopButton() {
        if (document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20) {
            document.getElementById('back-to-up').classList.remove('d-none');
        } else {
            document.getElementById('back-to-up').classList.add('d-none');
        }
    }
</script>
@stack('javascript')

</html>

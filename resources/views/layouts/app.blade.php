<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
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

<body id="body-pd" class="bg-light">
    @if(!(Route::is('login') || Route::is('register')))
    <header class="header shadow-sm" id="header">
        <div class="header_toggle">
            <i class="bx bx-menu" id="header-toggle"></i>
        </div>
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
            <span
                class="me-2 d-none d-lg-inline text-secondary text-decoration-none fw-bold ms-auto text-capitalize">
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
                            <img src="{{ asset('images/' . $photoProfil) }}" alt="Foto Profil Pengguna">
                        @endif

                    </div>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in ms-auto"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>
                        Activity Log
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </div>
            @endguest
        </header>
     
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav_logo text-decoration-none">
                        <i class="bx bx-layer nav_logo-icon"></i>
                        <span class="nav_logo-name text-capitalize">{{ Auth::User()->user_role }}</span>
                    </a>
                    <div class="nav_list">
                        <a href="#" class="nav_link text-decoration-none active">
                            <i class="bx bx-grid-alt nav_icon"></i>
                            <span class="nav_name">Dashboard</span>
                        </a>
                        <a href="#" class="nav_link text-decoration-none">
                            <i class="bx bx-user nav_icon"></i>
                            <span class="nav_name">Users</span>
                        </a>
                        <a href="#" class="nav_link text-decoration-none">
                            <i class="bx bx-message-square-detail nav_icon"></i>
                            <span class="nav_name">Messages</span>
                        </a>
                        <a href="#" class="nav_link text-decoration-none">
                            <i class="bx bx-bookmark nav_icon"></i>
                            <span class="nav_name">Bookmark</span>
                        </a>
                        <a href="#" class="nav_link text-decoration-none">
                            <i class="bx bx-folder nav_icon"></i>
                            <span class="nav_name">Files</span>
                        </a>
                        <a href="#" class="nav_link text-decoration-none">
                            <i class="bx bx-bar-chart-alt-2 nav_icon"></i>
                            <span class="nav_name">Stats</span>
                        </a>
                    </div>
                </div>
                <a href="#" class="nav_link text-decoration-none">
                    <i class="bx bx-log-out nav_icon"></i>
                    <span class="nav_name">SignOut</span>
                </a>
            </nav>
        </div>
        @endif
        <div class="container-fluid height-100 pt-5 mt-5">
            @yield('content')
        </div>

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
                            nav.classList.toggle("show");
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



        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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


        {{-- footer --}}
        <div class="container-fluid">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top border-3">
              <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-muted">&copy; 2023 Company, Inc</span>
              </div>
            </footer>
          </div>
    </body>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js"></script>


    {{-- cropper js --}}
    <script>
        var $modal = $('.imagecrop');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".avatar", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $("body").on("click", "#crop", function() {
            canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#base64image').val(base64data);
                    document.getElementById('imagePreview').style.backgroundImage = "url(" +
                        base64data + ")";
                    $modal.modal('hide');
                }
            });
        })
    </script>


    {{-- paasword --}}

    <script>
        function new_password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye_1");
            var hide_eye = document.getElementById("hide_eye_1");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        // confirm

        function password_confirm_show_hide() {
            var x = document.getElementById("password-confirm");
            var show_eye = document.getElementById("show_eye_2");
            var hide_eye = document.getElementById("hide_eye_2");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
    @stack('javascript')

    </html>

@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success mt-5 mb-0">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger mt-5 mb-0">
    {{ session('error') }}
</div>
@endif

    <div class="container-fluid mt-5 pt-5 vh-100">
        

        <div class="content_login shadow  my-auto bg-white">
            <div class="row">
                <div class="col-md-6 d-lg-block d-none">
                    <div class="image-login">
                        <img src="{{ asset('images/asset/login-asset.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                   <div class="px-sm-5 px-3 py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-5 d-grid justify-content-center">
                                <img class="mx-auto mb-1" style="width:40px;"
                                    src="{{ asset('images/asset/logo_kemenag.png') }}" alt="">
                                <span class="fw-bold text-secondary"
                                    style="font-size: 10px">{{ 'Kementrian Agama Kabupaten Batang' }}</span>
                            </div>
                            <div class="col-12 mb-4">
                                <h2 class="fw-bold">{{ 'Selamat Datang!' }}</h2>
                            </div>

                            <div class="col-12 mb-4">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="{{ 'Alamat Email' }}" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-4 d-flex">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="{{ 'Kata Sandi' }}" required autocomplete="current-password">
                                <span class="input-group-text" onclick="new_password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye_1"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye_1"></i>
                                </span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-1">
                                <button type="submit" class="btn btn-success w-100">
                                    {{ __('Masuk') }}
                                </button>
                            </div>

                            <div class="col-12 mb-4 d-flex justify-content-end">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-decoration-none" style="font-size: 11px"
                                        href="{{ route('password.request') }}">
                                        {{ __('Lupa Kata Sandi ?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="col-12 text-center" style="font-size: 12px">
                                <span class="text-secondary">Belum Punya Akun?</span>
                                <a class="fw-bold text-decoration-none text-dark " href="{{ route('register') }}">Daftar</a>
                            </div>
                        </div>


                        {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div> --}}

                    </form>
                   </div>
                </div>
            </div>
        </div>

     
    </div>
@endsection

@push('javascript')
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
    </script>
@endpush

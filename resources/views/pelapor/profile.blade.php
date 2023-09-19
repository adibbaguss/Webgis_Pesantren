@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5 pt-5 vh-100">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex  justify-content-center">
            <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none; max-width:500px">
                <div class="card-body bg-light py-4">
                    <div class="row">
                        <div class="col-md-12 d-flex">

                            <div class="dropdown me-0 ms-auto">
                                <button class="btn btn-outline-secondary dropdown-toggle " type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-sliders-h"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pelapor.profile_edit', ['id' => $user->id]) }}">
                                            <i class="fas fa-edit"></i>
                                            {{ 'Perbaharui Profil' }}
                                        </a>
                                    </li>
                                    <li>

                                        <a class="dropdown-item" type="button" data-bs-toggle="modal"
                                            data-bs-target="#updatePasswordModal">
                                            <i class="fas fa-edit"></i>
                                            {{ 'Ubah Password' }}
                                        </a>
                                    </li>
                                </ul>
                            </div>




                        </div>
                        <div class="col-md-12 mb-3 d-flex">
                            @if (empty($user->photo_profil))
                                <!-- Tampilkan avatar default -->
                                <img class="rounded-circle mx-auto" style="max-width: 120px"
                                    src="{{ asset('images/profile_photos/default.jpg') }}" alt="Avatar Default">
                            @else
                                <!-- Tampilkan foto profil pengguna -->
                                <img class="rounded-circle mx-auto" style="max-width: 120px"
                                    src="{{ asset('images/profile_photos/' . $user->photo_profil) }}"
                                    alt="Foto Profil Pengguna">
                            @endif
                        </div>

                        <div class="col-md-12 d-flex mb-3">
                            <span class="btn btn-secondary mx-auto">{{ $user->user_role }}</span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span class="fw-bold fs-5">{{ $user->name }}</span>
                        </div>

                        <div class="col-md-12 text-center mb-3">
                            <span>{{ $user->username }}</span>
                        </div>

                        <div class="col-md-12 text-center">
                            <span>{{ $user->email }}</span>
                        </div>

                        <div class="col-md-12 text-center">
                            @if (empty($user->phone_number))
                                <span>xxx-xxx-xxx-xxx</span>
                            @else
                                <span class="">{{ $user->phone_number }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ 'Ganti Kata Sandi' }}</h5>
                    <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('pelapor.password_update', ['id' => $user->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-12 mb-4 d-flex">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" placeholder="Kata Sandi Baru">

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



                            <div class="col-12 mb-4 d-flex">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Konfirmasi Kata Sandi">

                                <span class="input-group-text" onclick="password_confirm_show_hide();">
                                    <i class="fas fa-eye" id="show_eye_2"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye_2"></i>
                                </span>

                            </div>

                            <div class="col-12 mb-4 d-flex">
                                <div class="me-0 ms-auto">
                                    <button class="btn btn-outline-secondary" type="button"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Perbaharui</button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
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
@endpush

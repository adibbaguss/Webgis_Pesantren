@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5 pt-5 mb-5">
        <div class="content_register shadow bg-white mb-3">
            <div class="row">
                <div class="col-md-6 d-lg-block d-none">
                    <div class="image-register h-100">
                        <img src="{{ asset('images/asset/login-asset.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 px-lg-4 px-md-0 py-0">
                    <div class="px-5 pt-4">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            {{-- photo profile --}}
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="photo_profil" accept=".png, .jpg, .jpeg" name="photo_profil"
                                        class="avatar" />
                                    <input type="hidden" name="base64image" name="base64image" id="base64image">
                                    <label for="photo_profil"></label>
                                </div>
                                <div class="avatar-preview container2">
                                    @php
                                        $imagePath = public_path('images/profile_photos/' . ($image->image ?? 'default.jpg'));
                                        $imageUrl = asset('images/profile_photos/' . ($image->image ?? 'default.jpg'));
                                        $imageStyle = "background-image: url('$imageUrl')";
                                    @endphp

                                    <div id="imagePreview" style="{{ $imageStyle }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        {{-- <input style="margin-top: 60px;" type="submit" class="btn btn-danger"> --}}
                                    </div>

                                </div>
                            </div>

                            <div class="row ">
                                {{-- <div class="col-12 mb-5 d-grid justify-content-center">
                                <img class="mx-auto mb-1" style="width:40px;" src="{{ asset('images/asset/logo_kemenag.png') }}" alt="">
                                <span class="fw-bold text-secondary" style="font-size: 10px">{{ 'Kementrian Agama Kabupaten Batang' }}</span>
                            </div>
                            <div class="col-12 mb-4">
                                <h2 class="fw-bold">{{ 'Register' }}</h2>
                            </div> --}}

                                <div class="col-12 mb-4">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" placeholder="Nama Lengkap">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-4">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username"
                                        placeholder="Username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-4">
                                    <input id="phone_number" type="tel"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ old('phone_number') }}" placeholder="Nomor Handphone" required
                                        autocomplete="phone_number">
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-12 mb-4 d-flex">

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Alamat Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-12 mb-4 d-flex">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Kata Sandi">

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


                                <div class="col-12 mb-4">
                                    <button type="submit" class="btn btn-success w-100">
                                        {{ __('Daftar') }}
                                    </button>
                                </div>


                                <div class="col-12 text-center mb-3" style="font-size: 12px">
                                    <span class="text-secondary">Sudah Punya Akun?</span>
                                    <a class="fw-bold text-decoration-none text-dark " href="{{ route('login') }}">
                                        Masuk
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal Crop -->

    <div class="modal fade imagecrop" id="model" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel"
    aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content crop-content border-0 shadow">
      
            <div class="modal-body crop-body">
                <div class="image-canvas">
                    <img id="image" src="" alt="">
                </div>
            </div>
            <div class="modal-footer d-flex">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                <button type="button" class="btn btn-outline-success crop" id="crop">Potong</button>
            </div>
          </div>
        </div>
      </div>

@endsection


@push('javascript')
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
                aspectRatio: 1/1,
                dragMode: 'move',
                cropBoxMovable: false,
                cropBoxResizable: false,
                checkOrientation: true,
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
@endpush

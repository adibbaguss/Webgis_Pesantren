@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5 pt-5">
        <div class="content_register shadow bg-white mx-auto" style="max-width: 600px">
            <div class="px-2 px-sm-5 pt-4" >
                <form method="POST" action="{{ route('admin.update_profile', ['id'=>$user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- photo profile --}}
                    <div class="avatar-upload mx-auto">
                        <div class="avatar-edit">
                            <input type='file' id="photo_profil" accept=".png, .jpg, .jpeg" name="photo_profil"
                                class="avatar" />
                            <input type="hidden" name="base64image" name="base64image" id="base64image">
                            <label for="photo_profil"></label>
                        </div>
                        <div class="avatar-preview container2">
                            @php
                            if ($user->photo_profil == null) {
                                $imagePath = public_path('images/profile_photos/default.jpg');
                                $imageUrl = asset('images/profile_photos/default.jpg');
                            } else {
                                $imagePath = public_path('images/profile_photos/' . $user->photo_profil);
                                $imageUrl = asset('images/profile_photos/' . $user->photo_profil);
                            }
                            $imageStyle = "background-image: url('$imageUrl')";
                        @endphp

                            <div id="imagePreview" style="{{ $imageStyle }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{-- <input style="margin-top: 60px;" type="submit" class="btn btn-danger"> --}}
                            </div>

                        </div>
                    </div>

                    <div class="row ">

                        <div class="col-12 mb-4">
                            <label for="">{{ 'Nama Lengkap' }}</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}" required autocomplete="name" placeholder="Nama Lengkap">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <label for="">{{ 'Username' }}</label>
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ $user->username }}" required autocomplete="username"
                                placeholder="Username">

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <label for="">{{ 'Nomor Telepon' }}</label>
                            <input id="phone_number" type="tel"
                                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                value="{{ $user->phone_number }}" placeholder="Nomor Handphone" required
                                autocomplete="phone_number">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="col-12 mb-4">
                            <label for="">{{ 'Email' }}</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $user->email }}" required autocomplete="email"
                                placeholder="Alamat Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>




                        <div class="col-6 mb-4 me-0 ms-auto d-flex justify-content-end">
                            <a href="{{ route('admin.profile', ['id' => $user->id]) }}" class="btn btn-outline-secondary me-1">
                                {{ __('Batal') }}
                            </a>
                            <button type="submit" class="btn btn-success ">
                                {{ __('Perbaharui') }}
                            </button>

                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- Modal Crop -->

    <div class="modal fade imagecrop" id="model" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel"
    aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content crop-content border-0 shadow">
            <div class="modal-header">
              <h5 class="modal-title">Crop Image</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body crop-body">
                <div class="image-canvas">
                    <img id="image" src="" alt="">
                </div>
            </div>
            <div class="modal-footer d-flex">
                <button type="button" style="width:100%" class="btn btn-outline-success crop" id="crop">Crop</button>
            </div>
          </div>
        </div>
      </div>

@endsection


@push('javascript')
    {{-- paasword --}}





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

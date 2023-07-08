@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">

                    {{-- <form enctype="multipart/form-data" action="{{route('register')}}" method="POST" class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="imageUpload" class=" imageUpload" />
                            <input type="hidden" name="base64image" name="base64image" id="base64image">
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview container2">
                            @php
                                if(!empty($image->image) && $image->image!='' && file_exists(public_path('images/'.$image->image))){
                                  $image =$image->image;
                                }else{
                                  $image = 'default.png';
                                }
                                $url = url('public/images/'.$image);
                                $imgs =  "background-image:url($url)";
                                  
                            @endphp
                            <div id="imagePreview" style="{{$imgs}};">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input style="margin-top: 60px;" type="submit" class="btn btn-danger">  
                            </div>
                        </div>
                    </form> --}}
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="photo_profil" accept=".png, .jpg, .jpeg" name="photo_profil" class="avatar" />
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

                        {{-- photo profile --}}
                        {{-- <div class="row mb-3 text-center">
                            <div class="col-md-12 profile-pic">
                                <label class="-label" for="photo_profil" data-toggle="modal" data-target="#cropModal">
                                  <span class="glyphicon glyphicon-camera"></span>
                                  <span>{{__('Change Profile')}}</span>
                                </label>
                                <input id="photo_profil" type="file" class="item-img form-control-file @error('photo_profil') is-invalid @enderror" name="photo_profil" value="{{ old('photo_profil') }}" autocomplete="photo_profil" accept="image/*" />
                                <img src="" id="image-preview" class="preview" style="max-width: 200px; max-height: 200px;" />
                            </div>
                            <div class="col-md-6 text-center">
                                    
                                @error('photo_profil')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="imageUpload" class=" imageUpload" />
                            <input type="hidden" name="base64image" name="base64image" id="base64image">
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview container2">
                            @php
                                if(!empty($image->image) && $image->image!='' && file_exists(public_path('images/'.$image->image))){
                                  $image =$image->image;
                                }else{
                                  $image = 'default.png';
                                }
                                $url = url('public/images/'.$image);
                                $imgs =  "background-image:url($url)";
                                  
                            @endphp
                            <div id="imagePreview" style="{{$imgs}};">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input style="margin-top: 60px;" type="submit" class="btn btn-danger">  
                            </div>
                        </div> --}}

                        {{-- name --}}
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>
    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- username --}}
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
    
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
    
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- phone number --}}
                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Handphone') }}</label>
    
                            <div class="col-md-6">
                                <input id="phone_number" type="tel"   class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Format: xxxx-xxxx-xxxx"  required autocomplete="phone_number">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- email --}}
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>
    
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- password --}}
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Kata Sandi') }}</label>
    
                            <div class="col-md-6 d-flex">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                               
                                  <span class="input-group-text" onclick="new_password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye_1"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye_1"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- konfirmasi password --}}
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Kata Sandi') }}</label>
    
                            <div class="col-md-6 d-flex">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                               
                                <span class="input-group-text" onclick="password_confirm_show_hide();">
                                    <i class="fas fa-eye" id="show_eye_2"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye_2"></i>
                            </div>
                        </div>

                        


                        
    
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Crop -->
<div class="modal fade imagecrop" id="model" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog"  >
        <div class="modal-content"  >
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Foto Profil</h5>
            </div>
            <div class="modal-body " >
                {{-- <div id="image_demo" class="center-block"></div> --}}
                <div class="container p-0"  style="max-width= 300px; max-height:300px;" >
                    <img id="image"  src="">             
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> --}}
                <button type="button" class="btn btn-primary crop" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>

@endsection




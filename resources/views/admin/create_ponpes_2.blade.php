@extends('layouts.app')

@section('css')
    <style>
        .label {
            cursor: pointer;
        }

        .alert {
            display: none;

        }

    </style>
@endsection

@section('content')
    <div class="container mt-5 pt-5">
        {{-- progress bar --}}
        <div class="position-relative my-4 mx-5">
            <div class="progress bg-secondary" style="height: 2px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-success rounded-pill"
                style="width: 2rem; height:2rem;">1</div>
            <div class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-success rounded-pill"
                style="width: 2rem; height:2rem;">2</div>
            <div class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill"
                style="width: 2rem; height:2rem;">3</div>
        </div>
        {{-- end progress bar --}}


        <div class="mt-5 pt-3">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 bg-white shadow p-md-5">
                    <form method="POST" action="{{ route('create-ponpes-2') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mt-2 mb-4">
                                <div class="px-5 pt-4">

                                    {{-- unggah gambar jumbtron  --}}
                                    <div class="d-grid mb-4">
                                        <img class="rounded w-100 mb-2 border" id="jumbotron-img"
                                            src="{{ asset('images/ponpes/default-image.png') }}" alt="avatar">
                                        <label class="label custom-file-upload btn btn-outline-secondary w-50 ms-auto me-0"
                                            data-bs-toggle="tooltip" title="Pilih Gambar Jumborton">
                                            <input type="file" class="d-none" id="file-input" name="image-1"
                                                accept="image/*">
                                            {{ 'Unggah Jumbotron' }}
                                        </label>
                                    </div>
                                    <input type="text" name="title-1" value="jumbotron" hidden>
                                    <input type="number" name="ponpes_id-1" value="{{ $ponpes->id }}" hidden>
                                    <input type="text" name="type-1" value="jumbotron" hidden>
                                    <input type="hidden" id="cropped-image" name="cropped_image">

                                </div>
                            </div>


                            {{-- form image 1 --}}
                            @for ($i = 2; $i <= 7; $i++)
                            <div class="col-md-6 mb-4 p-3 border">
                                <div class="px-5 d-grid">


                                    <div class="d-flex">
                                        <img class="rounded w-75 mb-2 border" id="ponpes-img-{{ $i }}"
                                            src="{{ asset('images/ponpes/default-image-1.png') }}" alt="Gambar 1">

                                        <label class="label custom-file-upload btn btn-outline-secondary h-25 my-auto ms-3"
                                            data-bs-toggle="tooltip-{{ $i }}" title="Pilih Gambar untuk Informasi Pesantren">
                                            <input type="file" class="d-none" id="file-input-{{ $i }}" name="image-{{ $i }}"
                                                accept="image/*">
                                            {{ 'Unggah' }}
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <input id="title-{{ $i }}" type="text"
                                                class="form-control @error('title') is-invalid @enderror" name="title-{{ $i }}"
                                                value="{{ old('title-' . $i) }}"  required autocomplete="title-{{ $i }}"
                                                placeholder="Judul Gambar">

                                            @error('title-{{ $i }}')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="number" name="ponpes_id-{{ $i }}" value="{{ $ponpes->id }}" hidden>
                                    <input type="text" name="type-{{ $i }}" value="reguler" hidden>
                                    <input type="hidden" id="cropped-image-{{ $i }}" name="cropped_image-{{ $i }}">


                                </div>
                            </div>
                            @endfor

                            {{-- end form image 1 --}}


                        </div>
                        <button type="submit" class="btn btn-success me-0 ms-auto">Lanjut</button>

                    </form>
                </div>

            </div>

        </div>


    </div>

    {{-- modal jumbotron --}}
    <div class="modal fade imagecrop"id="cropJumbotronModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content crop-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body crop-body">
                    <div class="image-canvas">
                        <img id="uploadedJumbotron" src="" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal jumbotron --}}

    {{-- modal image 1 --}}

    @for ($i = 2; $i <= 7; $i++)
    <div class="modal fade imagecrop"id="cropImagemodal-{{ $i }}" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content crop-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body crop-body">
                    {{ $i }}
                    <div class="image-canvas">
                        <img id="uploadImage-{{ $i }}" src="" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop-{{ $i }}">Crop</button>
                </div>
            </div>
        </div>
    </div>
    @endfor

@endsection

@push('javascript')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var avatar = document.getElementById('jumbotron-img');
            var image = document.getElementById('uploadedJumbotron');
            var input = document.getElementById('file-input');
            var cropBtn = document.getElementById('crop');

            var $modal = $('#cropJumbotronModal');
            var cropper;

            $('[data-bs-toggle="tooltip"]').tooltip();

            input.addEventListener('change', function(e) {
                var files = e.target.files;
                var done = function(url) {
                    // input.value = '';
                    console.log(input.value)
                    image.src = url;
                    $modal.modal('show');
                };
                // var reader;
                // var file;
                // var url;

                if (files && files.length > 0) {
                    let file = files[0];

                    // done(URL.createObjectURL(file));
                    // if (URL) {
                    // } 

                    // else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                    // }
                }
            });




            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 16 / 9,
                    viewMode: 1,
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            cropBtn.addEventListener('click', function() {
                // var initialAvatarURL;
                var canvas;

                $modal.modal('hide');

                if (cropper) {
                    canvas = cropper.getCroppedCanvas({
                        width: 780,
                        height: 440,
                    });
                    // initialAvatarURL = avatar.src;
                    avatar.src = canvas.toDataURL();
                    document.getElementById('cropped-image').value = canvas.toDataURL('image/jpeg');
                }
            });

        });
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            function setupCropper(elementIndex) {
                var avatar = document.getElementById('ponpes-img-' + elementIndex);
                var image = document.getElementById('uploadImage-' + elementIndex);
                var input = document.getElementById('file-input-' + elementIndex);
                var cropBtn = document.getElementById('crop-' + elementIndex);
                var $modal = $('#cropImagemodal-' + elementIndex);
                var cropper;

                $('[data-bs-toggle="tooltip-' + elementIndex + '"]').tooltip();

                input.addEventListener('change', function(e) {
                    var files = e.target.files;
                    var done = function(url) {
                        image.src = url;
                        $modal.modal('show');
                    };

                    if (files && files.length > 0) {
                        let file = files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                $modal.on('shown.bs.modal', function() {
                    cropper = new Cropper(image, {
                        aspectRatio: 4 / 3,
                        viewMode: 1,
                    });
                }).on('hidden.bs.modal', function() {
                    cropper.destroy();
                    cropper = null;
                });

                cropBtn.addEventListener('click', function() {
                    var canvas;
                    $modal.modal('hide');

                    if (cropper) {
                        canvas = cropper.getCroppedCanvas({
                            width: 500,
                            height: 375,
                        });
                        avatar.src = canvas.toDataURL();
                        document.getElementById('cropped-image-' + elementIndex).value = canvas.toDataURL(
                            'image/jpeg');
                    }
                });
            }

            // Setup for each element;
            setupCropper(2);
            setupCropper(3);
            setupCropper(4);
            setupCropper(5);
            setupCropper(6);
            setupCropper(7);
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-5 mt-5">
        <h2 class="mb-0 text-secondary ">{{ 'Formulir Pembuatan Data Madrasah Diniyah & TPQ' }}</h2>
        <div class="container d-grid mb-5 mt-5">
            <div class="mx-md-5 px-md-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10 bg-white shadow p-md-5">
                        <div class=" pt-4">
                            <form method="POST" action="{{ route('admin_kemenag.create_madin') }}" enctype="multipart/form-data">
                                @csrf
                                {{-- photo profile --}}
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="photo_profil" accept=".png, .jpg, .jpeg"
                                            name="photo_profil" class="avatar" />
                                        <input type="hidden" name="base64image" name="base64image" id="base64image">
                                        <label for="photo_profil"></label>
                                    </div>
                                    <div class="avatar-preview container2">
                                        @php
                                            $imagePath = public_path('images/ponpes/profile/' . ($image->image ?? 'logo_ponpes_default.jpg'));
                                            $imageUrl = asset('images/ponpes/profile/' . ($image->image ?? 'logo_ponpes_default.jpg'));
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
                                        <label for=""
                                            class="small ms-2">{{ 'Nomor Statistik Diniyah Takmiliyah' }}</label>
                                        <input id="nsdt" type="number"
                                            class="form-control @error('nsdt') is-invalid @enderror" name="nsdt"
                                            value="{{ old('nsdt') }}" required autocomplete="nsdt">

                                        @error('nsdt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Nama Madrasah Diniyah/TPQ' }}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Nomor Telepon' }}</label>
                                        <input id="phone_number" type="tel"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="{{ old('phone_number') }}" required
                                            autocomplete="phone_number">

                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Link Website' }}</label>
                                        <input id="website" type="text"
                                            class="form-control @error('website') is-invalid @enderror" name="website"
                                            value="{{ old('website') }}" autocomplete="website">

                                        @error('website')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Alamat Email' }}</label>
                                        <input id="email" type="tel"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Tanggal Berdiri' }}</label>
                                        <input id="standing_date" type="date"
                                            class="form-control @error('standing_date') is-invalid @enderror"
                                            name="standing_date" value="{{ old('standing_date') }}" required
                                            autocomplete="standing_date">

                                        @error('standing_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-4">
                                        <label for=""
                                            class="small ms-2">{{ 'Pimpinan  Madrasah Diniyah/TPQ' }}</label>
                                        <input id="pimpinan" type="text"
                                            class="form-control @error('pimpinan') is-invalid @enderror" name="pimpinan"
                                            value="{{ old('pimpinan') }}" required autocomplete="pimpinan">

                                        @error('pimpinan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-4 d-flex">
                                        <div class="inputan me-1 w-100">
                                            <label for=""
                                                class="small ms-2">{{ 'Luas Wilayah M' }}<sup>2</sup></label>
                                            <input id="surface_area" type="number"
                                                class="form-control @error('surface_area') is-invalid @enderror"
                                                name="surface_area" value="{{ old('surface_area') }}" required
                                                autocomplete="surface_area">

                                            @error('surface_area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="inputan ms-1 w-100">
                                            <label for=""
                                                class="small ms-2">{{ 'Luas Bangunan M' }}<sup>2</sup></label>
                                            <input id="building_area" type="number"
                                                class="form-control @error('building_area') is-invalid @enderror"
                                                name="building_area" value="{{ old('building_area') }}" required
                                                autocomplete="building_area">

                                            @error('building_area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Kota/Kabupaten' }}</label>
                                        <input id="city" type="text" class="form-control" value="Batang" name="city" readonly>
                                    </div>


                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Kecamatan' }}</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="subdistrict">
                                            <option selected>Pilih Kecamatan</option>
                                            @foreach ($kecamatanOptions as $kecamatan)
                                                <option value="{{ $kecamatan }}">{{ $kecamatan }}</option>
                                            @endforeach
                                        </select>

                                        @error('subdistrict')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Kode Pos' }}</label>
                                        <input id="postal_code" type="number"
                                            class="form-control @error('postal_code') is-invalid @enderror"
                                            name="postal_code" value="{{ old('postal_code') }}" required
                                            autocomplete="postal_code">

                                        @error('postal_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label for="" class="small ms-2">{{ 'Alamat' }}</label>
                                        <input id="address" type="text"
                                            class="form-control @error('address') is-invalid @enderror" name="address"
                                            value="{{ old('address') }}" required autocomplete="address">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-4 d-flex">
                                        <div class="inputan me-1 w-100">
                                            <label for="" class="small ms-2">{{ 'Latitude' }}</label>
                                            <input id="latitude" type="text"
                                                class="form-control @error('latitude') is-invalid @enderror"
                                                name="latitude" value="{{ old('latitude') }}" required
                                                autocomplete="latitude">

                                            @error('latitude')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="inputan ms-1 w-100">
                                            <label for="" class="small ms-2">{{ 'Longitude' }}</label>
                                            <input id="longitude" type="text"
                                                class="form-control @error('longitude') is-invalid @enderror"
                                                name="longitude" value="{{ old('longitude') }}" required
                                                autocomplete="longitude">

                                            @error('longitude')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12 mb-4">
                                        <div id="map" style="height: 400px;"></div>
                                    </div>


                                    <div class="col-4 me-0 ms-auto mb-4">
                                        <button type="submit" class="btn btn-success w-100">
                                            {{ __('Tambah') }}
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
                        <button type="button" style="width:100%" class="btn btn-outline-success crop"
                            id="crop">Crop</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('javascript')
    <script>
        const map = L.map('map').setView([-6.993808128800089, 109.83246433526726], 10);

        const baseLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '<button class="btn border-1" style="font-size:10px" onclick="focusOnArea()">Kabupaten Batang</button>'
        });

        const groupLayer = L.layerGroup().addTo(map);

        const geoJSONFiles = [
            'Batang',
            'Bawang',
            'Bandar',
            'Banyuputih',
            'Tersono',
            'Limpung',
            'Blado',
            'Warungasem',
            'Wonotunggal',
            'Gringsing',
            'Kandeman',
            'Reban',
            'Tersono',
            'Tulis',
            'Pecalungan',
            'Subah'
        ];

        geoJSONFiles.forEach((filename) => {
            const geoJSONUrl = `/geojson/${filename}.geojson`;

            fetch(geoJSONUrl)
                .then((response) => response.json())
                .then((data) => {
                    L.geoJSON(data, {
                        onEachFeature: function(feature, layer) {
                            // Tambahkan layer ke grup layer
                            groupLayer.addLayer(layer);
                            // Beberapa opsi lain seperti menambahkan popup atau interaksi dengan fitur dapat dilakukan di sini
                        },
                    });
                })
                .catch((error) => console.error('Error fetching GeoJSON data:', error));
        });

        function focusOnArea() {
            // Koordinat daerah yang ingin difokuskan
            var areaCoordinates = [
                [-6.970228790174548, 109.70809578547586],
                [-6.981569161983875, 110.0456888726489],
                [-6.911688089761459, 109.85672672728148],
                [-7.179395037882008, 109.84883213797919]
            ];

            var areaBounds = L.latLngBounds(areaCoordinates); // Membuat batas daerah dari koordinat

            map.fitBounds(areaBounds); // Mengatur peta untuk memfokuskan pada batas daerah
        }



        function onMapClick(e) {
            const {
                lat,
                lng
            } = e.latlng; // Separate latitude and longitude variables

            // Update the input fields with the clicked latitude and longitude
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);

            L.popup()
                .setLatLng(e.latlng)
                .setContent(`Latitude : ${lat.toFixed(6)}, <br> Longitude : ${lng.toFixed(6)}`)
                .openOn(map);
        }

        map.on('click', onMapClick);

        // Add the base layer to the map
        baseLayer.addTo(map);
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
                aspectRatio: 1 / 1,
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

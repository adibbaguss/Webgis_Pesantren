@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-5 mt-5">
        <h2 class="mb-0 text-secondary  mb-5">{{ 'Perbaharui Data ' . $ponpes->name }}</h2>
        <div class="mx-md-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 bg-white shadow rounded">
                    <div class="pt-4">
                        <form method="POST" action="{{ route('admin_kemenag.ponpes_update', $ponpes->id) }}">
                            @csrf
                            @method('PUT')


                            <div class="row ">

                                <div class="col-12 mb-4">
                                    <label for=""
                                        class="small ms-2">{{ 'Admin Pesantren : ' . $ponpes->user_id }}</label>


                                    <select class="form-select @error('user_id') is-invalid @enderror"
                                        aria-label="Default select example" name="user_id">
                                        @if ($ponpes->user && $ponpes->user->user_role == 'admin pesantren' && $ponpes->user->count() == 0)
                                            <option value="" disabled>Akun Admin Pesantren Belum Dibuat</option>
                                        @else
                                            @if ($ponpes->user_id === null)
                                                @foreach ($user as $item)
                                                    @if ($item->user_role == 'admin pesantren' && $item->ponpes == null)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->id . ' - ' . $item->name . ' (' . $item->email . ')' }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @php $found = false; @endphp <!-- Set the variable to false initially -->
                                                @foreach ($user as $item)
                                                    @if ($item->user_role == 'admin pesantren' && $item->id == $ponpes->user_id)
                                                        @php
                                                            $hasPonpesRelation = $item->ponpes !== null;
                                                            $displayName = $item->id . ' - ' . $item->name . ' (' . $item->username . ')';
                                                        @endphp
                                                        <option value="{{ $item->id }}"
                                                            @if (old('user_id', $ponpes->user_id) == $item->id) selected @endif>
                                                            {{ $displayName }}
                                                            @if ($hasPonpesRelation)
                                                                (Ponpes: {{ $item->ponpes->name }})
                                                            @endif
                                                        </option>
                                                        @php $found = true; @endphp
                                                        <!-- Set the variable to true if a matching item is found -->
                                                    @endif
                                                    @if ($item->user_role == 'admin pesantren' && $item->ponpes == null)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->id . ' - ' . $item->name . ' (' . $item->email . ')' }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                                @if (!$found)
                                                    <!-- Display message if no matching item is found -->
                                                    <option value="" disabled selected>Akun Admin Pesantren belum
                                                        dibuat</option>
                                                @endif
                                            @endif
                                        @endif
                                    </select>

                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-12 mb-4">
                                    <label for=""
                                        class="small ms-2">{{ 'Nomor Statistik Pondok Pesantren' }}</label>
                                    <input id="nspp" type="number"
                                        class="form-control @error('nspp') is-invalid @enderror" name="nspp"
                                        value="{{ $ponpes->nspp }}" required autocomplete="nspp">

                                    @error('nspp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Nama Pesantren' }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $ponpes->name }}" required autocomplete="name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Kategori Pesantren' }}</label>
                                    <select class="form-select" aria-label="Default select example" name="category">
                                        <option value="{{ $ponpes->category }}">{{ $ponpes->category }}</option>
                                        <option value="{{ 'Pesantren Salafiyah (Tradisional)' }}">
                                            {{ 'Pesantren Salafiyah (Tradisional)' }}
                                        </option>
                                        <option value="{{ 'Pesantren Khalafiyah (Modern)' }}">
                                            {{ 'Pesantren Khalafiyah (Modern)' }}
                                        </option>
                                        <option value="{{ 'Pesantren Kombinasi' }}">{{ 'Pesantren Kombinasi' }}
                                        </option>
                                    </select>

                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Pesantren Takhasus' }}</label>
                                    <select class="form-select" aria-label="Default select example" name="takhasus">
                                        <option value="yes" @if ($ponpes->takhasus == 'yes') selected @endif>Ya</option>
                                        <option value="no" @if ($ponpes->takhasus == 'no') selected @endif>Tidak
                                        </option>

                                    </select>

                                    @error('takhasus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Nomor Telepon' }}</label>
                                    <input id="phone_number" type="tel"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ $ponpes->phone_number }}" required autocomplete="phone_number">

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
                                        value="{{ $ponpes->website }}" required autocomplete="website">

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
                                        value="{{ $ponpes->email }}" required autocomplete="email">

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
                                        name="standing_date" value="{{ $ponpes->standing_date }}" required
                                        autocomplete="standing_date">

                                    @error('standing_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Pimpinan/Pengasuh Pesantren' }}</label>
                                    <input id="pimpinan" type="text"
                                        class="form-control @error('pimpinan') is-invalid @enderror" name="pimpinan"
                                        value="{{ $ponpes->pimpinan }}" required autocomplete="pimpinan">

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
                                            name="surface_area" value="{{ $ponpes->surface_area }}" required
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
                                            name="building_area" value="{{ $ponpes->building_area }}" required
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
                                    <input id="city" type="text" class="form-control"
                                        value="{{ $ponpes->city }}" name="city" readonly>
                                </div>


                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Kecamatan' }}</label>
                                    <select class="form-select" aria-label="Default select example" name="subdistrict">
                                        @foreach ($kecamatanOptions as $kecamatan)
                                            <option value="{{ $kecamatan }}"
                                                @if (old('subdistrict', $ponpes->subdistrict) === $kecamatan) selected @endif>{{ $kecamatan }}
                                            </option>
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
                                        name="postal_code" value="{{ $ponpes->postal_code }}" required
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
                                        value="{{ $ponpes->address }}" required autocomplete="address">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-4">
                                    <label for=""
                                        class="small ms-2">{{ 'Status' }}</label>
                                        <select class="form-select" aria-label="Pilih status" name="status">
                                            <option value="active" @if(old('status') == 'active') selected @endif>Aktif</option>
                                            <option value="non-active" @if(old('status') == 'non-active') selected @endif>Tidak Aktif</option>
                                        </select>                                        

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-4 d-flex">
                                    <div class="inputan me-1 w-100">
                                        <label for="" class="small ms-2">{{ 'Latitude' }}</label>
                                        <input id="latitude" type="text"
                                            class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                                            value="{{ $ponpes->latitude }}" required autocomplete="latitude">
                                        <small>Latitude Sebelumnya : {{ $ponpes->latitude }}</small>

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
                                            name="longitude" value="{{ $ponpes->longitude }}" required
                                            autocomplete="longitude">
                                        <small>Longitude Sebelumnya : {{ $ponpes->longitude }}</small>

                                        @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mb-4 ">
                                    <div id="map" style="height: 400px;"></div>
                                </div>


                                <div class="col-12  mb-4 d-flex justify-content-end">
                                    <a href="{{ route('admin_kemenag.ponpes_view', ['id' => $ponpes->id]) }}"
                                        class="btn btn-outline-secondary me-2">
                                        {{ __('Batal') }}
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Perbaharui') }}
                                    </button>
                                </div>

                            </div>

                        </form>
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

        fetch('/geojson/{{ $ponpes->subdistrict }}.geojson') // Ubah sesuai dengan path file GeoJSON Anda
            .then((response) => response.json())
            .then((data) => {
                const geojson = L.geoJson(data).addTo(map);


            })
            .catch((error) => console.error('Error fetching GeoJSON data:', error));

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



        const LeafIcon = L.Icon.extend({
            options: {
                iconSize: [30, 36],
                iconAnchor: [15, 36],
                popupAnchor: [0, -36]
            }
        });

        const ponpesIcon1 = new LeafIcon({
            iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_1.png') }}',
        });
        const ponpesIcon2 = new LeafIcon({
            iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_2.png') }}',
        });
        const ponpesIcon3 = new LeafIcon({
            iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_3.png') }}',
        });


        @if ($ponpes->category == 'Pesantren Salafiyah (Tradisional)')
            $markerIcon = ponpesIcon1;
        @elseif ($ponpes->category == 'Pesantren Khalafiyah (Modern)')
            $markerIcon = ponpesIcon2;
        @else
            $markerIcon = ponpesIcon3;
        @endif
        L.marker([{{ $ponpes->latitude ?? 0 }}, {{ $ponpes->longitude ?? 0 }}], {
                icon: $markerIcon
            })
            .bindPopup(`
            <div class="row custom-popup">
                <div class="col-3  p-0 my-auto">
                   @if (!$ponpes->photo_profil)
                        <img class="w-100" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}" alt="profil Default">
                   @else
                        <img src="{{ asset('/images/ponpes/profile/' . $ponpes->photo_profil) }}" alt="Profil Pesatren">
                   @endif
                </div>
                <div class="col-9 py-0 pe-0 my-auto">
                    <span class="fw-bold">{{ $ponpes->name }}</span>
                    <br>
                    <span class="text-secondary">{{ $ponpes->subdistrict }}, </span>
                    <span class="text-secondary">{{ $ponpes->city }} </span>
                    <br>
                    <span class="text-secondary" style="font-size:12px">{{ $ponpes->category }} </span>
                    
                </div>
            </div>
        `).addTo(map);





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
@endpush

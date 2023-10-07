@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-5 mt-5">
        <h2 class="mb-0 text-secondary  mb-5">{{ 'Perbaharui Data ' . $madin->name }}</h2>
        <div class="mx-md-5 px-md-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 bg-white shadow rounded">
                    <div class="pt-4">
                        <form method="POST" action="{{ route('admin_kemenag.madin_update', $madin->id) }}">
                            @csrf
                            @method('PUT')


                            <div class="row ">

                                <div class="col-12 mb-4">
                                    <label for=""
                                        class="small ms-2">{{ 'Admin Madin/TPQ: ' . $madin->user_id }}</label>


                                    <select class="form-select @error('user_id') is-invalid @enderror"
                                        aria-label="Default select example" name="user_id">
                                        @if ($madin->user && $madin->user->user_role == 'admin madin' && $madin->user->count() == 0)
                                            <option value="" disabled>Akun Admin Madin/TPQ Belum Dibuat</option>
                                        @else
                                            @if ($madin->user_id === null)
                                                @foreach ($user as $item)
                                                    @if ($item->user_role == 'admin madin' && $item->madin == null)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->id . ' - ' . $item->name . ' (' . $item->email . ')' }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @php $found = false; @endphp <!-- Set the variable to false initially -->
                                                @foreach ($user as $item)
                                                    @if ($item->user_role == 'admin madin' && $item->id == $madin->user_id)
                                                        @php
                                                            $hasMadinRelation = $item->madin !== null;
                                                            $displayName = $item->id . ' - ' . $item->name . ' (' . $item->username . ')';
                                                        @endphp
                                                        <option value="{{ $item->id }}"
                                                            @if (old('user_id', $madin->user_id) == $item->id) selected @endif>
                                                            {{ $displayName }}
                                                            @if ($hasMadinRelation)
                                                                (Madin: {{ $item->madin->name }})
                                                            @endif
                                                        </option>
                                                        @php $found = true; @endphp
                                                        <!-- Set the variable to true if a matching item is found -->
                                                    @endif
                                                    @if ($item->user_role == 'admin madin' && $item->madin == null)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->id . ' - ' . $item->name . ' (' . $item->email . ')' }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                                @if (!$found)
                                                    <!-- Display message if no matching item is found -->
                                                    <option value="" disabled selected>Akun Admin Madin/TPQ belum
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
                                        class="small ms-2">{{ 'Nomor Statistik Diniyah Takmiliyah' }}</label>
                                    <input id="nsdt" type="number"
                                        class="form-control @error('nsdt') is-invalid @enderror" name="nsdt"
                                        value="{{ $madin->nsdt }}" required autocomplete="nsdt">

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
                                        value="{{ $madin->name }}" required autocomplete="name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

  



                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Nomor Telepon' }}</label>
                                    <input id="phone_number" type="tel"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ $madin->phone_number }}" required autocomplete="phone_number">

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
                                        value="{{ $madin->website }}" required autocomplete="website">

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
                                        value="{{ $madin->email }}" required autocomplete="email">

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
                                        name="standing_date" value="{{ $madin->standing_date }}" required
                                        autocomplete="standing_date">

                                    @error('standing_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Pimpinan Madrasah Diniyah/TPQ' }}</label>
                                    <input id="pimpinan" type="text"
                                        class="form-control @error('pimpinan') is-invalid @enderror" name="pimpinan"
                                        value="{{ $madin->pimpinan }}" required autocomplete="pimpinan">

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
                                            name="surface_area" value="{{ $madin->surface_area }}" required
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
                                            name="building_area" value="{{ $madin->building_area }}" required
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
                                        value="{{ $madin->city }}" name="city" readonly>
                                </div>


                                <div class="col-12 mb-4">
                                    <label for="" class="small ms-2">{{ 'Kecamatan' }}</label>
                                    <select class="form-select" aria-label="Default select example" name="subdistrict">
                                        @foreach ($kecamatanOptions as $kecamatan)
                                            <option value="{{ $kecamatan }}"
                                                @if (old('subdistrict', $madin->subdistrict) === $kecamatan) selected @endif>{{ $kecamatan }}
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
                                        name="postal_code" value="{{ $madin->postal_code }}" required
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
                                        value="{{ $madin->address }}" required autocomplete="address">

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
                                            value="{{ $madin->latitude }}" required autocomplete="latitude">
                                        <small>Latitude Sebelumnya : {{ $madin->latitude }}</small>

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
                                            name="longitude" value="{{ $madin->longitude }}" required
                                            autocomplete="longitude">
                                        <small>Longitude Sebelumnya : {{ $madin->longitude }}</small>

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
                                    <a href="{{ route('admin_kemenag.madin.madin_view', ['id' => $madin->id]) }}"
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

    fetch('/geojson/{{ $madin->subdistrict }}.geojson') // Ubah sesuai dengan path file GeoJSON Anda
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

    const madinIcon = new LeafIcon({
        iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_1.png') }}',
    });




    $markerIcon = madinIcon;

    L.marker([{{ $madin->latitude ?? 0 }}, {{ $madin->longitude ?? 0 }}], {
            icon: $markerIcon
        })
        .bindPopup(`
        <div class="row custom-popup">
            <div class="col-3  p-0 my-auto">
               @if (!$madin->photo_profil)
                    <img class="w-100" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}" alt="profil Default">
               @else
                    <img src="{{ asset('/images/ponpes/profile/' . $madin->photo_profil) }}" alt="Profil Pesatren">
               @endif
            </div>
            <div class="col-9 py-0 pe-0 my-auto">
                <span class="fw-bold">{{ $madin->name }}</span>
                <br>
                <span class="text-secondary">{{ $madin->subdistrict }}, </span>
                <span class="text-secondary">{{ $madin->city }} </span>
            
                
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

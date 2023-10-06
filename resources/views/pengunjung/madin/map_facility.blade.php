@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5 pt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('errorss'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

           {{-- panggil map nav --}}
           @include('layouts.map_nav_madin')
           {{-- end panggil map nav --}}
           
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
           
            <h2 class="mb-0 text-secondary">Peta Fasilitas Madrasah Diniyah dan TPQ di Kabupaten Batang</h2>
        </div>


        <div class="form mb-2">
            <form action="{{ route('pengunjung.madin.search_facility') }}" method="GET" class="d-flex justify-content-end">
                <div class="form-group">
                    <select class="form-control" id="attribute" name="attribute">
                        <option value="">-- Tampilkan Semua --</option>
                        @foreach ($attributeNames as $attributes => $attributeLabel)
                            <option value="{{ $attributes }}" {{ old('attribute') == $attributes ? 'selected' : '' }}>
                                {{ $attributeLabel }}</option>
                        @endforeach
                    </select>

                </div>
                <button type="submit" class="btn btn-outline-success ms-2">Tampilkan</button>
            </form>

        </div>

        <div class="text-start">
            @if (isset($attribute))
                <span class="text-secondary">Fasilitas :
                    {{ $attributeNames[$attribute] ?? 'Nama Fasilitas Tidak Diketahui' }}</span>
            @endif
        </div>
        <div class="map-view mb-5 bg-white p-2 rounded-3 shadow-sm">
            <div id="map" class="rounded-3" style="min-height:500px;max-height:900px"></div>
        </div>


        @if (isset($attribute))
            <table class="table table-bordered table-hover text-center shadow-sm ms-auto me-0 mb-5"
                style="max-width: 400px">
                <thead>
                    <tr>
                        <th colspan="2">PENJELASAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="{{ asset('/images/ponpes/maps/icon_marker_4.png') }}" alt=""
                                style="max-width: 30px"></td>
                        <td class="text-start">Memiliki Fasilitas {{ $attributeNames[$attribute] }}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('/images/ponpes/maps/icon_marker_5.png') }}" alt=""
                                style="max-width: 30px"></td>
                        <td class="text-start">Tidak Memiliki Fasilitas {{ $attributeNames[$attribute] }}</td>
                    </tr>
                </tbody>

            </table>
        @endif


        @if (!isset($attribute))
            <table class="table table-striped" id="tablefacility" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="19" class="text-center">DATA JUMLAH FASILITAS</th>
                    </tr>
                    <tr>

                        <th class="align-middle">NO</th>
                        <th class="align-middle">NAMA MADIN dan TPQ</th>
                        @foreach ($attributeNames as $item)
                            <th class="text-uppercase align-middle">{{ $item }}</th>
                        @endforeach

                    </tr>
                </thead>
                <tbody>

                    @foreach ($facilities as $facility)
                        <tr>
                            <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
                            <td>{{ $facility->madin->name ?? 'Nama Ponpes Tidak Diketahui' }}</td>
                            @foreach ($attributeTable as $item)
                                <td class="text-center align-middle">{{ $facility->$item }}</td>
                            @endforeach


                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-3">
                <a href="/pengunjung/fasilitas_madin_export_xlsx" class="btn btn-outline-success"><i class="fas fa-file-excel"></i></a>
                <a href="/pengunjung/fasilitas_madin_export_csv" class="btn btn-outline-success ms-2"><i class="fas fa-file-csv"></i></a>
            </div>
        @else
            <table class="table table-striped w-100" id="tablefacility" class="display">
                <thead>
                    <tr class="w-100">
                        <th class="align-middle text-center">NO</th>
                        <th class="align-middle text-center">NAMA MADIN dan TPQ</th>
                        @if (isset($attribute))
                            <th class="align-middle text-uppercase text-center">Jumlah
                                {{ $attributeNames[$attribute] ?? 'Nama Fasilitas Tidak Diketahui' }}</th>
                        @else
                            <th class="align-middle">FASILITAS</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facilities as $facility)
                        <tr>
                            <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
                            <td>{{ $facility->madin->name ?? 'Nama Madrasah Diniyah / TPQ Tidak Diketahui' }}</td>
                            <td class="text-center">{{ isset($attribute) ? $facility->{$attribute} : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.src.js"></script>
    <!-- Script DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Inisialisasi DataTables
        $(document).ready(function() {
            new DataTable('#tablefacility', {
                scrollCollapse: true,
                scrollX: true

            });

        });
    </script>
    <script>
        var map = new L.map('map').setView([-6.993808128800089, 109.83246433526726], 10);
        map.addLayer(new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')); //base
        const baseLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '<button class="btn border-1" style="font-size:10px" onclick="focusOnArea()">Kabupaten Batang</button>'
        });

        const subdistrictLayers = {}; // Objek untuk menyimpan layer berdasarkan subdistrict

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
            iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_4.png') }}',
        });
        const ponpesIcon2 = new LeafIcon({
            iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_5.png') }}',
        });



        var markersLayer = new L.LayerGroup();
        map.addLayer(markersLayer);

        var controlSearch = new L.Control.Search({
            position: 'topleft',
            layer: markersLayer,
            initial: false,
            zoom: 18,
            markerLocation: true
        })

        map.addControl(controlSearch);

        // Buat array untuk simpan data pencarian
        @php
            $data_pencarian = [];
        @endphp

        @foreach ($facilities as $facility)
            @php
                $db_data = [
                    'loc' => [$facility->madin->latitude, $facility->madin->longitude],
                    'title' => $facility->madin->name,
                ];
                
                $data_pencarian[] = $db_data;
            @endphp
        @endforeach

        // insialisasi variable data (convert variable php ke js)
        var data = @json($data_pencarian);
        var i = 0

        @foreach ($facilities as $facility)
            @php
                $ponpes = $facility->ponpes;
                $subdistrict = $facility->madin->subdistrict;
                $markerIcon = null;
                
                if (!isset($attribute)) {
                    $markerIcon = 'ponpesIcon1';
                } else {
                    $hasPositiveAttribute = false;
                
                    foreach ($attributeTable as $item) {
                        if ($facility->$item > 0) {
                            $hasPositiveAttribute = true;
                            break;
                        }
                    }
                
                    $markerIcon = $hasPositiveAttribute ? 'ponpesIcon1' : 'ponpesIcon2';
                }
            @endphp

            // Membuat layer berdasarkan subdistrict jika belum ada
            if (!subdistrictLayers['{{ $subdistrict }}']) {
                subdistrictLayers['{{ $subdistrict }}'] = L.layerGroup().addTo(map);
            }
            var title = data[i].title, //data yang dicari, nama variable harus 'title'
                loc = data[i].loc, //untuk naruh posisi marker
                marker = new L.Marker(new L.latLng(loc), {
                    title: title,
                    icon: {!! $markerIcon === 'ponpesIcon1' ? 'ponpesIcon1' : 'ponpesIcon2' !!}
                });
            marker.bindPopup(`
                <div class="row custom-popup ">
                    <div class="col-3 p-0 my-auto">
                        @if (!$facility->madin->photo_profil)
                            <img class="w-100" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}" alt="profil Default">
                        @else
                            <img src="{{ asset('/images/ponpes/profile/' . $facility->madin->photo_profil) }}" alt="Profil Madin">
                        @endif
                    </div>
                    <div class="col-9 py-0 pe-0 my-auto">
                        <div class="title-map m-0">
                            <a href="{{ route('pengunjung.madin.madin_view', ['id' => $facility->madin->id]) }}">
                                <span class="fw-bold">{{ $facility->madin->name }}</span>    
                            </a>
                        </div>

                        <span class="text-secondary">{{ $facility->madin->subdistrict }}, </span>
                        <span class="text-secondary">{{ $facility->madin->city }} </span>
                        <br>
                        @if (isset($attribute))
                            <span class="text-secondary" style="font-size:12px">Jumlah : {{ isset($attribute) ? $facility->{$attribute} : '-' }} </span>
                        @endif
                    </div>
                </div>
            `)
                .addTo(subdistrictLayers['{{ $subdistrict }}']);
            markersLayer.addLayer(marker);
            i += 1
        @endforeach

        function onMapClick(e) {
            const {
                lat,
                lng
            } = e.latlng; // Separate latitude and longitude variables

            L.popup()
                .setLatLng(e.latlng)
                .setContent(`Posisi Klik <br>Latitude: ${lat.toFixed(6)}<br> Longitude: ${lng.toFixed(6)}`)
                .openOn(map);
        }

        map.on('click', onMapClick);

        // Group layer control
        const baseLayers = {
            'Base Layer': baseLayer,
            'Topography View': L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '<button class="btn border-1" style="font-size:10px" onclick="focusOnArea()">Kabupaten Batang</button>'
            })
        };

        const overlayLayers = {
            @foreach ($facilities->groupBy('madin.subdistrict') as $subdistrict => $facilitiesGroup)
                '{{ $subdistrict }}': subdistrictLayers['{{ $subdistrict }}'],
            @endforeach
        };

        L.control.layers(baseLayers, overlayLayers).addTo(map);


        $('#textsearch').on('keyup', function(e) {
            controlSearch.searchText(e.target.value);
        })

        // maps ke-dua
    </script>
@endpush

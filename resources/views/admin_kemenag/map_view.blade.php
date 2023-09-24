@extends('layouts.app')



@section('content')
    <div class="container-fluid mt-5 pt-5">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0 text-secondary">Peta Pondok Pesantren di Kabupaten Batang</h2>
        </div>
        <div class="map-view mb-3 bg-white p-2 rounded-3 shadow-sm">
            <div id="map" class="rounded-3" style="min-height:500px;max-height:900px"></div>
        </div>
        <table class="table table-bordered table-hover text-center shadow-sm ms-auto me-0 mb-5" style="max-width: 400px">
            <thead>
                <tr>
                    <th colspan="2">PENJELASAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="{{ asset('/images/ponpes/maps/icon_marker_1.png') }}" alt=""
                            style="max-width: 30px"></td>
                    <td class="text-start">Pesantren Salafiyah (Tradisional)</td>
                </tr>
                <tr>
                    <td><img src="{{ asset('/images/ponpes/maps/icon_marker_2.png') }}" alt=""
                            style="max-width: 30px"></td>
                    <td class="text-start">Pesantren Khalafiyah (Modern)</td>
                </tr>
                <tr>
                    <td><img src="{{ asset('/images/ponpes/maps/icon_marker_3.png') }}" alt=""
                            style="max-width: 30px"></td>
                    <td class="text-start">Pesantren Kombinasi</td>
                </tr>
            </tbody>

        </table>
        <table class="table table-responsive table-bordered table-hover text-center shadow" id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th colspan="6"class="text-center" >DATA JENIS PESANTREN</th>
                </tr>
                <tr >
                    <th scope="col" class="text-center">NO</th>
                    <th scope="col" class="text-center">KECAMATAN</th>
                    <th scope="col" class="text-center">SALAFIYAH (TRADISIONAL)</th>
                    <th scope="col" class="text-center">KHALAFIYAH (MODERN)</th>
                    <th scope="col" class="text-center">KOMBINASI</th>
                    <th scope="col" class="text-center">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp

                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="text-start">{{ $item->subdistrict }}</td>
                        <td>{{ $item->salafiyah_count }}</td>
                        <td>{{ $item->khalafiyah_count }}</td>
                        <td>{{ $item->kombinasi_count }}</td>
                        <td>{{ $item->Total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
            new DataTable('#example', {
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
            iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_1.png') }}',
        });
        const ponpesIcon2 = new LeafIcon({
            iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_2.png') }}',
        });
        const ponpesIcon3 = new LeafIcon({
            iconUrl: '{{ asset('/images/ponpes/maps/icon_marker_3.png') }}',
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

        // Buat asosiatif array dan masukkan ke array sebelumnya
        @foreach ($ponpes as $ponpe)
            @php
                $db_data = [
                    'loc' => [$ponpe->latitude, $ponpe->longitude],
                    'title' => $ponpe->name,
                ];
                
                $data_pencarian[] = $db_data;
            @endphp
        @endforeach

        // insialisasi variable data (convert variable php ke js)
        var data = @json($data_pencarian);
        var i = 0

        @foreach ($ponpes as $ponpe)
            @php
                $subdistrict = $ponpe->subdistrict;
                $markerIcon = null;
                
                if ($ponpe->category == 'Pesantren Salafiyah (Tradisional)') {
                    $markerIcon = 'ponpesIcon1';
                } elseif ($ponpe->category == 'Pesantren Khalafiyah (Modern)') {
                    $markerIcon = 'ponpesIcon2';
                } else {
                    $markerIcon = 'ponpesIcon3';
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
                    icon: {{ $markerIcon }}
                });
            marker.bindPopup(`
                <div class="row custom-popup ">
                    <div class="col-3 p-0 my-auto">
                        @if (!$ponpe->photo_profil)
                            <img class="w-100" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}" alt="profil Default">
                        @else
                            <img src="{{ asset('/images/ponpes/profile/' . $ponpe->photo_profil) }}" alt="Profil Pesatren">
                        @endif
                    </div>
                    <div class="col-9 py-0 pe-0 my-auto">
                        <div class="title-map m-0">
                            <a href="{{ route('admin_kemenag.ponpes_view', ['id' => $ponpe->id]) }}">
                                <span class="fw-bold">{{ $ponpe->name }}</span>    
                            </a>
                        </div>

                        <span class="text-secondary">{{ $ponpe->subdistrict }}, </span>
                        <span class="text-secondary">{{ $ponpe->city }} </span>
                        <br>
                        <span class="text-secondary" style="font-size:12px">{{ $ponpe->category }} </span>
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
            @foreach ($ponpes->groupBy('subdistrict') as $subdistrict => $ponpes)
                '{{ $subdistrict }}': subdistrictLayers['{{ $subdistrict }}'],
            @endforeach
        };

        L.control.layers(baseLayers, overlayLayers).addTo(map);

        $('#textsearch').on('keyup', function(e) {
            controlSearch.searchText(e.target.value);
        })

    </script>
@endpush





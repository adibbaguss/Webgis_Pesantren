@extends('layouts.app')



@section('content')
    <div class="container mt-5 pt-5">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0 text-secondary">Peta Pondok Pesantren</h2>
        </div>
        <div class="map-view mb-5 bg-white p-2 rounded-3 shadow">
            <div id="map" class="rounded-3" style="min-height:400px;max-height:700px"></div>
        </div>
        <table class="table table-responsive table-bordered table-hover text-center shadow">
            <thead>
                <tr>
                    <th colspan="6">DATA JENIS PESANTREN</th>
                </tr>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">KECAMATAN</th>
                    <th scope="col">SALAFIYAH</th>
                    <th scope="col">KHALAFIYAH</th>
                    <th scope="col">KOMBINASI</th>
                    <th scope="col">TOTAL</th>
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
                iconSize: [20, 30],
                iconAnchor: [10, 30],
                popupAnchor: [0, -30]
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
                
                if ($ponpe->category == 'Pesantren Salafiyah') {
                    $markerIcon = 'ponpesIcon1';
                } elseif ($ponpe->category == 'Pesantren Khalafiyah') {
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
                            <a href="{{ route('admin.ponpes_view', ['id' => $ponpe->id]) }}">
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
                .setContent(`Anda Klik Latitude: (${lat.toFixed(6)}, Lotitude: ${lng.toFixed(6)})`)
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

        // maps ke-dua
    </script>
@endpush




// @push('javascript')
    //
    <script>
        //         // const map2 = L.map('map_2').setView([-6.993808128800089, 109.83246433526726], 10);

        //         // const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //         //     maxZoom: 19,
        //         //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        //         // }).addTo(map2);

        //         // @foreach ($ponpes2 as $polygon)
        //         //     fetch('{{ asset('/geojson/' . $polygon->subdistrict . '.geojson') }}')
        //         //         .then(response => response.json())
        //         //         .then(data => {
        //         //             L.geoJSON(data).addTo(map2);
        //         //         });
        //         // @endforeach

        //         // fetch('{{ asset('/geojson/Banyuputih.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Batang.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Bawang.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Blado.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Gringsing.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Kandeman.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Limpung.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Pecalungan.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Reban.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Subah.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Tersono.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Tulis.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Warungasem.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });

        //         //     fetch('{{ asset('/geojson/Wonotunggal.geojson') }}')
        //         //     .then(response => response.json())
        //         //     .then(data => {
        //         //         L.geoJSON(data).addTo(map2);
        //         //     });
        //     
    </script>
    //
@endpush

// @push('javascript')
    //
    <script>
        //         // Inisialisasi peta
        //         var map = L.map('map').setView([-7.797068, 110.370529], 10);

        //         // Tambahkan lapisan peta dasar
        //         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //             attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        //             maxZoom: 18,
        //         }).addTo(map);

        //         // Tambahkan data kecamatan dari GeoJSON
        //         var geojsonLayer = L.geoJSON(null, {
        //             style: function(feature) {
        //                 var count = feature.properties.count;
        //                 return {
        //                     fillColor: getColor(count),
        //                     weight: 1,
        //                     opacity: 1,
        //                     color: 'white',
        //                     fillOpacity: 0.7
        //                 };
        //             },
        //             onEachFeature: function(feature, layer) {
        //                 layer.on({
        //                     mouseover: highlightFeature,
        //                     mouseout: resetHighlight
        //                 });

        //                 var count = feature.properties.count;
        //                 layer.bindPopup('Subdistrict: ' + feature.properties.subdistrict + '<br>Total Ponpes: ' +
        //                     count);
        //             }
        //         }).addTo(map);

        //         // Ambil data GeoJSON dari file
        //         var geojsonUrl = '/geojson/your_geojson_file.geojson';
        //         fetch(geojsonUrl)
        //             .then(response => response.json())
        //             .then(data => {
        //                 geojsonLayer.addData(data);
        //             });

        //         // Fungsi untuk menentukan warna berdasarkan jumlah Ponpes
        //         function getColor(count) {
        //             // Ubah rentang dan skala warna sesuai kebutuhan
        //             if (count < 10) {
        //                 return 'green';
        //             } else if (count < 20) {
        //                 return 'yellow';
        //             } else {
        //                 return 'red';
        //             }
        //         }

        //         // Fungsi untuk menyoroti kecamatan saat mouseover
        //         function highlightFeature(e) {
        //             var layer = e.target;

        //             layer.setStyle({
        //                 weight: 2,
        //                 color: '#666',
        //                 dashArray: '',
        //                 fillOpacity: 0.9
        //             });

        //             if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        //                 layer.bringToFront();
        //             }
        //         }

        //         // Fungsi untuk mengembalikan kecamatan ke tampilan awal saat mouseout
        //         function resetHighlight(e) {
        //             geojsonLayer.resetStyle(e.target);
        //         }
        //     
    </script>
    //
@endpush

@extends('layouts.app')


@section('content')
    <div class="container-fluid mt-5 pt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- age Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-secondary">Dashboard</h4>
        </div>

        <div class="row">

            <div class="col-xl-7 col-lg-6 mb-4">
                <div class="card shadow mb-4 " style="user-select: none;">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-success">{{ 'Lokasi ' . $ponpes->name }}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="map-area ">
                            <div class="border-3" id="map"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-4 mb-4">
                <div class="card shadow mb-4 " style="user-select: none;">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-success">
                            {{ 'Jumlah Santri & Santriwati Tahun ' . \Carbon\Carbon::now()->format('Y') }}
                        </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <canvas id="chartStudent" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>



        </div>

    </div>
@endsection

@push('javascript')
    <script>
        const map = L.map('map').setView([{{ $ponpes->latitude ?? 0 }}, {{ $ponpes->longitude ?? 0 }}], 15);

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


        @if ($ponpes->category == 'Pesantren Salafiyah')
            $markerIcon = ponpesIcon1;
        @elseif ($ponpes->category == 'Pesantren Khalafiyah')
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




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Fetch your chart data from Laravel
        var chartData = @json($chartData);

        // Get the canvas element
        var ctx = document.getElementById('chartStudent').getContext('2d');

        // Create the chart
        var studentChart = new Chart(ctx, {
            type: 'bar', // You can choose other types such as line, pie, etc.
            data: {
                labels: chartData.labels,
                datasets: [{
                        label: 'Santri Mukim',
                        data: chartData.male_resident_count,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Santriwati Mukim',
                        data: chartData.female_resident_count,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Santri Tidak Mukim',
                        data: chartData.male_non_resident_count,
                        backgroundColor: 'rgba(255, 205, 86, 0.2)',
                        borderColor: 'rgba(255, 205, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Santriwati Tidak Mukim',
                        data: chartData.female_non_resident_count,
                        backgroundColor: 'rgba(48, 255, 145, 0.2)',
                        borderColor: 'rgba(48, 255, 145, 1)',
                        borderWidth: 1
                    },

                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        min: 0,
                        ticks: {
                            // forces step size to be 50 units
                            stepSize: 1
                        }
                    },
                }
            }
        });
    </script>
@endpush

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

            <!--Jumlah Pengajar-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Pengajar' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-success ">
                                    {{ $madin->instructors_madin->count() }}
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                {{-- <i class="fas fa-building fs-1 text-success "></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Jumlah aktifitas-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Aktivitas' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-success ">
                                    {{ $madin->activities_madin->count() }}
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                {{-- <i class="fas fa-building fs-1 text-success "></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Jumlah pembelajaran-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah pembelajaran' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-success ">
                                    {{ $madin->learning_madin->count() }}
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                {{-- <i class="fas fa-building fs-1 text-success "></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Jumlah aktifitas-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Murid Saat ini' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-success ">
                                    @php
                                        $jumlah = 0; // Inisialisasi variabel jumlah
                                    @endphp

                                    @foreach ($madin->studentCount_madin as $item)
                                        @if ($item->year == date('Y'))
                                            @php
                                                // Tambahkan setiap nilai ke variabel jumlah
                                                $jumlah += $item->male;
                                                $jumlah += $item->female;
                                            @endphp
                                        @endif
                                    @endforeach

                                    {{ $jumlah }}
                                </div>
                            </div>

                            <div class="col-auto my-auto">
                                {{-- <i class="fas fa-building fs-1 text-success "></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-xl-7 col-lg-6 mb-4">
                <div class="card shadow mb-4 " style="user-select: none;">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-success">{{ 'Lokasi ' . $madin->name }}</h6>
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
                            {{ 'Jumlah Siswa ' . \Carbon\Carbon::now()->format('Y') }}
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
        const map = L.map('map').setView([{{ $madin->latitude ?? 0 }}, {{ $madin->longitude ?? 0 }}], 15);

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
                        label: 'Siswa (LK)',
                        data: chartData.male,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Siswa (PR)',
                        data: chartData.female,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
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

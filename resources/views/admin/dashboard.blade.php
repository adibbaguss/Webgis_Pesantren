@extends('layouts.app')


@section('content')
    <div class="container mt-5 pt-5">

        <!-- age Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-secondary">Dashboard</h4>
        </div>

        <div class="row">
            <!--Jumlah Ponpes-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ps-1 bg-primary my-2  border-0 shadow"  style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-primary text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Pondok Pesantren' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-secondary">
                                    {{ \App\Models\Ponpes::count() }}
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <i class="fas fa-building fs-1 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Jumlah Santri-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ps-1 bg-warning my-2  border-0 shadow"  style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-warning text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Santri Tahun '. date('Y') }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-secondary">
                                    {{ $studentCount[0]->total_count }}
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <i class="fas fa-user-graduate  fs-1 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--Jumlah akun-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ps-1 bg-danger my-2  border-0 shadow"  style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-danger text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Akun' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-secondary">
                                    {{ \App\Models\User::where('user_role', '!=', 'admin')->count() }}
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <i class="fas fa-user  fs-1 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Jumlah Report-->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow"  style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Pelaporan' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-secondary">
                                    {{ $reports->count() }}
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <i class="fas fa-file-alt  fs-1 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-7 col-lg-6 mb-4">
                <div class="card shadow mb-4 "  style="user-select: none;">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-success">{{ 'Pemetaan Pondok Pesantren' }}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area ">
                            <div class="border-3" id="map"></div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-5 col-lg-6 mb-4">
                <div class="card shadow mb-4"  style="user-select: none;">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-success">{{ 'Pertumbuhan Pondok Pesantren' }}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area  py-3">
                            <canvas class="w-100 h-100 mx-auto" id="chartPonpes"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @push('javascript')
        <script>
            const map = L.map('map').setView([-6.993808128800089, 109.83246433526726], 10);

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                 attribution: '<button class="btn border-1" style="font-size:10px" onclick="focusOnArea()">Kabupaten Batang</button>'
            }).addTo(map);


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
                }
            });

            const ponpesIcon1 = new LeafIcon({
                iconUrl:  '{{ asset('/images/ponpes/maps/icon_marker_1.png') }}',
            });
            const ponpesIcon2 = new LeafIcon({
                iconUrl:  '{{ asset('/images/ponpes/maps/icon_marker_2.png') }}',
            });
            const ponpesIcon3 = new LeafIcon({
                iconUrl:  '{{ asset('/images/ponpes/maps/icon_marker_3.png') }}',
            });

            @foreach ($ponpes as $ponpe)
                @if ($ponpe->category == 'Pesantren Salafiyah')
                    $markerIcon = ponpesIcon1;
                @elseif ($ponpe->category == 'Pesantren Khalafiyah')
                    $markerIcon = ponpesIcon2;
                @else
                    $markerIcon = ponpesIcon3;
                @endif
                L.marker([{{ $ponpe->latitude ?? 0 }}, {{ $ponpe->longitude ?? 0 }}], {
                        icon: $markerIcon
                    })
                    .bindPopup(`
                    <div class="row custom-popup">
                        <div class="col-3  p-0 my-auto">
                           @if (!$ponpe->photo_profil)
                                <img class="w-100" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}" alt="profil Default">
                           @else
                                <img src="{{ asset('/images/ponpes/profile/'.$ponpe->photo_profil) }}" alt="Profil Pesatren">
                           @endif
                        </div>
                        <div class="col-9 py-0 pe-0 my-auto">
                            <span class="fw-bold">{{ $ponpe->name }}</span>
                            <br>
                            <span class="text-secondary">{{ $ponpe->subdistrict }}, </span>
                            <span class="text-secondary">{{ $ponpe->city }} </span>
                            <br>
                            <span class="text-secondary" style="font-size:12px">{{ $ponpe->category }} </span>
                            
                        </div>
                    </div>
                `).addTo(map);
            @endforeach



            // function onMapClick(e) {
            //     const {
            //         lat,
            //         lng
            //     } = e.latlng; // Separate latitude and longitude variables

            //     L.popup()
            //         .setLatLng(e.latlng)
            //         .setContent(`You clicked the map at (${lat.toFixed(6)}, ${lng.toFixed(6)})`)
            //         .openOn(map);
            // }

            // map.on('click', onMapClick);
        </script>






        <script>
            // Mendapatkan data chart dari controller
            var chartData = @json($chartData);

            // Membuat chart menggunakan Chart.js
            var ctx = document.getElementById('chartPonpes').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                            label: 'Total Per-Tahun',
                            data: chartData.total_count,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Penambahan Per-Tahun',
                            data: chartData.count,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
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

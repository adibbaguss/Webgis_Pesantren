<div class="col-xl-7 col-lg-6 mb-4">
    <div class="card shadow-sm mb-4 " style="user-select: none;">
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

    @foreach ($ponpes as $ponpe)
        @if ($ponpe->category == 'Pesantren Salafiyah (Tradisional)')
            $markerIcon = ponpesIcon1;
        @elseif ($ponpe->category == 'Pesantren Khalafiyah (Modern)')
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
                            <img src="{{ asset('/images/ponpes/profile/' . $ponpe->photo_profil) }}" alt="Profil Pesatren">
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
    
@endpush
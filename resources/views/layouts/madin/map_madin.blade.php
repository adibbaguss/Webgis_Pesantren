<!-- Tampilan pertama peta -->
<div class="col-xl-7 col-lg-6 mb-4">
    <div class="card shadow-sm mb-4" style="user-select: none;">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-success">{{ 'Pemetaan Pondok Pesantren' }}</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <div class="border-3" id="map" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Tampilan kedua peta -->
<div class="col-xl-7 col-lg-6 mb-4">
    <div class="card shadow-sm mb-4" style="user-select: none;">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-success">{{ 'Pemetaan Madrasah Diniyah & TPQ' }}</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <div class="border-3" id="map_madin" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>

@push('javascript')
<script>
    // Inisialisasi peta pertama
    const map = L.map('map').setView([-6.993808128800089, 109.83246433526726], 10);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<button class="btn border-1" style="font-size:10px" onclick="focusOnArea()">Kabupaten Batang</button>'
    }).addTo(map);

    // Inisialisasi peta kedua
    const map_madin = L.map('map_madin').setView([-6.993808128800089, 109.83246433526726], 10);

    const tiles_madin = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '<button class="btn border-1" style="font-size:10px" onclick="focusOnArea()">Kabupaten Batang</button>'
    }).addTo(map_madin);

    // Fungsi untuk fokus pada area tertentu
    function focusOnArea() {
        // Koordinat daerah yang ingin difokuskan
        var areaCoordinates = [
            [-6.970228790174548, 109.70809578547586],
            [-6.981569161983875, 110.0456888726489],
            [-6.911688089761459, 109.85672672728148],
            [-7.179395037882008, 109.84883213797919]
        ];

        var areaBounds = L.latLngBounds(areaCoordinates); // Membuat batas daerah dari koordinat

        map.fitBounds(areaBounds); // Mengatur peta pertama untuk memfokuskan pada batas daerah
        map_madin.fitBounds(areaBounds); // Mengatur peta kedua untuk memfokuskan pada batas daerah
    }

    // Definisi ikon marker
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

    // Tambahkan marker ke peta pertama
    @foreach ($ponpes as $item)
        var markerIcon = madinIcon;
        L.marker([{{ $item->latitude ?? 0 }}, {{ $item->longitude ?? 0 }}], {
            icon: markerIcon
        })
        .bindPopup(`
            <div class="row custom-popup">
                <div class="col-3  p-0 my-auto">
                    @if (!$item->photo_profil)
                        <img class="w-100" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}" alt="profil Default">
                    @else
                        <img src="{{ asset('/images/ponpes/profile/' . $item->photo_profil) }}" alt="Profil Pesantren">
                    @endif
                </div>
                <div class="col-9 py-0 pe-0 my-auto">
                    <span class="fw-bold">{{ $item->name }}</span>
                    <br>
                    <span class="text-secondary">{{ $item->subdistrict }}, </span>
                    <span class="text-secondary">{{ $item->city }} </span>
                </div>
            </div>
        `).addTo(map);
    @endforeach

    // Tambahkan marker ke peta kedua
    @foreach ($madin as $item)
        var markerIcon_madin = madinIcon;
        L.marker([{{ $item->latitude ?? 0 }}, {{ $item->longitude ?? 0 }}], {
            icon: markerIcon_madin
        })
        .bindPopup(`
            <div class="row custom-popup">
                <div class="col-3  p-0 my-auto">
                    @if (!$item->photo_profil)
                        <img class="w-100" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}" alt="profil Default">
                    @else
                        <img src="{{ asset('/images/ponpes/profile/' . $item->photo_profil) }}" alt="Profil Pesatren">
                    @endif
                </div>
                <div class="col-9 py-0 pe-0 my-auto">
                    <span class="fw-bold">{{ $item->name }}</span>
                    <br>
                    <span class="text-secondary">{{ $item->subdistrict }}, </span>
                    <span class="text-secondary">{{ $item->city }} </span>
                </div>
            </div>
        `).addTo(map_madin);
    @endforeach
</script>
@endpush

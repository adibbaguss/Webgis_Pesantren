@if (!Auth::User())
    <div class="d-sm-block d-none">
        <div class="d-flex justify-content-center w-100">
            <a href="{{ route('pengunjung.map_view') }}"
                class="btn btn-{{ request()->is('pengunjung/map_view*') ? 'success' : 'outline-success' }}">
                <i class="fas fa-map-marked-alt"></i> Kategori
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('pengunjung.maps_facility') }}"
                class="btn btn-{{ request()->is('pengunjung/maps_facility*') ? 'success' : 'outline-success' }}"
                disabled>
                <i class="fas fa-map-marked-alt"></i> Fasilitas
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('pengunjung.maps_schools') }}"
                class="btn btn-{{ request()->is('pengunjung/maps_schools*') ? 'success' : 'outline-success' }}"
                disabled>
                <i class="fas fa-map-marked-alt"></i> Sekolah
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('pengunjung.map_takhasus') }}"
                class="btn btn-{{ request()->is('pengunjung/map_takhasus*') ? 'success' : 'outline-success' }}">
                <i class="fas fa-map-marked-alt"></i> Takhasus
            </a>
        </div>
    </div>

    <div class="d-sm-none d-block">
        <div class="d-grid justify-content-center">
            <div class="d-flex justify-content-between mb-2">

                <a href="{{ route('pengunjung.map_view') }}"
                    class="mx-1 btn btn-{{ request()->is('pengunjung/map_view*') ? 'success' : 'outline-success' }}">
                    <i class="fas fa-map-marked-alt"></i> Kategori
                </a>

                <a href="{{ route('pengunjung.maps_facility') }}"
                    class="mx-1 btn btn-{{ request()->is('pengunjung/maps_facility*') ? 'success' : 'outline-success' }}"
                    disabled>
                    <i class="fas fa-map-marked-alt"></i> Fasilitas
                </a>
            </div>
            <div class="d-flex justify-content-between mb-2">

                <a href="{{ route('pengunjung.maps_schools') }}"
                    class="mx-1 btn btn-{{ request()->is('pengunjung/maps_schools*') ? 'success' : 'outline-success' }}"
                    disabled>
                    <i class="fas fa-map-marked-alt"></i> Sekolah
                </a>

                <a href="{{ route('pengunjung.map_takhasus') }}"
                    class="mx-1 btn btn-{{ request()->is('pengunjung/map_takhasus*') ? 'success' : 'outline-success' }}">
                    <i class="fas fa-map-marked-alt"></i> Takhasus
                </a>
            </div>
        </div>
    </div>
@elseif(Auth::User()->user_role == 'admin kemenag')
    <div class="d-sm-block d-none">
        <div class="d-flex justify-content-center w-100">
            <a href="{{ route('admin_kemenag.map_view') }}"
                class="btn btn-{{ request()->is('admin kemenag/map_view*') ? 'success' : 'outline-success' }}">
                <i class="fas fa-map-marked-alt"></i> Kategori
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('admin_kemenag.maps_facility') }}"
                class="btn btn-{{ request()->is('admin kemenag/maps_facility*') ? 'success' : 'outline-success' }}"
                disabled>
                <i class="fas fa-map-marked-alt"></i> Fasilitas
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('admin_kemenag.maps_schools') }}"
                class="btn btn-{{ request()->is('admin kemenag/maps_schools*') ? 'success' : 'outline-success' }}"
                disabled>
                <i class="fas fa-map-marked-alt"></i> Sekolah
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('admin_kemenag.map_takhasus') }}"
                class="btn btn-{{ request()->is('admin kemenag/map_takhasus*') ? 'success' : 'outline-success' }}">
                <i class="fas fa-map-marked-alt"></i> Takhasus
            </a>
        </div>
    </div>

    <div class="d-sm-none d-block">
        <div class="d-grid justify-content-center">
            <div class="d-flex justify-content-between mb-2">

                <a href="{{ route('admin_kemenag.map_view') }}"
                    class="mx-1 btn btn-{{ request()->is('admin kemenag/map_view*') ? 'success' : 'outline-success' }}">
                    <i class="fas fa-map-marked-alt"></i> Kategori
                </a>

                <a href="{{ route('admin_kemenag.maps_facility') }}"
                    class="mx-1 btn btn-{{ request()->is('admin kemenag/maps_facility*') ? 'success' : 'outline-success' }}"
                    disabled>
                    <i class="fas fa-map-marked-alt"></i> Fasilitas
                </a>
            </div>
            <div class="d-flex justify-content-between mb-2">

                <a href="{{ route('admin_kemenag.maps_schools') }}"
                    class="mx-1 btn btn-{{ request()->is('admin kemenag/maps_schools*') ? 'success' : 'outline-success' }}"
                    disabled>
                    <i class="fas fa-map-marked-alt"></i> Sekolah
                </a>

                <a href="{{ route('admin_kemenag.map_takhasus') }}"
                    class="mx-1 btn btn-{{ request()->is('admin kemenag/map_takhasus*') ? 'success' : 'outline-success' }}">
                    <i class="fas fa-map-marked-alt"></i> Takhasus
                </a>
            </div>
        </div>
    </div>
@elseif(Auth::User()->user_role == 'pelapor')
    <div class="d-sm-block d-none">
        <div class="d-flex justify-content-center w-100">
            <a href="{{ route('pelapor.map_view') }}"
                class="btn btn-{{ request()->is('pelapor/map_view*') ? 'success' : 'outline-success' }}">
                <i class="fas fa-map-marked-alt"></i> Kategori
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('pelapor.maps_facility') }}"
                class="btn btn-{{ request()->is('pelapor/maps_facility*') ? 'success' : 'outline-success' }}" disabled>
                <i class="fas fa-map-marked-alt"></i> Fasilitas
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('pelapor.maps_schools') }}"
                class="btn btn-{{ request()->is('pelapor/maps_schools*') ? 'success' : 'outline-success' }}" disabled>
                <i class="fas fa-map-marked-alt"></i> Sekolah
            </a>
            <div class="mx-1"></div>
            <a href="{{ route('pelapor.map_takhasus') }}"
                class="btn btn-{{ request()->is('pelapor/map_takhasus*') ? 'success' : 'outline-success' }}">
                <i class="fas fa-map-marked-alt"></i> Takhasus
            </a>
        </div>
    </div>

    <div class="d-sm-none d-block">
        <div class="d-grid justify-content-center">
            <div class="d-flex justify-content-between mb-2">

                <a href="{{ route('pelapor.map_view') }}"
                    class="mx-1 btn btn-{{ request()->is('pelapor/map_view*') ? 'success' : 'outline-success' }}">
                    <i class="fas fa-map-marked-alt"></i> Kategori
                </a>

                <a href="{{ route('pelapor.maps_facility') }}"
                    class="mx-1 btn btn-{{ request()->is('pelapor/maps_facility*') ? 'success' : 'outline-success' }}"
                    disabled>
                    <i class="fas fa-map-marked-alt"></i> Fasilitas
                </a>
            </div>
            <div class="d-flex justify-content-between mb-2">

                <a href="{{ route('pelapor.maps_schools') }}"
                    class="mx-1 btn btn-{{ request()->is('pelapor/maps_schools*') ? 'success' : 'outline-success' }}"
                    disabled>
                    <i class="fas fa-map-marked-alt"></i> Sekolah
                </a>

                <a href="{{ route('pelapor.map_takhasus') }}"
                    class="mx-1 btn btn-{{ request()->is('pelapor/map_takhasus*') ? 'success' : 'outline-success' }}">
                    <i class="fas fa-map-marked-alt"></i> Takhasus
                </a>
            </div>
        </div>
    </div>
@endif
<hr class="pb-1 mb-4">

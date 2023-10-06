{{-- <h5 class="text-center">
  - PETA PONDOK PESANTREN - 
</h5> --}}

<style>
    .scrollable-buttons {
        overflow-x: auto;
        white-space: nowrap;
        /* Menghindari pemisahan baris */
        display: flex;
        justify-content: flex-start;
        /* Alinasi tombol-tombol ke kiri */
        align-items: center;
        /* Pusatkan secara vertikal */

    }

    /* Stil tambahan sesuai kebutuhan Anda */
    .scrollable-buttons a {
        margin-right: 10px;
        /* Spasi antara tombol */
        margin-bottom: 10px;

    }
</style>
@if (!Auth::User())
    <div class="scrollable-buttons  justify-content-md-center mb-2">
        <a href="{{ route('pengunjung.map_view') }}"
            class="btn btn-{{ request()->is('pengunjung/map_view*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-map-marked-alt"></i> Kategori
        </a>

        <a href="{{ route('pengunjung.maps_facility') }}"
            class="btn btn-{{ request()->is('pengunjung/maps_facility*') ? 'success' : 'outline-success' }}" disabled>
            <i class="fas fa-map-marked-alt"></i> Fasilitas
        </a>

        <a href="{{ route('pengunjung.maps_schools') }}"
            class="btn btn-{{ request()->is('pengunjung/maps_schools*') ? 'success' : 'outline-success' }}" disabled>
            <i class="fas fa-map-marked-alt"></i> Sekolah
        </a>

        <a href="{{ route('pengunjung.map_takhasus') }}"
            class="btn btn-{{ request()->is('pengunjung/map_takhasus*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-map-marked-alt"></i> Takhasus
        </a>
    </div>
@elseif(Auth::User()->user_role == 'admin kemenag')
    <div class="scrollable-buttons  justify-content-md-center mb-2">

        <a href="{{ route('admin_kemenag.map_view') }}"
        class="btn btn-{{ request()->is('admin kemenag/map_view*') ? 'success' : 'outline-success' }}">
        <i class="fas fa-map-marked-alt"></i> Umum
    </a>

        <a href="{{ route('admin_kemenag.map_category') }}"
            class="btn btn-{{ request()->is('admin kemenag/map_category*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-map-marked-alt"></i> Kategori
        </a>

        <a href="{{ route('admin_kemenag.maps_facility') }}"
            class="btn btn-{{ request()->is('admin kemenag/maps_facility*') ? 'success' : 'outline-success' }}"
            disabled>
            <i class="fas fa-map-marked-alt"></i> Fasilitas
        </a>

        <a href="{{ route('admin_kemenag.maps_schools') }}"
            class="btn btn-{{ request()->is('admin kemenag/maps_schools*') ? 'success' : 'outline-success' }}"
            disabled>
            <i class="fas fa-map-marked-alt"></i> Sekolah
        </a>

        <a href="{{ route('admin_kemenag.map_takhasus') }}"
            class="btn btn-{{ request()->is('admin kemenag/map_takhasus*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-map-marked-alt"></i> Takhasus
        </a>
    </div>
@elseif(Auth::User()->user_role == 'pelapor')
    <div class="scrollable-buttons  justify-content-md-center mb-2">
        <a href="{{ route('pelapor.map_view') }}"
            class="btn btn-{{ request()->is('pelapor/map_view*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-map-marked-alt"></i> Kategori
        </a>

        <a href="{{ route('pelapor.maps_facility') }}"
            class="btn btn-{{ request()->is('pelapor/maps_facility*') ? 'success' : 'outline-success' }}" disabled>
            <i class="fas fa-map-marked-alt"></i> Fasilitas
        </a>

        <a href="{{ route('pelapor.maps_schools') }}"
            class="btn btn-{{ request()->is('pelapor/maps_schools*') ? 'success' : 'outline-success' }}" disabled>
            <i class="fas fa-map-marked-alt"></i> Sekolah
        </a>

        <a href="{{ route('pelapor.map_takhasus') }}"
            class="btn btn-{{ request()->is('pelapor/map_takhasus*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-map-marked-alt"></i> Takhasus
        </a>
    </div>
@endif

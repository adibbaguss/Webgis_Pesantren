<div class="d-flex justify-content-center">
    <a href="{{ route('admin_kemenag.map_view') }}" class="btn btn-{{ request()->is('admin kemenag/map_view*') ? 'success' : 'outline-success' }}">
        <i class="fas fa-map-marked-alt"></i> Kategori
    </a>
    <div class="mx-1"></div> 
    <a href="{{ route('admin_kemenag.maps_facility') }}" class="btn btn-{{ request()->is('admin kemenag/maps_facility*') ? 'success' : 'outline-success' }}" disabled>
        <i class="fas fa-map-marked-alt"></i> Fasilitas
    </a>
    <div class="mx-1"></div> 
    <a href="{{ route('admin_kemenag.maps_schools') }}" class="btn btn-{{ request()->is('admin kemenag/maps_schools*') ? 'success' : 'outline-success' }}" disabled>
        <i class="fas fa-map-marked-alt"></i> Sekolah
    </a>
</div>
<hr class="pb-1 mb-4">

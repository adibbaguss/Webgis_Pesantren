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
        <a href="{{ route('pengunjung.data_ponpes') }}"
            class="btn btn-{{ request()->is('pengunjung/data_ponpes*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-mosque"></i> Ponpes
        </a>
        <a href="{{ route('pengunjung.data_madin') }}"
            class="btn btn-{{ request()->is('pengunjung/data_madin*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-mosque"></i> Madin & TPQ
        </a>

    </div>
@elseif(Auth::User()->user_role == 'admin kemenag')
    <div class="scrollable-buttons  justify-content-md-center mb-2">
        <a href="{{ route('admin_kemenag.data_ponpes') }}"
            class="btn btn-{{ request()->is('admin kemenag/data_ponpes*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-mosque"></i> Ponpes
        </a>
        <a href="{{ route('admin_kemenag.data_madin') }}"
            class="btn btn-{{ request()->is('admin kemenag/data_madin*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-mosque"></i> Madin & TPQ
        </a>

    </div>
@elseif(Auth::User()->user_role == 'pelapor')
    <div class="scrollable-buttons  justify-content-md-center mb-2">
        <a href="{{ route('pelapor.data_ponpes') }}"
            class="btn btn-{{ request()->is('pelapor/data_ponpes*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-mosque"></i> Ponpes
        </a>
        <a href="{{ route('pelapor.data_madin') }}"
            class="btn btn-{{ request()->is('pelapor/data_madin*') ? 'success' : 'outline-success' }}">
            <i class="fas fa-mosque"></i> Madin & TPQ
        </a>
    </div>
@endif

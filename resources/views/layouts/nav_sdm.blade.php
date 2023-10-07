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
 

    </div>
@elseif(Auth::User()->user_role == 'admin kemenag')
    <div class="scrollable-buttons  justify-content-md-center mb-2">
        <a href="{{ route('admin_kemenag.data_sdm_ponpes') }}"
        class="btn btn-{{ request()->is('admin kemenag/ponpes/data_sdm*') ? 'success' : 'outline-success' }}">
        <i class="fas fa-users"></i> Ponpes
    </a>
        <a href="{{ route('admin_kemenag.data_sdm_madin') }}"
        class="btn btn-{{ request()->is('admin kemenag/madin/data_sdm*') ? 'success' : 'outline-success' }}">
        <i class="fas fa-users"></i> Madin & TPQ
    </a>

    </div>
@elseif(Auth::User()->user_role == 'pelapor')
    <div class="scrollable-buttons  justify-content-md-center mb-2">

    </div>
@endif

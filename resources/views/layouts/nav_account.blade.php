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
@if (Auth::User()->user_role == 'admin kemenag')
    <div class="scrollable-buttons  justify-content-md-center mb-2">
        <a href="{{ route('admin_kemenag.data_admin_pesantren') }}"
            class="btn btn-{{ request()->is('admin kemenag/data_admin_pesantren*') ? 'success' : 'outline-success' }}">
            <i class="far fa-user-circle"></i> Admin Pesantren
        </a>
        <a href="{{ route('admin_kemenag.data_admin_madin') }}"
            class="btn btn-{{ request()->is('admin kemenag/madin/data_admin_madin*') ? 'success' : 'outline-success' }}">
            <i class="far fa-user-circle"></i> Admin Madin/TPQ
        </a>


        <a href="{{ route('admin_kemenag.data_pelapor') }}"
            class="btn btn-{{ request()->is('admin kemenag/data_pelapor*') ? 'success' : 'outline-success' }}">
            <i class="far fa-user-circle"></i> Pelapor
        </a>
    </div>
@endif

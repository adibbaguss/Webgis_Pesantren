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
@if (Auth::user()->user_role == 'pelapor')
    <div class="scrollable-buttons justify-content-md-center mb-2">
        @if (Auth::user()->user_role == 'pelapor')
            <a href="{{ route('pelapor.ponpes.data_report', ['id' => $user_id]) }}"
               class="btn btn-{{ request()->is('pelapor/ponpes/data_report/*') ? 'success' : 'outline-success' }}">
                <i class="fas fa-flag"></i> Ponpes
            </a>
        @endif

        @if (Auth::user()->user_role == 'pelapor')
            <a href="{{ route('pelapor.madin.data_report', ['id' => $user_id]) }}"
               class="btn btn-{{ request()->is('pelapor/madin/data_report/*') ? 'success' : 'outline-success' }}">
                <i class="fas fa-flag"></i> Madin & TPQ
            </a>
        @endif
    </div>
@endif


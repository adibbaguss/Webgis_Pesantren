@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5 pt-5">

        {{-- notif delete --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="d-flex mb-3">
            <h2 class="mb-0 text-secondary ">{{ 'Data Sumber Daya Manusia Pesantren' }}</h2>
            <div class="dropdown me-0 ms-auto">
                <button class="btn btn-outline-secondary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-sliders-h"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/admin kemenag/sdm_pesantren_export" class="dropdown-item">
                            <i class="fas fa-print"></i>
                            {{ 'Cetak' }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <table class="table table-bordered table-hover text-center" id="example" class="display" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th scope="col" rowspan="2">NO</th>
                    <th scope="col" rowspan="2">NSPP</th>
                    <th scope="col" rowspan="2">NAMA PESANTREN</th>
                    <th scope="col" colspan="6">JUMLAH SUMBER DAYA MANUSIA</th>
                    <th scope="col" rowspan="2" >JUMLAH PENGAJAR</th>
                    <th scope="col" rowspan="2">JUMLAH SANTRI dan SANTRIWATI MUKIM</th>
                    <th scope="col" rowspan="2">JUMLAH SANTRI dan SANTRIWATI TIDAK MUKIM</th>
                </tr>
                <tr>
                    <th>USTADZ</th>
                    <th>USTADZAH</th>
                    <th>SANTRI MUKIM</th>
                    <th>SANTRIWATI MUKIM</th>
                    <th>SANTRI TIDAK MUKIM</th>
                    <th>SANTRIWATI TIDAK MUKIM</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ponpes as $data)
                    <tr>
                        <td></td>
                        <td>{{ $data->nspp }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->studentCount->instructor->gender == 'Laki-laki' }}</td>
                        <td>{{ $data->studentCount->instructor->gender == 'Perempuan' }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('javascript')
    <!-- Script DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Inisialisasi DataTables
        $(document).ready(function() {
            new DataTable('#example', {
                scrollCollapse: true,
                scrollX: true

            });

        });
    </script>

@endpush

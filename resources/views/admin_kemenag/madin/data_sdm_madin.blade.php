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

        {{-- panggil nav --}}
        @include('layouts.nav_sdm')
        {{-- end panggil nav --}}



        <div class="d-flex mb-3">
            <h2 class="mb-0 text-secondary ">
                {{ 'Data Sumber Daya Manusia Madrasah Diniyah & TPQ Kabupaten Batang Tahun ' . $currentYear }}</h2>
            <div class="dropdown me-0 ms-auto">
                <button class="btn btn-outline-secondary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-sliders-h"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="" class="dropdown-item" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#printModal">
                            <i class="fas fa-print"></i>
                            {{ 'Cetak' }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 col-sm-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Ustadz ' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-secondary">
                                    {{ $totalMaleInstructors }} <!-- Menampilkan total Ustadz Laki-laki -->
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                {{-- <i class="fas fa-school fs-1 text-secondary"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Jumlah Ustadzah ' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-secondary">
                                    {{ $totalFemaleInstructors }} <!-- Menampilkan total Ustadz Laki-laki -->
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                {{-- <i class="fas fa-school fs-1 text-secondary"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Total Murid Laki-Laki' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-secondary">
                                    {{ $totalMaleStudent }} <!-- Menampilkan total Ustadz Laki-laki -->
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                {{-- <i class="fas fa-school fs-1 text-secondary"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 mb-4">
                <div class="card ps-1 bg-success my-2  border-0 shadow" style="user-select: none;">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-12">
                                <div class="fw-bold text-success text-uppercase mb-1" style="font-size:11px">
                                    {{ 'Total Murid Perempuan' }}
                                </div>
                            </div>
                            <div class="col me-2">
                                <div class="fs-4 me-auto fw-bold text-secondary">
                                    {{ $totalFemaleStudent }} <!-- Menampilkan total Ustadz Laki-laki -->
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                {{-- <i class="fas fa-school fs-1 text-secondary"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <table class="table table-bordered table-hover" id="example" class="display" style="width:100%">
            <thead class="table-success">
                <tr class="align-middle">
                    <th scope="col" rowspan="2" class="text-center">NO</th>
                    <th scope="col" rowspan="2" class="text-center">NSDT</th>
                    <th scope="col" rowspan="2" class="text-center">NAMA MADIN/TPQ</th>
                    <th scope="col" rowspan="2" class="text-center">KECAMATAN</th>
                    <th scope="col" colspan="4" class="text-center">JUMLAH SUMBER DAYA MANUSIA</th>
                    <th scope="col" rowspan="2" class="text-center">TOTAL PENGAJAR</th>
                    <th scope="col" rowspan="2" class="text-center">TOTAL MURID</th>
                </tr>
                <tr class="text-center align-middle">
                    <th class="text-center">USTADZ</th>
                    <th class="text-center">USTADZAH</th>
                    <th class="text-center">MURID (LK)</th>
                    <th class="text-center">MURID (PR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($madin as $data)
                    <tr class="align-middle">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $data->nsdt }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->subdistrict }}</td>
                        <td class="text-center ">
                            {{ count($data->instructors_madin->where('gender', 'Laki-laki')->where('status', 'active')) }}
                        </td>
                        <td class="text-center ">
                            {{ count($data->instructors_madin->where('gender', 'Perempuan')->where('status', 'active')) }}
                        </td>
                        <td class="text-center ">{{ $data->studentCount_madin->sum('male') }}</td>
                        <td class="text-center ">{{ $data->studentCount_madin->sum('female') }}</td>
                        <td class="text-center ">{{ $data->instructors_madin->where('status', 'active')->count() }}</td>
                        <td class="text-center ">
                            {{ $data->studentCount_madin->sum('female') + $data->studentCount_madin->sum('male') }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">{{ 'Pilih Format File' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <a href="/admin kemenag/sdm_madin_export_xlsx"
                        class="text-deocartion-none btn btn-outline-success p-3">
                        <i class="fas fa-file-excel fs-1"></i>
                        {{ 'Cetak Excel' }}
                    </a>

                    <a href="/admin kemenag/sdm_madin_export_csv"
                        class="text-deocartion-none btn btn-outline-success p-3">
                        <i class="fas fa-file-csv fs-1"></i>
                        {{ 'Cetak CSV' }}
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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

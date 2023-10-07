@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5 pt-5 ">

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
        @include('layouts.nav_report')
        {{-- end panggil nav --}}

        <div class="d-flex mb-3">
            <h2 class="mb-0 text-secondary ">{{ 'Daftar Pelaporan Madrasah Diniyah & TPQ di Kabupaten Batang' }}</h2>
            <div class="dropdown me-0 ms-auto">
                <button class="btn btn-outline-secondary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-sliders-h"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/admin kemenag/madin/report_export" class="dropdown-item">
                            <i class="fas fa-print"></i>
                            {{ 'Cetak' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin_kemenag.madin.category_report') }}" class="dropdown-item">
                            <i class="fas fa-edit"></i>
                            {{ 'Edit Kategori Laporan' }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <table class="table table-bordered table-hover text-center" id="example" class="display" style="width:100%">
            <thead>
                <tr class="text-center align-middle">
                    <th scope="col">NO</th>
                    <th scope="col">KODE LAPORAN</th>
                    <th scope="col">TANGGAL MASUK</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">MADIN/TPQ</th>
                    <th scope="col">PELAPOR</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">OPSI</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sortedReports = $reports->sortBy('reportHistoriesMadin.0.date'); // Mengurutkan berdasarkan tanggal ascending
                @endphp

                @foreach ($sortedReports as $item)
                    <tr class="text-start">
                        <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>

                        <td class="align-middle">{{ $item->reporting_code }}</td>
                        <td class="align-middle">
                            @php $found = false; @endphp
                            @foreach ($item->reportHistoriesMadin as $data)
                                @if ($data->status === 'baru')
                                    {{ $data->date }}
                                    @php
                                        $found = true;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            @if (!$found)
                                NULL
                            @endif
                        </td>

                        <td class="align-middle">{{ $item->category_name }}</td>
                        <td class="align-middle">{{ $item->madin_name }}</td>
                        <td class="align-middle">{{ $item->user_name }}</td>

                        @php $latestHistory = $item->reportHistoriesMadin->sortByDesc('created_at')->first(); @endphp

                        @if ($latestHistory->status == 'baru')
                            <td class="align-middle text-center fw-bold text-danger">{{ $latestHistory->status }}</td>
                        @elseif($latestHistory->status == 'dalam proses')
                            <td class="align-middle text-center fw-bold text-warning">{{ $latestHistory->status }}</td>
                        @elseif($latestHistory->status == 'selesai')
                            <td class="align-middle text-center fw-bold text-success">{{ $latestHistory->status }}</td>
                        @else
                            <td class="align-middle text-center fw-bold text-secondary">{{ $latestHistory->status }}
                            </td>
                        @endif

                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-between">
                                <a class="text-secondary fs-5" type="button" data-bs-toggle="modal"
                                    data-bs-target="#infoModal{{ $item->id }}">
                                    <i class="fas fa-info-circle"></i>
                                </a>

                                <a class="text-secondary fs-5" type="button" data-bs-toggle="modal"
                                    data-bs-target="#updateStatusModal{{ $item->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        @foreach ($reports as $item)
            <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title" id="exampleModalLabel">{{ 'Kode Laporan: ' }} <span
                                    class="fw-bold">{{ $item->reporting_code }}</span>
                            </span>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <label for="" class="fw-bold">
                                        Pelapor
                                    </label>
                                    <p>{{ $item->user_name }}</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="" class="fw-bold">
                                        Madin/TPQ
                                    </label>
                                    <p>{{ $item->madin_name }}</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="" class="fw-bold">
                                        Kategori
                                    </label>
                                    <p>{{ $item->category_name }}</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="" class="fw-bold">
                                        Judul
                                    </label>
                                    <p>{{ $item->title }}</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="" class="fw-bold">
                                        Deskripsi
                                    </label>
                                    <p>{{ $item->description }}</p>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($item->reportHistoriesMadin as $data)
                                                @if ($data->report_id == $item->id)
                                                    <tr>
                                                        <td>{{ $data->date }}</td>
                                                        <td>{{ $data->status }}</td>
                                                        <td>{{ $data->information }}</td>

                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($reports as $item)
            <div class="modal fade" id="updateStatusModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title" id="exampleModalLabel">{{ 'Kode Laporan: ' }} <span
                                    class="fw-bold">{{ $item->reporting_code }}</span>
                            </span>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 mb-3">
                                <label for="" class="fw-bold">
                                    Status Sekarang :
                                </label>
                                @php
                                    $latestStatus = $item->reportHistoriesMadin->sortByDesc('created_at')->first();
                                @endphp

                                @if ($latestStatus)
                                    @if ($latestStatus->status == 'baru')
                                        <p class="btn btn-danger">{{ $latestStatus->status }}</p>
                                    @elseif($latestStatus->status == 'dalam proses')
                                        <p class="btn btn-warning">{{ $latestStatus->status }}</p>
                                    @elseif($latestStatus->status == 'selesai')
                                        <p class="btn btn-success">{{ $latestStatus->status }}</p>
                                    @else
                                        <p class="btn btn-secondary">{{ $latestStatus->status }}</p>
                                    @endif
                                @else
                                    <p class="btn btn-secondary">Tidak Ada Status</p>
                                @endif

                            </div>
                            <form method="POST"
                                action="{{ route('admin_kemenag.madin.report_status_update', $item->id) }}">
                                @csrf
                                @method('POST')

                                <input type="number" class="form-control" id="report_id" name="report_id"
                                    value="{{ $item->id }}" hidden>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="status">Perbarui Status</label>
                                            <select name="status" id="status" class="form-control mb-4">
                                                <option class="text-secondary">Pilih Status</option>
                                                <option value="baru" class="text-danger fw-bold">Baru</option>
                                                <option value="dalam proses" class="text-warning fw-bold">Dalam Proses
                                                </option>
                                                <option value="selesai" class="text-success fw-bold">Selesai</option>
                                                <option value="ditolak" class="text-secondary fw-bold">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="information">Keterangan:</label>
                                            <textarea class="form-control" id="information" name="information" rows="4" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Perbarui</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


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

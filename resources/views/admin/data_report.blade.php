@extends('layouts.app')
@section('content')
    <div class="container-fluid mx-0 mt-5 pt-5 vh-100">
     
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="container mx-0">
            <div class="d-flex mb-3">
                <h2 class="mb-0 text-secondary ">{{ 'Daftar Pelaporan' }}</h2>
                <div class="dropdown me-0 ms-auto">
                    <button class="btn btn-outline-secondary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/admin/report_export" class="dropdown-item">
                                <i class="fas fa-print"></i>
                                {{ 'Cetak' }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.category_report') }}" class="dropdown-item">
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
                        <th scope="col">TANGGAL MASUK</th>
                        <th scope="col">KATEGORI</th>
                        <th scope="col">PESANTREN</th>
                        <th scope="col">PELAPOR</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $item)
                        <tr class="text-start">
                            <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
                            <td class="align-middle">{{ $item->reporting_date }}</td>
                            <td class="align-middle">{{ $item->category_name }}</td>
                            <td class="align-middle">{{ $item->ponpes_name }}</td>
                            <td class="align-middle">{{ $item->user_name }}</td>

                            @if ($item->status == 'baru')
                                <td class="align-middle text-center fw-bold text-danger">{{ $item->status }}</td>
                            @elseif($item->status == 'dalam proses')
                                <td class="align-middle text-center fw-bold text-warning">{{ $item->status }}</td>
                            @elseif($item->status == 'selesai')
                                <td class="align-middle text-center fw-bold text-success">{{ $item->status }}</td>
                            @else
                                <td class="align-middle text-center fw-bold text-secondary">{{ $item->status }}</td>
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
        </div>


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
                                        Tanggal Masuk
                                    </label>
                                    <p>{{ $item->reporting_date }}</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="" class="fw-bold">
                                        Pelapor
                                    </label>
                                    <p>{{ $item->user_name }}</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="" class="fw-bold">
                                        Pesantren
                                    </label>
                                    <p>{{ $item->ponpes_name }}</p>
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

                                <div class="col-md-12">
                                    <label for="" class="fw-bold">
                                        Status
                                    </label>
                                    @if ($item->status == 'baru')
                                        <p class=" fw-bold text-danger">{{ $item->status }}</p>
                                    @elseif($item->status == 'dalam proses')
                                        <p class=" fw-bold text-warning">{{ $item->status }}</p>
                                    @elseif($item->status == 'selesai')
                                        <p class=" fw-bold text-success">{{ $item->status }}</p>
                                    @else
                                        <p class=" fw-bold text-secondary">{{ $item->status }}</p>
                                    @endif
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
                            @if ($item->status == 'baru')
                                <p class="btn btn-danger">{{ $item->status }}</p>
                            @elseif($item->status == 'dalam proses')
                                <p class="btn btn-warning">{{ $item->status }}</p>
                            @elseif($item->status == 'selesai')
                                <p class="btn btn-success">{{ $item->status }}</p>
                            @else
                                <p class="btn btn-secondary">{{ $item->status }}</p>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('admin.report_status_update', $item->id) }}">
                            @csrf
                            @method('PUT')
                            <label for="">Perbarui Status</label>
                            <select name="status" id="" class="form-control mb-4">
                                <option class="text-secondary">Pilih Status</option>
                                <option value="baru" class="text-danger fw-bold">baru</option>
                                <option value="dalam proses" class="text-warning fw-bold">dalam proses</option>
                                <option value="selesai" class="text-success fw-bold">selesai</option>
                                <option value="ditolak" class="text-secondary fw-bold">ditolak</option>
                            </select>
                            <button type="submit" class="d-flex btn btn-success me-0 ms-auto">Perbaharui</button>
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

@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5 pt-5">

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
            <h2 class="mb-0 text-secondary ">{{ 'Riwayat Laporan' }}</h2>
        </div>
        <table class="table table-bordered table-hover text-center" id="example" class="display" style="width:100%">
            <thead>
                <tr class="text-center align-middle">
                    <th scope="col">NO</th>
                    <th scope="col">TANGGAL MASUK</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">PESANTREN</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">OPSI</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sortedReports = $reports->sortBy('reportHistories.0.date'); 
                @endphp
                @if ($user_id == Auth::user()->id)
                    @foreach ($sortedReports as $item)
                        <tr class="text-start">
                            <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>
                            <td class="align-middle">
                                @php $found = false; @endphp
                                @foreach ($item->reportHistories as $data)
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
                            <td class="align-middle">{{ $item->ponpes_name }}</td>


                            @php $latestHistory = $item->reportHistories->sortByDesc('created_at')->first(); @endphp

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

                                    @php $latestHistory = $item->reportHistories->sortByDesc('created_at')->first(); @endphp

                                    @if ($latestHistory->status == 'baru')
                                        <a class="text-danger fs-5" type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @else
                                        <a class="text-secondary fs-5" type="button" data-bs-toggle="modal"
                                            data-bs-target="#deleteModalCancel{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif

                                </div>

                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>


        {{-- modal info --}}
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
                                            @foreach ($item->reportHistories as $data)
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

        {{-- modal delete --}}

        @foreach ($reports as $item)
            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title" id="exampleModalLabel"> Konfirmasi Hapus Laporan
                            </span>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Apakah anda akan mengahapus Laporan ini ?</span>
                            <table class="border-0 my-3">
                                <tr>
                                    <td>Kode Laporan</td>
                                    <td> : </td>
                                    <td class="fw-bold">{{ $item->reporting_code }}</td>
                                </tr>
                                <tr>
                                    <td>Pesantren</td>
                                    <td> : </td>
                                    <td class="fw-bold">{{ $item->ponpes_name }}</td>
                                </tr>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>

                            <form action="{{ route('pelapor.report_delete', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($reports as $item)
            <div class="modal fade" id="deleteModalCancel{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title" id="exampleModalLabel"> Konfirmasi Hapus Laporan
                            </span>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Anda Tidak Bisa Menghapus ini karena status sudah dirubah</span>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Kembali</button>
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

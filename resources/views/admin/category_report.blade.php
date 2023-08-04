@extends('layouts.app')
@section('content')
    <div class="container mx-0 mt-5 pt-5 vh-100">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="container mx-md-5 px-md-5">
            <div class="d-flex justify-content-between mb-3">
                <h2 class="mb-0 text-secondary ">{{ 'Daftar Pelaporan' }}</h2>
                <a type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-success">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <table class="table table-bordered table-hover text-center" id="example" class="display" style="width:100%">
                <thead>
                    <tr class="align-middle">
                        <th scope="col" class="text-center">NO</th>
                        <th scope="col" class="text-center">KATEGORI</th>
                        <th scope="col" class="text-center">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category_report as $item)
                        <tr class="text-start">
                            <th scope="row" class="text-center align-middle">{{ $loop->iteration }}</th>

                            <td class="align-middle">{{ $item->name }}</td>

                            <td class="text-center align-middle">

                                <div class="d-flex justify-content-center">
                                    <a class="text-secondary fs-5 me-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#updateModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a class="text-danger fs-5 ms-1" type="button" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    {{-- modal create --}}

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
            </div>
            <form action="{{ route('admin.category_report_create') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name">Kategori</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                id="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambahakan</button>
                </div>
            </form>
        </div>
    </div>
</div>



{{-- modal update --}}
@foreach ($category_report as $item)
<div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Perbaharui Kategori</h1>
            </div>
            <form action="{{ route('admin.category_report_update', ['id'=>$item->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name">Kategori</label>
                            <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{ $item->name }}" id="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endforeach

{{-- delete modal --}}
@foreach ($category_report as $item)
<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Kategori</h1>
            </div>
            <form action="{{ route('admin.category_report_delete', ['id'=>$item->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus kategori "{{ $item->name }}" ? <br>
                    kategori yang dihapus akan menghapus laporan dengan kategori ini</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endforeach



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

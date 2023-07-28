@extends('layouts.app')

@section('css')
    <style>
        .img-overflow {
            background: rgb(241, 241, 241);
            width: 100%;
            height: 100px;
            overflow: hidden;

        }

        .img-overflow img {
            width: 100%;
            height: 110px;
        }

        .img-overflow img:hover {
            transform: scale(1.5);
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5 pt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('errorss'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 d-flex justify-content-between mb-4">

                <div class="d-flex">
                    @if (!$ponpes->photo_profil)
                        <img class="opacity-50" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}"
                            alt="profil Default" style="width: 40px" class="my-auto">
                    @else
                        <img src="{{ asset('/images/ponpes/profile/' . $ponpes->photo_profil) }}" alt="Profil Pesatren"
                            style="width: 40px" class="my-auto">
                    @endif
                    <h2 class="text-secondary fw-bold my-auto ms-1">{{ $ponpes->name }}</h2>
                </div>


            </div>


            <div class="col-md-7 bg-white py-5 rounded ">

                {{-- jumbotron --}}
                <div class="jumbotron" style="user-select: none;">
                    <img src="{{ asset('images/ponpes/default-image.png') }}" class="card-img border" alt="..."
                        style="max-height:300px">
                </div>
                {{-- end jumbotron --}}


                {{-- slick-js --}}
                <div class=" slick-responsive">

                    @for ($i = 0; $i < 6; $i++)
                        <div class="img-overflow border">
                            <img type="button" data-bs-toggle="modal" data-bs-target="#imageModal.{{ $i }}"
                                src="{{ asset('images/ponpes/default-image-1.png') }}" alt="">
                        </div>
                    @endfor


                </div>
                {{-- end slick js --}}

                <div class="row ">

                    <div class="col-md-12 mb-3">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingThree">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                                        {{ 'Pengajar' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body pt-3 px-1 pb-1">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                                data-bs-target="#InstructorsModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">{{ 'No' }}</th>
                                                        <th scope="col">{{ 'NIK' }}</th>
                                                        <th scope="col">{{ 'Nama' }}</th>
                                                        <th scope="col">{{ 'Keahlian' }}</th>
                                                        <th scope="col">{{ 'Gender' }}</th>
                                                        <th scope="col">{{ 'Status' }}</th>
                                                        <th scope="col">{{ 'Opsi' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @forelse ($instructors as $item)
                                                        <tr>
                                                            <th class="text-center" scope="row">{{ $no++ }}</th>
                                                            <td>{{ $item->nik }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->expertise }}</td>
                                                            <td>{{ $item->gender }}</td>
                                                            @if ($item->status === 'active')
                                                                <td><span class="text-success">Aktif</span></td>
                                                            @else
                                                                <td><span class="text-danger fw-bold">Tidak Aktif</span>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <div class="d-flex justify-content-between">
                                                                    <a class="me-1 text-secondary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateInstructorModal{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>

                                                                    <a class="ms-1 text-danger" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteInstructorModal{{ $item->id }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center bg-secondary text-white">
                                                                {{ 'Belum diisi' }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mb-3 d-grid">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        {{ 'Fasilitas' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse "
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body pt-3 px-1 pb-1">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                                data-bs-target="#FacilityModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark mb-0">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">{{ 'No' }}</th>
                                                        <th scope="col">{{ 'Fasilitas' }}</th>
                                                        <th scope="col">{{ 'Jumlah' }}</th>
                                                        <th scope="col">{{ 'Opsi' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @forelse ($facility as $item)
                                                        <tr>
                                                            <th class="text-center" scope="row">{{ $no++ }}
                                                            </th>
                                                            <td>{{ $item->name }}</td>
                                                            <td class="text-center">{{ $item->count }}</td>
                                                            <td>
                                                                <div class="d-flex justify-content-between">
                                                                    <a class="me-1 text-secondary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateFacilityModal{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>

                                                                    <a class="ms-1 text-danger" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteFacilityModal{{ $item->id }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4"
                                                                class="text-center bg-secondary text-white">
                                                                {{ 'Belum diisi' }}</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mb-3 d-grid">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                        {{ 'Aktivitas' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse  "
                                    aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body pt-3 px-1 pb-1">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                                data-bs-target="#ActivitiesModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">{{ 'No' }}</th>
                                                        <th scope="col">{{ 'Aktivitas' }}</th>
                                                        <th scope="col">{{ 'Deskripsi' }}</th>
                                                        <th scope="col">{{ 'Opsi' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @forelse ($activities as $item)
                                                        <tr>
                                                            <th class="text-center" scope="row">{{ $no++ }}
                                                            </th>
                                                            <td>{{ $item->name }}</td>
                                                            <td class="text-break">{{ $item->description }}</td>
                                                            <td>
                                                                <div class="d-flex justify-content-between">
                                                                    <a class="me-1 text-secondary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateActivitiesModal{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>

                                                                    <a class="ms-1 text-danger" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteActivitiesModal{{ $item->id }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4"
                                                                class="text-center bg-secondary text-white">
                                                                {{ 'Belum diisi' }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mb-3 d-grid">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingFour">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseFour">
                                        {{ 'Pembelajaran' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse  "
                                    aria-labelledby="panelsStayOpen-headingFour">
                                    <div class="accordion-body pt-3 px-1 pb-1">
                                        <table class="table table-bordered border-dark table-responsive">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">{{ 'No' }}</th>
                                                    <th scope="col">{{ 'Pembelajaran' }}</th>
                                                    <th scope="col">{{ 'Deskripsi' }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @forelse ($learning as $item)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ $no++ }}</th>
                                                        <td>{{ $item->name }}</td>
                                                        <td class="text-break">{{ $item->description }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center bg-secondary text-white">
                                                            {{ 'Belum diisi' }}
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{-- drop down info  --}}

        </div>



        {{-- modal image preview --}}
        @for ($i = 0; $i < 6; $i++)
            <div class="modal fade" id="imageModal.{{ $i }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog px-0">
                    <div class="modal-content bg-none">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('images/ponpes/default-image.png') }}" alt=""
                                style="width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        @endfor




        {{-- modal delete instructor --}}
        @foreach ($instructors as $item)
            <div class="modal fade" id="deleteInstructorModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Pengajar' }}</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ 'Anda Yakin Menghapus Data ' . $item->name . ' ?' }}</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button"
                                data-bs-dismiss="modal">Batal</button>

                            <form id="delete-form"
                                action="{{ route('updater.instructors_delete', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end modal instuctor --}}

        {{-- update instuctors/pengajar --}}
        @foreach ($instructors as $item)
            <div class="modal fade" id="updateInstructorModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ 'Perbaharui Data (' . $item->name . ')' }}
                            </h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('updater.instructors_update', ['id' => $item->id]) }}" method="post"
                                class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="ponpes_id" value="{{ $item->ponpes_id }}" hidden>
                                    <div class="col-12 mb-3">
                                        <label for="">Nomor Induk Keluarga (NIK)</label>
                                        <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                            name="nik" value="{{ $item->nik }}">
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ $item->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="">Keahlian</label>
                                        <input type="text"
                                            class="form-control @error('expertise') is-invalid @enderror" name="expertise"
                                            value="{{ $item->expertise }}">
                                        <small class="text-secondary">Contoh : Tafsir Al-Quran, Hadis, Fiqih, Kaligrafi,
                                            dll.</small>
                                        @error('expertise')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="gender" id=""
                                            class="form-control @error('gender') is-invalid @enderror">
                                            <option value="Pria" @if (old('gender', $item->gender) === 'Pria') selected @endif>Pria
                                            </option>
                                            <option value="Wanita" @if (old('gender', $item->gender) === 'Wanita') selected @endif>Wanita
                                            </option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="">Status</label>
                                        <select name="status" id=""
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="active" @if (old('status', $item->status) === 'active') selected @endif>active
                                            </option>
                                            <option value="non-active" @if (old('status', $item->status) === 'non-active') selected @endif>
                                                non-active</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3 d-flex justify-content-end">
                                        <button class="btn btn-outline-secondary me-2" type="button"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Perbaharui</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end  modal update instuctors --}}

        {{--  modal create instuctor --}}
        <div class="modal fade" id="InstructorsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambah Data Pengajar</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updater.instructors_create') }}" method="post" class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="ponpes_id" value="{{ $ponpes->id }}"
                                    hidden>
                                <div class="col-12 mb-3">
                                    <label for="">Nomor Induk Keluarga (NIK)</label>
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror"
                                        name="nik" value="{{ old('nik') }}">
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Keahlian</label>
                                    <input type="text" class="form-control @error('expertise') is-invalid @enderror"
                                        name="expertise" value="{{ old('expertise') }}">
                                    <small class="text-secondary">Contoh : Tafsir Al-Quran, Hadis, Fiqih, Kaligrafi,
                                        dll.</small>
                                    @error('expertise')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="gender" id=""
                                        class="form-control @error('gender') is-invalid @enderror">
                                        <option value="Pria" @if (old('gender') === 'Pria') selected @endif>Pria
                                        </option>
                                        <option value="Wanita" @if (old('gender') === 'Wanita') selected @endif>Wanita
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Status</label>
                                    <select name="status" id=""
                                        class="form-control @error('status') is-invalid @enderror">
                                        <option value="active" @if (old('status') === 'active') selected @endif>active
                                        </option>
                                        <option value="non-active" @if (old('status') === 'non-active') selected @endif>
                                            non-active</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3 d-flex justify-content-end">
                                    <button class="btn btn-outline-secondary me-2" type="button"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- end modal create instructor --}}




        {{-- modal delete facility --}}
        @foreach ($facility as $item)
            <div class="modal fade" id="deleteFacilityModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Fasilitas' }}</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ 'Anda Yakin Menghapus Data ' . $item->name . ' ?' }}</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button"
                                data-bs-dismiss="modal">Batal</button>

                            <form id="delete-form" action="{{ route('updater.facility_delete', ['id' => $item->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end modal facility --}}


        {{-- update facility --}}
        @foreach ($facility as $item)
            <div class="modal fade" id="updateFacilityModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ 'Perbaharui Data (' . $item->name . ')' }}
                            </h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('updater.facility_update', ['id' => $item->id]) }}" method="post"
                                class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="ponpes_id" value="{{ $item->ponpes_id }}" hidden>
                                    <div class="col-12 mb-3">
                                        <label for="">Nama Fasilitas</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ $item->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="">Jumlah</label>
                                        <input type="number" class="form-control @error('count') is-invalid @enderror"
                                            name="count" value="{{ $item->count }}">

                                        @error('count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3 d-flex justify-content-end">
                                        <button class="btn btn-outline-secondary me-2" type="button"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Perbaharui</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end  modal facility --}}

        {{-- create modal facility --}}
        <div class="modal fade" id="FacilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambah Data Fasilitas</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updater.facility_create') }}" method="post" class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="ponpes_id" value="{{ $ponpes->id }}"
                                    hidden>
                                <div class="col-12 mb-3">
                                    <label for="">Nama Fasilitas</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Jumlah</label>
                                    <input type="number" class="form-control @error('count') is-invalid @enderror"
                                        name="count" value="{{ old('count') }}">

                                    @error('count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3 d-flex justify-content-end">
                                    <button class="btn btn-outline-secondary me-2" type="button"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- end modal facility --}}



        {{-- modal delete activities --}}
        @foreach ($activities as $item)
            <div class="modal fade" id="deleteActivitiesModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Aktivitas' }}</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ 'Anda Yakin Menghapus Data ' . $item->name . ' ?' }}</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button"
                                data-bs-dismiss="modal">Batal</button>

                            <form id="delete-form"
                                action="{{ route('updater.activities_delete', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end modal activities --}}


        {{-- update activities --}}
        @foreach ($activities as $item)
            <div class="modal fade" id="updateActivitiesModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ 'Perbaharui Data (' . $item->name . ')' }}
                            </h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('updater.activities_update', ['id' => $item->id]) }}" method="post"
                                class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="ponpes_id" value="{{ $item->ponpes_id }}" hidden>
                                    <div class="col-12 mb-3">
                                        <label for="">Nama Fasilitas</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ $item->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="description">Deskripsi</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"
                                            maxlength="254" oninput="updateCharacterCountUpdate(this, {{ $item->id }})">{{ $item->description ?? old('description') }}</textarea>
                                        <small>Karakter Tersisa: <span
                                                id="characterCountUpdate_{{ $item->id }}">254</span></small>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-3 d-flex justify-content-end">
                                        <button class="btn btn-outline-secondary me-2" type="button"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Perbaharui</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end  modal activities --}}

        {{-- create modal activities --}}
        <div class="modal fade" id="ActivitiesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambah Data Aktivitas</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updater.activities_create') }}" method="post" class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="ponpes_id"
                                    value="{{ $ponpes->id }}" hidden>
                                <div class="col-12 mb-3">
                                    <label for="">Nama Aktivitas</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"
                                        maxlength="254" oninput="updateCharacterCount(this, {{ $item->id }})">{{ old('description') }}</textarea>
                                    <small>Karakter Tesisa : </small><small id="characterCount">254</small>

                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-12 mb-3 d-flex justify-content-end">
                                    <button class="btn btn-outline-secondary me-2" type="button"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- end modal activities --}}
    @endsection


    @push('javascript')
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- Script DataTables -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

        <script>
            // Inisialisasi DataTables
            $(document).ready(function() {
                new DataTable('#table_instructors', {

                    scrollX: true

                });

            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.slick-responsive').slick({
                    dots: true,
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,

                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });

            });
        </script>

        <script>
            function updateCharacterCount(textarea) {
                const maxLength = parseInt(textarea.getAttribute('maxlength'));
                const currentLength = textarea.value.length;
                const remaining = maxLength - currentLength;

                const characterCountElement = document.getElementById('characterCount');
                characterCountElement.textContent = remaining;
            }
        </script>

        <script>
            function updateCharacterCountUpdate(textarea, id) {
                const maxLength = 254;
                const currentLength = textarea.value.length;
                const remainingLength = maxLength - currentLength;
                const characterCountElement = document.getElementById('characterCountUpdate_' + id);
                characterCountElement.innerText = remainingLength;
            }

            // Trigger the function on input event for each textarea with name "description"
            const textareas = document.querySelectorAll('textarea[name="description"]');
            textareas.forEach(textarea => {
                const id = textarea.dataset.id; // Add the data-id attribute to each textarea in the HTML
                updateCharacterCountUpdate(textarea, id);
                textarea.addEventListener('input', function() {
                    updateCharacterCountUpdate(this, id);
                });
            });
        </script>

        {{-- <script>
            function updateCharacterCountUpdate(textarea) {
                const maxLength = parseInt(textarea.getAttribute('maxlength'));
                const currentLength = textarea.value.length;
                const remaining = maxLength - currentLength;

                const characterCountElement = document.getElementById('characterCountUpdate');
                characterCountElement.textContent = remaining;
            }
        </script> --}}
    @endpush

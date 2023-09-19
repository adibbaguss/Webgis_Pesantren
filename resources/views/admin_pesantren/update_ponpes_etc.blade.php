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

                <div class="row mb-4">

                    {{-- image  --}}
                    <div class="col-md-12 mb-3">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingZero">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseZero"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseZero">
                                        {{ 'Gambar Pondok Pesantren' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseZero" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingZero">
                                    <div class="accordion-body pt-3 px-1 pb-1">

                                        <div class="d-flex justify-content-end mb-3">
                                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                                data-bs-target="#jumbotronModal">
                                                <i class="fas fa-plus"></i> Gambar Jumbotron
                                            </a>
                                        </div>

                                        <div class="table-responsive">
                                            @php
                                                $no = 1;
                                            @endphp
                                            {{-- table khusus jumbotron --}}

                                            <table class="table table-bordered border-dark text-center">
                                                <tr>
                                                    <th colspan="3">Gambar Jumbotron</th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>File</th>
                                                    <th>Hapus</th>
                                                </tr>
                                                @foreach ($image as $item)
                                                    @if ($item->type == 'jumbotron')
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td><a type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#previewModal{{ $item->id }}">Klik
                                                                    Preview</a></td>
                                                            <td>
                                                                <a class="text-danger" type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteImageModal{{ $item->id }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>

                                        </div>


                                        <div class="d-flex justify-content-end mb-3">
                                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                                data-bs-target="#regulerModal">
                                                <i class="fas fa-plus"></i> Gambar Reguler
                                            </a>
                                        </div>

                                        <div class="table-responsive">
                                            @php
                                                $no = 1;
                                            @endphp
                                            {{-- table khusus jumbotron --}}
                                            <table class="table table-bordered border-dark text-center">
                                                <tr>
                                                    <th colspan="3">Gambar Reguler</th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>File</th>
                                                    <th>Hapus</th>
                                                </tr>
                                                @foreach ($image as $item)
                                                    @if ($item->type == 'reguler')
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td><a type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#previewModal{{ $item->id }}">Klik
                                                                    Preview</a></td>
                                                            <td>
                                                                <a class="text-danger" type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteImageModal{{ $item->id }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        
                                                    @endif
                                          
                                                @endforeach
                                               
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end image --}}

                    {{-- pengajar --}}
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
                                                            <th class="text-center" scope="row">{{ $no++ }}
                                                            </th>
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
                                                            <td colspan="7"
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
                    {{-- end pengajar --}}

                    {{-- fasilitas --}}
                    <div class="col-12 mb-3">
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
                    {{-- end fasilitas --}}

                    {{-- aktivitas --}}
                    <div class="col-12 mb-3">
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
                    {{-- end aktivitas --}}

                    {{-- pembelajaran --}}
                    <div class="col-12 mb-3">
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
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                                data-bs-target="#LearningModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">{{ 'No' }}</th>
                                                        <th scope="col">{{ 'Pembelajaran' }}</th>
                                                        <th scope="col">{{ 'Deskripsi' }}</th>
                                                        <th scope="col">{{ 'Opsi' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @forelse ($learning as $item)
                                                        <tr>
                                                            <th class="text-center" scope="row">{{ $no++ }}
                                                            </th>
                                                            <td>{{ $item->name }}</td>
                                                            <td class="text-break">{{ $item->description }}</td>
                                                            <td>
                                                                <div class="d-flex justify-content-between">
                                                                    <a class="me-1 text-secondary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateLearningModal{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>

                                                                    <a class="ms-1 text-danger" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteLearningModal{{ $item->id }}">
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
                    {{-- end pembelajaran --}}

                    {{-- jumlah santri --}}
                    <div class="col-12 mb-3">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingFive">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseFive">
                                        {{ 'Jumlah Santri' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse  "
                                    aria-labelledby="panelsStayOpen-headingFive">
                                    <div class="accordion-body pt-3 px-1 pb-1">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                                data-bs-target="#StudentCountModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th rowspan="2" scope="col" class="align-middle">
                                                            {{ 'No' }}</th>
                                                        <th rowspan="2" scope="col" class="align-middle">
                                                            {{ 'Tahun' }}</th>
                                                        <th colspan="2" scope="col" class="align-middle">
                                                            {{ 'Mukim' }}</th>
                                                        <th colspan="2" scope="col" class="align-middle">
                                                            {{ 'Tidak Mukim' }}</th>
                                                        <th rowspan="2" scope="col" class="align-middle">
                                                            {{ 'Total' }}</th>
                                                        <th rowspan="2" scope="col" class="align-middle">
                                                            {{ 'Opsi' }}</th>

                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="text-center">{{ 'Santri' }}</th>
                                                        <th scope="col" class="text-center">{{ 'Santriwati' }}</th>
                                                        <th scope="col" class="text-center">{{ 'Santri' }}</th>
                                                        <th scope="col" class="text-center">{{ 'Santriwati' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @forelse ($studentCount as $item)
                                                        <tr>
                                                            <th class="text-center" scope="row" class="align-middle">
                                                                {{ $no++ }}</th>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->year }}
                                                            </td>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->male_resident_count }}</td>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->female_resident_count }}</td>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->male_non_resident_count }}</td>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->female_non_resident_count }}</td>
                                                            <td class="text-center align-middle">
                                                                {{ $item->male_resident_count + $item->female_resident_count + $item->male_non_resident_count + $item->female_non_resident_count }}
                                                            </td>

                                                            <td>
                                                                <div class="d-flex justify-content-between">
                                                                    <a class="me-1 text-secondary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateStudentCountModal{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>

                                                                    <a class="ms-1 text-danger" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteStudentCountModal{{ $item->id }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8"
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
                    {{-- end jumlah santri --}}

                </div>


                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin_pesantren.ponpes_view', ['id' => $ponpes->user_id]) }}"
                        class="btn btn-success">Selesai</a>
                </div>


            </div>

        </div>



        {{-- create image jumbotron --}}
        <div class="modal fade" id="jumbotronModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Unggah Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin_pesantren.ponpes_image_create_jumbotron') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="ponpes_id" value="{{ $ponpes->id }}" hidden>
                                    <br>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label for="jumbotron">Jumbotron Image:</label>
                                    <input type="file" class="form-control @error('jumbotron') is-invalid @enderror" name="jumbotron">
                                    @error('jumbotron')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <ul class="small text-secondary">
                                        <li>Maksimal 1 gambar yang diunggah</li>
                                        <li>Ukuran file maksimal 2 Mb</li>
                                        <li>Saran skala gambar yang diunggah adalah 16:9</li>
                                        <li>Format Gambar : jpeg,png,jpg,gif</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Unggah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end create image jumbotron --}}


        {{-- create image reguler --}}
        <div class="modal fade" id="regulerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Unggah Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin_pesantren.ponpes_image_create_reguler') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="ponpes_id" value="{{ $ponpes->id }}" hidden>
                                    <br>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <input type="file" class="form-control @error('reguler') is-invalid @enderror" name="reguler[]" multiple>
                                    @error('reguler')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <ul class="small text-secondary">
                                        <li>Maksimal 6 gambar yang diunggah</li>
                                        <li>Ukuran file maksimal 1 Mb</li>
                                        <li>Saran skala gambar yang diunggah adalah 5:4</li>
                                        <li>Format Gambar : jpeg,png,jpg,gif</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Unggah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end create image reguler --}}






        {{-- modal image preview --}}


        @foreach ($image as $item)
            <div class="modal fade" id="previewModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Preview Gambar</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('images/ponpes/image/' . $item->image_name) }}" alt=""
                                class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end image preview --}}


        {{-- modal delete gambar --}}
        @foreach ($image as $item)
            <div class="modal fade" id="deleteImageModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Gambar' }}</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ 'Anda Yakin Menghapus Gambar ' . $item->image_name . ' ?' }}</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button"
                                data-bs-dismiss="modal">Batal</button>

                            <form id="delete-form" action="{{ route('admin_pesantren.image_delete', ['id' => $item->id]) }}"
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
        {{-- end modal instuctor --}}


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
                                action="{{ route('admin_pesantren.instructors_delete', ['id' => $item->id]) }}" method="POST">
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
                            <form action="{{ route('admin_pesantren.instructors_update', ['id' => $item->id]) }}" method="post"
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
                                            <option value="active" @if (old('status', $item->status) === 'active') selected @endif>
                                                active
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
                        <form action="{{ route('admin_pesantren.instructors_create') }}" method="post" class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="ponpes_id"
                                    value="{{ $ponpes->id }}" hidden>
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

                            <form id="delete-form" action="{{ route('admin_pesantren.facility_delete', ['id' => $item->id]) }}"
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
                            <form action="{{ route('admin_pesantren.facility_update', ['id' => $item->id]) }}" method="post"
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
                        <form action="{{ route('admin_pesantren.facility_create') }}" method="post" class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="ponpes_id"
                                    value="{{ $ponpes->id }}" hidden>
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
                                action="{{ route('admin_pesantren.activities_delete', ['id' => $item->id]) }}" method="POST">
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
                            <form action="{{ route('admin_pesantren.activities_update', ['id' => $item->id]) }}" method="post"
                                class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="ponpes_id" value="{{ $item->ponpes_id }}" hidden>
                                    <div class="col-12 mb-3">
                                        <label for="">Nama Aktivitas</label>
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
                                                id="characterCountUpdate_{{ $item->id }}">-</span></small>
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
                        <form action="{{ route('admin_pesantren.activities_create') }}" method="post" class="w-100">
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
                                        maxlength="254" oninput="updateCharacterCount(this)">{{ old('description') }}</textarea>
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


        {{-- modal delete learning --}}
        @foreach ($learning as $item)
            <div class="modal fade" id="deleteLearningModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Pembelajaran' }}</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ 'Anda Yakin Menghapus Data ' . $item->name . ' ?' }}</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button"
                                data-bs-dismiss="modal">Batal</button>

                            <form id="delete-form" action="{{ route('admin_pesantren.learning_delete', ['id' => $item->id]) }}"
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
        {{-- end modal learning --}}


        {{-- update learning --}}
        @foreach ($learning as $item)
            <div class="modal fade" id="updateLearningModal{{ $item->id }}" tabindex="-1" role="dialog"
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
                            <form action="{{ route('admin_pesantren.learning_update', ['id' => $item->id]) }}" method="post"
                                class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="ponpes_id" value="{{ $item->ponpes_id }}" hidden>
                                    <div class="col-12 mb-3">
                                        <label for="">Nama Pembelajaran</label>
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
                                                id="characterCountUpdate_{{ $item->id }}">-</span></small>
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
        {{-- end  modal learning --}}

        {{-- create modal learning --}}
        <div class="modal fade" id="LearningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambah Data Pembelajaran</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin_pesantren.learning_create') }}" method="post" class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="ponpes_id"
                                    value="{{ $ponpes->id }}" hidden>
                                <div class="col-12 mb-3">
                                    <label for="">Nama Pembelajaran</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"
                                        maxlength="254" oninput="updateCharacterCount_2(this)">{{ old('description') }}</textarea>
                                    <small>Karakter Tesisa : </small><small id="characterCount_2">254</small>

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
        {{-- end modal learning --}}


        {{-- modal delete StudentCount --}}
        @foreach ($studentCount as $item)
            <div class="modal fade" id="deleteStudentCountModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Pembelajaran' }}</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ 'Anda Yakin Menghapus Data ' . $item->name . ' ?' }}</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button"
                                data-bs-dismiss="modal">Batal</button>

                            <form id="delete-form"
                                action="{{ route('admin_pesantren.studentcount_delete', ['id' => $item->id]) }}"
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
        {{-- end modal StudentCount --}}


        {{-- update StudentCount --}}
        @foreach ($studentCount as $item)
            <div class="modal fade" id="updateStudentCountModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ 'Perbaharui Data (Tahun ' . $item->year . ')' }}
                            </h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin_pesantren.studentcount_update', ['id' => $item->id]) }}"
                                method="post" class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="ponpes_id" value="{{ $item->ponpes_id }}" hidden>



                                    <div class="col-12 mb-3">
                                        <label for="year">Tahun</label>
                                        <input type="number" name="year"
                                            class="form-control @error('year') is-invalid @enderror"
                                            value="{{ $item->year }}" id="year">
                                        @error('year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="male_resident_count">Santri Mukim</label>
                                        <input type="number" name="male_resident_count"
                                            class="form-control @error('male_resident_count') is-invalid @enderror"
                                            value="{{ $item->male_resident_count }}" id="male_resident_count">
                                        @error('male_resident_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="female_resident_count">Santriwati Mukim</label>
                                        <input type="number" name="female_resident_count"
                                            class="form-control @error('female_resident_count') is-invalid @enderror"
                                            value="{{ $item->female_resident_count }}" id="female_resident_count">
                                        @error('female_resident_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="male_non_resident_count">Santri Tidak Mukim</label>
                                        <input type="number" name="male_non_resident_count"
                                            class="form-control @error('male_non_resident_count') is-invalid @enderror"
                                            value="{{ $item->male_non_resident_count }}" id="male_non_resident_count">
                                        @error('male_non_resident_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="female_non_resident_count">Santriwati Tidak Mukim</label>
                                        <input type="number" name="female_non_resident_count"
                                            class="form-control @error('female_non_resident_count') is-invalid @enderror"
                                            value="{{ $item->female_non_resident_count }}"
                                            id="female_non_resident_count">
                                        @error('female_non_resident_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-2">
                                        <ul>
                                            <li><small>Mukim : Santri/Santriwati yang menetap di pondok
                                                    pesantren</small></li>
                                            <li><small>Tidak Mukim : Santri/Santriwati yang tidak menetap di pondok
                                                    pesantren atau berasal dari desa sekitar</small></li>
                                        </ul>
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
        {{-- end  modal StudentCount --}}

        {{-- create modal StudentCount --}}
        <div class="modal fade" id="StudentCountModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambah Data Jumlah Santri</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin_pesantren.studentcount_create') }}" method="post" class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="ponpes_id"
                                    value="{{ $ponpes->id }}" hidden>

                                <div class="col-12 mb-3">
                                    <label for="year">Tahun</label>
                                    <input type="number" name="year"
                                        class="form-control @error('year') is-invalid @enderror"
                                        value="{{ old('year') }}" id="year">
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="male_resident_count">Santri Mukim</label>
                                    <input type="number" name="male_resident_count"
                                        class="form-control @error('male_resident_count') is-invalid @enderror"
                                        value="{{ old('male_resident_count') }}" id="male_resident_count">
                                    @error('male_resident_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="female_resident_count">Santriwati Mukim</label>
                                    <input type="number" name="female_resident_count"
                                        class="form-control @error('female_resident_count') is-invalid @enderror"
                                        value="{{ old('female_resident_count') }}" id="female_resident_count">
                                    @error('female_resident_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="male_non_resident_count">Santri Tidak Mukim</label>
                                    <input type="number" name="male_non_resident_count"
                                        class="form-control @error('male_non_resident_count') is-invalid @enderror"
                                        value="{{ old('male_non_resident_count') }}" id="male_non_resident_count">
                                    @error('male_non_resident_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="female_non_resident_count">Santriwati Tidak Mukim</label>
                                    <input type="number" name="female_non_resident_count"
                                        class="form-control @error('female_non_resident_count') is-invalid @enderror"
                                        value="{{ old('female_non_resident_count') }}" id="female_non_resident_count">
                                    @error('female_non_resident_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-12 mb-2">
                                    <ul>
                                        <li><small>Mukim : Santri/Santriwati yang menetap di pondok pesantren</small></li>
                                        <li><small>Tidak Mukim : Santri/Santriwati yang tidak menetap di pondok pesantren
                                                atau berasal dari desa sekitar</small></li>
                                    </ul>
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
        {{-- end modal StudentCount --}}
    @endsection


    @push('javascript')
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- Script DataTables -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>




        {{-- create form activity --}}
        <script>
            function updateCharacterCount(textarea) {
                const maxLength = parseInt(textarea.getAttribute('maxlength'));
                const currentLength = textarea.value.length;
                const remaining = maxLength - currentLength;

                const characterCountElement = document.getElementById('characterCount');
                characterCountElement.textContent = remaining;
            }
        </script>

        {{-- create form learning --}}
        <script>
            function updateCharacterCount_2(textarea) {
                const maxLength = parseInt(textarea.getAttribute('maxlength'));
                const currentLength = textarea.value.length;
                const remaining = maxLength - currentLength;

                const characterCountElement = document.getElementById('characterCount_2');
                characterCountElement.textContent = remaining;
            }
        </script>




        {{-- updaate form --}}
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
    @endpush

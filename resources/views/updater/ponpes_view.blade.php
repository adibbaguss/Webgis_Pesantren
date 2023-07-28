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
        <div class="row">
            <div class="col-12 d-flex justify-content-between mb-4">

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


                <div class="dropdown ">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="https://maps.google.com/?q={{ $ponpes->latitude . ',' . $ponpes->longitude }}"
                                class="dropdown-item">
                                <i class="fas fa-map-marked-alt"></i>
                                Buka Google Maps
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('updater.ponpes_edit', ['id' => $ponpes->id]) }}" class="dropdown-item">
                                <i class="fas fa-edit"></i>
                                Perbaharui Utama
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('updater.ponpes_edit_etc', ['id' => $ponpes->id]) }}" class="dropdown-item">
                                <i class="fas fa-edit"></i>
                                Perbaharui Lanjutan
                            </a>
                        </li>
                        {{-- <li>
                            <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fas fa-trash-alt"></i>
                                Hapus
                            </a>
                        </li> --}}
                    </ul>
                </div>

            </div>


            <div class="col-md-7">

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

                {{-- dropdown info --}}
                <div class="row d-md-block d-none">

                    <div class="col-12 mb-3">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingThree">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                                        {{ 'Pengajar' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse  "
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body pt-3 px-1 pb-1">
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
                                                                <td><span class=" btn btn-success w-100">Aktif</span></td>
                                                            @else
                                                                <td><span class="btn btn-danger w-100">Tidak Aktif</span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center bg-secondary text-white">
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">{{ 'No' }}</th>
                                                        <th scope="col">{{ 'Fasilitas' }}</th>
                                                        <th scope="col">{{ 'Jumlah' }}</th>
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
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3"
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


                    <div class="col-12 mb-3 ">
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">{{ 'No' }}</th>
                                                        <th scope="col">{{ 'Aktivitas' }}</th>
                                                        <th scope="col">{{ 'Deskripsi' }}</th>
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
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3"
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


                    <div class="col-12 mb-3 ">
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
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
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
                                                    @forelse ($activities as $item)
                                                        <tr>
                                                            <th class="text-center" scope="row">{{ $no++ }}
                                                            </th>
                                                            <td>{{ $item->name }}</td>
                                                            <td class="text-break">{{ $item->description }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3"
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
                                                            <td class="text-center" class="align-middle">{{ $item->year }}
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
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center bg-secondary text-white">
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
                {{-- end dropdown info --}}

            </div>

            <div class="col-md-5">
                <div class="row ">

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Nomor Statistik Pondok Pesantren' }}</label>
                        <span>{{ $ponpes->nspp }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Pengasuh' }}</label>
                        <span>{{ $ponpes->pimpinan }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Kategori' }}</label>
                        <span>{{ $ponpes->category }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Nomor Telepon' }}</label>
                        <span>{{ $ponpes->phone_number }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Alamat' }}</label>
                        <span>{{ $ponpes->address . ', ' . $ponpes->subdistrict . ', ' . $ponpes->city . ', ' . $ponpes->postal_code }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Alamat Email' }}</label>
                        <span>{{ $ponpes->email }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Website' }}</label>
                        <a href="{{ 'https://' . $ponpes->website }}">{{ $ponpes->website }}</a>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Tanggal Berdiri' }}</label>
                        <span>{{ \Carbon\Carbon::parse($ponpes->standing_date)->format('d F Y') }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Luas Tanah' }}</label>
                        <span>{{ $ponpes->surface_area }} M<sup>2</sup></span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Luas Bangunan' }}</label>
                        <span>{{ $ponpes->building_area }} M<sup>2</sup></span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Status' }}</label>
                        @if ($ponpes->status == 'active')
                            <span class="btn btn-success" style="width:fit-content">{{ 'Aktif' }}</span>
                        @else
                            <span class="bg-danger" style="width:fit-content">{{ 'Tidak Aktif' }}</span>
                        @endif
                    </div>



                </div>
            </div>

            {{-- drop dropdown info  --}}

            <div class="row d-md-none d-block">

                <div class="col-12 mb-3">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="panelsStayOpen-headingThree">
                                <button class="accordion-button fw-bold bg-light" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                    aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                                    {{ 'Pengajar' }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse  "
                                aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body pt-3 px-1 pb-1">
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
                                                            <td><span class=" btn btn-success w-100">Aktif</span></td>
                                                        @else
                                                            <td><span class="btn btn-danger w-100">Tidak Aktif</span>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center bg-secondary text-white">
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-dark">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">{{ 'No' }}</th>
                                                    <th scope="col">{{ 'Fasilitas' }}</th>
                                                    <th scope="col">{{ 'Jumlah' }}</th>
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
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center bg-secondary text-white">
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


                <div class="col-12 mb-3 ">
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-dark">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">{{ 'No' }}</th>
                                                    <th scope="col">{{ 'Aktivitas' }}</th>
                                                    <th scope="col">{{ 'Deskripsi' }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @forelse ($activities as $item)
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


                <div class="col-12 mb-3 ">
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-dark">
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
                                                @forelse ($activities as $item)
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
                                                        <td class="text-center" class="align-middle">{{ $item->year }}
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
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center bg-secondary text-white">
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

            {{-- end dropdwon info --}}

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




        {{-- modal delete --}}

        {{-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Pondok</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">{{ 'Anda Yakin Menghapus Data'.$ponpes->name .' ?'}}</div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
    
                        <form id="delete-form" action="{{ route('updater.ponpes_delete', ['id' => $ponpes->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Ponpes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    @endsection


    @push('javascript')
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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
    @endpush

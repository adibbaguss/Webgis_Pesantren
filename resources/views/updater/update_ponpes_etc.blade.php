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
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->expertise }}</td>
                                                            <td>{{ $item->gender }}</td>
                                                            @if ($item->status === 'Active')
                                                                <td><span class="text-success">Aktif</span></td>
                                                            @else
                                                                <td><span class="text-danger fw-bold">Tidak Aktif</span>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <div class="d-flex justify-content-between">
                                                                    <a class="btn btn-outline-secondary">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <a class="btn btn-outline-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                          
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
                                        <table class="table table-bordered border-dark table-responsive mb-0">
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
                                                        <th class="text-center" scope="row">{{ $no++ }}</th>
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
                                        <table class="table table-bordered border-dark table-responsive">
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




        {{-- modal delete --}}

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
                                <input type="text" name="ponpes_id" value="{{ $ponpes->id }}" hidden>
                                <div class="col-12 mb-3">
                                    <label for="">Nomor Induk Keluarga (NIK)</label>
                                    <input type="text" class="form-control" name="nik">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="">Keahlian</label>
                                    <input type="text" class="form-control" name="expertise">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="gender" id="" class="form-control">
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="active">active</option>
                                        <option value="non-active">non-active</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3 d-flex justify-content-end">
                                    <button class="btn btn-outline-secondary me-2" type="button"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
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
    @endpush

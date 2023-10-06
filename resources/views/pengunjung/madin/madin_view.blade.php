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
        @elseif(session('errorss'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 d-flex justify-content-between mb-4">

                <div class="d-flex">
                    @if (!$madin->photo_profil)
                        <img class="opacity-50" src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}"
                            alt="profil Default" style="width: 40px" class="my-auto">
                    @else
                        <img src="{{ asset('/images/ponpes/profile/' . $madin->photo_profil) }}" alt="Profil Pesatren"
                            style="width: 40px" class="my-auto">
                    @endif
                    <h2 class="text-secondary fw-bold my-auto ms-1">{{ $madin->name }}</h2>
                </div>


                <div class="dropdown ">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="https://maps.google.com/?q={{ $madin->latitude . ',' . $madin->longitude }}"
                                class="dropdown-item">
                                <i class="fas fa-map-marked-alt"></i>
                                Buka Google Maps
                            </a>
                        </li>
                        <li>
                            <a href="/pengunjung/ponpes_report"
                                class="dropdown-item">
                                <i class="fas fa-exclamation-circle"></i>
                                Laporkan
                            </a>
                        </li>
   
                    </ul>
                </div>

            </div>


            <div class="col-md-7">

                {{-- jumbotron --}}
                <div class="jumbotron" style="user-select: none;">
                    @if ($jumbotronImage)
                        <img src="{{ asset('images/ponpes/image/' . $jumbotronImage->image_name) }}" class="card-img border"
                            alt="..." style="max-height:300px">
                    @else
                        <img src="{{ asset('images/ponpes/default-image.png') }}" class="card-img border" alt="..."
                            style="max-height:300px">
                    @endif
                </div>
                {{-- end jumbotron --}}


                {{-- slick-js --}}
                <div class="slick-responsive">
                    @if ($regulerImages->isEmpty())
                        @for ($i = 0; $i < 6; $i++)
                            <div class="img-overflow border">
                                <img type="button" data-bs-toggle="modal" data-bs-target="#imageModal.{{ $i }}"
                                    src="{{ asset('images/ponpes/default-image-1.png') }}" alt="">
                            </div>
                        @endfor
                    @else
                        @foreach ($regulerImages as $regulerImage)
                            <div class="img-overflow border">
                                <img type="button" data-bs-toggle="modal"
                                    data-bs-target="#imageModal.{{ $regulerImage->id }}"
                                    src="{{ asset('images/ponpes/image/' . $regulerImage->image_name) }}" alt="">
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- end slick js --}}

                {{-- dropdown info desktop --}}
                <div class="row d-md-block d-none">
                    {{-- informasi lainnya dari madin --}}
                    @include('layouts.madin_info_etc')           
                </div>
                {{-- end dropdown info --}}

            </div>

            <div class="col-md-5">
                <div class="row ">

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Nomor Statistik Diniyah Takmiliyah' }}</label>
                        <span>{{ $madin->nsdt }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Pengasuh' }}</label>
                        <span>{{ $madin->pimpinan }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Nomor Telepon' }}</label>
                        <span>{{ $madin->phone_number }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Alamat' }}</label>
                        <span>{{ $madin->address . ', ' . $madin->subdistrict . ', ' . $madin->city . ', ' . $madin->postal_code }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Alamat Email' }}</label>
                        <span>{{ $madin->email }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Website' }}</label>
                        <a href="{{ 'https://' . $madin->website }}">{{ $madin->website }}</a>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Tanggal Berdiri' }}</label>
                        <span>{{ \Carbon\Carbon::parse($madin->standing_date)->format('d F Y') }}</span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Luas Tanah' }}</label>
                        <span>{{ $madin->surface_area }} M<sup>2</sup></span>
                    </div>

                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Luas Bangunan' }}</label>
                        <span>{{ $madin->building_area }} M<sup>2</sup></span>
                    </div>


                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Operator/Updater' }}</label>
                        @if ($madin->user_id)
                            <table class="w-50">
                                <tr>
                                    <td>ID</td>
                                    <td>:</td>
                                    <td>{{ $madin->user->id }}</td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td>{{ $madin->user->username }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $madin->user->name }}</td>
                                </tr>
                            </table>
                        @else
                            <span>Belum Dibuat</span>
                        @endif
                    </div>


                    <div class="col-12 mb-4 d-grid">
                        <label class="fs-6 fw-bold text-secondary">{{ 'Status' }}</label>
                        @if ($madin->status == 'active')
                            <span class="btn btn-success" style="width:fit-content">{{ 'Aktif' }}</span>
                        @else
                            <span class="btn btn-danger" style="width:fit-content">{{ 'Tidak Aktif' }}</span>
                        @endif
                    </div>



                </div>
            </div>

            {{-- drop down info  --}}

            {{-- dropdown info desktop --}}
            <div class="row d-md-none d-block">
                {{-- informasi lainnya dari madin --}}
                 @include('layouts.madin_info_etc')             
            </div>
            {{-- end dropdown info --}}

        </div>


        {{-- modal image preview --}}
        @foreach ($regulerImages as $regulerImage)
            <div class="modal fade" id="imageModal.{{ $regulerImage->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog px-0">
                    <div class="modal-content bg-none">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- <img src="{{ asset('images/ponpes/default-image.png') }}" alt=""
                                style="width: 100%"> --}}
                            <img src="{{ asset('images/ponpes/image/' . $regulerImage->image_name) }}"
                                alt="Image Madin" style="width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

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
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });

            });
        </script>
    @endpush

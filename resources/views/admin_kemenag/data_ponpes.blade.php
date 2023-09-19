@extends('layouts.app')

@section('content')


    <div class="container-fluid mt-5 pt-5">
        {{-- notif penambahan data --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif(session('errorss'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <h5 class="mb-0 text-secondary d-md-none d-block mb-5">{{ 'Daftar Pondok Pesantren di Kabupaten Batang' }}</h5>
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h2 class="mb-0 text-secondary d-md-block d-none">{{ 'Daftar Pondok Pesantren di Kabupaten Batang' }}</h2>
            <form class="d-flex me-2 ms-auto " role="search" action="{{ route('admin_kemenag.ponpes_search') }}" method="GET">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search" name="query" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-sliders-h"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/admin/create_ponpes" class="dropdown-item">
                            <i class="fas fa-plus"></i>
                            {{ 'Tambah Data' }}
                        </a>
                    </li>
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

            @if (count($ponpes) > 0)
                @foreach ($ponpes as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3 mx-0">
                        <a href="{{ route('admin_kemenag.ponpes_view', ['id' => $item->id]) }}">
                            <div class="card border-0 shadow-sm">
                                @if ($item->photo_profil != null)
                                    <img src="{{ asset('/images/ponpes/profile/' . $item->photo_profil) }}"
                                        class="card-img-top" alt="Image Pondok Pesantren">
                                @else
                                    <img class="opacity-50"
                                        src="{{ asset('/images/ponpes/profile/logo_ponpes_default.jpg') }}"
                                        class="card-img-top" alt="Image Pondok Pesantren Default">
                                @endif
                                <div class="card-body bg-white text-decoration-none">
                                    <h class="card-title mb-0">{{ $item->name }}</h>

                                </div>
                                <div class="card-footer bg-white border-0">
                                    <p class="card-text small fw-bold mb-0">{{ $item->category }}</p>
                                    <small class="text-muted">{{ $item->subdistrict . ', ' . $item->city }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="bg-secondary opacity-50 p-5">
                    <h2 class="text-center text-white">
                        {{ 'Data Tidak Tersedia' }}
                    </h2>
                </div>
            @endif



        </div>
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
                    <a href="/admin kemenag/ponpes_export_xlsx" class="text-deocartion-none btn btn-outline-success p-3">
                        <i class="fas fa-file-excel fs-1"></i>
                        {{ 'Cetak Excel' }}
                    </a>

                    <a href="/admin kemenag/ponpes_export_csv" class="text-deocartion-none btn btn-outline-success p-3">
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

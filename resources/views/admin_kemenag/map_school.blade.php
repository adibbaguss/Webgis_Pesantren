@extends('layouts.app')

@section('contents')
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

        <div class="d-sm-flex align-items-center justify-content-between mb-5">
            <h2 class="mb-0 text-secondary">Peta Lembaga Pendidikan Formal Milik Pondok Pesantren di Kabupaten Batang</h2>
        </div>

        <div class="form mb-2">
            <form action="{{ route('admin_kemenag.search_facility') }}" method="GET" class="d-flex justify-content-end">
                <div class="form-group">
                    <select class="form-control" id="attribute" name="attribute">
                        <option value="">-- Tampilkan Semua --</option>
                        {{-- @foreach ($attributeNames as $attributes => $attributeLabel)
                            <option value="{{ $attributes }}" {{ old('attribute') == $attributes ? 'selected' : '' }}>
                                {{ $attributeLabel }}</option>
                        @endforeach --}}
                    </select>

                </div>
                <button type="submit" class="btn btn-outline-success ms-2">Tampilkan</button>
            </form>

        </div>

        <div class="text-start">
            {{-- @if (isset($attribute))
                <span class="text-secondary">Fasilitas :
                    {{ $attributeNames[$attribute] ?? 'Nama Fasilitas Tidak Diketahui' }}</span>
            @endif --}}
        </div>
        <div class="map-view mb-5 bg-white p-2 rounded-3 shadow-sm">
            <div id="map" class="rounded-3" style="min-height:500px;max-height:900px"></div>
        </div>
    </div>
@endsection

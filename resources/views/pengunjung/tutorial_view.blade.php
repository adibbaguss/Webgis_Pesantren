@extends('layouts.app')

@section('css')
    <style>
        #pdf-container {
            width: 100%;
            height: 600px;
            /* Sesuaikan dengan ketinggian yang diinginkan */
            overflow: auto;
        }

        #pdf-iframe {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
@include('layouts.panduan_sistem')
@endsection

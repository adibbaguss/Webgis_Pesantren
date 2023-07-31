@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('updater.ponpes_image_create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="ponpes_id" value="{{ $ponpes->id }}" hidden>
                            <br>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="jumbotron">Jumbotron Image:</label>
                            <input type="file" class="form-control" name="jumbotron">
                            @error('jumbotron')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="reguler[]">Regular Image :</label>
                            <input type="file" class="form-control" name="reguler[]" multiple>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Upload Images</button>
                            </div>

                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection
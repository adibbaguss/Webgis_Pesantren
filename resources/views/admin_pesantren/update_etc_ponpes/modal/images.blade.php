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
                                    <input type="file" class="form-control @error('jumbotron') is-invalid @enderror"
                                        name="jumbotron">
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
                                    <input type="file" class="form-control @error('reguler') is-invalid @enderror"
                                        name="reguler[]" multiple>
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

                            <form id="delete-form"
                                action="{{ route('admin_pesantren.image_delete', ['id' => $item->id]) }}"
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
        {{-- end modal gambar --}}
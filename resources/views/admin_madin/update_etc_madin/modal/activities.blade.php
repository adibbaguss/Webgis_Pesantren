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
                                action="{{ route('admin_madin.activities_delete', ['id' => $item->id]) }}"
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
                            <form action="{{ route('admin_madin.activities_update', ['id' => $item->id]) }}"
                                method="post" class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="madin_id" value="{{ $item->madin_id }}" hidden>
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
                        <form action="{{ route('admin_madin.activities_create') }}" method="post" class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="madin_id"
                                    value="{{ $madin->id }}" hidden>
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
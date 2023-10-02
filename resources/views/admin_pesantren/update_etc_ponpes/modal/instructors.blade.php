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
                                action="{{ route('admin_pesantren.instructors_delete', ['id' => $item->id]) }}"
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
                            <form action="{{ route('admin_pesantren.instructors_update', ['id' => $item->id]) }}"
                                method="post" class="w-100">
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
                                            <option value="Laki-laki" @if (old('gender', $item->gender) === 'Laki-Laki') selected @endif>
                                                Laki-Laki
                                            </option>
                                            <option value="Perempuan" @if (old('gender', $item->gender) === 'Perempuan') selected @endif>
                                                Perempuan
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
                                                Aktif
                                            </option>
                                            <option value="non-active" @if (old('status', $item->status) === 'non-active') selected @endif>
                                                Tidak Aktif</option>
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
                                        <option value="Laki-laki" @if (old('gender') === 'Laki-laki') selected @endif>
                                            Laki-laki
                                        </option>
                                        <option value="Perempuan" @if (old('gender') === 'Perempuan') selected @endif>
                                            Perempuan
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
                                        <option value="active" @if (old('status') === 'active') selected @endif>Aktif
                                        </option>
                                        <option value="non-active" @if (old('status') === 'non-active') selected @endif>
                                            Tidak Aktif</option>
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
        {{-- modal delete StudentCount --}}
        @foreach ($studentCount as $item)
            <div class="modal fade" id="deleteStudentCountModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Pembelajaran' }}</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ 'Anda Yakin Menghapus Data ' . $item->name . ' ?' }}</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button"
                                data-bs-dismiss="modal">Batal</button>

                            <form id="delete-form"
                                action="{{ route('admin_madin.studentcount_delete', ['id' => $item->id]) }}"
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
        {{-- end modal StudentCount --}}


        {{-- update StudentCount --}}
        @foreach ($studentCount as $item)
            <div class="modal fade" id="updateStudentCountModal{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ 'Perbaharui Data (Tahun ' . $item->year . ')' }}
                            </h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin_madin.studentcount_update', ['id' => $item->id]) }}"
                                method="post" class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="madin_id" value="{{ $item->madin_id }}" hidden>



                                    <div class="col-12 mb-3">
                                        <label for="year">Tahun</label>
                                        <select name="year" id="year"
                                            class="form-control @error('year') is-invalid @enderror">
                                            @for ($tahun = date('Y'); $tahun >= 1900; $tahun--)
                                                <option value="{{ $tahun }}"
                                                    {{ $tahun == $item->year ? 'selected' : '' }}>
                                                    {{ $tahun }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="male">Siswa Laki-Laki</label>
                                        <input type="number" name="male"
                                            class="form-control @error('male') is-invalid @enderror"
                                            value="{{ $item->male}}" id="male">
                                        @error('male')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="female">Siswa Perempuan</label>
                                        <input type="number" name="female"
                                            class="form-control @error('female') is-invalid @enderror"
                                            value="{{ $item->female}}" id="female">
                                        @error('female')
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
        {{-- end  modal StudentCount --}}

        {{-- create modal StudentCount --}}
        <div class="modal fade" id="StudentCountModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambah Data Jumlah Santri</h5>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin_madin.studentcount_create') }}" method="post"
                            class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="madin_id"
                                    value="{{ $madin->id }}" hidden>

                                {{-- Year Selector --}}
                                <div class="col-12 mb-3">
                                    <label for="year">Tahun</label>
                                    <select name="year" id="year"
                                        class="form-control @error('year') is-invalid @enderror">
                                        <option value="">Pilih Tahun</option>
                                        @for ($tahun = date('Y'); $tahun >= 1900; $tahun--)
                                            <option value="{{ $tahun }}"
                                                {{ old('year') == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Male Resident Count --}}
                                <div class="col-12 mb-3">
                                    <label for="male">Muri Laki-laki</label>
                                    <input type="number" name="male"
                                        class="form-control @error('male') is-invalid @enderror"
                                        value="{{ old('male') }}" id="male">
                                    @error('male')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Female Resident Count --}}
                                <div class="col-12 mb-3">
                                    <label for="female">Siswa Perempuan</label>
                                    <input type="number" name="female"
                                        class="form-control @error('female') is-invalid @enderror"
                                        value="{{ old('female') }}" id="female">
                                    @error('female')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>




                                {{-- Form Actions --}}
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

        {{-- end modal StudentCount --}}
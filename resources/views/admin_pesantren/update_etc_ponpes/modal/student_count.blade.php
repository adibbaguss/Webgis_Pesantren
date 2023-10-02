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
                                action="{{ route('admin_pesantren.studentcount_delete', ['id' => $item->id]) }}"
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
                            <form action="{{ route('admin_pesantren.studentcount_update', ['id' => $item->id]) }}"
                                method="post" class="w-100">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- hidden input --}}
                                    <input type="text" name="ponpes_id" value="{{ $item->ponpes_id }}" hidden>



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
                                        <label for="male_resident_count">Santri Mukim</label>
                                        <input type="number" name="male_resident_count"
                                            class="form-control @error('male_resident_count') is-invalid @enderror"
                                            value="{{ $item->male_resident_count }}" id="male_resident_count">
                                        @error('male_resident_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="female_resident_count">Santriwati Mukim</label>
                                        <input type="number" name="female_resident_count"
                                            class="form-control @error('female_resident_count') is-invalid @enderror"
                                            value="{{ $item->female_resident_count }}" id="female_resident_count">
                                        @error('female_resident_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="male_non_resident_count">Santri Tidak Mukim</label>
                                        <input type="number" name="male_non_resident_count"
                                            class="form-control @error('male_non_resident_count') is-invalid @enderror"
                                            value="{{ $item->male_non_resident_count }}" id="male_non_resident_count">
                                        @error('male_non_resident_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="female_non_resident_count">Santriwati Tidak Mukim</label>
                                        <input type="number" name="female_non_resident_count"
                                            class="form-control @error('female_non_resident_count') is-invalid @enderror"
                                            value="{{ $item->female_non_resident_count }}"
                                            id="female_non_resident_count">
                                        @error('female_non_resident_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-2">
                                        <ul>
                                            <li><small>Mukim : Santri/Santriwati yang menetap di pondok
                                                    pesantren</small></li>
                                            <li><small>Tidak Mukim : Santri/Santriwati yang tidak menetap di pondok
                                                    pesantren atau berasal dari desa sekitar</small></li>
                                        </ul>
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
                        <form action="{{ route('admin_pesantren.studentcount_create') }}" method="post"
                            class="w-100">
                            @csrf
                            @method('POST')
                            <div class="row">
                                {{-- hidden input --}}
                                <input class="form-control" type="text" name="ponpes_id"
                                    value="{{ $ponpes->id }}" hidden>

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
                                    <label for="male_resident_count">Santri Mukim</label>
                                    <input type="number" name="male_resident_count"
                                        class="form-control @error('male_resident_count') is-invalid @enderror"
                                        value="{{ old('male_resident_count') }}" id="male_resident_count">
                                    @error('male_resident_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Female Resident Count --}}
                                <div class="col-12 mb-3">
                                    <label for="female_resident_count">Santriwati Mukim</label>
                                    <input type="number" name="female_resident_count"
                                        class="form-control @error('female_resident_count') is-invalid @enderror"
                                        value="{{ old('female_resident_count') }}" id="female_resident_count">
                                    @error('female_resident_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Male Non-Resident Count --}}
                                <div class="col-12 mb-3">
                                    <label for="male_non_resident_count">Santri Tidak Mukim</label>
                                    <input type="number" name="male_non_resident_count"
                                        class="form-control @error('male_non_resident_count') is-invalid @enderror"
                                        value="{{ old('male_non_resident_count') }}" id="male_non_resident_count">
                                    @error('male_non_resident_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Female Non-Resident Count --}}
                                <div class="col-12 mb-3">
                                    <label for="female_non_resident_count">Santriwati Tidak Mukim</label>
                                    <input type="number" name="female_non_resident_count"
                                        class="form-control @error('female_non_resident_count') is-invalid @enderror"
                                        value="{{ old('female_non_resident_count') }}" id="female_non_resident_count">
                                    @error('female_non_resident_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Explanation --}}
                                <div class="col-12 mb-2">
                                    <ul>
                                        <li><small>Mukim : Santri/Santriwati yang menetap di pondok pesantren</small></li>
                                        <li><small>Tidak Mukim : Santri/Santriwati yang tidak menetap di pondok pesantren
                                                atau berasal dari desa sekitar</small></li>
                                    </ul>
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
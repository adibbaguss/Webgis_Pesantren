    {{-- create modal StudentCount --}}
    <div class="modal fade" id="createSchoolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menambah Data Sekolah</h5>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin_pesantren.school_create') }}" method="post" class="w-100">
                        @csrf
                        @method('POST')
                        <div class="row">
                            {{-- hidden input --}}
                            <input type="text" name="ponpes_id" value="{{ $ponpes->id }}" hidden>
                            <table class="table table-bordered border-dark">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" colspan="2" class="align-middle text-center">
                                            {{ 'Sekolah Yang Dimiliki/Berelasi' }}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row" class="align-middle">SD/MI</th>
                                        <td>
                                            <input type="text" name="sd"
                                                class="form-control @error('sd') is-invalid @enderror" id="sd">
                                            @error('sd')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="align-middle">SMP/MTS</th>
                                        <td>
                                            <input type="text" name="smp"
                                                class="form-control @error('smp') is-invalid @enderror" id="smp">
                                            @error('smp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="align-middle">SMA/MA</th>
                                        <td>
                                            <input type="text" name="sma"
                                                class="form-control @error('sma') is-invalid @enderror" id="sma">
                                            @error('sma')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="align-middle">SMK</th>

                                        <td>
                                            <input type="text" name="smk"
                                                class="form-control @error('smk') is-invalid @enderror" id="smk">
                                            @error('smk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>

                                        <th scope="row" class="align-middle">Perguruan Tinggi</th>
                                        <td>
                                            <input type="text" name="pt"
                                                class="form-control @error('pt') is-invalid @enderror" id="pt">
                                            @error('pt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>


                                </tbody>
                            </table>



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



    
    @if ($ponpes->school)

    @if ($ponpes->school->count() > 0)
        {{-- update school --}}

        <div class="modal fade" id="updateSchoolModal{{ $ponpes->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ 'Perbaharui Data Sekolah' }}
                        </h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin_pesantren.school_update', ['id' => $school->id]) }}" method="post"
                            class="w-100">
                            @csrf
                            @method('PUT')
                            <div class="row">
                     
                                <input type="text" name="ponpes_id" value="{{ $school->id }}" hidden>
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col" colspan="2" class="align-middle text-center">
                                                {{ 'Sekolah Yang Dimiliki/Berelasi' }}
                                            </th>
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attributeTable as $table)
                                            <tr>
                                                <th scope="row" class="align-middle">
                                                    {{ $attributeNames[$table] ?? '-' }}</th>
                                                <td>
                                                    <input type="text" name="{{ $table }}"
                                                        class="form-control @error('{{ $table }}') is-invalid @enderror"
                                                        value="{{ $school->$table }}" id="{{ $table }}">
                                                    @error('{{ $table }}')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
    
    
    
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
    
        {{-- end  modal school --}}



        
            {{-- modal delete school --}}
            
            <div class="modal fade" id="deleteSchoolModal{{ $ponpes->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Data Sekolah' }}</h5>
                            <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">{{ 'Anda Yakin Menghapus Data sekolah milik ' . $ponpes->name . ' ?' }}</div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary" type="button"
                                data-bs-dismiss="modal">Batal</button>

                            <form id="delete-form"
                                action="{{ route('admin_pesantren.school_delete', ['id' => $ponpes->school->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
        {{-- end modal school --}}
    @endif
    @endif





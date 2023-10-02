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
                        <form action="{{ route('admin_pesantren.school_update', ['id' => $school->id]) }}"
                            method="post" class="w-100">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                {{-- hidden input --}}
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
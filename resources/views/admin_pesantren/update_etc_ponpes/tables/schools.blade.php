                    {{-- sekolah --}}
                    <div class="col-12 mb-3">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingSix">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseSix">
                                        {{ 'Sekolah Yang Dimiliki/Berelasi' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse  "
                                    aria-labelledby="panelsStayOpen-headingSix">
                                    <div class="accordion-body pt-3 px-1 pb-1">
                                        <div class="d-flex justify-content-end">
                                            @if (empty($ponpes->school))
                                                <!-- Tampilkan tombol "Tambah" jika objek $ponpes ada tetapi tidak memiliki relasi 'school' -->
                                                <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#createSchoolModal">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            @endif



                                            @if ($ponpes->school)
                                                <!-- Tampilkan tombol "Edit" jika relasi 'school' ada dan tidak null -->
                                                @if ($ponpes->school->count() > 0)
                                            
                                                    <button class="btn btn-outline-secondary mb-2 me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateSchoolModal{{ $ponpes->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <button class="btn btn-outline-danger mb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteSchoolModal{{ $ponpes->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col" colspan="2"
                                                            class="align-middle text-center">
                                                            {{ 'Sekolah Yang Dimiliki/Berelasi' }}
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($attributeTable as $table)
                                                        <tr>
                                                            <th scope="row" class="align-middle">
                                                                {{ $attributeNames[$table] ?? '-' }}</th>
                                                            <td class="align-middle">
                                                                {{ $school->$table ?? '-' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- end sekolah --}}

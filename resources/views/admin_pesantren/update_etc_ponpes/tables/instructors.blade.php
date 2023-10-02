                    {{-- pengajar --}}
                    <div class="col-md-12 mb-3">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingThree">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                                        {{ 'Pengajar' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body pt-3 px-1 pb-1">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                                data-bs-target="#InstructorsModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">{{ 'No' }}</th>
                                                        <th scope="col">{{ 'NIK' }}</th>
                                                        <th scope="col">{{ 'Nama' }}</th>
                                                        <th scope="col">{{ 'Keahlian' }}</th>
                                                        <th scope="col">{{ 'Gender' }}</th>
                                                        <th scope="col">{{ 'Status' }}</th>
                                                        <th scope="col">{{ 'Opsi' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @forelse ($instructors as $item)
                                                        <tr>
                                                            <th class="text-center" scope="row">{{ $no++ }}
                                                            </th>
                                                            <td>{{ $item->nik }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->expertise }}</td>
                                                            <td>{{ $item->gender }}</td>
                                                            @if ($item->status === 'active')
                                                                <td><span class="text-success">Aktif</span></td>
                                                            @else
                                                                <td><span class="text-danger fw-bold">Tidak Aktif</span>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <div class="d-flex justify-content-between">
                                                                    <a class="me-1 text-secondary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateInstructorModal{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>

                                                                    <a class="ms-1 text-danger" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteInstructorModal{{ $item->id }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7"
                                                                class="text-center bg-secondary text-white">
                                                                {{ 'Belum diisi' }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end pengajar --}}
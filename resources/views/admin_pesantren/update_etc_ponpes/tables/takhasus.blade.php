        {{-- Program Takhasus --}}
        @if ($ponpes->takhasus == 'yes')
        <div class="col-12 mb-3">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header " id="panelsStayOpen-headingSeven">
                        <button class="accordion-button fw-bold bg-light" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven"
                            aria-expanded="true" aria-controls="panelsStayOpen-collapseSeven">
                            {{ 'Program Takhasus' }}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse  "
                        aria-labelledby="panelsStayOpen-headingSeven">
                        <div class="accordion-body pt-3 px-1 pb-1">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                    data-bs-target="#ProgramTakhasusModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">{{ 'No' }}</th>
                                            <th scope="col">{{ 'Program Takhasus' }}</th>
                                            <th scope="col">{{ 'Deskripsi' }}</th>
                                            <th scope="col">{{ 'Opsi' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @forelse ($programTakhasus as $item)
                                            <tr>
                                                <th class="text-center" scope="row">{{ $no++ }}
                                                </th>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-break">{{ $item->description }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <a class="me-1 text-secondary" type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateProgramTakhasusModal{{ $item->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <a class="ms-1 text-danger" type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteProgramTakhasusModal{{ $item->id }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4"
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
        @endif
        {{-- end Program Takhasus --}}
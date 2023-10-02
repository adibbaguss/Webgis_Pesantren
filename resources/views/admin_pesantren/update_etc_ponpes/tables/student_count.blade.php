                    {{-- jumlah santri --}}
                    <div class="col-12 mb-3">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="panelsStayOpen-headingFive">
                                    <button class="accordion-button fw-bold bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseFive">
                                        {{ 'Jumlah Santri' }}
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse  "
                                    aria-labelledby="panelsStayOpen-headingFive">
                                    <div class="accordion-body pt-3 px-1 pb-1">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-outline-success mb-2" data-bs-toggle="modal"
                                                data-bs-target="#StudentCountModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-dark">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th rowspan="2" scope="col" class="align-middle">
                                                            {{ 'No' }}</th>
                                                        <th rowspan="2" scope="col" class="align-middle">
                                                            {{ 'Tahun' }}</th>
                                                        <th colspan="2" scope="col" class="align-middle">
                                                            {{ 'Mukim' }}</th>
                                                        <th colspan="2" scope="col" class="align-middle">
                                                            {{ 'Tidak Mukim' }}</th>
                                                        <th rowspan="2" scope="col" class="align-middle">
                                                            {{ 'Total' }}</th>
                                                        <th rowspan="2" scope="col" class="align-middle">
                                                            {{ 'Opsi' }}</th>

                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="text-center">{{ 'Santri' }}</th>
                                                        <th scope="col" class="text-center">{{ 'Santriwati' }}</th>
                                                        <th scope="col" class="text-center">{{ 'Santri' }}</th>
                                                        <th scope="col" class="text-center">{{ 'Santriwati' }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @forelse ($studentCount as $item)
                                                        <tr>
                                                            <th class="text-center" scope="row" class="align-middle">
                                                                {{ $no++ }}</th>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->year }}
                                                            </td>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->male_resident_count }}</td>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->female_resident_count }}</td>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->male_non_resident_count }}</td>
                                                            <td class="text-center" class="align-middle">
                                                                {{ $item->female_non_resident_count }}</td>
                                                            <td class="text-center align-middle">
                                                                {{ $item->male_resident_count + $item->female_resident_count + $item->male_non_resident_count + $item->female_non_resident_count }}
                                                            </td>

                                                            <td>
                                                                <div class="d-flex justify-content-between">
                                                                    <a class="me-1 text-secondary" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#updateStudentCountModal{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>

                                                                    <a class="ms-1 text-danger" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteStudentCountModal{{ $item->id }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8"
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
                    {{-- end jumlah santri --}}

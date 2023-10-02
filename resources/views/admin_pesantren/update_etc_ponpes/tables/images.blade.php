          {{-- image  --}}
          <div class="col-md-12 mb-3">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header " id="panelsStayOpen-headingZero">
                        <button class="accordion-button fw-bold bg-light" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseZero"
                            aria-expanded="true" aria-controls="panelsStayOpen-collapseZero">
                            {{ 'Gambar Pondok Pesantren' }}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseZero" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingZero">
                        <div class="accordion-body pt-3 px-1 pb-1">

                            <div class="d-flex justify-content-end mb-3">
                                <a type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#jumbotronModal">
                                    <i class="fas fa-plus"></i> Gambar Jumbotron
                                </a>
                            </div>

                            <div class="table-responsive">
                                @php
                                    $no = 1;
                                @endphp
                                {{-- table khusus jumbotron --}}

                                <table class="table table-bordered border-dark text-center">
                                    <tr>
                                        <th colspan="3">Gambar Jumbotron</th>
                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>File</th>
                                        <th>Hapus</th>
                                    </tr>
                                    @foreach ($image as $item)
                                        @if ($item->type == 'jumbotron')
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td><a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#previewModal{{ $item->id }}">Klik
                                                        Preview</a></td>
                                                <td>
                                                    <a class="text-danger" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteImageModal{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>

                            </div>


                            <div class="d-flex justify-content-end mb-3">
                                <a type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#regulerModal">
                                    <i class="fas fa-plus"></i> Gambar Reguler
                                </a>
                            </div>

                            <div class="table-responsive">
                                @php
                                    $no = 1;
                                @endphp
                                {{-- table khusus jumbotron --}}
                                <table class="table table-bordered border-dark text-center">
                                    <tr>
                                        <th colspan="3">Gambar Reguler</th>
                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>File</th>
                                        <th>Hapus</th>
                                    </tr>
                                    @foreach ($image as $item)
                                        @if ($item->type == 'reguler')
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td><a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#previewModal{{ $item->id }}">Klik
                                                        Preview</a></td>
                                                <td>
                                                    <a class="text-danger" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteImageModal{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end image --}}
      {{-- fasilitas --}}
      <div class="col-12 mb-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button fw-bold bg-light" type="button"
                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        {{ 'Fasilitas' }}
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse "
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body pt-3 px-1 pb-1">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-secondary mb-2" data-bs-toggle="modal"
                                data-bs-target="#updateFacilityModal">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered border-dark">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">{{ 'Fasilitas' }}</th>
                                        <th scope="col">{{ 'Jumlah' }}</th>
                                    </tr>
                                </thead>
                                @foreach ($facility as $item)
                                    <tbody>
                                        <tr>
                                            <td>Asrama Laki-laki</td>
                                            <td class="text-center">{{ $item->asrama_lk }}</td>
                                        </tr>
                                        <tr>
                                            <td>Asrama Perempuan</td>
                                            <td class="text-center">{{ $item->asrama_pr }}</td>
                                        </tr>
                                        <tr>
                                            <td>Masjid</td>
                                            <td class="text-center">{{ $item->masjid }}</td>
                                        </tr>
                                        <tr>
                                            <td>Aula Kegiatan</td>
                                            <td class="text-center">{{ $item->aula_kegiatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ruang Pembelajaran</td>
                                            <td class="text-center">{{ $item->ruang_pembelajaran }}</td>
                                        </tr>
                                        <tr>
                                            <td>Perpustakaan</td>
                                            <td class="text-center">{{ $item->perpustakaan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kantor Pengajar</td>
                                            <td class="text-center">{{ $item->kantor_pengajar }}</td>
                                        </tr>
                                        <tr>
                                            <td>Dapur</td>
                                            <td class="text-center">{{ $item->dapur }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kantin</td>
                                            <td class="text-center">{{ $item->kantin }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Olahraga</td>
                                            <td class="text-center">{{ $item->tempat_olahraga }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kamar Mandi</td>
                                            <td class="text-center">{{ $item->kamar_mandi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ruang Kesehatan</td>
                                            <td class="text-center">{{ $item->ruang_kesehatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kamar Pengajar</td>
                                            <td class="text-center">{{ $item->kamar_pengajar }}</td>
                                        </tr>
                                        <tr>
                                            <td>Lab Komputer</td>
                                            <td class="text-center">{{ $item->lab_komputer }}</td>
                                        </tr>
                                        <tr>
                                            <td>Lapangan Pertanian</td>
                                            <td class="text-center">{{ $item->lapangan_pertanian }}</td>
                                        </tr>
                                        <tr>
                                            <td>Lapangan Pertenakan</td>
                                            <td class="text-center">{{ $item->lapangan_pertenakan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Laundry</td>
                                            <td class="text-center">{{ $item->laundry }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end fasilitas --}}
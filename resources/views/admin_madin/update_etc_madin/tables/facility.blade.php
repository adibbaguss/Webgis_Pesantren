      {{-- fasilitas --}}
      <div class="col-12 mb-3">
          <div class="accordion" id="accordionPanelsStayOpenExample">
              <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                          data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                          aria-controls="panelsStayOpen-collapseOne">
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
                                              <td>Mushola/Tempat Ibadah</td>
                                              <td class="text-center">
                                                  {{ $item->mushola }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>Ruang Kelas</td>
                                              <td class="text-center">
                                                  {{ $item->kelas_pengajaran }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>Perpustakaan</td>
                                              <td class="text-center">
                                                  {{ $item->perpustakaan }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>Ruang Guru</td>
                                              <td class="text-center">
                                                  {{ $item->ruang_guru }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>Fasilitas Audio Visual</td>
                                              <td class="text-center">
                                                  {{ $item->fasilitas_audio_visual }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>Kamar Mandi</td>
                                              <td class="text-center">
                                                  {{ $item->kamar_mandi }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>Ruangan Administrasi</td>
                                              <td class="text-center">
                                                  {{ $item->ruangan_administrasi }}
                                              </td>
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

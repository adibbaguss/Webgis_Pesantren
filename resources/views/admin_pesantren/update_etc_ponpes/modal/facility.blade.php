        {{-- update facility --}}
        @foreach ($facility as $item)
        <div class="modal fade" id="updateFacilityModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ 'Perbaharui Data Fasilitas' }}
                    </h5>
                    <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin_pesantren.facility_update', ['id' => $item->id]) }}"
                        method="post" class="w-100">
                        @csrf
                        @method('PUT')
                        <input type="text" name="ponpes_id" value="{{ $item->ponpes_id }}" hidden>
                        <table class="table table-bordered border-dark">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">{{ 'Fasilitas' }}</th>
                                    <th scope="col" class="w-25">{{ 'Jumlah' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Asrama Laki-laki</td>
                                    <td class="text-center">
                                        <input type="number" name="asrama_lk" class="form-control"
                                            value="{{ $item->asrama_lk }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Asrama Perempuan</td>
                                    <td class="text-center">
                                        <input type="number" name="asrama_pr" class="form-control"
                                            value="{{ $item->asrama_pr }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Masjid</td>
                                    <td class="text-center">
                                        <input type="number" name="masjid" class="form-control"
                                            value="{{ $item->masjid }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Aula Kegiatan</td>
                                    <td class="text-center">
                                        <input type="number" name="aula_kegiatan" class="form-control"
                                            value="{{ $item->aula_kegiatan }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ruang Pembelajaran</td>
                                    <td class="text-center">
                                        <input type="number" name="ruang_pembelajaran" class="form-control"
                                            value="{{ $item->ruang_pembelajaran }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Perpustakaan</td>
                                    <td class="text-center">
                                        <input type="number" name="perpustakaan" class="form-control"
                                            value="{{ $item->perpustakaan }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kantor Pengajar</td>
                                    <td class="text-center">
                                        <input type="number" name="kantor_pengajar" class="form-control"
                                            value="{{ $item->kantor_pengajar }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dapur</td>
                                    <td class="text-center">
                                        <input type="number" name="dapur" class="form-control"
                                            value="{{ $item->dapur }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kantin</td>
                                    <td class="text-center">
                                        <input type="number" name="kantin" class="form-control"
                                            value="{{ $item->kantin }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tempat Olahraga</td>
                                    <td class="text-center">
                                        <input type="number" name="tempat_olahraga" class="form-control"
                                            value="{{ $item->tempat_olahraga }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kamar Mandi</td>
                                    <td class="text-center">
                                        <input type="number" name="kamar_mandi" class="form-control"
                                            value="{{ $item->kamar_mandi }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ruang Kesehatan</td>
                                    <td class="text-center">
                                        <input type="number" name="ruang_kesehatan" class="form-control"
                                            value="{{ $item->ruang_kesehatan }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kamar Pengajar</td>
                                    <td class="text-center">
                                        <input type="number" name="kamar_pengajar" class="form-control"
                                            value="{{ $item->kamar_pengajar }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lab Komputer</td>
                                    <td class="text-center">
                                        <input type="number" name="lab_komputer" class="form-control"
                                            value="{{ $item->lab_komputer }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lapangan Pertanian</td>
                                    <td class="text-center">
                                        <input type="number" name="lapangan_pertanian" class="form-control"
                                            value="{{ $item->lapangan_pertanian }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lapangan Pertenakan</td>
                                    <td class="text-center">
                                        <input type="number" name="lapangan_pertenakan" class="form-control"
                                            value="{{ $item->lapangan_pertenakan }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Laundry</td>
                                    <td class="text-center">
                                        <input type="number" name="laundry" class="form-control"
                                            value="{{ $item->laundry }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-success float-end">Perbaharui</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
        @endforeach
        
        {{-- end  modal facility --}}
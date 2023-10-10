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
                            <form action="{{ route('admin_madin.facility_update', ['id' => $item->id]) }}"
                                method="post" class="w-100">
                                @csrf
                                @method('PUT')
                                <input type="text" name="madin_id" value="{{ $item->madin_id }}" hidden>
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">{{ 'Fasilitas' }}</th>
                                            <th scope="col" class="w-25">{{ 'Jumlah' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Mushola/Tempat Ibadah</td>
                                            <td class="text-center">
                                                <input type="number" name="mushola" class="form-control"
                                                    value="{{ $item->mushola }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ruang Kelas</td>
                                            <td class="text-center">
                                                <input type="number" name="kelas_pengajaran" class="form-control"
                                                    value="{{ $item->kelas_pengajaran }}">
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
                                            <td>Ruang Guru</td>
                                            <td class="text-center">
                                                <input type="number" name="ruang_guru" class="form-control"
                                                    value="{{ $item->ruang_guru }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fasilitas Audio Visual</td>
                                            <td class="text-center">
                                                <input type="number" name="fasilitas_audio_visual" class="form-control"
                                                    value="{{ $item->fasilitas_audio_visual }}">
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
                                            <td>Ruangan Administrasi</td>
                                            <td class="text-center">
                                                <input type="number" name="ruangan_administrasi" class="form-control"
                                                    value="{{ $item->ruangan_administrasi }}">
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

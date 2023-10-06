
<div class="col-12 mb-3">
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
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($instructors as $item)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->expertise }}</td>
                                        <td>{{ $item->gender }}</td>
                                        @if ($item->status === 'active')
                                            <td><span class=" btn btn-success w-100">Aktif</span></td>
                                        @else
                                            <td><span class="btn btn-danger w-100">Tidak Aktif</span>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center bg-secondary text-white">
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
                                @php
                                $fasilitas = [
                                    'mushola' => 'Mushola/Tempat Ibadah',
                                    'kelas_pengajaran' => 'Ruang Kelas',
                                    'perpustakaan' => 'Perpustakaan',
                                    'ruang_guru' => 'Ruang Guru',
                                    'fasilitas_audio_visual' => 'Fasilitas Audio Visual',
                                    'kamar_mandi' => 'Kamar Mandi',
                                    'ruangan_administrasi' => 'Ruangan Administrasi',
                                ];
                                @endphp
                            
                                @foreach ($fasilitas as $key => $label)
                                <tr>
                                    <td>{{ $label }}</td>
                                    <td class="text-center">{{ $item->$key }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-12 mb-3 ">
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header " id="panelsStayOpen-headingTwo">
                <button class="accordion-button fw-bold bg-light" type="button"
                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                    aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                    {{ 'Aktivitas' }}
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body pt-3 px-1 pb-1">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">{{ 'No' }}</th>
                                    <th scope="col">{{ 'Aktivitas' }}</th>
                                    <th scope="col">{{ 'Deskripsi' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($activities as $item)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $no++ }}
                                        </th>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-break">{{ $item->description }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center bg-secondary text-white">
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


<div class="col-12 mb-3 ">
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header " id="panelsStayOpen-headingFour">
                <button class="accordion-button fw-bold bg-light" type="button"
                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                    aria-expanded="true" aria-controls="panelsStayOpen-collapseFour">
                    {{ 'Pembelajaran' }}
                </button>
            </h2>
            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingFour">
                <div class="accordion-body pt-3 px-1 pb-1">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">{{ 'No' }}</th>
                                    <th scope="col">{{ 'Pembelajaran' }}</th>
                                    <th scope="col">{{ 'Deskripsi' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($activities as $item)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $no++ }}
                                        </th>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-break">{{ $item->description }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center bg-secondary text-white">
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


<div class="col-12 mb-3">
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header " id="panelsStayOpen-headingFive">
                <button class="accordion-button fw-bold bg-light" type="button"
                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive"
                    aria-expanded="true" aria-controls="panelsStayOpen-collapseFive">
                    {{ 'Jumlah Siswa' }}
                </button>
            </h2>
            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingFive">
                <div class="accordion-body pt-3 px-1 pb-1">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark">
                            <thead>
                                <tr class="text-center">
                                    <th  scope="col" class="align-middle">
                                        {{ 'No' }}</th>
                                    <th  scope="col" class="align-middle">
                                        {{ 'Tahun' }}</th>
                                        <th  scope="col" class="align-middle">
                                            {{ 'Laki-Laki' }}</th>
                                        <th  scope="col" class="align-middle">
                                            {{ 'Perempuan' }}</th>
                                             <th  scope="col" class="align-middle">
                                            {{ 'Total' }}</th>
                                    

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
                                            {{ $item->male }}</td>
                                        <td class="text-center" class="align-middle">
                                            {{ $item->female }}</td>
                                            <td class="text-center" class="align-middle">
                                                {{ $item->male + $item->female }}</td>
                    
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center bg-secondary text-white">
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


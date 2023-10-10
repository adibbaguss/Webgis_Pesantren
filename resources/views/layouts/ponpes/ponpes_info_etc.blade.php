
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
                                @forelse ($learning as $item)
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
                    {{ 'Jumlah Santri' }}
                </button>
            </h2>
            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingFive">
                <div class="accordion-body pt-3 px-1 pb-1">
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
            <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingSix">
                <div class="accordion-body pt-3 px-1 pb-1">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" colspan="2" class="align-middle text-center">
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
                <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingSeven">
                    <div class="accordion-body pt-3 px-1 pb-1">
                        <div class="table-responsive">
                            <table class="table table-bordered border-dark">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="align-middle text-center">
                                            {{ 'No' }}
                                        </th>
                                        <th scope="col" class="align-middle text-center">
                                            {{ 'Nama Program' }}
                                        </th>
                                        <th scope="col" class="align-middle text-center">
                                            {{ 'Deskripsi' }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($takhasus as $item)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $index + 1 }}
                                            </th>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-break">{{ $item->description }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3"
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

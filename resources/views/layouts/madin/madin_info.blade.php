<div class="col-md-5">
    <div class="row ">

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Nomor Statistik Diniyah Takmiliyah' }}</label>
            <span>{{ $madin->nsdt }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Pengasuh / Pemimpin' }}</label>
            <span>{{ $madin->pimpinan }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Nomor Telepon' }}</label>
            <span>{{ $madin->phone_number }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Alamat' }}</label>
            <span>{{ $madin->address . ', ' . $madin->subdistrict . ', ' . $madin->city . ', ' . $madin->postal_code }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Alamat Email' }}</label>
            <span>{{ $madin->email }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Website' }}</label>
            <a href="{{ 'https://' . $madin->website }}">{{ $madin->website }}</a>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Tanggal Berdiri' }}</label>
            <span>{{ \Carbon\Carbon::parse($madin->standing_date)->format('d F Y') }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Luas Tanah' }}</label>
            <span>{{ $madin->surface_area }} M<sup>2</sup></span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Luas Bangunan' }}</label>
            <span>{{ $madin->building_area }} M<sup>2</sup></span>
        </div>

        @if (!Auth::User())
        @elseif (Auth::User()->user_role == 'admin kemenag')
            <div class="col-12 mb-4 d-grid">
                <label class="fs-6 fw-bold text-secondary">{{ 'Akun Admin Madin/TPQ' }}</label>
                @if ($madin->user_id)
                    <table class="w-50">
                        <tr>
                            <td>ID</td>
                            <td>:</td>
                            <td>{{ $madin->user->id }}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td>{{ $madin->user->username }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $madin->user->name }}</td>
                        </tr>
                    </table>
                @else
                    <span class="text-danger">Belum Dibuat</span>
                @endif
            </div>

        @endif



        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Status' }}</label>
            @if ($madin->status == 'active')
                <span class="btn btn-success" style="width:fit-content">{{ 'Aktif' }}</span>
            @else
                <span class="btn btn-danger" style="width:fit-content">{{ 'Tidak Aktif' }}</span>
            @endif
        </div>



    </div>
</div>

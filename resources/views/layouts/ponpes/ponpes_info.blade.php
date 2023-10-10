<div class="col-md-5">
    <div class="row ">

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Nomor Statistik Pondok Pesantren' }}</label>
            <span>{{ $ponpes->nspp }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Pengasuh / Pimpinan' }}</label>
            <span>{{ $ponpes->pimpinan }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Kategori' }}</label>
            <span>{{ $ponpes->category }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Nomor Telepon' }}</label>
            <span>{{ $ponpes->phone_number }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Alamat' }}</label>
            <span>{{ $ponpes->address . ', ' . $ponpes->subdistrict . ', ' . $ponpes->city . ', ' . $ponpes->postal_code }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Alamat Email' }}</label>
            <span>{{ $ponpes->email }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Website' }}</label>
            <a href="{{ 'https://' . $ponpes->website }}">{{ $ponpes->website }}</a>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Tanggal Berdiri' }}</label>
            <span>{{ \Carbon\Carbon::parse($ponpes->standing_date)->format('d F Y') }}</span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Luas Tanah' }}</label>
            <span>{{ $ponpes->surface_area }} M<sup>2</sup></span>
        </div>

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Luas Bangunan' }}</label>
            <span>{{ $ponpes->building_area }} M<sup>2</sup></span>
        </div>

        @if (!Auth::User())
        @elseif (Auth::User()->user_role == "admin kemenag")
        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Akun Admin Pesantren' }}</label>
            @if ($ponpes->user_id)
                <table class="w-50">
                    <tr>
                        <td>ID</td>
                        <td>:</td>
                        <td>{{ $ponpes->user->id }}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td>{{ $ponpes->user->username }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $ponpes->user->name }}</td>
                    </tr>
                </table>
            @else
                <span class="text-danger">Belum Dibuat</span>
            @endif
        </div>
        @endif

        <div class="col-12 mb-4 d-grid">
            <label class="fs-6 fw-bold text-secondary">{{ 'Status' }}</label>
            @if ($ponpes->status == 'active')
                <span class="btn btn-success" style="width:fit-content">{{ 'Aktif' }}</span>
            @else
                <span class="btn btn-danger" style="width:fit-content">{{ 'Tidak Aktif' }}</span>
            @endif
        </div>



    </div>
</div>

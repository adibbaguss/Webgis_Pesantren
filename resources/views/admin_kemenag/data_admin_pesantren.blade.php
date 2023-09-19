@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-5 pt-5">

        {{-- notif delete --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="d-flex mb-3">
            <h2 class="mb-0 text-secondary ">{{ 'Daftar Akun Admin Pesantren' }}</h2>
            <div class="dropdown me-0 ms-auto">
                <button class="btn btn-outline-secondary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-sliders-h"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-user-plus"></i>
                            {{ 'Tambah Akun' }}
                        </a>
                    </li>
                    <li>
                        <a href="/admin kemenag/account_admin_pesantren_export" class="dropdown-item">
                            <i class="fas fa-print"></i>
                            {{ 'Cetak' }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <table class="table table-bordered table-hover text-center" id="example" class="display" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">FOTO</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">USERNAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">NO TELPON</th>
                    <th scope="col">PESANTREN</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">DIBUAT</th>
                    <th scope="col">OPSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($account as $item)
                    <tr class="align-middle">
                        <th scope="row">{{ $loop->iteration }}</th>
                        @if (empty($item->photo_profil))
                            <td>
                                <img class="rounded-circle mx-auto opacity-" style="max-width: 30px"
                                    src="{{ asset('images/profile_photos/default.jpg') }}" alt="">
                            </td>
                        @else
                            <td>
                                <img class="rounded-circle mx-auto " style="max-width: 30px"
                                    src="{{ asset('images/profile_photos/' . $item->photo_profil) }}" alt="">
                            </td>
                        @endif


                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone_number }}</td>
                        <td>
                            @if ($item->ponpes)
                                <span>{{ $item->ponpes->name }}</span>
                            @else
                                <span class="text-danger fw-bold">NULL</span>
                            @endif
                        </td>

                        <td>
                            @if ($item->status === 'not confirmed')
                                <span class="btn btn-secondary">Belum dikonfirmasi</span>
                            @elseif($item->status === 'active')
                                <span class="btn btn-success">Aktif</span>
                            @else
                                <span class="btn btn-danger">Diblokir</span>
                            @endif
                        </td>
                        </td>

                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>

                            <div class="d-flex justify-content-between">
                                <a class="dropdown-item text-secondary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#updateModal{{ $item->id }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>

                                <a class="dropdown-item text-danger" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    {{-- modal delete --}}
    @foreach ($account as $item)
        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ 'Hapus Account' }}</h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">{{ 'Anda Yakin Menghapus Data ' . $item->name . ' ?' }}</div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">Batal</button>

                        <form id="delete-form" action="{{ route('admin_kemenag.account_admin_pesantren_delete', ['id' => $item->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @foreach ($account as $item)
        <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ 'Perbaharui Akun (' . $item->user_role . ')' }}
                        </h5>
                        <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin_kemenag.account_admin_pesantren_update', $item->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label small">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $item->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label small">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $item->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label small">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username', $item->username) }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label small">No Telepon</label>
                                <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number"
                                    value="{{ old('phone_number', $item->phone_number) }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="status" class="form-label small">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="not confirmed"
                                        {{ old('status', $item->status) === 'not confirmed' ? 'selected' : '' }}>Belum
                                        dikonfirmasi</option>
                                    <option value="active"
                                        {{ old('status', $item->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="blocked"
                                        {{ old('status', $item->status) === 'blocked' ? 'selected' : '' }}>Blokir</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex">
                                <div class="me-0 ms-auto">
                                    <button class="btn btn-outline-secondary" type="button"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Perbaharui</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- create --}}
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ 'Tambah Akun Admin Pesantren' }}</h5>
                    <button class="btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin_kemenag.account_admin_pesantren_create') }}">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="name" class="form-label small">Nama</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label small">Alamat Email</label>
                            <input id="email" type="text"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label small">Username</label>
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username') }}" required autocomplete="username">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label small">Password</label>
                            <div class="d-flex">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                <span class="input-group-text" onclick="new_password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye_1"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye_1"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label small">No Telepon</label>
                            <input id="phone_number" type="number"
                                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                value="{{ old('phone_number') }}" autocomplete="phone_number">
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <input type="text" name="user_role" id="user_role" value="admin pesantren" hidden>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label small">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="not confirmed">Belum dikonfirmasi</option>
                                <option value="active">Aktif</option>
                                <option value="blocked">Blokir</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-flex">
                            <div class="me-0 ms-auto">
                                <button class="btn btn-outline-secondary" type="button"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <!-- Script DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Inisialisasi DataTables
        $(document).ready(function() {
            new DataTable('#example', {
                scrollCollapse: true,
                scrollX: true

            });

        });
    </script>

    <script>
        function new_password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye_1");
            var hide_eye = document.getElementById("hide_eye_1");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
@endpush

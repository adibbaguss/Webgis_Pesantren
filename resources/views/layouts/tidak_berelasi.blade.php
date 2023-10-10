<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid text-center pt-5">
        <div class="align-middle">
            <h1>404 - Page Not Found</h1>
            @if (Auth::user()->user_role == 'admin pesantren')
                <h5>Akun belum direlasikan dengan data Pondok Pesantren</h5>
            @elseif(Auth::user()->user_role == 'admin madin')
                <h5>Akun belum direlasikan dengan data Madrasah Diniyah / TPQ</h5>
            @endif
            <p>Silahkan hubungi kembali Admin Sistem untuk merelasikan</p>
            <a class="btn btn-dark" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Keluar') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>

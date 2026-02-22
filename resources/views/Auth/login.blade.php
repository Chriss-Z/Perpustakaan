<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card border-0 shadow"
        style="width:100%; max-width:420px; min-height:500px; border-radius:20px;">

        <div class="card-body d-flex flex-column justify-content-center p-5">

            <h3 class="text-center mb-4 fw-light">Login</h3>

            @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <div class="mb-4">
                    <input type="text"
                        name="username"
                        class="form-control border-0 border-bottom rounded-0 shadow-none"
                        placeholder="Username"
                        required>
                </div>

                <div class="mb-5">
                    <input type="password"
                        name="password"
                        class="form-control border-0 border-bottom rounded-0 shadow-none"
                        placeholder="Password"
                        required>
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-pill">
                    Login
                </button>
            </form>

            <p class="text-center mt-4 mb-0 small text-muted">
                Belum punya akun? <a href="/register" class="text-dark text-decoration-none">Daftar</a>
            </p>

        </div>
    </div>

</body>

</html>
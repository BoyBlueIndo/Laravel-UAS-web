<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Laravel</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>
<body>

    <div class="text-center mt-5">
        <h2>Login Aplikasi</h2>
        <p>Silahkan masuk dengan menggunakan akun Anda!</p>

        <div class="row justify-content-center">
            <dov class="col-md-4">
                <div class="card">
                    <div class="card-body text-start">
                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <label>Email</label>
                            <input type="email" name="email" class="form-control mb-2">

                            <label>Password</label>
                            <input type="password" name="password" class="form-control mb-2">

                            <button class="btn btn-primary">Submit Login</button>
                        </form>

                        @if (session('Gagal'))
                            <p class="btn-danger">{{ session('Gagal') }}</p>
                        @endif
                    </div>
                </div>
            </dov>
        </div>
    </div>
    
</body>
</html>
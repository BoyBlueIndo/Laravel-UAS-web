<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi Laravel</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>
<body>

    <div class="text-center mt-5">
        <h2>Registrasi Aplikasi</h2>
        <p>Silahkan isi formulir berikut untuk registrasi aplikasi</p>

        <div class="row justify-content-center">
            <dov class="col-md-4">
                <div class="card">
                    <div class="card-body text-start">
                        <form action="{{ route('registrasi.submit') }}" method="POST">
                            @csrf
                            <label>Username</label>
                            <input type="text" name="name" class="form-control mb-2">

                            <label>Email</label>
                            <input type="email" name="email" class="form-control mb-2">

                            <label>Password</label>
                            <input type="password" name="password" class="form-control mb-2">

                            <button class="btn btn-primary">Submit Registrasi</button>
                        </form>
                    </div>
                </div>
            </dov>
        </div>
    </div>
    
</body>
</html>
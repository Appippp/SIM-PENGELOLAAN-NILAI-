<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Line Icons CSS -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-image: linear-gradient(to top, #7028e4 0%, #e5b2ca 100%);
        }

        .demo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Full viewport height */
        }

        .login-card {
            max-width: 400px;
            width: 100%;
        }

        .btn-lg {
            padding: 12px 26px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        ::placeholder {
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .form-control-lg {
            font-size: 16px;
            padding: 25px 20px;
        }

        .font-500 {
            font-weight: 500;
        }

        .image-size-small {
            width: 140px;
            margin: 0 auto;
        }

        .image-size-small img {
            width: 140px;
        }

        .icon-camera {
            position: absolute;
            right: -1px;
            top: 75px;
            width: 30px;
            height: 30px;
            background-color: #FFF;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-camera a {
            color: #7028e4;
        }
    </style>
</head>

<body>
    <div class="demo-container">
        <div class="login-card p-4 bg-white rounded shadow-lg">
            <div class="text-center image-size-small position-relative">
                <img src="{{ asset('image/1.jpg') }}" class="rounded-circle p-1 bg-white">
            </div>
            <p class="text-center lead font-500">SMP PGRI KAB PELALAWAN</p>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="font-500">Username</label>
                    <input type="text" name="username"
                        class="form-control form-control-lg mb-3 @error('username') is-invalid @enderror"
                        placeholder="Enter your username">
                    @error('username')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-500">Password</label>
                    <input type="password" name="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="Enter your password">
                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100 shadow-lg">LOGIN</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

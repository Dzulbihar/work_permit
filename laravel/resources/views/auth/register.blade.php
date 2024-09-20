<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Work Permit</title>
    <link rel="shortcut icon" href="{{asset('logo/tpks1.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
    <style type="text/css">
        body {
            padding: 0;
            margin: 0;
            background-image: url("{{asset('logo/putih.jpg')}}");
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1; /* Di bawah konten */
        }

        .container {
            display: flex;
            align-items: stretch; /* Untuk memastikan kedua kolom memiliki tinggi yang sama */
            z-index: 2; /* Di atas overlay */
            position: relative;
            width: 90%;
            max-width: 1200px;
            height: 80%;
        }

        .info-form-wrapper {
            display: flex;
            flex: 1;
            overflow: hidden;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 10px 10px rgb(0, 0, 0, .2);
        }

        .info-box {
            width: 300px;
            padding: 20px;
            background-color: #f9f9f9;
            border-right: 1px solid #ddd;
            overflow-y: auto; /* Menambahkan scroll jika konten melebihi tinggi */
        }

        .form-container {
            flex: 1;
            padding: 20px;
            overflow-y: auto; /* Menambahkan scroll jika konten melebihi tinggi */
        }

        .form-box {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 10px 10px rgb(0, 0, 0, .2);
            padding: 20px;
        }

        .header p {
            font-size: x-small;
        }

        .login-area {
            text-align: center;
            padding: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            width: 100%;
        }

        .form-group label {
            flex: 1;
            margin-bottom: 0;
            font-weight: bold;
            text-align: left; /* Label berada di sebelah kiri */
            padding-right: 10px; /* Jarak antara label dan input */
        }

        .form-group input {
            flex: 2;
            text-align: center; /* Agar teks dalam input rata tengah */
        }

        .username,
        .password {
            text-align: center;
            padding: 13px 0;
            border-radius: 20px;
            outline: none;
            border: none;
            color: white;
            background-color: rgba(169, 169, 169, 1.0); /* Warna abu-abu */
            margin-bottom: 10px;
            transition: 0.5s;
        }

        .username::placeholder,
        .password::placeholder {
            color: rgba(255, 255, 255, .7);
        }

        .username:focus,
        .password:focus {
            background-color: rgba(128, 128, 128, 1.0); /* Warna abu-abu lebih gelap */
        }

        .submit {
            width: 150px;
            padding: 10px;
            background-color: rgba(169, 169, 169, 1.0); /* Warna abu-abu */
            border-radius: 10px;
            font-weight: bold;
            color: white;
            border: none;
            outline: none;
            margin: 10px;
            transition: .2s;
            cursor: pointer;
        }

        .submit:hover {
            background-color: #696969; /* Warna abu-abu lebih gelap */
        }

        a {
            display: block;
            font-size: x-small;
            text-decoration: none;
            color: rgba(128, 128, 128, 1.0); /* Warna abu-abu */
            margin-top: 10px;
        }

        .form-checkbox {
            margin: 10px 0;
        }

        a {
            display: block;
            font-size: x-small;
            text-decoration: none;
            color: #007bff; /* Warna biru untuk menandakan link */
            margin-top: 10px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3; /* Warna biru lebih gelap saat hover */
        }        
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container">
        <div class="info-form-wrapper">
            <div class="info-box">
                <h3>Informasi Register</h3>
                <p>Untuk mendaftar, silakan isi formulir di sebelah kanan dengan informasi yang benar dan lengkap.</p>
                <ul>
                    <li>Nama Perusahaan</li>
                    <li>Nama Pemilik</li>
                    <li>NPWP</li>
                    <li>NO Handphone</li>
                    <li>Email</li>
                    <li>Password</li>
                    <li>Ulangi Password</li>
                </ul>
                <p>Jika sudah memiliki akun, silakan klik link di bawah ini untuk login.</p>
                <a href="{{url('/login')}}">Sudah punya akun</a>
            </div>
            <div class="form-container">
                <div class="form-box">
                    <form action="{{route('simpandaftar')}}" method="post">
                        @csrf
                       <h5 align="center"> 
                          <!-- Notifikasi ----------------------- -->
                          @if(session('sukses'))
                          <div class="alert alert-success" role="alert">
                            {{session('sukses')}}
                          </div>
                          @endif
                        </h5>
                        <div class="login-area">
                            <div class="form-group">
                                <label for="company">Nama Perusahaan</label>
                                <input id="company" name="company" type="text" class="username" placeholder="Nama Perusahaan" value="{{ old('company') }}" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="name">Nama Pemilik</label>
                                <input id="name" name="name" type="text" class="username" placeholder="Nama Pemilik" value="{{ old('name') }}" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="npwp">NPWP</label>
                                <input id="npwp" name="npwp" type="text" class="username" placeholder="NPWP" value="{{ old('npwp') }}" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="nohp">NO Handphone</label>
                                <input id="nohp" name="nohp" type="text" class="username" placeholder="NO Handphone" value="{{ old('nohp') }}" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="username @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="off">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="username kata_sandi @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" required autocomplete="off">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password2">Ulangi Password</label>
                                <input id="password2" name="password2" type="password" class="username kata_sandi @error('password2') is-invalid @enderror" placeholder="Ulangi Password" value="{{ old('password2') }}" required autocomplete="off">
                                @error('password2')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="checkbox" class="form-checkbox"> Show password
                            </div>

                            @if(session('sukses'))
                            <div class="alert alert-danger" role="alert">
                                {{session('sukses')}}
                            </div>
                            @endif

                            <input type="submit" value="Register" class="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".form-checkbox").on('change', function () {
                if ($(this).is(':checked')) {
                    $(".kata_sandi").attr("type", "text");
                } else {
                    $(".kata_sandi").attr("type", "password");
                }
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Work Permit</title>
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
            width: 80%;
            max-width: 1200px;
            height: 80%;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 10px 10px rgb(0, 0, 0, .2);
            z-index: 2; /* Di atas overlay */
            position: relative;
        }

        .info {
            flex: 1;
            background-color: #f7f7f7;
            border-radius: 15px 0 0 15px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .info h1 {
            margin: 0;
            font-size: 2em;
            color: #333;
        }

        .info p {
            margin-top: 10px;
            color: #666;
            text-align: center;
        }

        .form-container {
            flex: 1;
            padding: 30px;
        }

        .header {
            text-align: center; /* Rata tengah teks di dalam .header */
            margin: 0; /* Hapus margin default jika ada */
            padding: 20px; /* Sesuaikan padding sesuai kebutuhan */
            background-color: #f8f9fa; /* Warna latar belakang untuk header (optional) */
            border-radius: 10px; /* Membuat sudut header membulat (optional) */
        }

        .login-area {
            text-align: center;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-group label {
            display: block;
            width: 40%;
            text-align: left;
            font-weight: bold;
        }

        .form-group input {
            width: 55%;
            text-align: center;
            padding: 13px 0;
            border-radius: 20px;
            outline: none;
            border: none;
            color: white;
            background-color: rgba(169, 169, 169, 1.0); /* Warna abu-abu */
            transition: 0.5s;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, .7);
        }

        .form-group input:focus {
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
            color: #007bff; /* Warna biru untuk menandakan link */
            margin-top: 10px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3; /* Warna biru lebih gelap saat hover */
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
   <div class="overlay"></div>
   <div class="container">
       <div class="info">
           <h1>Selamat Datang!</h1>
           <p>Masuk untuk mengakses Dasbor Izin Kerja dan mengelola tugas Anda.</p>
       </div>
       <div class="form-container">
           <form action="{{route('login')}}" method="post">
               @csrf
               <div class="header">
                   <h3>Login ... </h3>
               </div>
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
                       <label for="email">Username</label>
                       <input type="email" class="username @error('email') is-invalid @enderror" name="email" id="email" placeholder="Username" value="{{ old('email') }}" required autocomplete="off">
                       @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                   </div>

                   <div class="form-group">
                       <label for="password">Password</label>
                       <input type="password" class="password @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password" placeholder="Password">
                       @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                   </div>

                   <div class="form-group">
                       <input type="checkbox" class="form-checkbox"> Show password
                   </div>

                   <input type="submit" value="Login" class="submit">
                   <a href="{{url('/register')}}">Buat akun baru</a>
               </div>
           </form>
       </div>
   </div>
</body>

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){       
        $('.form-checkbox').click(function(){
            if($(this).is(':checked')){
                $('.password').attr('type','text');
            }else{
                $('.password').attr('type','password');
            }
        });
    });
</script>

</html>

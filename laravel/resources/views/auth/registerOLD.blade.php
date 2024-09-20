<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Register - Work Permit </title>
    <link rel="shortcut icon" href="{{asset('logo/tpks1.png')}}">
    <style type="text/css">
        body {
            padding: 0;
            margin: 0;
            background-image: url("{{asset('logo/putih.jpg')}}");
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
        }

        .overlay {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .box {
            position: absolute;
            width: 400px;
            background-color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 15px;
            box-shadow: 0 10px 10px 10px rgb(0, 0, 0, .2);
        }

        .header {
            background-image: url("{{asset('logo/putih.jpg')}}");
            background-size: cover;
            padding: 90px 30px;
            color: aqua;
            border-radius: 15px 15px 0 0;
        }

        .header p {
            font-size: x-small;
        }

        .login-area {
            text-align: center;
            padding: 50px 50px 30px 50px;
        }

        .username,
        .password {
            width: 100%;
            text-align: center;
            padding: 13px 0;
            border-radius: 20px;
            outline: none;
            border: none;
            color: white;
            background-color: rgba(169, 169, 169, 1.0); /* Warna abu-abu */
            margin-bottom: 15px;
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
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="overlay"></div>
    <form action="{{route('simpandaftar')}}" method="post" class="box">
        @csrf
        <div class="header">
        </div>
        <h5 align="center"> 
            <!-- Notifikasi ----------------------- -->
            @if(session('sukses'))
            <div class="alert alert-success" role="alert">
            {{session('sukses')}}
            </div>
            @endif
        </h5>
        <h3 align="center">
            <hr>
            Register 
            <hr>
        </h3>

       <div class="login-area">

        <!-- company --> 
            <input name="company" type="text" class="username" placeholder="Nama Perusahaan" value="{{ old('company') }}" required autocomplete="off">
        <!-- name --> 
            <input name="name" type="text" class="username" placeholder="Nama Pemilik" value="{{ old('name') }}" required autocomplete="off">
        <!-- npwp --> 
            <input name="npwp" type="text" class="username" placeholder="NPWP" value="{{ old('npwp') }}" required autocomplete="off">
        <!-- nohp --> 
            <input name="nohp" type="text" class="username" placeholder="NO Handphone" value="{{ old('nohp') }}" required autocomplete="off">

        <!-- email --> 
            <input name="email" type="email" class="username  @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="off">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        <!-- password --> 
            <input name="password" type="password" class="username kata_sandi @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" required autocomplete="off">
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        <!-- password2 --> 
            <input name="password2" type="password" class="username kata_sandi  @error('password2') is-invalid @enderror" placeholder="Ulangi Password" value="{{ old('password2') }}" required autocomplete="off">
            @error('password2')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="checkbox" class="form-checkbox"> Show password
            @if(session('sukses'))
            <div class="alert alert-danger" role="alert">
                {{session('sukses')}}
            </div>
            @endif
        <input type="submit" value="Register" class="submit">
        <a href="{{url('/login')}}"> Sudah punya akun </a>
       </div>
   </form> 

</body>

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){       
        $('.form-checkbox').click(function(){
            if($(this).is(':checked')){
                $('.kata_sandi').attr('type','text');
            }else{
                $('.kata_sandi').attr('type','password');
            }
        });
    });
</script>

</html>

@extends('layouts.app')

@section('heading', 'Profile')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Profile Card -->
            <div class="card shadow-lg border-0 rounded-lg mt-0">
                <div class="card-body">
                    <!-- Profil Pengguna dengan Gambar Background -->
                    <div class="profile-header text-center" style="height: 150px; background: url('{{ asset('logo/profile-bg.jpg') }}') no-repeat center center; background-size: cover;">
                        <!-- Foto Profil dan Nama Pengguna -->

                        <h3 class="mt-2 font-weight-bold">{{ $user->company }}</h3>
                        <p class="text-muted">{{ $user->name }}</p>
                    </div>

                    <!-- Detail Profil Perusahaan -->
                    <div class="mt-4">
                        <h5 class="font-weight-bold text-primary text-center">Informasi Perusahaan</h5>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h5 class="font-weight-bold"><i class="fas fa-building"></i> Nama Perusahaan</h5>
                                
                                    <p class="text-muted">{{ auth()->user()->company }}</p>

                                    <h5 class="font-weight-bold"><i class="fas fa-user-tie"></i> Nama Pemilik</h5>
                                    <p class="text-muted">{{ auth()->user()->name }}</p>

                                    <h5 class="font-weight-bold"><i class="fas fa-id-card"></i> NPWP</h5>
                                    <p class="text-muted">{{ auth()->user()->npwp }}</p>

                                    <h5 class="font-weight-bold"><i class="fas fa-phone"></i> No. Handphone</h5>
                                    <p class="text-muted">{{ auth()->user()->nohp }}</p>

                                    <h5 class="font-weight-bold"><i class="fas fa-envelope"></i> Email</h5>
                                    <p class="text-muted">{{ auth()->user()->email }}</p>

                            </div>
                        </div>
                    </div>

                    <!-- Tombol Edit Profil -->
                    <div class="text-center mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for Social Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .profile-header {
        position: relative;
        padding-top: 75px; /* Ensure the content is pushed down */
    }
    .btn-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 18px;
    }
</style>

@endsection

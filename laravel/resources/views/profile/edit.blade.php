@extends('layouts.app')

@section('heading', 'Edit Profile')

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
            <div class="card">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Input for changing profile picture -->
                        

                        <div class="form-group">
                            <label for="company">Nama Perusahaan</label>
                            <input type="text" name="company" class="form-control" value="{{ old('company', auth()->user()->company) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Pemilik</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="npwp">NPWP</label>
                            <input type="text" name="npwp" class="form-control" value="{{ old('npwp', auth()->user()->npwp) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nohp">No. Handphone</label>
                            <input type="text" name="nohp" class="form-control" value="{{ old('nohp', auth()->user()->nohp) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

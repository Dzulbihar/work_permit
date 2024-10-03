@extends('layouts.app')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Klasifikasi Kerja</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Klasifikasi Kerja</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Tambah Klasifikasi Kerja</b></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('klasifikasi_kerja.store') }}" method="POST">
                            @csrf

                            <!-- Nama Klasifikasi -->
                            <div class="form-group">
                                <label for="nama">Nama Klasifikasi</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Klasifikasi" required>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('heading', 'Klasifikasi')

@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Master Klasifikasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Master Klasifikasi</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Klasifikasi</b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Tombol Tambah -->
                        <div class="row">
                            <div class="col-sm-12 text-right mb-3">
                                <a href="{{ route('klasifikasi.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah
                                </a>
                            </div>
                        </div>
						<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center;">No</th>
            <th style="width: 75%; text-align: center;">Nama Klasifikasi</th>
            <th style="width: 25%; text-align: center;">Action</th>                  
        </tr>
    </thead>
    <tbody>
        <?php $nomer = 1; ?>
        @foreach($klasifikasiKerja as $klasifikasi)
        <tr>
            <td style="text-align: center;">{{ $nomer++ }}</td>
            <td>{{ $klasifikasi->nama }}</td>
            <td style="text-align: center;">
                <!-- Tombol Edit -->
                <a href="{{ route('klasifikasi.edit', $klasifikasi->id) }}" class="btn btn-warning text-white btn-sm">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a>

                <!-- Tombol Hapus -->
                <form action="{{ route('klasifikasi.destroy', $klasifikasi->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

						
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

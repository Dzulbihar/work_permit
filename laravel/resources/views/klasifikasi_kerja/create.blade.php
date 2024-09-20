@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Klasifikasi Kerja</h1>
    
    <form action="{{ route('klasifikasi_kerja.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Klasifikasi</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Klasifikasi" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

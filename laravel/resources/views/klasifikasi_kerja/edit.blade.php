@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Edit Klasifikasi</h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('klasifikasi.update', $klasifikasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Klasifikasi</label>
                    <input type="text" name="nama" class="form-control" value="{{ $klasifikasi->nama }}" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" name="status" class="form-control" value="{{ $klasifikasi->status }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </section>
@endsection

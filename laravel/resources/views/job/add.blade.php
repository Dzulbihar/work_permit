@section('heading', 'Job')

@extends('layouts.app')

@section('content')


@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif



<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1> Tambah Pekerjaan </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{route('job')}}">Pekerjaan</a></li>
					<li class="breadcrumb-item active"> Tambah Pekerjaan </li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<form action="{{ route('job.save') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"> <b>Tambah Pekerjaan</b> </h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label> Nomor Pekerjaan </label>
							<input type="text" name="job_no" class="form-control" autocomplete="off" value="{{ old('job_no') }}" required>
						</div>

						<div class="form-group" id="workPermitForm">
							<label>Klasifikasi Pekerjaan</label><br>
							@foreach($klasifikasiKerja as $klasifikasi)
							<div class="form-check">
								<input type="checkbox" name="job_class[]" value="{{ $klasifikasi->nama }}" id="job_{{ $klasifikasi->id }}" class="form-check-input" {{ in_array($klasifikasi->nama, old('job_class', [])) ? 'checked' : '' }}>
								<label for="job_{{ $klasifikasi->id }}" class="form-check-label">{{ $klasifikasi->nama }}</label>
							</div>
							@endforeach
						</div>

						<div class="form-group">
							<label> Nama Pekerjaan </label>
							<input type="text" name="job_name" class="form-control" autocomplete="off" autofocus value="{{ old('job_name') }}" required>
						</div>

						<div class="form-group">
							<label>Lokasi</label>
							<textarea id="text" name="location" class="form-control" required>{{ old('location') }}</textarea>
						</div>

						<div class="form-group">
							<label>Area</label>
							<textarea id="text" name="area" class="form-control" required>{{ old('area') }}</textarea>
						</div>

						<div class="form-group">
							<label>Dokument Pendukung (*pdf) </label>
							<input type="file" class="form-control" name="document">
						</div>

						<div class="form-group">
							<label> Tanggal Mulai Kerja </label>
							<input type="date" name="start_work" class="form-control" autocomplete="off" value="{{ old('start_work') }}" required>
						</div>

						<div class="form-group">
							<label> Tanggal Akhir Kerja </label>
							<input type="date" name="end_work" class="form-control" autocomplete="off" value="{{ old('end_work') }}" required>
						</div>

						<button type="submit" class="btn btn-success btn-sm">
							<i class="fas fa-save"></i>
							Simpan
						</button>
						<a href="{{ route('job') }}" class="btn btn-secondary btn-sm float-right">
							<i class="fas fa-undo"></i>
							Kembali
						</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
<!-- /.content -->

<script>
	document.querySelector('form').addEventListener('submit', function(event) {
	    // Mendapatkan semua checkbox dengan nama 'job_class[]'
	    var checkboxes = document.querySelectorAll('input[name="job_class[]"]');
	    var checked = Array.from(checkboxes).some(checkbox => checkbox.checked);

	    // Jika tidak ada checkbox yang dipilih, tampilkan peringatan dan batalkan pengiriman form
	    if (!checked) {
	    	alert('Silakan pilih setidaknya satu klasifikasi pekerjaan.');
	        event.preventDefault(); // Mencegah form dikirim
	    }
	});
</script>


@endsection

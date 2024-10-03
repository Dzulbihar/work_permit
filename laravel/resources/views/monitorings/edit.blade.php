@extends('layouts.app') <!-- Sesuaikan dengan layout utama Anda -->

@section('content')

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Monitoring</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="{{route('home')}}">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="{{route('job_desc')}}">Pengajuan Izin Kerja</a>
					</li>
					<li class="breadcrumb-item active">Detail Edit Monitoring</li>
				</ol>
			</div>
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><b>Edit Monitoring</b></h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form action="{{ route('monitorings.update', $monitoring->id) }}" method="POST">
							@csrf
							@method('PUT')

							<input type="hidden" name="job_id" value="{{ $monitoring->job_id }}"> <!-- Hidden job_id -->

							<!-- Fields for editing monitoring -->
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" class="form-control" value="{{ $monitoring->nama }}" required>
							</div>

							<div class="form-group">
								<label>Lokasi</label>
								<input type="text" name="lokasi" class="form-control" value="{{ $monitoring->lokasi }}" required>
							</div>

							<div class="form-group">
								<label>Tanggal</label>
								<input type="date" name="tanggal" class="form-control" value="{{ $monitoring->tanggal }}" required>
							</div>

							<div class="form-group">
								<label>Status</label>
								<input type="text" name="status" class="form-control" value="{{ $monitoring->status }}" required>
							</div>

							<!-- Submit Button -->
							<div class="form-group text-right">
								<button type="submit" class="btn btn-primary">Update Data</button>
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

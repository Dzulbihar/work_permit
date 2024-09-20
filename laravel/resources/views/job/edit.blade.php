@section('heading', 'Job')

@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1> Edit Pekerjaan </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{route('job')}}">Pekerjaan</a></li>
					<li class="breadcrumb-item active"> Edit Pekerjaan </li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<form action="{{route('job.update',$job->id)}}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"> <b>Edit Pekerjaan</b> </h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label> Nomor Pekerjaan </label>
							<input type="text" name="job_no" value="{{ $job->job_no}}" class="form-control" autocomplete="off" autofocus>
						</div>
						<div class="form-group" id="workPermitForm">
							<label>Klasifikasi Pekerjaan</label><br>
							@foreach($klasifikasiKerja as $klasifikasi)
								<div class="form-check">
									<input type="checkbox" name="job_class[]" value="{{ $klasifikasi->nama }}" id="job_{{ $klasifikasi->id }}" class="form-check-input" {{ in_array($klasifikasi->nama, $selectedJobClass) ? 'checked' : '' }}>
									<label for="job_{{ $klasifikasi->id }}" class="form-check-label">{{ $klasifikasi->nama }}</label>
								</div>
							@endforeach
						</div>
						
						    <div class="form-check">
						        <input type="checkbox" name="job_class[]" value="Kerja_Listrik" id="Kerja_Listrik" class="form-check-input"
						            {{ in_array('Kerja_Listrik', explode(',', $job->job_class)) ? 'checked' : '' }}>
						        <label for="Kerja_Listrik" class="form-check-label">Kerja Listrik</label>
						    </div>
						    <div class="form-check">
						        <input type="checkbox" name="job_class[]" value="Ketinggian" id="Ketinggian" class="form-check-input"
						            {{ in_array('Ketinggian', explode(',', $job->job_class)) ? 'checked' : '' }}>
						        <label for="Ketinggian" class="form-check-label">Ketinggian</label>
						    </div>
						    <div class="form-check">
						        <input type="checkbox" name="job_class[]" value="Bawah_Laut" id="Bawah_Laut" class="form-check-input"
						            {{ in_array('Bawah_Laut', explode(',', $job->job_class)) ? 'checked' : '' }}>
						        <label for="Bawah_Laut" class="form-check-label">Bawah Laut</label>
						    </div>
						    <div class="form-check">
						        <input type="checkbox" name="job_class[]" value="Perpipaan" id="Perpipaan" class="form-check-input"
						            {{ in_array('Perpipaan', explode(',', $job->job_class)) ? 'checked' : '' }}>
						        <label for="Perpipaan" class="form-check-label">Perpipaan</label>
						    </div>
						    <div class="form-check">
						        <input type="checkbox" name="job_class[]" value="Ruang_Tertutup" id="Ruang_Tertutup" class="form-check-input"
						            {{ in_array('Ruang_Tertutup', explode(',', $job->job_class)) ? 'checked' : '' }}>
						        <label for="Ruang_Tertutup" class="form-check-label">Ruang Tertutup</label>
						    </div>
						    <div class="form-check">
						        <input type="checkbox" name="job_class[]" value="Zat_Berbahaya" id="Zat_Berbahaya" class="form-check-input"
						            {{ in_array('Zat_Berbahaya', explode(',', $job->job_class)) ? 'checked' : '' }}>
						        <label for="Zat_Berbahaya" class="form-check-label">Zat Berbahaya</label>
						    </div>
						    <div class="form-check">
						        <input type="checkbox" name="job_class[]" value="Galian" id="Galian" class="form-check-input"
						            {{ in_array('Galian', explode(',', $job->job_class)) ? 'checked' : '' }}>
						        <label for="Galian" class="form-check-label">Galian</label>
						    </div>
						</div>

						<div class="form-group">
							<label> Nama Pekerjaan </label>
							<input type="text" name="job_name" value="{{ $job->job_name}}" class="form-control" autocomplete="off" autofocus>
						</div>
						<div class="form-group">
							<label> Lokasi </label>
							<input type="text" name="location" value="{{ $job->location}}" class="form-control" autocomplete="off" autofocus>
						</div>
						<div class="form-group">
							<label> Area </label>
							<input type="text" name="area" value="{{ $job->area}}" class="form-control" autocomplete="off" autofocus>
						</div>

						<div class="form-group">
							<label> Tanggal Mulai Kerja </label>
							<input type="date" name="start_work" value="{{ $job->start_work}}" class="form-control" autocomplete="off">
						</div>
						<div class="form-group">
							<label> Tanggal Akhir Kerja </label>
							<input type="date" name="end_work" value="{{ $job->end_work}}" class="form-control" autocomplete="off">
						</div>

						<button type="submit" class="btn btn-success btn-sm">
							<i class="fas fa-save"></i>
							Perbarui
				        </button>
				        <a href="{{route('job')}}" class="btn btn-secondary btn-sm float-right">
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


@endsection

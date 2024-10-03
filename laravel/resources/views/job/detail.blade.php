@section('heading', 'Job')

@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1> Detail Pengajuan  </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="{{route('home')}}">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="{{route('job')}}">Pengajuan Izin Kerja</a>
					</li>
					<li class="breadcrumb-item active">Detail Pengajuan</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="card">
		<div class="card-header">
			<h3 class="card-title"> <b>Detail Pengajuan </b> </h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-md-12 col-lg-6 order-2 order-md-1">
					<div class="row">
						<div class="col-12 col-sm-6">
							<div class="info-box bg-light">
								<div class="info-box-content">
									<span class="info-box-text text-center text-muted"> Tanggal Mulai Kerja </span>
									<span class="info-box-number text-center text-muted mb-0">
										{{ \Carbon\Carbon::parse($job->start_work)->locale('id')->translatedFormat('l, d F Y') }}
									</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="info-box bg-light">
								<div class="info-box-content">
									<span class="info-box-text text-center text-muted">Tanggal Akhir Kerja</span>
									<span class="info-box-number text-center text-muted mb-0">
										{{ \Carbon\Carbon::parse($job->end_work)->locale('id')->translatedFormat('l, d F Y') }}
									</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="info-box bg-light">
								<div class="info-box-content">
									<span class="info-box-text text-center text-muted">Jangka Waktu</span>
									<span class="info-box-number text-center text-muted mb-0">
										@if($job->end_work && $job->start_work)
										@php
										$start = \Carbon\Carbon::parse($job->start_work);
										$end = \Carbon\Carbon::parse($job->end_work);
										$duration = $end->diffInDays($start); // Menghitung durasi dalam hari
										@endphp
										{{ $duration }} hari
										@endif
									</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="info-box bg-light">
								<div class="info-box-content">
									<span class="info-box-text text-center text-muted">Sisa Waktu</span>
									<span class="info-box-number text-center text-muted mb-0">
										@if($job->end_work && $job->start_work)
										@php
										$start = \Carbon\Carbon::parse($job->start_work);
										$end = \Carbon\Carbon::parse($job->end_work);

										// Menggunakan tanggal hari ini jika start_work lebih kecil dari hari ini
										$today = \Carbon\Carbon::today();

										if ($start > $today) {
											$duration = $end->diffInDays($start); // Menghitung durasi dalam hari
										} else {
											$duration = $end->diffInDays($today); // Menghitung durasi dari hari ini
										}
										@endphp
										{{ $duration }} hari
										@endif
									</span>
								</div>
							</div>
						</div>
					</div>

					<hr>
					<h3 class="text-primary"><i class="fas fa-paint-brush"></i> 
						{{ $job->job_name}} 
					</h3>
					<p class="text-muted">
						Lokasi : {{ $job->location}}
					</p>
					<p class="text-muted">
						Area : {{ $job->area}}
					</p>
					<p class="text-muted">
						Klasifikasi Pekerjaan : 
						@if($job->job_class)
						@php
						// Memisahkan job_class berdasarkan koma
						$job_classes = explode(',', $job->job_class);
						@endphp
						<ul>
							@foreach($job_classes as $class)
							<li>{{ str_replace('_', ' ', trim($class)) }}</li> <!-- Mengganti underscore dengan spasi -->
							@endforeach
						</ul>
						@else
						<span>-</span> <!-- Jika job_class kosong, tampilkan tanda strip atau pesan lainnya -->
						@endif
					</p>
					<hr>
				
					
					<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Monitoring</h1>
						</div>
						<div class="col-sm-6">
						
						</div>
					</div>
				</div>
			</section>
					
					<!-- Tabel Monitoring -->
					<div class="card">
								<div class="card-header">
									<h3 class="card-title"><b>Daftar Monitoring</b></h3>
								</div>
								<div class="card-body">
									<table id="monitoringTable" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Lokasi</th>
												<th>Tanggal</th>
												<th>Status</th>
												
											</tr>
										</thead>
										<tbody>
											<?php $nomer = 1; ?>
											@foreach($monitorings as $monitoring)
											<tr>
												<th>{{ $nomer++ }}</th>
												<td>{{ $monitoring->nama }}</td>
												<td>{{ $monitoring->lokasi }}</td>
												<td>{{ $monitoring->tanggal }}</td>
												<td>{{ $monitoring->status }}</td>
												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					
				

				<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
					<div class="row">
						<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
							<h5 class="mt-0 text-black"> Daftar Nama Anggota</h5>
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Aksi</th>                 
									</tr>
								</thead>
								<tbody>
									<?php $nomer = 1; ?>
									@foreach($persons as $person)
									<tr>
										<th>{{ $nomer++}}</th>
										<td> {{ $person->name}} </td>
										<td>
											<a href="#" class="btn btn-danger btn-sm delete_person" data-id="{{ $person->id}}" data-job_id="{{ $person->job_id}}" data-name="{{ $person->name}}">
												<i class="fas fa-trash"></i>
												Hapus
											</a>
										</td>
									</tr>
									@endforeach 
								</tbody>
							</table>
							<!-- Tombol Tambah yang akan membuka modal -->
							<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModalPerson">
								<i class="fas fa-plus-circle"></i>
								Tambah
							</a>
						</div>
						<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
							<h5 class="mt-0 text-black"> Daftar Peralatan Pekerjaan </h5>
							<table id="example3" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Aksi</th>                 
									</tr>
								</thead>
								<tbody>
									<?php $nomer = 1; ?>
									@foreach($tools as $tool)
									<tr>
										<th>{{ $nomer++}}</th>
										<td> {{ $tool->name}} </td>
										<td>
											<a href="#" class="btn btn-danger btn-sm delete_tool" data-id="{{ $tool->id}}" data-job_id="{{ $tool->job_id}}" data-name="{{ $tool->name}}">
												<i class="fas fa-trash"></i>
												Hapus
											</a>
										</td>
									</tr>
									@endforeach 
								</tbody>
							</table>
							<!-- Tombol Tambah yang akan membuka modal -->
							<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModalTool">
								<i class="fas fa-plus-circle"></i>
								Tambah
							</a>
						</div>
					</div>
					<hr>
					<br>

					<!-- Daftar Peralatan Keselamatan-->
					@if($tools2->isEmpty())
						<form id="createForm" action="{{ route('tool2.save', $job->id) }}" method="POST">
							@csrf
							<div class="row">
								<div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
									<div class="form-group" id="workPermitForm">
										<h5 class="mt-0 text-black">Daftar Peralatan Keselamatan</h5>
										<span class="mt-0 text-muted"> Alat Pelindung Diri </span>
										<div class="row">
											<div class="col-12 col-md-4 col-lg-4 order-1 order-md-2">
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Helm" id="Helm" class="form-check-input">
													<label for="Helm" class="form-check-label">Helm</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Kacamata" id="Kacamata" class="form-check-input">
													<label for="Kacamata" class="form-check-label">Kacamata</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Goggle" id="Goggle" class="form-check-input">
													<label for="Goggle" class="form-check-label">Goggle</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Tameng_Muka" id="Tameng_Muka" class="form-check-input">
													<label for="Tameng_Muka" class="form-check-label">Tameng Muka</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Kop_Las" id="Kop_Las" class="form-check-input">
													<label for="Kop_Las" class="form-check-label">Kop Las</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Masker_Kain" id="Masker_Kain" class="form-check-input">
													<label for="Masker_Kain" class="form-check-label">Masker Kain</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Masker_Kimia" id="Masker_Kimia" class="form-check-input">
													<label for="Masker_Kimia" class="form-check-label">Masker Kimia</label>
												</div>
											</div>
											<div class="col-12 col-md-4 col-lg-4 order-1 order-md-2">
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Earplug_Earmuff" id="Earplug_Earmuff" class="form-check-input">
													<label for="Earplug_Earmuff" class="form-check-label">Earplug_Earmuff</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sarung_Tangan_Katun" id="Sarung_Tangan_Katun" class="form-check-input">
													<label for="Sarung_Tangan_Katun" class="form-check-label">Sarung Tangan Katun</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sarung_Tangan_Karet" id="Sarung_Tangan_Karet" class="form-check-input">
													<label for="Sarung_Tangan_Karet" class="form-check-label">Sarung Tangan Karet</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sarung_Tangan_Kulit" id="Sarung_Tangan_Kulit" class="form-check-input">
													<label for="Sarung_Tangan_Kulit" class="form-check-label">Sarung Tangan Kulit</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sarung_Tangan_Las" id="Sarung_Tangan_Las" class="form-check-input">
													<label for="Sarung_Tangan_Las" class="form-check-label">Sarung Tangan Las</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sabuk_Keselamatan" id="Sabuk_Keselamatan" class="form-check-input">
													<label for="Sabuk_Keselamatan" class="form-check-label">Sabuk Keselamatan</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Full_Body_Harness" id="Full_Body_Harness" class="form-check-input">
													<label for="Full_Body_Harness" class="form-check-label">Full Body Harness</label>
												</div>
											</div>
											<div class="col-12 col-md-4 col-lg-4 order-1 order-md-2">
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Pelampung" id="Pelampung" class="form-check-input">
													<label for="Pelampung" class="form-check-label">Pelampung</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Tali_Pelindung" id="Tali_Pelindung" class="form-check-input">
													<label for="Tali_Pelindung" class="form-check-label">Tali Pelindung</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sepatu_Keselamatan" id="Sepatu_Keselamatan" class="form-check-input">
													<label for="Sepatu_Keselamatan" class="form-check-label">Sepatu Keselamatan</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sapatu_Boots" id="Sapatu_Boots" class="form-check-input">
													<label for="Sapatu_Boots" class="form-check-label">Sapatu Boots</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Tabung_Pernapasan" id="Tabung_Pernapasan" class="form-check-input">
													<label for="Tabung_Pernapasan" class="form-check-label">Tabung Pernapasan</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Apron" id="Apron" class="form-check-input">
													<label for="Apron" class="form-check-label">Apron</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Lainnya" id="Lainnya" class="form-check-input">
													<label for="Lainnya" class="form-check-label">Lainnya</label>
												</div>
											</div>
										</div>
										<br>
										<span class="mt-0 text-muted"> Perlengkapan Keselamatan & Darurat </span>
										<div class="row">
											<div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Pemadam_Api" id="Pemadam_Api" class="form-check-input">
													<label for="Pemadam_Api" class="form-check-label">Pemadam Api (APAR, Karung Goni Basah)</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Safety_cone_line" id="Safety_cone_line" class="form-check-input">
													<label for="Safety_cone_line" class="form-check-label">Safety cone & line</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Rambu_Tanda_Keselamatan" id="Rambu_Tanda_Keselamatan" class="form-check-input">
													<label for="Rambu_Tanda_Keselamatan" class="form-check-label">Rambu/Tanda Keselamatan</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="LOTO" id="LOTO" class="form-check-input">
													<label for="LOTO" class="form-check-label">LOTO (Lock Out Tag Out)</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Radio_Telekomunikasi" id="Radio_Telekomunikasi" class="form-check-input">
													<label for="Radio_Telekomunikasi" class="form-check-label">Radio Telekomunikasi</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Jaring_Tali_Keselamatan" id="Jaring_Tali_Keselamatan" class="form-check-input">
													<label for="Jaring_Tali_Keselamatan" class="form-check-label">Jaring Tali Keselamatan</label>
												</div>
											</div>  
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-success btn-sm">
								<i class="fas fa-save"></i> Simpan
							</button>
						</form>

					@else
						<form id="createForm" action="{{ route('tool2.update', $job->id) }}" method="POST">
							@csrf
							<div class="row">
								<div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
									<div class="form-group" id="workPermitForm">
										<h5 class="mt-0 text-black">Daftar Peralatan Keselamatan</h5>
										<span class="mt-0 text-muted"> Alat Pelindung Diri </span>
										@foreach($tools2 as $tool)
										<div class="row">
											<div class="col-12 col-md-4 col-lg-4 order-1 order-md-2">
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Helm" id="Helm" class="form-check-input" {{ in_array('Helm', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Helm" class="form-check-label">Helm</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Kacamata" id="Kacamata" class="form-check-input" {{ in_array('Kacamata', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Kacamata" class="form-check-label">Kacamata</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Goggle" id="Goggle" class="form-check-input" {{ in_array('Goggle', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Goggle" class="form-check-label">Goggle</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Tameng_Muka" id="Tameng_Muka" class="form-check-input" {{ in_array('Tameng_Muka', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Tameng_Muka" class="form-check-label">Tameng Muka</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Kop_Las" id="Kop_Las" class="form-check-input" {{ in_array('Kop_Las', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Kop_Las" class="form-check-label">Kop Las</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Masker_Kain" id="Masker_Kain" class="form-check-input" {{ in_array('Masker_Kain', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Masker_Kain" class="form-check-label">Masker Kain</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Masker_Kimia" id="Masker_Kimia" class="form-check-input" {{ in_array('Masker_Kimia', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Masker_Kimia" class="form-check-label">Masker Kimia</label>
												</div>
											</div>
											<div class="col-12 col-md-4 col-lg-4 order-1 order-md-2">
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Earplug_Earmuff" id="Earplug_Earmuff" class="form-check-input" {{ in_array('Earplug_Earmuff', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Earplug_Earmuff" class="form-check-label">Earplug_Earmuff</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sarung_Tangan_Katun" id="Sarung_Tangan_Katun" class="form-check-input" {{ in_array('Sarung_Tangan_Katun', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Sarung_Tangan_Katun" class="form-check-label">Sarung Tangan Katun</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sarung_Tangan_Karet" id="Sarung_Tangan_Karet" class="form-check-input" {{ in_array('Sarung_Tangan_Karet', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Sarung_Tangan_Karet" class="form-check-label">Sarung Tangan Karet</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sarung_Tangan_Kulit" id="Sarung_Tangan_Kulit" class="form-check-input" {{ in_array('Sarung_Tangan_Kulit', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Sarung_Tangan_Kulit" class="form-check-label">Sarung Tangan Kulit</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sarung_Tangan_Las" id="Sarung_Tangan_Las" class="form-check-input" {{ in_array('Sarung_Tangan_Las', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Sarung_Tangan_Las" class="form-check-label">Sarung Tangan Las</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sabuk_Keselamatan" id="Sabuk_Keselamatan" class="form-check-input" {{ in_array('Sabuk_Keselamatan', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Sabuk_Keselamatan" class="form-check-label">Sabuk Keselamatan</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Full_Body_Harness" id="Full_Body_Harness" class="form-check-input" {{ in_array('Full_Body_Harness', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Full_Body_Harness" class="form-check-label">Full Body Harness</label>
												</div>
											</div>
											<div class="col-12 col-md-4 col-lg-4 order-1 order-md-2">
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Pelampung" id="Pelampung" class="form-check-input" {{ in_array('Pelampung', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Pelampung" class="form-check-label">Pelampung</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Tali_Pelindung" id="Tali_Pelindung" class="form-check-input" {{ in_array('Tali_Pelindung', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Tali_Pelindung" class="form-check-label">Tali Pelindung</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sepatu_Keselamatan" id="Sepatu_Keselamatan" class="form-check-input" {{ in_array('Sepatu_Keselamatan', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Sepatu_Keselamatan" class="form-check-label">Sepatu Keselamatan</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Sapatu_Boots" id="Sapatu_Boots" class="form-check-input" {{ in_array('Sapatu_Boots', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Sapatu_Boots" class="form-check-label">Sapatu Boots</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Tabung_Pernapasan" id="Tabung_Pernapasan" class="form-check-input" {{ in_array('Tabung_Pernapasan', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Tabung_Pernapasan" class="form-check-label">Tabung Pernapasan</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Apron" id="Apron" class="form-check-input" {{ in_array('Apron', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Apron" class="form-check-label">Apron</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Lainnya" id="Lainnya" class="form-check-input" {{ in_array('Lainnya', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Lainnya" class="form-check-label">Lainnya</label>
												</div>
											</div>
										</div>
										<br>
										<span class="mt-0 text-muted"> Perlengkapan Keselamatan & Darurat </span>
										<div class="row">
											<div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Pemadam_Api" id="Pemadam_Api" class="form-check-input" {{ in_array('Pemadam_Api', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Pemadam_Api" class="form-check-label">Pemadam Api (APAR, Karung Goni Basah)</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Safety_cone_line" id="Safety_cone_line" class="form-check-input" {{ in_array('Safety_cone_line', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Safety_cone_line" class="form-check-label">Safety cone & line</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Rambu_Tanda_Keselamatan" id="Rambu_Tanda_Keselamatan" class="form-check-input" {{ in_array('Rambu_Tanda_Keselamatan', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Rambu_Tanda_Keselamatan" class="form-check-label">Rambu/Tanda Keselamatan</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="LOTO" id="LOTO" class="form-check-input" {{ in_array('LOTO', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="LOTO" class="form-check-label">LOTO (Lock Out Tag Out)</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Radio_Telekomunikasi" id="Radio_Telekomunikasi" class="form-check-input" {{ in_array('Radio_Telekomunikasi', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Radio_Telekomunikasi" class="form-check-label">Radio Telekomunikasi</label>
												</div>
												<div class="form-check">
													<input type="checkbox" name="name[]" value="Jaring_Tali_Keselamatan" id="Jaring_Tali_Keselamatan" class="form-check-input" {{ in_array('Jaring_Tali_Keselamatan', explode(',', $tool->name)) ? 'checked' : '' }}>
													<label for="Jaring_Tali_Keselamatan" class="form-check-label">Jaring Tali Keselamatan</label>
												</div>
											</div>  
										</div>
										@endforeach 
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-success btn-sm">
								<i class="fas fa-save"></i> Simpan
							</button>
						</form>
					@endif

				</div>
			</div>
		</div>
	<!-- /.card-body -->
	</div>
<!-- /.card -->

</section>
<!-- /.content -->


<!-- Modal Create Data -->
<div class="modal fade" id="createModalPerson" tabindex="-1" role="dialog" aria-labelledby="createModalPersonLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="createModalPersonLabel">Tambah Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="createForm" action="{{ route('person.save', $job->id) }}" method="POST">
				@csrf
				<div class="modal-body">
					<!-- Form input fields -->
					<div class="form-group">
						<label for="name">Nama:</label>
						<input type="text" id="name" name="name" class="form-control" required autocomplete="off">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						<i class="fas fa-undo"></i>
						Tutup
					</button>
					<button type="submit" class="btn btn-success">
						<i class="fas fa-save"></i>
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Create Data -->
<div class="modal fade" id="createModalTool" tabindex="-1" role="dialog" aria-labelledby="createModalToolLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="createModalToolLabel">Tambah Alat</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="createForm" action="{{ route('tool.save', $job->id) }}" method="POST">
				@csrf
				<div class="modal-body">
					<!-- Form input fields -->
					<div class="form-group">
						<label for="name">Nama:</label>
						<input type="text" id="name" name="name" class="form-control" required autocomplete="off">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						<i class="fas fa-undo"></i>
						Tutup
					</button>
					<button type="submit" class="btn btn-success">
						<i class="fas fa-save"></i>
						Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	document.querySelector('form').addEventListener('submit', function(event) {
	    // Mendapatkan semua checkbox dengan nama 'name[]'
	    var checkboxes = document.querySelectorAll('input[name="name[]"]');
	    var checked = Array.from(checkboxes).some(checkbox => checkbox.checked);

	    // Jika tidak ada checkbox yang dipilih, tampilkan peringatan dan batalkan pengiriman form
	    if (!checked) {
	    	alert('Silakan pilih setidaknya satu klasifikasi pekerjaan.');
	        event.preventDefault(); // Mencegah form dikirim
	    }
	});
</script>


@endsection
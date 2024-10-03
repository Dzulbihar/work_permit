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
						<a href="{{route('job_desc')}}">Pengajuan Izin Kerja</a>
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

					<h3 class="text-primary"><i class="fas fa-paint-brush"></i> 
						{{ $job->job_name}} 
					</h3>
					<p class="text-muted">
						Lokasi : {{ $job->location}}
					</p>
					<p class="text-muted">
						Area : {{ $job->area}}
					</p>
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




					<!-- Main content -->
					<section class="content">
						<div class="container-fluid">

							<div class="row">

								<div class="col-12">

									<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMonitoringModal">
										Tambah Monitoring
									</button>

									<!-- Modal -->
									<div class="modal fade" id="tambahMonitoringModal" tabindex="-1" role="dialog" aria-labelledby="tambahMonitoringModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="tambahMonitoringModalLabel">Tambah Data Monitoring</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="{{ route('monitorings.store') }}" method="POST">
														@csrf
														<input type="hidden" name="job_id" value="{{ request()->route('id') }}">
														<div class="form-group">
															<label>Nama</label>
															<input type="text" name="nama" class="form-control" required>
														</div>
														<div class="form-group">
															<label>Lokasi</label>
															<input type="text" name="lokasi" class="form-control" required>
														</div>
														<div class="form-group">
															<label>Tanggal</label>
															<input type="date" name="tanggal" class="form-control" required>
														</div>
														<div class="form-group">
															<label>Status</label>
															<input name="status" class="form-control" required>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary">Tambah Data</button>
														</div>

													</form>
												</div>

											</div>
										</div>
									</div>

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
														<th>Aksi</th>
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
														<td>
															<!-- Tombol Edit -->
															<a href="{{ route('monitorings.edit', $monitoring->id) }}" class="btn btn-warning btn-sm">Edit</a>

															<!-- Tombol Hapus -->
															<form action="{{ route('monitorings.destroy', $monitoring->id) }}" method="POST" style="display:inline;">
																@csrf
																@method('DELETE')
																<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
															</form>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>



					</div>
					<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">



						<div class="row">
							<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
								<h5 class="mt-0 text-muted"> Daftar Nama Anggota</h5>
								<table id="example2" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
										</tr>
									</thead>
									<tbody>
										<?php $nomer = 1; ?>
										@foreach($persons as $person)
										<tr>
											<th>{{ $nomer++}}</th>
											<td> {{ $person->name}} </td>
										</tr>
										@endforeach 
									</tbody>
								</table>
							</div>
							<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
								<h5 class="mt-0 text-muted"> Daftar Alat</h5>
								<table id="example3" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
										</tr>
									</thead>
									<tbody>
										<?php $nomer = 1; ?>
										@foreach($tools as $tool)
										<tr>
											<th>{{ $nomer++}}</th>
											<td> {{ $tool->name}} </td>
										</tr>
										@endforeach 
									</tbody>
								</table>
							</div>

						</div>
						<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
							<h5 class="mt-5 text-muted"> Daftar Perlengkapan</h5>
							<table id="example4" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
									</tr>
								</thead>
								<tbody>
									<?php $nomer = 1; ?>
									<?php $nomer = 1; ?>
									@php
									$cv = explode(",", $tools2);
									@endphp
									@foreach($tools2 as $tool2)
									@foreach(explode(",", $tool2->name) as $name)
									<tr>
										<th>{{ $nomer++}}</th>
										<td> {{ $name}} </td>
									</tr>
									@endforeach 
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->

	</section>
	<!-- /.content -->







	@endsection
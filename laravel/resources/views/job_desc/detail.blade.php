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

					<div class="row">
						<div class="col-12">
							<h4>Aktivitas Terkini</h4>
							<div class="post">
								<div class="user-block">
									<img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
									<span class="username">
										<a href="#">Jonathan Burke Jr.</a>
									</span>
									<span class="description">Shared publicly - 7:45 PM today</span>
								</div>
								<!-- /.user-block -->
								<p>
									Lorem ipsum represents a long-held tradition for designers,
									typographers and the like. Some people hate it and argue for
									its demise, but others ignore.
								</p>

								<p>
									<a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
								</p>
							</div>

							<div class="post clearfix">
								<div class="user-block">
									<img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
									<span class="username">
										<a href="#">Sarah Ross</a>
									</span>
									<span class="description">Sent you a message - 3 days ago</span>
								</div>
								<!-- /.user-block -->
								<p>
									Lorem ipsum represents a long-held tradition for designers,
									typographers and the like. Some people hate it and argue for
									its demise, but others ignore.
								</p>
								<p>
									<a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
								</p>
							</div>

							<div class="post">
								<div class="user-block">
									<img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
									<span class="username">
										<a href="#">Jonathan Burke Jr.</a>
									</span>
									<span class="description">Shared publicly - 5 days ago</span>
								</div>
								<!-- /.user-block -->
								<p>
									Lorem ipsum represents a long-held tradition for designers,
									typographers and the like. Some people hate it and argue for
									its demise, but others ignore.
								</p>

								<p>
									<a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v1</a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
					<h3 class="text-primary"><i class="fas fa-paint-brush"></i> 
						{{ $job->job_name}} 
					</h3>
					<p class="text-muted">
						{{ $job->job_desc}}
					</p>
					<br>

					<div class="row">
						<div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
							<h5 class="mt-5 text-muted"> Daftar Nama Anggota</h5>
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
							<h5 class="mt-5 text-muted"> Daftar Alat</h5>
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
				</div>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->

</section>
<!-- /.content -->







@endsection
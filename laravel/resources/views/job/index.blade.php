@section('heading', 'Job')

@extends('layouts.app')

@section('content')


<style>
    .warning {
        background-color: yellow;
    }
</style>


<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Pengajuan Izin Kerja</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="{{route('home')}}">Home</a>
					</li>
					<li class="breadcrumb-item active">Pengajuan Izin Kerja</li>
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
						<h3 class="card-title"> <b>Pengajuan Izin Kerja</b> </h3>
						<div class="card-tools">
							<a href="{{route('job.add')}}" class="btn btn-success btn-sm">
								<i class="fas fa-plus-circle"></i>
								Tambah
							</a>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tombol</th> 
									<th>Status</th> 
									<th>Dokumen</th>
									<th>Nomor Pekerjaan</th>
									<th>Klasifikasi Pekerjaan</th>
									<th>Nama Pekerjaan</th>
									<th>Lokasi</th> 
									<th>Area</th> 
									<th>Tanggal Mulai Kerja</th> 
									<th>Tanggal Akhir Kerja</th> 
									<th>Jangka Waktu</th>
									<th>Sisa Waktu</th>
									<th>Tanggal Bertemu</th>   
									<th>Keterangan</th>   
								</tr>
							</thead>
							<tbody>
								<?php $nomer = 1; ?>
								@foreach($jobs as $job)
								<tr>
									<th>{{ $nomer++}}</th>
									<td>
									    @if($job->status == '0')
									        <a href="#" class="btn btn-primary btn-sm job_request_email_hsse m-1" data-id="{{ $job->id}}" data-name="{{ $job->job_name}}" title="Minta Persetujuan HSSE">
									            <i class="fas fa-paper-plane"></i>
									        </a>
									    @elseif($job->status == '1')
									        <a href="#" class="btn btn-primary btn-sm job_request_email_fungsional m-1" data-id="{{ $job->id}}" data-name="{{ $job->job_name}}" title="Minta Persetujuan Fungsional">
									            <i class="fas fa-paper-plane"></i>
									        </a>
									    @endif
									    <a href="{{route('job.detail', $job->id)}}" class="btn btn-info btn-sm m-1" title="Detail">
									        <i class="fas fa-clipboard-list"></i>
									    </a>
									    @if(!empty($job->meeting_date) && $job->status == '2')
									        <a href="{{ route('job.downloadPDF', $job->id) }}" rel="noopener" target="_blank" class="btn btn-default m-1" title="Unduh PDF">
									            <i class="fas fa-file-pdf"></i>
									        </a>
									        <a href="{{route('job.print', $job->id)}}" rel="noopener" target="_blank" class="btn btn-default m-1" title="Unduh Print">
									            <i class="fas fa-print"></i>
									        </a>
									    @endif
									    <a href="{{route('job.edit', $job->id)}}" class="btn btn-warning text-white btn-sm m-1" title="Edit">
									        <i class="fas fa-pencil-alt"></i>
									    </a>
									    <a href="#" class="btn btn-danger btn-sm delete_job m-1" data-id="{{ $job->id}}" data-name="{{ $job->job_name}}" title="Hapus">
									        <i class="fas fa-trash"></i>
									    </a>
									</td>
									<td>
									    @if($job->status == '0')
									        <span class="badge badge-danger">Belum Disetujui HSSE</span>
									    @elseif($job->status == '1')
									        <span class="badge badge-warning text-white">Belum Disetujui Fungsional</span>
									    @elseif($job->status == '2')
									        <span class="badge badge-success">Sudah Disetujui</span>
									    @endif
									</td>
									<td>
										<a href="{{ $job->getDocument() }}" target="_blank" class="btn btn-default btn-sm" title="Unduh PDF">
											<i class="fas fa-file-pdf"></i> Unduh PDF
										</a>
									</td>
									
									<td> {{ $job->job_no}} </td>
									<td>
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
									</td>
									<td> {{ $job->job_name}} </td>
									<td> {{ $job->location}} </td>
									<td> {{ $job->area}} </td>
									<td>
									    {{ \Carbon\Carbon::parse($job->start_work)->locale('id')->translatedFormat('l, d F Y') }}
									</td>
									<td>
									    {{ \Carbon\Carbon::parse($job->end_work)->locale('id')->translatedFormat('l, d F Y') }}
									</td>
									<td>
									    @if($job->end_work && $job->start_work)
									        @php
									            $start = \Carbon\Carbon::parse($job->start_work);
									            $end = \Carbon\Carbon::parse($job->end_work);
									            $duration = $end->diffInDays($start); // Menghitung durasi dalam hari
									        @endphp
									        {{ $duration }} hari
									    @endif
									</td>
									<td>
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
									        <span class="{{ $duration <= 5 ? 'warning' : '' }}">
									            {{ $duration }} hari
									        </span>
									    @endif
									</td>
									<td>
									    @if($job->meeting_date)
									        {{ \Carbon\Carbon::parse($job->meeting_date)->locale('id')->translatedFormat('l, d F Y') }}
									    @else
									        <!-- Kosongkan -->
									    @endif
									</td>
									<td> {{ $job->description}} </td>
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

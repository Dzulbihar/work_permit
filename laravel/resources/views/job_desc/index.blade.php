@section('heading', 'Job')

@extends('layouts.app')

@section('content')

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
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
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
									<th>Nama Perusahan</th>  
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
										@if(auth()->user()->role == 'hsse' && $job->status == '0')
										    <button class="btn btn-warning btn-sm m-1 text-white" data-toggle="modal" data-target="#meetingModalHsse-{{ $job->id }}" data-id="{{ $job->id }}" data-name="{{ $job->job_name }}" title="Setujui HSSE">
										        <i class="fas fa-check-circle"></i>
										    </button>
										@elseif(auth()->user()->role == 'fungsional' && $job->status == '1')
											<button class="btn btn-warning btn-sm m-1 text-white" data-toggle="modal" data-target="#meetingModalFungsional-{{ $job->id }}" data-id="{{ $job->id }}" data-name="{{ $job->job_name }}" title="Setujui Fungsional">
										        <i class="fas fa-check-circle"></i>
										    </button>
											<!-- 										    
											<a href="#" class="btn btn-success btn-sm m-1 status_job_approve_fungsional" data-id="{{ $job->id}}" data-name="{{ $job->job_name}}" title="Setujui Fungsional">
										        <i class="fas fa-check-circle"></i>
										    </a> -->
										@endif

									    <a href="{{route('job_desc.detail', $job->id)}}" class="btn btn-info btn-sm m-1" title="Daftar Anggota dan Alat">
									        <i class="fas fa-clipboard-list"></i>
									    </a>
									    
									    @if(!empty($job->meeting_date) && $job->status == '2')
									        <a href="{{ route('job_desc.downloadPDF', $job->id) }}" rel="noopener" target="_blank" class="btn btn-default m-1" title="Unduh PDF">
									            <i class="fas fa-file-pdf"></i>
									        </a>
									        <a href="{{route('job_desc.print', $job->id)}}" rel="noopener" target="_blank" class="btn btn-default m-1" title="Unduh Print">
									            <i class="fas fa-print"></i>
									        </a>
									    @endif 
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

									<td> {{ $job->user->company}} </td>
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
										    {{ $duration }} hari
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

								<!-- Modal -->
								<div class="modal fade" id="meetingModalHsse-{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="meetingModalHsseLabel-{{ $job->id }}" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="meetingModalHsseLabel-{{ $job->id }}">Atur Pertemuan untuk {{ $job->job_name }}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="{{ route('job_desc.approve_hsse', $job->id) }}" method="POST" enctype="multipart/form-data">
												@csrf
												<div class="modal-body">
													<input type="hidden" id="job_id" name="job_id" value="{{ $job->id }}">
													<div class="form-group">
														<label for="meeting_date">Tanggal Rapat:</label>
														<input type="date" id="meeting_date" name="meeting_date" class="form-control" required>
													</div>
													<div class="form-group">
														<label for="description">Deskripsi:</label>
														<textarea id="description" name="description" class="form-control" required></textarea>
													</div>

											        <div>
											            <p>- Kirim email ke vendor terkait persetujuan pekerjaan.</p>
											            <p>- Kirim email ke Fungsional terkait kesepakatan tanggal rapat.</p>
											        </div>													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">
														<i class="fas fa-undo"></i>
														Tutup
													</button>
													<button type="submit" class="btn btn-primary">
														<i class="fas fa-save"></i>
														Kirim
													</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<!-- Modal -->
								<div class="modal fade" id="meetingModalFungsional-{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="meetingModalFungsionalLabel-{{ $job->id }}" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="meetingModalFungsionalLabel-{{ $job->id }}">Atur Pertemuan untuk {{ $job->job_name }}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="{{ route('job_desc.approve_fungsional', $job->id) }}" method="POST" enctype="multipart/form-data">
												@csrf
												<div class="modal-body">
													<input type="hidden" id="job_id" name="job_id" value="{{ $job->id }}">
													<div class="form-group">
														<label for="meeting_date">Tanggal Rapat:</label>
        												<input type="date" id="meeting_date" name="meeting_date" class="form-control" value="{{ old('meeting_date', $job->meeting_date) }}" required>
													</div>
													<div class="form-group">
														<label for="description">Deskripsi:</label>
        												<textarea id="description" name="description" class="form-control" required>{{ old('description', $job->description) }}</textarea>
													</div>

											        <div>
											            <p>- Kirim email ke vendor terkait persetujuan pekerjaan.</p>
											            <p>- Kirim email ke HSSE terkait kesepakatan tanggal rapat.</p>
											        </div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">
														<i class="fas fa-undo"></i>
														Tutup
													</button>
													<button type="submit" class="btn btn-primary">
														<i class="fas fa-save"></i>
														Kirim
													</button>
												</div>
											</form>
										</div>
									</div>
								</div>

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

@section('scripts')
<script>
    $('#meetingModalHsse').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var jobId = button.data('id');
        var jobName = button.data('name');

        var modal = $(this);
        modal.find('.modal-title').text('Atur Pertemuan untuk ' + jobName);
        modal.find('#job_id').val(jobId);
    });

    $('#meetingForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        $.ajax({
            url: url,
            method: method,
            data: form.serialize(),
            success: function(response) {
                $('#meetingModalHsse').modal('hide');
                window.location.reload();
            },
            error: function(xhr) {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
</script>

<script>
    $('#meetingModalFungsional').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var jobId = button.data('id');
        var jobName = button.data('name');

        var modal = $(this);
        modal.find('.modal-title').text('Atur Pertemuan untuk ' + jobName);
        modal.find('#job_id').val(jobId);
    });

    $('#meetingForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        $.ajax({
            url: url,
            method: method,
            data: form.serialize(),
            success: function(response) {
                $('#meetingModalFungsional').modal('hide');
                window.location.reload();
            },
            error: function(xhr) {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        });
    });
</script>
@endsection
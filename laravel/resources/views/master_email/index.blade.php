@section('heading', 'Email')

@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Master Email</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="{{route('home')}}">Home</a>
					</li>
					<li class="breadcrumb-item active">Master Email</li>
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
						<h3 class="card-title"> <b>Email</b> </h3>
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
									<th>Email</th>
									<th>Status</th>
									<th>Action</th>                  
								</tr>
							</thead>
							<tbody>
								<?php $nomer = 1; ?>
								@foreach($emails as $email)
								<tr>
									<th>{{ $nomer++}}</th>
									<td> {{ $email->email}} </td>
									<td> {{ strtoupper($email->status) }} </td>
									<td> 
										<a href="{{route('email.edit',$email->id)}}" class="btn btn-warning text-white btn-sm">
					                      	<i class="fas fa-pencil-alt"></i>
					                      	Edit
					                    </a>
									</td>
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

@extends('layouts.app')

@section('heading', 'User Monitoring')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Master User</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="{{route('home')}}">Home</a>
					</li>
					<li class="breadcrumb-item active">User Monitoring</li>
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
						<h3 class="card-title"><b>Monitoring Pengguna</b></h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="userTable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Role</th>
									<th>Perusahaan</th>
									<th>NPWP</th>
									<th>No HP</th>
									<th>Email</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomer = 1; ?>
								@foreach($users as $user)
								<tr>
									<th>{{ $nomer++ }}</th>
									<td>{{ $user->name }}</td>
									<td>{{ $user->role }}</td>
									<td>{{ $user->company }}</td>
									<td>{{ $user->npwp }}</td>
									<td>{{ $user->nohp }}</td>
									<td>{{ $user->email }}</td>
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

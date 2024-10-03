@extends('layouts.app')

@section('content')

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Klasifikasi</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="{{ route('home') }}">Home</a>
					</li>
					<li class="breadcrumb-item active">Edit Klasifikasi</li>
				</ol>
			</div>
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><b>Edit Klasifikasi</b></h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="container-fluid">
							<form action="{{ route('klasifikasi.update', $klasifikasi->id) }}" method="POST">
								@csrf
								@method('PUT')

								<div class="form-group">
									<label>Nama Klasifikasi</label>
									<input type="text" name="nama" class="form-control" value="{{ $klasifikasi->nama }}" required>
								</div>

								<div class="form-group">
									<label>Status</label>
									<input type="text" name="status" class="form-control" value="{{ $klasifikasi->status }}" required>
								</div>

								<div class="form-group text-right">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>
						</div>
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

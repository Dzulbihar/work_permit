@section('heading', 'Email')

@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1> Edit Master Email </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{route('email')}}">Email</a></li>
					<li class="breadcrumb-item active"> Edit Master Email </li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<form action="{{route('email.update',$email->id)}}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"> <b>Edit Email</b> </h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
					    <div class="row">
					        <div class="col-md-6">
					            <div class="form-group">
					                <label>Email</label>
					                <input type="text" name="email" value="{{ $email->email }}" class="form-control">
					            </div>
					        </div>
					        <div class="col-md-6">
							    <div class="form-group">
							        <label>Status</label>
							        <input disabled value="{{ $email->status }}" class="form-control" style="text-transform: uppercase;">
							    </div>
							</div>
					    </div>
					    <div class="form-group mt-3">
					        <button type="submit" class="btn btn-success btn-sm">
					            <i class="fas fa-save"></i> Save
					        </button>
					        <a href="{{ route('email') }}" class="btn btn-secondary btn-sm float-right">
					            <i class="fas fa-undo"></i> Back
					        </a>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
<!-- /.content -->


@endsection

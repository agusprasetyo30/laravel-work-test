@extends('layouts.custom')

@section('title', 'Login Area')

@section('content')
<div class="row">
	<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
		<div class="login-brand">
			<img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
		</div>

		<div class="card card-primary">
			<div class="card-header"><h4>Selamat datang di QuizKu</h4></div>

			<div class="card-body">
				<a href="{{ route('admin.index') }}" class="btn btn-primary btn-block">Login as Admin</a>
				<a href="#" class="btn btn-primary btn-block">Login as Member</a>
			</div>
		</div>
		<div class="simple-footer">
			Copyright &copy; Stisla 2018
		</div>
	</div>
</div>



@endsection

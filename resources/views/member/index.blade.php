@extends('layouts.custom')

@section('title', 'Login Area')

@section('content')
<div class="row">
	<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
		<div class="login-brand">
			<img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
		</div>

		<div class="card card-primary">
			<div class="card-header"><h4>Member</h4></div>

                <form action="{{ route('member.login') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input name="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-warning btn-block">Back</a>
                </div>
            </form>
		</div>
		<div class="simple-footer">
			Copyright &copy; Stisla 2018
		</div>
	</div>
</div>



@endsection

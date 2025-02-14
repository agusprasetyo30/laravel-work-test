<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>@yield('title') - Coding Test</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}" >

	<!-- CSS Libraries -->

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
	@stack('css')
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				@yield('content')
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}" ></script>
	<script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/stisla.js') }}"></script>
	<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

	<!-- JS Libraies -->

	<!-- Template JS File -->
	<script src="{{ asset('assets/js/scripts.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

	<script>
		@if (session("alert_type") && session("message"))
			var toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timerProgressBar: true,
				timer: 3000
			});

			toast.fire({
				icon: '{{ session('alert_type') }}',
				title: '{{ session('message') }}'
			})
		@endif
   </script>
	<!-- Page Specific JS File -->
	@stack('js')
</body>
</html>

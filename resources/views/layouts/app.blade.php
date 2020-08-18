<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title','Mini Instagram')</title>

	@yield('class-login')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
	<link href="{{asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link rel="icon" type="image/png" href="{{asset('images/icons/ig-logo-email.png')}}"/>
	<link href="{{asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
	<link href="{{asset('assets/css/style.css') }}" rel="stylesheet" />
	
</head>
<body>
    @yield('content')
	

	<!-- script -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
		integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
		integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
		crossorigin="anonymous"></script>
	
	@if(!is_null( Session::get('login') ))
	<script>
		let loginData = @json(Session::get('login'));
		const base_url = {!!json_encode(url('/')) !!};
	</script>
	<script src="{{asset('assets/js/main.js') }}"></script>
	@endif

	@yield('script')
</body>
</html>
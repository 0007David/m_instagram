@extends('layouts.app')

@section('class-login')
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet" />
@endsection


@section('content')
<div class="wrapper fadeInDown">
	<div id="formContent">
		<!-- Tabs Titles -->
		<!-- Icon -->
		<div class="fadeIn first">
			<h4>Mini Instagram</h4>
			<p>Registrate para ver fotos y contenidos de tus amigos</p>
			<img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
		</div>
		
		
		@isset($mensaje)
		<div class="alert alert-warning alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ $mensaje ?? 'kskks'}}</strong>
		</div>
		@endisset

		<!-- Login Form -->
		<form method='POST' action="{{url('login')}}">
			@csrf
			<input type="text" id="login" class="fadeIn second" id="email" name="email" placeholder="correo">
			<input type="password" id="password" class="fadeIn third" id="password" name="password" placeholder="password">
			<input type="submit" class="fadeIn fourth" value="Log In">
			<!-- <a href="{{ url('/home') }}" class="fadeIn fourth" >Log In</a> -->
		</form>
		<!-- Remind Passowrd -->
		<div id="formFooter">
			<a class="underlineHover" href="#">Forgot Password?</a>
		</div>

	</div>
</div>
@endsection
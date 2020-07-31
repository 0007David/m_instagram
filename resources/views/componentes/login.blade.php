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
			<h4>GRUPO 12-SA</h4>
			<p>Registrate para ver fotos y contenidos de tus amigos</p>
			<img src="Imagen/mini.png" width="30" height="30" id="icon" alt="User Icon" />
		</div>
		
		
		@isset($status)
		<div class="alert alert-warning alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ $mensaje ?? 'kskks'}}</strong>
		</div>
		@endisset

		<!-- Login Form -->
		<form method='POST' action="{{url('login')}}">
			@csrf
			<input type="text" id="login" class="fadeIn second" id="email" name="email" placeholder="Correo Electronico">
			<input type="password" id="password" class="fadeIn third" id="password" name="password" placeholder="Contraseña">
			<input type="submit" class="fadeIn fourth" value="Log In">
			<!-- <a href="{{ url('/home') }}" class="fadeIn fourth" >Log In</a> -->
		</form>
		<!-- Remind Passowrd -->
		<div id="formFooter">
			<p class="underlineHover">¿No tienes una cuenta? <a href="/accounts/emailsignup/" tabindex="0"><span class="_7UhW9   xLCgt       qyrsm      gtFbE      se6yk        ">Regístrate</span></a></p>
		</div>

	</div>
</div>

@endsection
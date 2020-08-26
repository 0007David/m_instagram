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
			<img src="{{asset('Imagen/mini.png')}}" width="30" height="30" id="icon" alt="User Icon" />
		</div>
		
		
		@isset($status)
		<div class="alert alert-warning alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ $mensaje ?? 'kskks'}}</strong>
		</div>
		@endisset
		@php
			if( is_null(session()->get('count_view') )){
				$counter = 1;
			}else{	
				$contadorVistas = session()->get('count_view');
				if(isset($contadorVistas['login'])){
					$counter = $contadorVistas['login'];
					$counter++;
				}else{
					$counter = 1;
				}
			}
		@endphp
		<div class="alert alert-warning alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			Contador: <strong id="counter">{{$counter}}</strong>
		</div>
		
		<!-- Login Form -->
		<form id="form-login" method='POST' action="{{url('login')}}">
			@csrf
			<input type="text" id="login" class="fadeIn second error" id="email" name="email" data-rule="required|email|maxlength-56" placeholder="Correo Electronico">
			<input type="password" id="password" class="fadeIn third" id="password" data-rule="required|minlength-6" name="password" placeholder="Contraseña">
			<input type="submit" class="fadeIn fourth" value="Log In">
		</form>
		<!-- Remind Passowrd -->
		<div id="formFooter">
		<p >¿No tienes una cuenta? <a href="{{route('registrar')}}" tabindex="0"><span>Regístrate</span></a></p>
		</div>

	</div>
</div>
<script>
	let contadorVistas = @json($contadorVistas ?? '');
</script>
@endsection
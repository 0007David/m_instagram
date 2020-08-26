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
		@php
			if( is_null(session()->get('count_view') )){
				$counter = 1;
			}else{	
				$contadorVistas = session()->get('count_view');
				// Obtener las rutas
				$base_url = url('/');
				$ssl = ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? true:false;
  				$sp = strtolower( $_SERVER['SERVER_PROTOCOL'] );
  				$protocol = substr( $sp, 0, strpos( $sp, '/'  )) . ( ( $ssl ) ? 's://' : '://' );
				$current_url = $protocol. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
				$view = substr($current_url,strlen($base_url) + 1, strlen($current_url)+1);
				// --
				$urls = array('url_cu'=> $current_url,'url_ba'=>$base_url,'view'=>$view);		
				if(isset($contadorVistas[$view])){
					$counter = $contadorVistas[$view];
				}else{
					$counter = 1;
				}
			}
		@endphp
		<!-- {{ Session::get('login')['usuario_email']}}  -->
		<div class="alert alert-warning alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			Contador: <strong id="counter">{{$counter}}</strong>
		</div>

		<!-- Login Form -->
		<form id="form-register"  method='POST' action="{{url('registrar')}}">
            @csrf
            <input type="text" id="nombre" class="fadeIn third" name="nombre" placeholder="Nombre Completo" data-rule="required|name|maxlength-256">
            <input type="text" id="nombre_usuario" class="fadeIn third" name="nombre_usuario" data-rule="required|minlength-4|maxlength-120"  placeholder="Nombre_Usuario">
			<input type="text" class="fadeIn second" id="email_user" name="email" data-rule="required|email|maxlength-56" placeholder="Correo Electronico">
            <input type="password" id="password" class="fadeIn third" data-rule="required|minlength-6" name="password" placeholder="Contraseña">
			<input type="submit" class="fadeIn fourth" value="Registrar">
			<!-- <a href="{{ url('/home') }}" class="fadeIn fourth" >Log In</a> -->
		</form>
		<!-- Remind Passowrd -->
		<div id="formFooter">
			<p class="underlineHover">¿Regresar al login? <a href="{{url('/')}}" tabindex="0"><span class="_7UhW9   xLCgt       qyrsm      gtFbE      se6yk        ">Login</span></a></p>
		</div>

	</div>
</div>
@endsection
<script>
	let contadorVistas = @json($contadorVistas ?? '');
	let urls = @json( $urls ?? '');
</script>
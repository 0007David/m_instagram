<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title','Mini Instagram')</title>

	@yield('class-login')
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
	<link href="{{asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link rel="icon" type="image/png" href="{{asset('images/icons/ig-logo-email.png')}}" />
	<link href="{{asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
	<link rel="stylesheet" href="{{asset('assets/css/autoComplete.css')}}">
	<link href="{{asset('assets/css/style.css') }}" rel="stylesheet" />

</head>

<body>
	@yield('content')


	<!-- script -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@7.2.0/dist/js/autoComplete.min.js"></script>
	<script type="text/javascript" src="{{asset('assets/js/js-form-validator.js') }}"></script>
	<script type="text/javascript" src="{{asset('assets/js/validaciones.js') }}"></script>

	@if(!is_null( Session::get('login') ))
	<script>
		let loginData = @json(Session::get('login'));
	</script>
	@endif
	<script>
		const base_url = {!!json_encode(url('/')) !!};
	</script>
	<script src="{{asset('assets/js/main.js') }}"></script>
	@if(Session::has('msj'))
	<script>
		let mensaje = @json(Session::get('msj'));
		if(loginData.notificaciones == 't'){
			Toastify({
				text: mensaje.mensaje,
				duration: -1,
				gravity: "bottom", // `top` or `bottom`
				close: true,
				backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
				stopOnFocus: true, // Prevents dismissing of toast on hover
				onClick: function() {} // Callback after click
			}).showToast();
		}
		console.log('msj', mensaje);
		function notificacionDelete(){
			console.log('entro notify')
			fetch(base_url + '/notificaciones').then((response) => response.json()
			).then(function (myJson) {
				console.log('resp notify')
				console.log('notify: ', myJson);
			})  
			.catch((err)=> console.log('respuesta error',err,err.message)); 
		}
		notificacionDelete();
		delete mensaje;
	</script>
	
	@endif
	@yield('script')
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content text-center border-r1">
				<div id="m_body" class="modal-body">
				</div>
			</div>
		</div>
	</div>
	<!-- fin modal -->
</body>

</html>
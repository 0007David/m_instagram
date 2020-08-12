@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')

<!-- {{ Session::get('login')['usuario_email']}}  -->
<!-- <div>
    <?= var_dump(Session::get('login')) ?>
</div> -->
<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <img src="imagen/{{$datos['foto']}}" class="circular--square" alt="..." width="160" height="160">
        </div>
        <div class="col-md-8">
            <h4 class="dp-inline">{{$datos['nombre_usuario']}}</h4> <a href="{{ url('edit') }}" class="btn btn-light"> Editar Perfil</a>
            <ul class="col-md-8">
                <li class="liul"><span><span>{{$datos['cantidad_posts']}}</span> publicaciones</span></li>
                <li class="liul"><a tabindex="0"><span title="10">{{$datos['cantidad_seguidores']}}</span> seguidores</a></li>
                <li class="liul"><a tabindex="0"><span>{{$datos['cantidad_seguidos']}}</span> seguidos</a></li>
            </ul>
        <h4 class="dp-inline">{{$datos['nombre']}}</h4>
        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Publicaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">IGTV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">GUARDADAS </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <h3>HOME</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <h3>Menu 1</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                    <h3>Menu 2</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>

@endsection
@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')

<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container">
    <div class="row mt-5 pt-5">
        <div class="col-md-4">
            <img src="{{asset('Imagen/'.$perfil->foto)}}" class="circular--square" alt="..." width="160" height="160">
        </div>
        <div class="col-md-8">
            <h4 class="dp-inline">{{$perfil->nombre_usuario}}</h4> <a class="btn btn-light"> Enviar mensaje</a>
            <ul class="col-md-8">
                <li class="liul"><span><span>{{$perfil->usuario->post->count()}}</span> publicaciones</span></li>
                <li class="liul"><a tabindex="0"><span title="10">{{$perfil->usuario->seguidores->count()}}</span> seguidores</a></li>
                <li class="liul"><a tabindex="0"><span>{{$perfil->usuario->seguidos->count()}}</span> seguidos</a></li>
            </ul>
        <h4 class="dp-inline">{{$perfil->nombre}}</h4>
        <p>{{$perfil->presentacion}}</p>
        <a >{{$perfil->sitio_web}}</a>
        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">

                        Publicaciones</a>
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

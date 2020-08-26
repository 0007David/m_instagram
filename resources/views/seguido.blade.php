@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')

<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container">
    <div class="row mt-5 pt-5">
        <div class="col-md-4">
            @if( isset($perfil->foto) && !empty($perfil->foto))
            <img src="{{asset('Imagen/'.$perfil->foto)}}" class="circular--square" alt="..." width="160" height="160">
            @else
            <i class="fa fa-user-circle fa-6x"></i>
            @endif
        </div>
        <div class="col-md-8">
            <!-- <h4 class="dp-inline">{{$perfil->nombre_usuario}}</h4> <button class="btn btn-primary"> Seguir</button> -->
            <h4 class="dp-inline">{{$perfil->nombre_usuario}}</h4> <button data-seguirid="{{$perfil->id_usuario}}" id="btn-seguir-usuario" class="btn btn-primary">Seguir</button>
            <ul class="col-md-8">
                <li class="liul"><span><span>{{$perfil->usuario->post->count()}}</span> publicaciones</span></li>
                <li class="liul"><a tabindex="0"><span title="10">{{$perfil->usuario->seguidores->count()}}</span> seguidores</a></li>
                <li class="liul"><a tabindex="0"><span>{{$perfil->usuario->seguidos->count()}}</span> seguidos</a></li>
            </ul>
            <h4 class="dp-inline">{{$perfil->nombre}}</h4>
            <h6 class="col-md-8">{{$perfil->presentacion}}</h6>
            <h6 class="col-md-8"><a href="{{$perfil->sitio_web}}" target="_blank" rel="noopener noreferrer">{{$perfil->sitio_web}}</a></h6>
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
                    <!-- Grid row -->
                    <div class="gallery">
                        
                        @forelse ($posts as $post)
                            @if( strpos($post->foto, 'http://') !== false)
                            <div>
                                <img class="img-fluid img-thumbnail" src="{{$post->foto}}"  alt="Responsive image">
                            </div>
                            @else
                            <div>
                                <img class="img-fluid img-thumbnail" src="{{asset('imagen/'.$post->foto)}}" alt="Responsive image">
                            </div>
                            @endif
                        @empty
                            <div>
                                <img class="img-fluid img-thumbnail" src="{{asset('imagen/nohayfoto.jpg')}}" alt="Responsive image">
                            </div>
                        @endforelse
                    </div>
                    <!-- Grid row -->

                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <h3>Lo siento!</h3>
                    <p>Esta vista esta en proceso de desarrollo.</p>
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                    <h3>Lo siento!</h3>
                    <p>Esta vista esta en proceso de desarrollo.</p>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
@endsection
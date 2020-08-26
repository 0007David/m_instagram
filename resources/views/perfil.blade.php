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
<div class="container">
    <div class="row mt-5 pt-5">
        <div class="col-md-3">
            @if( isset($datos['foto']) && !empty($datos['foto']))
            <img src="imagen/{{$datos['foto']}}" class="circular--square" alt="..." width="160" height="160">
            @else
            <i class="fa fa-user-circle fa-6x"></i>
            @endif

        </div>
        <div class="col-md-8">
            <h4 class="dp-inline">{{$datos['nombre_usuario']}}</h4> <a href="{{ url('edit') }}" class="btn btn-light"> Editar Perfil</a>
            <ul class="col-md-8">
                <li class="liul"><span><span>{{$datos['cantidad_posts']}}</span> publicaciones</span></li>
                <li class="liul"><a tabindex="0"><span title="10">{{$datos['cantidad_seguidores']}}</span> seguidores</a></li>
                <li class="liul"><a tabindex="0"><span>{{$datos['cantidad_seguidos']}}</span> seguidos</a></li>
            </ul>
            <h4 class="dp-inline">{{$datos['nombre']}}</h4>
            <h6 class="col-md-8">{{$perfil->presentacion}}</h6>
            <h6 class="col-md-8"><a href="{{$perfil->sitio_web}}" target="_blank" rel="noopener noreferrer">{{$perfil->sitio_web}}</a></h6>
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

                    <!-- Grid row -->
                    <div class="gallery">
                        @foreach ($posts as $post)
                            @if( strpos($post->foto, 'http://') !== false)
                            <div>
                                <img class="img-fluid img-thumbnail" src="{{$post->foto}}"  alt="Responsive image">
                            </div>
                            @else
                            <div>
                                <img class="img-fluid img-thumbnail" src="{{asset('imagen/'.$post->foto)}}" alt="Responsive image">
                            </div>
                            @endif
                        
                        @endforeach
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
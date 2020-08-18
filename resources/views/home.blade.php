@extends('layouts.app')

@section('title','Mini-Instagram')

@section('content')


<!-- {{ Session::get('login')['usuario_email']}}  -->
<!-- <div>
    <?= var_dump(Session::get('login')) ?>
</div> -->
<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container mt-4">
    <br><br>
    <div class="row">
        <div class="col-md-6">
            @foreach($posts as $post)
            <div class="card">
                <div class="card-header row bc-white m-0">
                    <div class="col-md-11">
                        <a href="{{ url('seguido') }}">
                            <i class="fa fa-user-circle fa-2x c-gray"></i>
                            <h5 class="dp-inline c-gray">{{$post->user->perfil->nombre_usuario}}</h5>
                        </a>
                    </div>
                    
                    <div class="col-md-1 mt-1">
                        <i class="fa fa-ellipsis-h"></i>
                    </div>

                </div>
                <img src="imagen/{{$post->foto}}" class="card-img-top" alt="...">
                <div class="card-body row pb-0">
                    <div class="col-md-6">
                        <a>
                            <i class="fa fa-heart-o fa-1x mr-3"></i>
                        </a>

                        <a class="c-gray" href="{{route('comentario',$post->id)}}" title="ver">
                            <i class="fa fa-comment-o fa-1x mr-3"></i>
                        </a>
                        <a title="share">
                            <i class="fa fa-paper-plane-o fa-1x"></i>
                        </a>

                    </div>

                    <div class="offset-md-5">
                    </div>
                    <div class="col-md-1">
                        <i class="fa fa-bookmark-o fa-1x"></i>
                    </div>
                    <div class="col-md-12 mt-2"> 
                    <strong><a class="link-sin-hover" title="ver mas">{{$post->likes_count}} Me gusta</a></strong>
                    <p class="mb-1"><strong>{{$post->user->perfil->nombre_usuario}}: </strong> {{$post->descripcion}}</p>
                        <strong><a href="{{route('comentario',$post->id)}}" class="link-sin-hover">Ver los {{$post->comentario_count}} comentarios</a></strong>
                        @isset($post->first_comentario)
                            
                            <p class="mb-0"><strong>{{ $post->first_comentario->nombre_usuario }}: </strong> {{ $post->first_comentario->descripcion }}</p>
                        @endisset

                        @empty($post->first_comentario)
                            
                            <p class="mb-0"><strong></strong> No hay comentarios</p>
                        @endempty

                        
                        <p class="card-text"><small class="text-muted">{{ $post->fecha_actualizada}}</small></p>
                    </div>

                </div>
                <div class="dropdown-divider"></div>
                
                    <form class="card-food row" method='POST' action="{{ url('comentarios')}}">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="col-md-9">
                        <textarea required class="form-text-area" name="descripcion" placeholder="Añade un comentario..."></textarea>
                        <input type="hidden" name="id_usuario" value="{{Session::get('login')['usuario_id']}}">
                        <input type="hidden" name="id_post" value="{{$post->id}}">
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-outline-primary mt-2">Publicar</button>
                    </div>
                    </form>
               

            </div>
            <br>
            @endforeach


        </div>
        <div class="col-md-6" style="position:fixed; right: 0px;">
            <div class="card border-light mb-3 card-home-title">

                <div class="row card-header m-0">
                    <div class="col-md-3">
                        <img src="imagen/{{$usuario['foto']}}" class="circular--square" alt="..." width="65" height="65">
                    </div>
                    <div class="col-md-9">
                        <h6>{{$usuario['nombre_usuario'] ?? ''}}</h6>
                        <p>{{$usuario['nombre']?? ''}}</p>
                    </div>

                </div>
                <div class="card-body">
                    <h6 class="card-title">Sugerencia para ti</h6>

                    @foreach($seguidores as $seguidor)

                    <div class="row">
                        <div class="col-md-3">
                            <img src="imagen/{{$seguidor->foto}}" class="circular--square" alt="..." width="65" height="65">
                        </div>
                        <div class="col-md-9">
                            <h6>{{$seguidor->nombre}}</h6>
                            <h6>{{$seguidor->nombre_usuario}}<button type="button" class="btn btn-outline-primary" style="margin-left: 50px">+ Seguir</button></h6>
                            <p>Te sigue</p>
                        </div>
                    </div>
                    @endforeach

                    <!-- <div class="col-md-12"></div> -->

                    <p style="color:#CFCAC9" ; class="card-text">Información·Ayuda·Prensa·API·Empleo·Privacidad·Condiciones·Ubicaciones·Cuentas
                        destacadas·Hashtags·Idioma
                        Español (España)
                    </p>
                    <p style="color:#CFCAC9" ; class="card-text">
                        © 2020 MINI-INSTAGRAM FROM GRUPO12SA</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
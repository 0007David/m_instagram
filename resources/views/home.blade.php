@extends('layouts.app')

@section('title','Mini-Instagram')

@section('content')

<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container mt-4">
    <br><br>
    <div class="row">
        <div id="col-posts" class="col-md-6">
            @foreach($posts as $post)
            <div class="card">
                <div class="card-header row bc-white m-0">
                    <div class="col-md-11">
                        <a href="{{ url('user/'.$post->user->perfil->nombre_usuario) }}">
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
                            @if ($post->dioLikeSeguidor(Session::get('login')['usuario_id']))
                            <i id="btn-like" data-postid="{{$post->id}}" class="fa fa-heart fa-1x mr-3 c-red"></i>
                            @else
                            <i id="btn-like" data-postid="{{$post->id}}" class="fa fa-heart-o fa-1x mr-3"></i>
                            @endif
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
                        <strong><a id="likes_count" class="link-sin-hover" title="ver mas">{{$post->likes_count}}</a> Me gusta</strong>
                        <p class="mb-1"><strong>{{$post->user->perfil->nombre_usuario}}: </strong> {{$post->descripcion}}</p>
                        <strong><a href="{{url('comentarios')}}" class="link-sin-hover">Ver los {{$post->comentario_count}} comentarios</a></strong>
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
                <div id="sugerencia_list" class="card-body">
                    <h6 class="card-title">Sugerencia para ti</h6>

                    @foreach($seguidores as $seg)
                    <div class="row">
                        <div class="col-md-2">
                            <img src="imagen/{{$seg->usuarioSeguidor->perfil->foto}}" class="circular--square" alt="..." width="65" height="65">
                        </div>
                        <div class="col-md-7">
                            <h6>{{$seg->usuarioSeguidor->perfil->nombre}}</h6>
                            <h6>{{$seg->usuarioSeguidor->perfil->nombre_usuario}}</h6>
                            <p>Te sigue</p>
                        </div>
                        <div id="" class="col-md-2 m-2 pl-1">
                            @if( is_null($seg->loEstoySiguiendo( $seg->id_usuario_seguidor) ) )
                                <button data-seguirid="{{$seg->id_usuario_seguidor}}" id="btnSeguir" class="btn btn-primary">Seguir</button>
                            @else
                                <button data-seguirid="{{$seg->id_usuario_seguidor}}" id="btnDejarSeguir" class="btn btn-secondary">Seguiendo</button>
                            @endif
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    @endforeach

                    <!-- <div class="col-md-12"></div> -->

                    <p style="color:#CFCAC9" ; class="card-text">Información·Ayuda·Prensa·API·Empleo·Privacidad·Condiciones·Ubicaciones·Cuentas
                        destacadas·Hashtags·Idioma
                        Español (Bolivia)
                    </p>
                    <p style="color:#CFCAC9" ; class="card-text">
                        © 2020 MINI-INSTAGRAM FROM GRUPO12SA</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script src="{{asset('assets/js/home.js') }}"></script>
@endsection
@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')



<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container">
    <div class="row m-t-9 border-card">
        <div class="col-md-6 pl-0 pr-0">
            <!-- img-thumbnail  -->
            <!--"http://lorempixel.com/400/550/sports/"-->
            <!-- <img class="card-img-top" src="{{asset('imagen/'.$post->foto)}}" width="100%" alt="..."> -->
            @if( strpos($post->foto, 'http://') !== false)
            <img src="{{$post->foto}}" class="card-img-top" alt="...">
            @else
            <img src="{{asset('imagen/' .$post->foto)}}" class="card-img-top" alt="...">
            @endif
        </div>
        <div class="col-md-6">
            <div class="row card-header">
                <div class="col-md-3">
                    <i class="fa fa-user-circle fa-4x"></i>
                </div>
                <div class="col-md-8">
                <h6>{{$post->user->perfil->nombre_usuario}}</h6>
                    <p>{{$post->user->perfil->nombre}} </p>
                </div>
                <div class="col-md-1 mt-4">
                    <i class="fa fa-ellipsis-h fa-1x"></i>
                </div>

            </div>
            <div class="card-body seguidor-nav">
                @foreach ($post->comentario as $comentario)
                <div class="row">
                    <div class="col-md-3">
                        @if( isset($comentario->usuario->perfil->foto) && !empty($comentario->usuario->perfil->foto))
                        <img src="{{asset('imagen/'.$comentario->usuario->perfil->foto)}}" class="circular--square" alt="..." width="45" height="45">
                        @else
                        <i class="fa fa-user-circle fa-2x"></i>
                        @endif
                    </div>
                    <div class="col-md-8">
                    <strong>{{$comentario->usuario->perfil->nombre_usuario}}</strong>
                        <!-- <p>Lucas Granh </p> -->
                    </div>
                    <div class="col-md-1 mt-4">
                        <i class="fa fa-ellipsis-h"></i>
                    </div>
                    <div class="col-md-12">
                        <p>{{$comentario->descripcion}}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- style="position: absolute; bottom: 0px;" -->
            <div class="card-food row" >

                <div class="col-md-6">
                    <a>
                        <i class="fa fa-heart-o fa-1x mr-3"></i>
                    </a>
                    <a class="c-gray" title="ver">
                        <i class="fa fa-comment-o fa-1x mr-3"></i>
                    </a>
                    <a title="share">
                        <i class="fa fa-paper-plane-o fa-1x"></i>
                    </a>
                </div>

                <div class="offset-md-4">
                </div>
                <div class="col-md-2">
                    <i class="fa fa-bookmark-o fa-1x mr-2"></i>
                </div>
                <div class="col-md-12 mt-2">
                <strong><a class="link-sin-hover" title="ver mas">{{$post->likes->count()}} Me gusta</a></strong>
                    <p class="card-text"><small class="text-muted">{{$post->fecha_actualizada}}</small></p>
                </div>
                {{-- <div class="col-md-9">
                    <textarea class="form-text-area" placeholder="Añade un comentario..."></textarea>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-primary mt-2">Publicar</button>
                </div> --}}
                <form id="form-ComentarioUsuario" class="col-md-12" style="display: flex;" method='POST' action="{{ url('comentarios')}}">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="col-md-9">
                        <textarea required class="form-text-area" name="descripcion" data-rule="maxlength-256" placeholder="Añade un comentario..."></textarea>
                        <input type="hidden" name="id_usuario" value="{{Session::get('login')['usuario_id']}}">
                        <input type="hidden" name="id_post" value="{{$post->id}}">
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-outline-primary mt-2">Publicar</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
    <br><br>
</div>
<!-- Fotter -->
<x-foot />
<!-- Footer -->
@endsection
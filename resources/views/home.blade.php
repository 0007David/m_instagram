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
                            <h5 class="dp-inline c-gray">lucas</h5>
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

                        <a class="c-gray" href="{{ url('comentarios') }}" title="ver">
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
                        <strong><a class="link-sin-hover" title="ver mas">672.432 Me gusta</a></strong>
                        <p class="mb-1"><strong>lucas9382</strong> {{$post->descripcion}}</p>
                        <strong><a href="{{url('comentarios')}}" class="link-sin-hover">Ver los 4.435 comentarios</a></strong>
                        <p class="mb-0"><strong>david328</strong> Este es un comentario cualquiera</p>
                        <p class="card-text"><small class="text-muted">Hace {{ $post->fecha_actualizada}} ago</small></p>
                    </div>

                </div>
                <div class="dropdown-divider"></div>
                <div class="card-food row">
                    <div class="col-md-9">
                        <textarea class="form-text-area" placeholder="Añade un comentario..."></textarea>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-outline-primary mt-2">Publicar</button>
                    </div>
                    <!-- <input type="text" placeholder="Añade un comentario"> -->
                </div>

            </div>
            <br>
            @endforeach


        </div>
        <div class="col-md-6" style="position:fixed; right: 0px;">
            <div class="card border-light mb-3 card-home-title">

                <div class="row card-header m-0">
                    <div class="col-md-3">
                        <img src="https://instagram.fyei1-1.fna.fbcdn.net/v/t51.2885-19/44884218_345707102882519_2446069589734326272_n.jpg?_nc_ht=instagram.fyei1-1.fna.fbcdn.net&_nc_ohc=iYZpEIp9uDMAX-QY1Zs&oh=401b307448290dabd5fb52de7d2d9332&oe=5F3F2E0F&ig_cache_key=YW5vbnltb3VzX3Byb2ZpbGVfcGlj.2" alt="..." width="60" height="65">
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
                            <img src="https://instagram.fyei1-1.fna.fbcdn.net/v/t51.2885-19/44884218_345707102882519_2446069589734326272_n.jpg?_nc_ht=instagram.fyei1-1.fna.fbcdn.net&_nc_ohc=iYZpEIp9uDMAX-QY1Zs&oh=401b307448290dabd5fb52de7d2d9332&oe=5F3F2E0F&ig_cache_key=YW5vbnltb3VzX3Byb2ZpbGVfcGlj.2" alt="..." width="55" height="55">
                        </div>
                        <div class="col-md-9">
                            <h6>{{$seguidor->nombre}}</h6>
                            <h6>{{$seguidor->nombre_usuario}}</h6>
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
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
            <img src="imagen/{{$datos['foto']}}" class="circular--square" alt="..." width="160" height="160">
        </div>
        <div class="col-md-8">
            <h4 class="dp-inline">{{$datos['nombre_usuario']}}</h4>

            <ul class="col-md-8">
                <li class="liul"><span><span>{{$datos['cantidad_posts']}}</span> publicaciones</span></li>
                <li class="liul"><a  tabindex="0"><span title="10">{{$datos['cantidad_seguidores']}}</span> seguidores</a></li>
                <li class="liul"><a  tabindex="0"><span>{{$datos['cantidad_seguidos']}}</span> seguidos</a></li>
            </ul>
            <h4 class="dp-inline">{{$datos['nombre']}}</h4>
            <h6 class="col-md-8">{{$perfil->presentacion}}</h6>
            <h6 class="col-md-8">{{$perfil->sitio_web}}</h6>
        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#menu2">Publicaciones </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Publicar</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane fade"><br>
                    <h3>HOME</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>

                    <h3>Post </h3>
                    <form id="form-InsertPostUsuario" method='POST' action="{{url('insertPost')}}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="file">Foto: </label>
                            <input type="file" id="foto" name="foto"  data-rule="required|fileextension-jpg-png-jpeg|maxfilesize-2-MB">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripcion: </label>
                            <textarea class="form-control" type="text" id="descripcion" name="descripcion" data-rule="maxlength-256" placeholder="Ingrese una descripcion para su foto..."></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-light">cancelar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
                <div id="menu2" class="container tab-pane active"><br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Likes</th>
                                <th scope="col">Comentarios</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key => $post)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                
                                <td><img src="{{asset('imagen/'.$post->foto)}}" width="40" height="40"></td>
                                <td>{{$post->descripcion}}</td>
                                <td>{{$post->fecha_actualizada}}</td>
                                <td>{{$post->likes_count}}</td>
                                <td>{{$post->comentario_count}}</td>
                                <td>
                                    <form method='POST' action="{{ url('post')}}">
                                        {{ method_field('POST') }}
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$post->id}}">
                                        @if ($post->estado=='t')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                        <input type="hidden" name="estado" value="f">
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
<!-- Fotter -->
<x-foot />
<!-- Footer -->
@endsection
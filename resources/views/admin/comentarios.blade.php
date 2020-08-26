@extends('layouts.app')

@section('title','Administacion')

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
        <div class="col-md-12">
            <h2 class="dp-inline">Administracion Comentarios</h2>
            <button class="btn btn-primary mb-2">Crear</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Id Post</th>
                    <th scope="col">Dueño Post</th>
                    <th scope="col">Post</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comentarios as $key => $comentario)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    
                    <td>{{$comentario->descripcion}}</td>
                    <td>{{$comentario->nombre_usuario}}</td>
                    <td>{{$comentario->id_post}}</td>
                    <td>{{$comentario->dueño_post}}</td>
                    <td><img src="imagen/{{$comentario->foto}}" width="40" height="40"></td>
                    <td>{{$comentario->fecha}}</td>
                    <td>
                        <button class="btn btn-danger">Eliminar</button>
                        <a href="{{ route('comentarios.show',$comentario->id) }}" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <br><br>
</div>
<!-- Fotter -->
<x-foot />
<!-- Footer -->
@endsection
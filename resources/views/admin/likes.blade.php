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
            <h2 class="dp-inline">Administracion Likes</h2>
            <button class="btn btn-primary mb-2">Crear</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Id Post</th>
                    <th scope="col">Dueño Post</th>
                    <th scope="col">Post</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($likes as $key => $like)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    
                    <td>{{$like->nombre_usuario}}</td>
                    <td>{{$like->id_post}}</td>
                    <td>{{$like->dueño_post}}</td>
                    <td><img src="imagen/{{$like->foto}}" width="40" height="40"></td>
                    <td>
                        <button class="btn btn-danger">Eliminar</button>
                        <button class="btn btn-warning">Editar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <br><br>
</div>

@endsection
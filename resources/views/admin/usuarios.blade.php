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
            <h2 class="dp-inline">Administracion Usuarios</h2>
            <button class="btn btn-primary mb-2">Crear</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nombre Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Fecha Nacimiento</th>
         
                    <th scope="col">Actiones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    
                    <td>{{$user->nombre}}</td>
                    <td>{{$user->nombre_usuario}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->genero}}</td>
                    <td>{{$user->fecha_nacimiento}}</td>
             
                    <td>
                        <button class="btn btn-danger">Eliminar</button>
                        <a href="{{ route('usuarios.show',$user->id) }}" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <br><br>
</div>

@endsection
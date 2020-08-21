@extends('layouts.app')

@section('title','Administacion')

@section('content')

<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <h2 class="dp-inline">Administracion Accesos de los Usuarios </h2>
            <!-- <button class="btn btn-primary mb-2">Crear</button> -->
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nombre Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($perfiles as $key => $perfil)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$perfil->nombre}}</td>
                    <td>{{$perfil->nombre_usuario}}</td>
                    <td>{{$perfil->email}}</td>
                    <td>
                        @if( $perfil->file_log)
                        <button class="btn btn-primary">Ver Log</button>
                        <button class="btn btn-warning">Ver Estadistica</button>
                        @else
                        <button class="btn btn-default">Usuario sin Registros</button>
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>


    </div>
    <br><br>
</div>

@endsection
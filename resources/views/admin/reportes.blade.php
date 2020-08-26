@extends('layouts.app')

@section('title','Administacion')

@section('content')

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
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nombre Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <th scope="row">$key</th>
                    
                    <td>$user->nombre</td>
                    <td>$user->nombre_usuario</td>
                    <td>$user->email</td>
                    <td>$user->genero</td>
                    <td>
                        <button class="btn btn-danger">Eliminar</button>
                        <button class="btn btn-warning">Editar</button>
                    </td>
                </tr>
                
            </tbody>
        </table>


    </div>
    <br><br>
</div>
<!-- Fotter -->
<x-foot />
<!-- Footer -->
@endsection
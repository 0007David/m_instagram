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
            <h2 class="dp-inline">Administracion Contactos</h2>
            <button class="btn btn-primary mb-2">Crear</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Nombre Usuario</th>
                    <th scope="col">Actiones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contactos as $key => $contacto)
                <tr>
                    <th scope="row">{{$key}}</th>
                    
                    <td>{{$contacto->telefono}}</td>
                    <td>{{$contacto->usuario}}</td>
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
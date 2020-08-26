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
            <h2 class="dp-inline">Administracion Configuraciones</h2>
            <!--<button class="btn btn-primary mb-2">Crear</button>-->
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Notificaciones</th>
                    <th scope="col">Tema Fondo</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($configuraciones as $key => $configuracion)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    
                    <td>{{$configuracion->notificaciones}}</td>
                    <td>{{$configuracion->tema_fondo}}</td>
                    <td>{{$configuracion->usuario}}</td>
                    <td>
                        <!--<button class="btn btn-danger">Eliminar</button>-->
                        <a href="{{ route('configuraciones.show',$configuracion->id) }}" class="btn btn-warning">Editar</a>
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
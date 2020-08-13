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
        <div class="col-md-8 offset-2">
            <form method='POST' action="{{ url('usuario')}}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class=" form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" name="email" value="{{$user->email}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{$user->nombre}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre Usuario</label>
            <input type="text" class="form-control" name="nombre_usuario" placeholder="Nombre Usuario" value="{{$user->nombre_usuario}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Presentacion</label>
            <input type="text" class="form-control" name="presentacion" placeholder="Presentacion" value="{{$user->presentacion}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Sitio Web</label>
            <input type="text" class="form-control" name="sitio_web" placeholder="Sitio Web" value="{{$user->sitio_web}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Genero</label>
            <input type="text" class="form-control" name="genero" placeholder="Genero" value="{{$user->genero}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Fecha Nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" placeholder="Fecha Nacimiento" value="{{$user->fecha_nacimiento}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Telefono</label>
            <input type="text" class="form-control" name="telefono" placeholder="Telefono" value="{{$user->telefono}}">
            <input type="hidden" name="id" value="{{$user->id}}">
        </div>

        <div class="form-group text-center">
            <button class="btn btn-light">Cancelar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        </form>
    </div>
</div>


</div>
<br><br>
</div>

@endsection
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
            
        </div>
        <div class="col-md-8 offset-2">
            <form id="form-EditarUsuarioAdmi" method='POST' action="{{ url('admin/usuario')}}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
        <div class=" form-group">
                <label for="exampleFormControlInput1">Email</label>
                <input type="email" class="form-control" name="email" data-rule="required|email|maxlength-56" value="{{$user->email}}">
        </div>

        <div class=" form-group">
            <label for="exampleFormControlInput1">Password</label>
            <input type="password" class="form-control" name="password" value="">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre</label>
            <input type="text" class="form-control" name="nombre" data-rule="required|name|maxlength-256" placeholder="Nombre" value="{{$user->nombre}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre Usuario</label>
            <input type="text" class="form-control" name="nombre_usuario" data-rule="required|name|maxlength-120" placeholder="Nombre Usuario" value="{{$user->nombre_usuario}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Presentacion</label>
            <input type="text" class="form-control" name="presentacion" data-rule="maxlength-512" placeholder="Presentacion" value="{{$user->presentacion}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Sitio Web</label>
            <input type="text" class="form-control" name="sitio_web" data-rule="maxlength-200" placeholder="Sitio Web" value="{{$user->sitio_web}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Genero</label>
            <select data-rule="required" name="genero" class="form-control">
                <option value="">Seleccione</option>
                @if ($user->genero=='m')
                <option value="m" selected>Masculino</option>
                <option value="f" >Femenino</option>
                @endif
                @if ($user->genero=='f')
                <option value="f" selected>Femenino</option>
                <option value="m" >Masculino</option>
                @endif
            </select>
            <!--<input type="text" class="form-control" name="genero" placeholder="Genero" value="{{$user->genero}}"> -->
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Fecha Nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" data-rule="required" placeholder="Fecha Nacimiento" value="{{$user->fecha_nacimiento}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Telefono</label>
            <input type="text" class="form-control" name="telefono"data-rule="required|phone" placeholder="Telefono" value="{{$user->telefono}}">
            <input type="hidden" name="id" value="{{$user->id}}">
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Estado</label>
            <select data-rule="required" name="estado" class="form-control">
                <option value="">Seleccione</option>
                @if ($user->estado=='f')
                <option value="f" selected>Desactivado</option>
                <option value="t" >Activo</option>
                @endif
                @if ($user->estado=='t')
                <option value="t" selected>Activo</option>
                <option value="f" >Desactivado</option>
                @endif
            </select>
            <!--<input type="text" class="form-control" name="genero" placeholder="Genero" value="{{$user->genero}}"> -->
        </div>

        <div class="form-group">
            <label for="exampleFormControlInput1">Rol</label>
            <select data-rule="required" name="rol" class="form-control">
                <option value="">Seleccione</option>
                @if ($user->rol=='1')
                <option value="1" selected>Administrador</option>
                <option value="0" >Usuario</option>
                @endif
                @if ($user->rol=='0')
                <option value="0" selected>Usuario</option>
                <option value="1" >Administrador</option>
                @endif
            </select>
            
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
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
            <!--<button class="btn btn-primary mb-2">Crear</button>-->
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                   
                    <th scope="col">Foto</th>
                    <th scope="col">Email</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Fecha Nacimiento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Rol</th>
         
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    
                    <td>{{$user->nombre}}</td>
                  
                    <td><img src="{{asset('imagen/'.$user->foto)}}" width="40" height="40"></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->genero}}</td>
                    <td>{{$user->fecha_nacimiento}}</td>
                    <td>{{$user->estado}}</td>
                    <td>{{$user->rol}}</td>
                    <td>

                        <form method='POST' action="{{ url('admin/usuarios')}}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$user->id}}">
                            @if ($user->estado=='t')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            <input type="hidden" name="estado" value="f">
                            @endif
                            @if ($user->estado=='f')
                            <button type="submit" class="btn btn-success">Activar</button>
                            <input type="hidden" name="estado" value="t">
                            @endif
                        </form>
                        <a href="{{ route('usuarios.show',$user->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('seguidores',$user->id) }}" class="btn btn-info">Seguidores</a>
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
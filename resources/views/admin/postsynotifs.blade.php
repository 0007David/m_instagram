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
            <h2 class="dp-inline">Administracion Post</h2>
            <button class="btn btn-primary mb-2">Crear</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $key => $post)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    
                    <td><img src="{{asset('imagen/'.$post->foto)}}" width="40" height="40"></td>
                    <td>{{$post->descripcion}}</td>
                    <td>{{$post->fecha_actualizada}}</td>
                    <td>{{$post->nombre}}</td>
                    <td>{{$post->estado}}</td>
                    <td>
                        <form method='POST' action="{{ url('admin/postsynotifs')}}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$post->id}}">
                            @if ($post->estado=='t')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            <input type="hidden" name="estado" value="f">
                            @endif
                            @if ($post->estado=='f')
                            <button type="submit" class="btn btn-success">Activar</button>
                            <input type="hidden" name="estado" value="t">
                            @endif
                        </form>
                        <a href="{{ route('postsynotifs.show',$post->id) }}" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <br><br>
</div>

@endsection
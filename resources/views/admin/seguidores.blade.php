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
            <h2 class="dp-inline">Administracion Seguidores de {{$usuario->nombre}}</h2>
            
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Seguidores</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seguidores as $key => $seguidor)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    
                    <td>{{$seguidor->usuario_seguidor}}</td>
                    <td>{{$seguidor->estado}}</td>
                    <td>
                        <form method='POST' action="{{ url('admin/seguidores')}}">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$seguidor->id}}">
                            @if ($seguidor->estado=='t')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            <input type="hidden" name="estado" value="f">
                            @endif
                            @if ($seguidor->estado=='f')
                            <button type="submit" class="btn btn-success">Activar</button>
                            <input type="hidden" name="estado" value="t">
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <br><br>
</div>

@endsection
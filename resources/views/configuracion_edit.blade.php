@extends('layouts.app')

@section('title','Mini Instagram')

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
        <div class="card col-md-8 offset-md-2">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Editar Configuracion</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="tab-pane active"><br>
                    <div class="card-body">
                        <form method='POST' action="{{url('updateConfiguracion')}}">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Notificaciones</label>
                            <input type="text" class="form-control" name="notificaciones" placeholder="Notificaciones" value="{{$configuracion->notificaciones}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tema de Fondo</label>
                                <input type="text" class="form-control" name="tema_fondo" placeholder="Tema de Fondo" value="{{$configuracion->tema_fondo}}">
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-light">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
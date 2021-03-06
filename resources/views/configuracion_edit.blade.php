@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')


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
                        <form id="form-EditarConfiguracionUsuario" method='POST' action="{{url('updateConfiguracion')}}">
                            @method('POST')
                            @csrf

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Notificaciones</label>
                                <select data-rule="required" name="notificaciones" class="form-control">
                                    <option value="">Seleccione</option>
                                    @if ($configuracion->notificaciones=='t')
                                    <option value="t" selected>Activado</option>
                                    <option value="f" >Desactivado</option>
                                    @endif
                                    @if ($configuracion->notificaciones=='f')
                                    <option value="f" selected>Desactivado</option>
                                    <option value="t" >Activado</option>
                                    @endif
                                </select>
                               
                            </div>
            
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tema Fondo</label>
                                <select id="select_thema" data-rule="required" name="tema_fondo" class="form-control">
                                    <option value="">Seleccione</option>
                                    @if (trim($configuracion->tema_fondo)=='light')
                                    <option value="dark" >Dark</option>
                                    <option value="light" selected>Light</option>
                                    <option value="white" >White</option>
                                    <option value="gray" >Gray</option>
                                    @endif
                                    @if (trim($configuracion->tema_fondo)=='dark')
                                    <option value="dark" selected>Dark</option>
                                    <option value="light">Light</option>
                                    <option value="white" >White</option>
                                    <option value="gray" >Gray</option>
                                    @endif
                                    @if (trim($configuracion->tema_fondo)=='white')
                                    <option value="dark" >Dark</option>
                                    <option value="light">Light</option>
                                    <option value="white" selected>White</option>
                                    <option value="gray" >Gray</option>
                                    @endif
                                    @if (trim($configuracion->tema_fondo)=='gray')
                                    <option value="dark" >Dark</option>
                                    <option value="light">Light</option>
                                    <option value="white" >White</option>
                                    <option value="gray" selected>Gray</option>
                                    @endif
            
                                </select>
                                <input type="hidden" name="id" value="{{$configuracion->id}}">
                            
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
<!-- Fotter -->
<x-foot />
<!-- Footer -->
@endsection
@section('script')
<script src="{{asset('assets/js/configuracion.js') }}"></script>
@endsection
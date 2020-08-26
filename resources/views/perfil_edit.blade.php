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
                    <a class="nav-link active" data-toggle="tab" href="#home">Edit Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Cambiar Contraseña</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Cambiar Foto de Usuario</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Aplicaciones y Sitios web </a>
                </li>-->
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="tab-pane active"><br>
                    <div class="card-body">
                        <form id="form-PerfilEditUsuario"  method='POST' action="{{url('update')}}">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" id="email_user" name="email" placeholder="Email" data-rule="required|email|maxlength-56" value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nombre</label>
                            <input type="text" class="form-control" name="nombre" data-rule="required|name|maxlength-256" placeholder="Nombre" value="{{$perfil->nombre}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nombre Usuario</label>
                                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" data-rule="required|maxlength-120" placeholder="Nombre Usuario" value="{{$perfil->nombre_usuario}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Presentacion</label>
                                <input type="text" class="form-control" name="presentacion" data-rule="maxlength-512" placeholder="Presentacion" value="{{$perfil->presentacion}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Sitio Web</label>
                                <input type="text" class="form-control" name="sitio_web" data-rule="maxlength-200" placeholder="Sitio Web" value="{{$perfil->sitio_web}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Genero</label>
                                <select data-rule="required" name="genero" class="form-control">
                                    <option value="">Seleccione</option>
                                    @if ($perfil->genero=='m')
                                    <option value="m" selected>Masculino</option>
                                    <option value="f" >Femenino</option>
                                    @endif
                                    @if ($perfil->genero=='f')
                                    <option value="m" >Masculino</option>
                                    <option value="f" selected>Femenino</option>
                                    @endif
                                    @if(!isset($perfil->genero))
                                    <option value="m">Masculino</option>
                                    <option value="f" >Femenino</option>
                                    @endif
                                </select>
                                <!--<input type="text" class="form-control" name="genero" placeholder="Genero" value="{{$user->genero}}"> -->
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Fecha Nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" data-rule="required" placeholder="Fecha Nacimiento" value="{{$perfil->fecha_nacimiento}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Telefono</label>
                                <input type="text" class="form-control" name="telefono" data-rule="required|phone" placeholder="Telefono" value="{{$perfil->telefono}}">
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-light">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade"><br>
                <div class="card-body">
                        <form id="form-EditPasswordUsuario" method='POST' action="{{url('updatePass')}}">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nueva Contraseña</label>
                            <input type="text" class="form-control"  data-rule="required|minlength-6" name="password" placeholder="Contraseña" value="">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-light">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade"><br>
                <div class="card-body">
                    <h3>Foto de Usuario </h3>
                    <form id="form-EditFotoUsuario" method='POST' action="{{url('updateFoto')}}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="file">Foto: </label>
                            <input type="file" id="foto" name="foto" data-rule="required|fileextension-jpg-png-jpeg|maxfilesize-2-MB">
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-light">cancelar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                    </div>
                </div>
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
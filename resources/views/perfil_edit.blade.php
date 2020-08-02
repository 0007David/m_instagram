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
                    <a class="nav-link active" data-toggle="tab" href="#home">Edit Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Cambiar Contraseña</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Aplicaciones y Sitios web </a>
                </li>-->
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="tab-pane active"><br>
                    <div class="card-body">
                        <form method='POST' action="{{url('update')}}">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{$perfil->nombre}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nombre Usuario</label>
                                <input type="text" class="form-control" name="nombre_usuario" placeholder="Nombre Usuario" value="{{$perfil->nombre_usuario}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Presentacion</label>
                                <input type="text" class="form-control" name="presentacion" placeholder="Presentacion" value="{{$perfil->presentacion}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Sitio Web</label>
                                <input type="text" class="form-control" name="sitio_web" placeholder="Sitio Web" value="{{$perfil->sitio_web}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Genero</label>
                                <input type="text" class="form-control" name="genero" placeholder="Genero" value="{{$perfil->genero}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Fecha Nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" placeholder="Fecha Nacimiento" value="{{$perfil->fecha_nacimiento}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Telefono</label>
                                <input type="text" class="form-control" name="telefono" placeholder="Telefono" value="{{$perfil->telefono}}">
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
                        <form method='POST' action="{{url('updatePass')}}">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nueva Contraseña</label>
                            <input type="text" class="form-control" name="password" placeholder="Contraseña" value="">
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
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Aplicacion</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Sitio web</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-light">cancelar</button>
                                <button type="button" class="btn btn-primary">Enviar</button>
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

@endsection
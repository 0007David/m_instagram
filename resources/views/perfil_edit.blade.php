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
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Aplicaciones y Sitios web </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="tab-pane active"><br>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Example select</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Example multiple select</label>
                                <select multiple class="form-control" id="exampleFormControlSelect2">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Example textarea</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-light">cancelar</button>
                                <button type="button" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade"><br>
                <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Antigua Contraseña</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Nueva Contraseña</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-light">cancelar</button>
                                <button type="button" class="btn btn-primary">Enviar</button>
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
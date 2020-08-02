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
        <div class="col-md-4">
            <i class="fa fa-user-circle fa-6x"></i>
        </div>
        <div class="col-md-8">
            <h4 class="dp-inline">LucasGrahnm289</h4> <a href="{{ url('edit') }}" class="btn btn-light"> Editar Perfil</a>

            <ul class="list_p">
                <li class="liul"><span><span>0</span> publicaciones</span></li>
                <li class="liul"><a href="#" tabindex="0"><span title="10">10</span> seguidores</a></li>
                <li class="liul"><a href="#" tabindex="0"><span>42</span> seguidos</a></li>
            </ul>
            <h5>Lucas Granh Man</h5>
        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#home">Publicaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#menu1">Publicar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">GUARDADAS </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane fade"><br>
                    <h3>HOME</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div id="menu1" class="container tab-pane active"><br>

                    <h3>Post </h3>
                    <form>
                        <div class="form-group">
                            <label for="file">Foto</label>
                            <input type="file" id="file">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripcion</label>
                            <textarea class="form-control" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-light">cancelar</button>
                            <button type="button" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                    <h3>Menu 2</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>

@endsection
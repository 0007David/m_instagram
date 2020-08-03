@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')

<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <i class="fa fa-user-circle fa-6x"></i>
        </div>
        <div class="col-md-8">
            <h4 class="dp-inline">aprendiendoingles</h4> <a class="btn btn-light"> Enviar mensaje</a>
            <ul class="col-md-8">
                <li class="liul"><span><span>3.367</span> publicaciones</span></li>
                <li class="liul"><a tabindex="0"><span title="10">371K</span> seguidores</a></li>
                <li class="liul"><a tabindex="0"><span>7.490</span> seguidos</a></li>
            </ul>
        <h4 class="dp-inline">Aprender Ingles</h4>
        <p>Descripcion del personal de la pagina que Esse deserunt exercitation voluptate eu id id esse commodo sint et adipisicing laborum est incididunt.</p>
        <a >https://mipagina.com.bo</a>
        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">

                        Publicaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">IGTV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">GUARDADAS </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <h3>HOME</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                    <h3>Menu 1</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
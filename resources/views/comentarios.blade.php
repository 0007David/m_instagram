@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')



<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container">
    <div class="row m-t-9 border-card">
        <div class="col-md-6 pl-0 pr-0">
            <!-- img-thumbnail  -->
            <img class="card-img-top" src="http://lorempixel.com/400/550/sports/" width="100%" alt="...">
        </div>
        <div class="col-md-6">
            <div class="row card-header">
                <div class="col-md-3">
                    <i class="fa fa-user-circle fa-4x"></i>
                </div>
                <div class="col-md-8">
                    <h6>lucas</h6>
                    <p>Lucas Granh </p>
                </div>
                <div class="col-md-1 mt-4">
                    <i class="fa fa-ellipsis-h fa-1x"></i>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <i class="fa fa-user-circle fa-2x"></i>
                    </div>
                    <div class="col-md-8">
                        <strong>juanito</strong>
                        <!-- <p>Lucas Granh </p> -->
                    </div>
                    <div class="col-md-1 mt-4">
                        <i class="fa fa-ellipsis-h"></i>
                    </div>
                    <div class="col-md-12">
                        <p>Velit ut do ut voluptate ea ad fugiat est reprehenderit minim qui aliquip ea laborum.
                            incididunt sit nulla irure nostrud. Proident amet do elit commodo sint velit adipisicing
                            dolor deserunt ullamco amet laboris do.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <i class="fa fa-user-circle fa-2x"></i>
                    </div>
                    <div class="col-md-8">
                        <strong>juanito</strong>
                        <!-- <p>Lucas Granh </p> -->
                    </div>
                    <div class="col-md-1 mt-4">
                        <i class="fa fa-ellipsis-h"></i>
                    </div>
                    <div class="col-md-12">
                        <p>Velit ut do ut voluptate ea ad fugiat est reprehenderit minim qui aliquip ea laborum .</p>
                    </div>
                </div>

            </div>
            <div class="card-food row" style="position: absolute; bottom: 0px;">

                <div class="col-md-6">
                    <a>
                        <i class="fa fa-heart-o fa-1x mr-3"></i>
                    </a>
                    <a class="c-gray" title="ver">
                        <i class="fa fa-comment-o fa-1x mr-3"></i>
                    </a>
                    <a title="share">
                        <i class="fa fa-paper-plane-o fa-1x"></i>
                    </a>
                </div>

                <div class="offset-md-4">
                </div>
                <div class="col-md-2">
                    <i class="fa fa-bookmark-o fa-1x mr-2"></i>
                </div>
                <div class="col-md-12 mt-2">
                    <strong><a class="link-sin-hover" title="ver mas">672.432 Me gusta</a></strong>
                    <p class="card-text"><small class="text-muted">Hace $post->fecha_actualizada ago</small></p>
                </div>
                <div class="col-md-9">
                    <textarea class="form-text-area" placeholder="Añade un comentario..."></textarea>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-outline-primary mt-2">Publicar</button>
                </div>
                <!-- <input type="text" placeholder="Añade un comentario"> -->
            </div>
        </div>
    </div>
    <br><br>
</div>

@endsection
@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')



<!-- {{ Session::get('login')['usuario_email']}}  -->
<!-- <div>
    <?= var_dump(Session::get('login')) ?>
</div> -->
<!-- Componente NAVBAR -->
<x-nav/>
<!-- FIN Componente NAVBAR -->
<div class="container mt-4">
    <br><br>
    <div class="row">
        <div class="col-md-6">
            @foreach($posts as $post)
            <div class="card">
                <img src="imagen/{{$post->foto}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$post->descripcion}}</h5>
                    <p class="card-text">{{$post->descripcion}}</p>
                    <p class="card-text"><small class="text-muted"> {{ $post->fecha_actualizada}} </small></p>
                </div>
            </div>
            <br>
            @endforeach


        </div>
        <div class="col-md-6" style="position:fixed; right: 0px;">
            <div class="card border-light mb-3 card-home-title">
                <div class="row card-header">
                    <div class="col-md-3">
                        <img src="https://instagram.fyei1-1.fna.fbcdn.net/v/t51.2885-19/44884218_345707102882519_2446069589734326272_n.jpg?_nc_ht=instagram.fyei1-1.fna.fbcdn.net&_nc_ohc=iYZpEIp9uDMAX-QY1Zs&oh=401b307448290dabd5fb52de7d2d9332&oe=5F3F2E0F&ig_cache_key=YW5vbnltb3VzX3Byb2ZpbGVfcGlj.2" alt="..." width="60" height="65">
                    </div>
                    <div class="col-md-9">
                        <h6>{{$usuario['nombre_usuario'] ?? ''}}</h6>
                        <p>{{$usuario['nombre']?? ''}}</p>
                    </div>

                </div>
                <div class="card-body">
                    <h6 class="card-title">Sugerencia para ti</h6>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="https://instagram.fyei1-1.fna.fbcdn.net/v/t51.2885-19/44884218_345707102882519_2446069589734326272_n.jpg?_nc_ht=instagram.fyei1-1.fna.fbcdn.net&_nc_ohc=iYZpEIp9uDMAX-QY1Zs&oh=401b307448290dabd5fb52de7d2d9332&oe=5F3F2E0F&ig_cache_key=YW5vbnltb3VzX3Byb2ZpbGVfcGlj.2" alt="..." width="55" height="55">
                        </div>
                        <div class="col-md-9">
                            <h6>lucasgram280</h6>
                            <p>Te sigue</p>
                        </div>
                        <i class="fa fa-user-circle"></i>
                        <i class="fa fa-user-circle" style="font-size:24px"></i>
                        <i class="fa fa-user-circle" style="font-size:36px"></i>
                        <i class="fa fa-user-circle" style="font-size:48px;color:red"></i>
                        <br>
                    </div>

                    <!-- <div class="col-md-12"></div> -->

                    <p class="card-text">InformaciónAyudaPrensaAPIEmpleoPrivacidadCondicionesUbicacionesCuentas
                        destacadasHashtagsIdioma
                        Español (España)
                        © 2020 INSTAGRAM FROM FACEBOOK</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
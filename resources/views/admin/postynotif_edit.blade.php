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
            <h2 class="dp-inline">Administracion Post</h2>
            
        </div>
        <div class="col-md-8 offset-2">
            <form id="form-EditarPostUsuario" method='POST' action="{{ url('admin/post')}}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                

                <div class="form-group">
                    <label for="exampleFormControlInput1">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" data-rule="maxlength-256" placeholder="Descripcion" value="{{$post->descripcion}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Estado</label>
                    <select data-rule="required" name="estado" class="form-control">
                        <option value="">Seleccione</option>
                        @if ($post->estado=='f')
                        <option value="f" selected>Desactivado</option>
                        <option value="t" >Activo</option>
                        @endif
                        @if ($post->estado=='t')
                        <option value="t" selected>Activo</option>
                        <option value="f" >Desactivado</option>
                        @endif
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$post->id}}">

                <div class="form-group text-center">
                    <button class="btn btn-light">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
        </form>
    </div>
</div>


</div>
<br><br>
</div>

@endsection
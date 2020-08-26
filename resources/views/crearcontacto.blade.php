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
        </div>
        <div class="col-md-8 offset-2">
        <form id="form-CrearContactoUsuario" method='POST' action="{{ url('storecontacto')}}">
                {{ method_field('POST') }}
                {{ csrf_field() }}
        <div class=" form-group">
            <label for="exampleFormControlInput1">Telefono</label>
            <input type="text" class="form-control" name="telefono" data-rule="required|phone" placeholder="Telefono">
        </div>

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
<!-- Fotter -->
<x-foot />
<!-- Footer -->
@endsection

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
            <h2 class="dp-inline">Administracion Contactos</h2>
            <a href="{{url('crearcontacto')}}" class="btn btn-primary mb-2">Crear</a>
            <button type="button" class="btn btn-primary mb-2" id="btn-contacto">
                Buscar Amigos
              </button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Telefono</th>         
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($contactos as $key => $contacto)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    
                    <td>{{$contacto->telefono}}</td>
                    <td>
                      
                      <form class="dp-inline"  method='POST' action="{{ route('contacto.eliminar')}}">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$contacto->id}}">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                      </form>
                      <a href="{{ route('contacto.show',$contacto->id) }}" class="btn btn-warning">Editar</a>
                  </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
        

    </div>
    <br><br>
</div>
@endsection
@section('script')
    <script src="{{asset('assets/js/contacto.js') }}"></script>
@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nombre Usuario</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Accion</th>
                  </tr>
                </thead>
                <tbody id="tabla_content">
                  
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
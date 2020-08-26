@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')

<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container">
    <div class="row mt-5 pt-5 text-center">
        <div class="col-md-4">
            @if( isset($user->perfil->foto) && !empty($user->perfil->foto))
            <img src="{{asset('Imagen/'.$user->perfil->foto)}}" class="circular--square" alt="..." width="160" height="160">
            @else
            <i class="fa fa-user-circle fa-6x"></i>
            @endif
        </div>
        <div class="col-md-8">
            <h4 class="dp-inline">{{$user->perfil->nombre_usuario}}</h4> <a href="{{ url('edit') }}" class="btn btn-light"> Editar Perfil</a>

            <ul class="list_p">
                <li class="liul"><span><span>{{$user->post->count()}}</span> publicaciones</span></li>
                <li class="liul"><a href="#" tabindex="0"><span title="10">{{$user->seguidores->count()}}</span> seguidores</a></li>
                <li class="liul"><a href="#" tabindex="0"><span>{{$user->seguidos->count()}}</span> seguidos</a></li>
            </ul>
            <h5>{{$user->perfil->nombre}}</h5>
        </div>
        <div class="col-md-12">
            <h5>Estadisticas y Reportes Personales </h5>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#esta1">Estadisticas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#esta2">Reportes</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="esta1" class="container tab-pane active"><br>
                    <!-- PIE CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Grafica de Genero de Seguidores</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Distribucion de Seguidores por Edades y Genero</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <!-- STACKED BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Stacked Bar Chart</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card -->
                </div>
                <div id="esta2" class="container tab-pane fade"><br>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Reporte de {{$user->perfil->nombre_usuario}}</h4>
                        <button class="btn btn-primary" id="btnExportPdf" >PDF</button>
                            <select id="reporte_selected" class="form-control col-md-4 offset-4 mb-4">
                                <option value="">Selecciones reporte</option>
                                <option selected value="posts">Mis Posts</option>
                                <option value="seguidores">Mis Seguidores</option>
                                <option value="seguidos">A los que Siguo</option>
                            </select>
                        </div>
                        <div id="row_reporte" class="col-md-12">
                            <table id="tabla_reporte" class="table table-striped">
                                <thead id="tabla_head">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Fecha </th>
                                    </tr>
                                </thead>
                                <tbody id="tabla_body">
                                    @foreach($user->post as $key => $value)
                                    <tr>
                                        <td>{{$key +1}}</td>
                                        <td><img src="{{asset('imagen/'.$value->foto)}}" width="40" height="40"></td>
                                        <td>
                                            {{$value->descripcion}}
                                        </td>
                                        <td>
                                            {{$value->fecha_creada}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
<script>
    let dataSetPieChart = @json($estadisticaGenero);
    let dataSetBar = @json($estadisticaEdades);
    let posts = @json($user->post);
    console.log(posts);
</script>
<!-- Fotter -->
<x-foot />
<!-- Footer -->
@endsection
@section('script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.0.0/jspdf.umd.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.5.9/dist/jspdf.plugin.autotable.min.js" integrity="sha512-6oCyRRRdXAgfXITH/5iavIaxb2x6QO8diA4/VgWBlin77Z07IPjzJPyrQ4+22zyd58pE5q/ma/ogHtlG/2gdPg==" crossorigin="anonymous"></script> -->
<script src="{{asset('assets/js/Chart.min.js') }}"></script>
<script src="{{asset('assets/js/estadisticas.js') }}"></script>
@endsection
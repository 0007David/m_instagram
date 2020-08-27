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
            <h2 class="dp-inline">Administracion Usuarios</h2>
            <h5>Estadisticas y Reportes Personales </h5>
            <select id="reporte_selected" class="form-control col-md-4 offset-1 hide">
                <option value="">Seleccione </option>
                <option value="posts">Post publicados</option>
                <option value="seguidores">Sus seguidores</option>
                <option value="seguidos">A los que sigue</option>

            </select>
            <select id="user_selected" class="form-control col-md-4 offset-1 dp-inline">
                <option value="">Selecciones usuario</option>
                @foreach($usuarios as $usuario)
                <option value="{{$usuario->id_usuario}}">{{@$usuario->nombre}}</option>
                @endforeach
            </select>


        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li id="btn_grafica" class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#esta1">Graficos Estadisticos</a>
                </li>
                <li id="btn_reporte" class="nav-item">
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
                    </div>
                    <!-- /.card -->
                    <!-- STACKED BAR CHART -->
                    <div class="card card-success">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Stacked Bar Chart</h3>
                        </div> -->
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div id="esta2" class="container tab-pane fade"><br>
                    <table class="table table-hover">
                        <thead id="tabla_head">
                        </thead>
                        <tbody id="tabla_body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <br><br>
</div>
<script>
    let dataSetPieChart = @json($estadisticaGenero);
    let dataSetBar = @json($estadisticaEdades);
</script>
<!-- Fotter -->
<x-foot />
<!-- Footer -->
@endsection
@section('script')
<script src="{{asset('assets/js/Chart.min.js') }}"></script>
<script src="{{asset('assets/js/estadisticas.admin.js') }}"></script>
@endsection
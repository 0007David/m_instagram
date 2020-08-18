@extends('layouts.app')

@section('title','Mini Instagram')

@section('content')

<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container">
    <div class="row mt-5 pt-5 text-center">
        <div class="col-md-4">
            <!-- <i class="fa fa-user-circle fa-6x"></i>user -->
            <img src="{{asset('Imagen/'.$user->perfil->foto)}}" class="circular--square" alt="..." width="160" height="160">
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
                    <a class="nav-link active" data-toggle="tab" href="#esta1">Seguidores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#esta2">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#esta3">Otros </a>
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
                </div>
                <div id="esta2" class="container tab-pane fade"><br>
                    <!-- DONUT CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Donut Chart</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

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

                <div id="esta3" class="container tab-pane fade"><br>
                    <h3>Menu 2</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
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
@endsection
@section('script')
<script src="{{asset('assets/js/Chart.min.js') }}"></script>
<script src="{{asset('assets/js/estadisticas.js') }}"></script>
@endsection
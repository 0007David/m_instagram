@extends('layouts.app')

@section('title','Administacion')

@section('class-login')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- Componente NAVBAR -->
<x-nav />
<!-- FIN Componente NAVBAR -->
<div class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <h2 class="dp-inline">Administracion Usuarios</h2>
            <h5>Logg del Usuario {{$perfil->nombre}}</h5>
        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#esta1">Archivo Log</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btnReporteAcceso" data-toggle="tab" href="#esta2">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#esta3">Grafica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btnAccesoFail" data-toggle="tab" href="#esta4">Accesos Fallidos</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="esta1" class="container tab-pane active"><br>
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Bootstrap WYSIHTML5
                                <small>Simple and fast</small>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="summernote">
                                @for ($i = 0; $i < $len; $i++) <p>{{ $arrayLines[$i] }}</p>
                                    @endfor

                            </div>
                        </div>
                    </div>

                </div>
                <div id="esta2" class="container tab-pane fade"><br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Fecha Accesso</th>
                                <th scope="col">vista</th>
                                <th scope="col">Nombre Usuario</th>
                                <th scope="col">User Agent</th>
                                <th scope="col">Ip Cliente</th>
                                <th scope="col">Ubicacion</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAcceso">
                        
                        </tbody>
                    </table>

                </div>
                <div id="esta3" class="container tab-pane fade"><br>

                    <div class="col-md-12">
                        <!-- DONUT CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Grafica de cantidad de Paginas Vistas</h3>
                                <!-- <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div> -->
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart" style="height:230px; min-height:230px"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-12">
                        <!-- BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Grafica de Duracion de Accesos x Mes
                                </h3>
                                <small><strong>Ejemplo:</strong>  1.5 Hrs => 1:30 min </small>
                                <!-- <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div> -->
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

                </div>
                <div id="esta4" class="container tab-pane fade"><br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nro</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">email</th>
                                <th scope="col">Password</th>
                                <th scope="col">User Agent</th>
                                <th scope="col">Ip</th>
                                <th scope="col">Ubicacion</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAccesFail">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
<!-- Fotter -->
<x-foot />
<!-- Footer -->
<script>
    let logBar = @json($logUsuario);
    console.log(logBar)
</script>
@endsection
@section('script')
<script src="{{asset('assets/js/Chart.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/locale/es.js"></script>



<script src="{{asset('assets/js/logaccess.js') }}"></script>
@endsection
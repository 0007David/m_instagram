<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light nav-border">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- add class container > 992px -->
    <div class="container collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">
            <img src="{{asset('Imagen/Mini.png')}}" alt="..." width="150" height="40">
        </a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item nav-search">
                <input class="form-control mr-sm-2" type="search" id="autoComplete" tabindex="1" placeholder="Search" aria-label="Search">
            </li>
            <!-- <div style="right: -60%;"> -->
            <li class="nav-item">
            @php
                if( is_null(session()->get('count_view') )){
                    $counter = 1;
                }else{	
                    $contadorVistas = session()->get('count_view');
                    // Obtener las rutas
                    $base_url = url('/');
                    $ssl = ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? true:false;
                    $sp = strtolower( $_SERVER['SERVER_PROTOCOL'] );
                    $protocol = substr( $sp, 0, strpos( $sp, '/'  )) . ( ( $ssl ) ? 's://' : '://' );
                    $current_url = $protocol. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
                    $view = substr($current_url,strlen($base_url) + 1, strlen($current_url)+1);
                    // --
                    $urls = array('url_cu'=> $current_url,'url_ba'=>$base_url,'view'=>$view);		
                    if(isset($contadorVistas[$view])){
                        $counter = $contadorVistas[$view];
                    }else{
                        $counter = 1;
                    }
                }
            @endphp
                <a class="nav-link" href="#">
                    <!-- <i class="fa fa-bandcamp fa-1x"></i> -->
                    <strong id="counter">{{$counter}}</strong>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('home') }}" title="Home">
                    <i class="fa fa-home fa-1x"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('post') }}">
                    <i class="fa fa-paper-plane-o fa-1x" title="Post"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('estadistica') }}" title="Estadisticas">
                    <i class="fa fa-dashboard fa-1x"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-id_usuario="{{Session::get('login')['usuario_id']?? ''}}" id="btn-seguir" class="fa fa-heart-o fa-1x"></i>
                </a>
                <!-- dropdpwn-menu: min-width: 22rem; left: -760%;-->
                <div class="dropdown-menu drop-down-left seguidor-nav" aria-labelledby="navbarDropdown">
                    <a id="list_seguir" class="dropdown-item">
                       <!-- Lista de seguidores -->
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            @if (Session::get('login')['rol']=='1')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-users fa-1x"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('admin/usuarios') }}"><span> <i class="fa fa-users"> Admi-Usuarios</i></span> </a>
                    <a class="dropdown-item" href="{{ url('admin/configuraciones') }}"><span> <i class="fa fa-cogs"> Admi-Config</i></span> </a>
                    <a class="dropdown-item" href="{{ url('admin/contactos') }}"><span> <i class="fa fa-address-book-o"> Admi-Contactos</i></span> </a>
                    <a class="dropdown-item" href="{{ url('admin/postsynotifs') }}"><span> <i class="fa fa-users"> Admi-Posts</i></span> </a>
                    <a class="dropdown-item" href="{{ url('admin/estadisticas') }}"><span> <i class="fa fa-bar-chart"> Admi-Est. y Rep.</i></span> </a>
                    <a class="dropdown-item" href="{{ url('admin/accesslog') }}"><span> <i class="fa fa-unlock-alt"> Log Access</i></span> </a> 
                </div>
            </li>
            @endif
            <!-- style="right: -60%;" -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle fa-1x"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('perfil') }}"><span> <i class="fa fa-user-circle"> Perfil</i></span> </a>
                    <a class="dropdown-item" href="{{ url('contacto') }}"><span> <i class="fa fa-book"> Contacto</i></span> </a>
                    <a class="dropdown-item" href="{{ url('editConfiguracion') }}"><span> <i class="fa fa-cogs"> Configuracion</i></span> </a>
                    <div class="dropdown-divider"></div>
                    <form class="form-inline my-2 my-lg-0" method='GET' action="{{url('/logout')}}">
                        @method('GET')
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </li>
            
            <!-- </div> -->
        </ul>

        <!-- <button class="btn btn-outline-success my-2 my-sm-0" >Logout</button> -->
    </div>
</nav>
<br>
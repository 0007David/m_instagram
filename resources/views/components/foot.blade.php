<footer class="navbar fixed-bottom nav-border bg-light">
    <!-- Grid row -->
    <div class="container-fluid text-center">
        <!-- Grid column -->
        @php
                // Obtener las rutas
                $base_url = url('/');
                $ssl = ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? true:false;
                $sp = strtolower( $_SERVER['SERVER_PROTOCOL'] );
                $protocol = substr( $sp, 0, strpos( $sp, '/'  )) . ( ( $ssl ) ? 's://' : '://' );
                $current_url = $protocol. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
                $view = substr($current_url,strlen($base_url) + 1, strlen($current_url)+1);
                // --
            if( is_null(session()->get('count_view') )){
                $counter = 1;
            }else{	
                $contadorVistas = session()->get('count_view');
                
                $urls = array('url_cu'=> $current_url,'url_ba'=>$base_url,'view'=>$view);		
                if(isset($contadorVistas[$view])){
                    $counter = $contadorVistas[$view];
                }else{
                    $counter = 1;
                }
            }
        @endphp
        <div class="col-md-12 mt-1">
            <div class="dp-inline" class="footer-copyright text-center py-3">© 2020 Copyright:
                <a href="https://getbootstrap.com/"> MINI-INSTAGRAM FROM GRUPO-12 SA</a>
            </div>
            <p class="dp-inline">Contador de Vistas : <strong>{{$counter??''}}</strong></p>
        </div>
    </div>
    <!-- Grid row -->

</footer>
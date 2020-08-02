<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light nav-border">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- add class container > 992px -->
    <div class="container collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">
            <img src="Imagen/Mini.png" alt="..." width="150" height="40">
        </a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item nav-search">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            </li>
            <!-- <div style="right: -60%;"> -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('home') }}">
                    <i class="fa fa-home fa-1x"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-paper-plane-o fa-1x"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-dashboard fa-1x"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-bandcamp fa-1x"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i style="color:red" class="fa fa-heart fa-1x"></i>
                </a>
                <!-- dropdpwn-menu: min-width: 22rem; left: -760%;-->
                <div class="dropdown-menu drop-down-left" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">
                        <div class="row">
                            <div class="col-md-1">
                                <img src="https://instagram.fyei1-1.fna.fbcdn.net/v/t51.2885-19/44884218_345707102882519_2446069589734326272_n.jpg?_nc_ht=instagram.fyei1-1.fna.fbcdn.net&_nc_ohc=iYZpEIp9uDMAX-QY1Zs&oh=401b307448290dabd5fb52de7d2d9332&oe=5F3F2E0F&ig_cache_key=YW5vbnltb3VzX3Byb2ZpbGVfcGlj.2" alt="..." width="33" height="33">
                            </div>
                            <div class="col-md-7">
                                <h6>aprendiendolenguas</h6>
                                <p>ha comenzado a seguirte. 4sem ago</p>
                            </div>
                            <div class="offset-md-1"></div>
                            <div class="col-md-2">
                                <button class="btn btn-primary">Seguir</button>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-md-1">
                                <img src="https://instagram.fyei1-1.fna.fbcdn.net/v/t51.2885-19/44884218_345707102882519_2446069589734326272_n.jpg?_nc_ht=instagram.fyei1-1.fna.fbcdn.net&_nc_ohc=iYZpEIp9uDMAX-QY1Zs&oh=401b307448290dabd5fb52de7d2d9332&oe=5F3F2E0F&ig_cache_key=YW5vbnltb3VzX3Byb2ZpbGVfcGlj.2" alt="..." width="33" height="33">
                            </div>
                            <div class="col-md-7">
                                <h6>aprendiendolenguas</h6>
                                <p>ha comenzado a seguirte. 4sem ago</p>
                            </div>
                            <div class="offset-md-1"></div>
                            <div class="col-md-2">
                                <button class="btn btn-primary">Seguir</button>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
        
                    

                </div>
            </li>
            <!-- style="right: -60%;" -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle fa-1x"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('perfil') }}"><span> <i class="fa fa-user-circle"> Perfil</i></span> </a>
                    <a class="dropdown-item" href="#"><span> <i class="fa fa-save"> Guardados</i></span> </a>
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
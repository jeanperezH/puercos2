<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="nav">
    <a @click="menu=0" class="navbar-brand" href="/"><img src="imgs/logo2.png" width="52%" ></a>
    <a @click="menu=0" class="navbar-brand " href="/">GALPÓN PEREZ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li @click="menu=1" class="nav-item active">
            <a class="nav-link" href="#"><i class="fas fa-mars"> </i>Gallos</a>
        </li>
        <li @click="menu=2" class="nav-item active">
            <a class="nav-link" href="#"><i class="fas fa-venus"></i>Gallinas</a>
        </li>
        <li @click="menu=3" class="nav-item active">
            <a class="nav-link" href="#"><i class="fas fa-egg"></i>Crías</a>
        </li>
        
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Skarmory" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">BUSCAR</button>
        
      </form>
      <ul class="nav navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-shield"></i> Administrador
                </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><i class="fas fa-user-edit"></i> Cuenta</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                        
                        
                </div>
            </li>
        </ul>
    </div>
</nav>
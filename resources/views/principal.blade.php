<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>G. PEREZ</title>
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <link rel="shortcut icon" href="imgs/gallo-ico.png" />
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    <div id="app">
      @include('cabecera.nabvar')

      <!--contenido-->
        @yield('contenido')
      <!--Fin contenido-->
  </div>
    <footer class="app-footer">
        <div class="container">
            <div class="row">
               <div class="col-lg-4 col-md-6 col-12">
                  <div class="footer_blog_section">
                     <h6 class="text-uppercase">GALPÓN PEREZ</h6>
                     <p style="margin-top: 5px;">Sangre de gallos campeones </p>
                  </div>
               </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer_blog_section">
                        <h6 class="text-uppercase">Dirección</h6>
                        <p style="margin-top: 5px;">Direccion: Jr. Arica s/n - Pucará</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="footer_blog_section">
                        <h6 class="text-uppercase">Contacto</h6>
                        <p style="margin-top: 5px;">Celular: 982745877 ó 920125043</p>
                    </div>
                </div>
            </div>
         </div>
         <center>
            <span><a href="#">G. PEREZ</a> &copy; 2020</span>
            <span class="ml-auto">Desarrollado por <a href="#">J34N</a></span>
          </center>
    </footer>

    <script src="js/estilos.js"></script>
    <script src="js/app.js"></script>
    <script src="js/all.min.js"></script>
    
    
    
</body>
</html>
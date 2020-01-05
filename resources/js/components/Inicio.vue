<template>
    <div class="container">
    <!--INICIO-->
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            
        </ol>
        <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="imgs/garchompS.jpg" class="d-block w-100" >
                <div class="carousel-caption d-none d-md-block">
                  <h4>Garchomp</h4>
                  <p>Gallo giro prieto</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="imgs/yonduS.jpg" class="d-block w-100" >
                <div class="carousel-caption d-none d-md-block">
                  <h5>Yondu</h5>
                  <p>Gallo giro </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="imgs/skarmoryS.jpg" class="d-block w-100" >
                <div class="carousel-caption d-none d-md-block">
                  <h5>Skarmory</h5>
                  <p>El más certero</p>
                </div>
              </div>
              
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
        </a>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
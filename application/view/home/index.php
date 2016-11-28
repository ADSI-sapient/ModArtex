<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Bodega</h3>

              <p>Bodega</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck fa-lg"></i>
            </div>
            <a href="<?= URL; ?>ctrBodega/registrarInsumo" class="small-box-footer"><b>Ingresar</b>  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Ficha</h3>

              <p>Ficha Técnica</p>
            </div>
            <div class="icon">
              <i class="fa fa-puzzle-piece fa-lg"></i>
            </div>
            <a href="<?= URL; ?>ctrFicha/regFicha" class="small-box-footer"><b>Ingresar</b>  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Pedido</h3>

              <p>Pedido</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar fa-lg"></i>
            </div>
            <a href="<?= URL; ?>ctrPedido/regPedido" class="small-box-footer"><b>Ingresar</b>  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Producto</h3>

              <p>Producto Terminado</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes" aria-hidden="true"></i>
            </div>
            <a href="<?= URL; ?>ctrProductoT/existenciasProductoT" class="small-box-footer"><b>Ingresar</b>  <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="">
        <div class="">
            <div id="carousel-1" class="carousel slide" data-ride="carousel">

                <!-- Indicadores -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-1" data-slide-to="1"></li>
                    <li data-target="#carousel-1" data-slide-to="2"></li>
                    <li data-target="#carousel-1" data-slide-to="3"></li>
                </ol>
            
                <!-- Contenedor de los slide -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="http://lorempixel.com/1200/400/nature/2" alt="" class="img-responsive">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide 1</h3>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://lorempixel.com/1200/400/city/1" alt="" class="img-responsive">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide 2</h3>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://lorempixel.com/1200/400/city/5" alt="" class="img-responsive">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide 3</h3>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="http://lorempixel.com/1200/400/nature/1" alt="" class="img-responsive">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide 4</h3>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>

                </div>
                <!-- Controles -->
                <a href="#carousel-1" class="carousel-control left" role="button" data-slide="prev">
                    <span class="fa fa-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a href="#carousel-1" class="carousel-control right" role="button" data-slide="next">
                    <span class="fa fa-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
    </div>
    
</section>

<script>
    $(document).ready(function(){
        $('#carousel-1').carousel({
            interval: 5000
        });
    });
</script>
   <!--  <script src="<?= URL;?>js/docs.min.js"></script> -->
<!--     <script src="<?= URL;?>js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?= URL;?>js/jssor.slider.mini.js"></script> -->

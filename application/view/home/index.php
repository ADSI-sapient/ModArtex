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

    <div class="box">
      <div class="box-header with-border">
        <h4 class="box-title"><b>REFERENCIAS MÁS PRODUCIDAS</b></h4>
      </div>


      <div class="box-body">
        <div class="col-md-12">
          <div id="canvContenedor" class="chart row">
              <canvas id="graficosRefPro" style="height:350px"></canvas>
          </div>
        </div>
      </div>

      <div class="box-footer"></div>


    </div>

    
</section>

<script type="text/javascript">
  $(function(){
    mostrarGraficaRefHome();
  });
</script>


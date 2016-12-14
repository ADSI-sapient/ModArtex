<section class="content">
  <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><strong>MAPA DE NAVEGACIÓN</strong></h3>
      </div> 
    <br>

<div class="row col-lg-12" style="padding-bottom: 2%; padding-top: 2%;">
  <div class="col-md-offset-1">

  <div class="col-md-4">
    <p style="text-align: center; margin-right: 15%; padding-bottom: 2%;"><i class="fa fa-user fa-lg" style="font-size: 35px; color: #4579FC;"></i><br> <b>Usuario</b></p>

     <div>
      <i style="margin-left: 45px; font-size: 150%;" class="fa fa-save"></i> 
      <i style="margin-left: 155px; font-size: 150%;"  class="fa fa-list-ol col-md-offset-4"></i><br>
      <a href="<?= URL; ?>ctrUsuario/regUsuario">Registrar Usuario</a> 
      <a class="col-md-offset-3" href="<?= URL; ?>ctrUsuario/consUsuario">Listar Usuario</a>
    </div>
  </div>

  <div class="col-md-4">
      <p style="text-align: center; margin-right: 15%; padding-bottom: 2%;"> <i class="fa fa-truck fa-lg" style="font-size: 35px; color: #3FEB41"></i><br> <b>Bodega</b></p>
          
     <div>
       <i style="margin-left: 45px; font-size: 150%;" class="fa fa-save"></i> 
       <i style="margin-left: 155px; font-size: 150%;"  class="fa fa-list-ol col-md-offset-4"></i><br>
       <a href="<?= URL; ?>ctrBodega/registrarInsumo">Registrar Insumo</a>
       <a class="col-md-offset-3" href="<?= URL; ?>ctrBodega/listarInsumos">Listar Insumo</a>
       <i class="fa fa-tags col-md-offset-5" style="font-size: 150%;"></i><br>
       <a class="col-md-offset-3" href="<?= URL; ?>ctrBodega/listExistencias">Existencias Insumos</a>
    </div>        

  </div>
      
    <div class="col-md-4">
         <p style="text-align: center; margin-right: 15%; padding-bottom: 2%;"><i class="fa fa-puzzle-piece fa-lg" style="font-size: 35px; color: #DF2C2C"></i><br> <b>Ficha Técnica</b></p>

        <div>
          <i style="margin-left: 45px; font-size: 150%;" class="fa fa-save"></i> 
          <i style="margin-left: 155px; font-size: 150%;" class="fa fa-list-ol col-md-offset-4"></i><br>
          <a href="<?= URL; ?>ctrFicha/regFicha">Registrar Ficha T</a>
          <a class="col-md-offset-3" href="<?= URL; ?>ctrFicha/consFicha">Listar Fichas Técnicas</a>
        </div> 
    </div>
  </div>
</div>



<div class="row col-lg-12" style="margin-top: 13px; padding-bottom: 2%;">
    <div class="col-md-offset-1">

    <div class="col-md-4">
      <p style="text-align: center; margin-right: 15%; margin-top: 30px; padding-bottom: 2%;"><i class="fa fa-users fa-lg" style="font-size: 35px; color: #DFD02C"></i><br> <b>Cliente</b></p>

      <div>
        <i style="margin-left: 45px; font-size: 150%;" class="fa fa-save"></i> 
        <i style="margin-left: 155px; font-size: 150%;"  class="fa fa-list-ol col-md-offset-4"></i><br>
        <a href="<?= URL; ?>ctrCliente/regCliente">Registrar Cliente</a>
        <a class="col-md-offset-3" href="<?= URL; ?>ctrCliente/consCliente">Listar Cliente</a>
      </div> 
</div>    
    
      <div class="col-md-4">
       <p style="text-align: center; margin-right: 15%; margin-top: 30px; padding-bottom: 2%;"><i class="fa fa-calculator fa-lg" style="font-size: 35px; color: #EC9646"></i><br><b>Cotización</b></p>

      <div>
        <i style="margin-left: 45px; font-size: 150%;" class="fa fa-save"></i> 
        <i style="margin-left: 155px; font-size: 150%;"  class="fa fa-list-ol col-md-offset-4"></i><br>
        <a href="<?= URL; ?>ctrCotizacion/regCotizacion">Registrar Cotización</a>
        <a class="col-md-offset-2" href="<?= URL; ?>ctrCotizacion/consCotizacion">Listar Cotización</a>
      </div>  
</div>
      
    <div class="col-md-4">
        <p style="text-align: center; margin-right: 15%; margin-top: 30px; padding-bottom: 2%;"><i class="fa fa-calendar fa-lg" style="font-size: 35px; color: #5F46EC"></i><br> <b>Pedido</b></p>

       <div>
          <i style="margin-left: 45px; font-size: 150%;" class="fa fa-save"></i> 
          <i style="margin-left: 155px; font-size: 150%;"  class="fa fa-list-ol col-md-offset-4"></i><br>
          <a href="<?= URL; ?>ctrPedido/regPedido">Registrar Pedido</a>
          <a class="col-md-offset-3" href="<?= URL; ?>ctrPedido/consPedido">Listar Pedido</a>
       </div>   
    </div>

    </div>
</div>

<div class="row col-lg-12" style="margin-top: 45px;">
    <div class="form-group col-md-offset-1">

    <div class="col-md-4">
      <p style="text-align: center; margin-right: 15%; margin-top: 30px; padding-bottom: 2%;"><i class="fa fa-calendar-check-o fa-lg" style="font-size: 35px; color: #42C95B"></i><br> <b>Producción</b></p>

      <div>  
        <i style="margin-left: 45px; font-size: 150%;" class="fa fa-save"></i> 
        <i style="margin-left: 155px; font-size: 150%;"  class="fa fa-list-ol col-md-offset-4"></i><br>
        <a href="<?= URL; ?>ctrProduccion/regOrden">Registrar Orden</a>
        <a class="col-md-offset-3" href="<?= URL; ?>ctrProduccion/consOrden">Listar Órdenes</a>
      </div> 
</div>    
    
      <div class="col-md-4">
       <p style="text-align: center; margin-right: 15%; margin-top: 30px; padding-bottom: 2%;"><i class="fa fa-dropbox fa-lg" style="font-size: 35px; color: #CE5C52"></i><br><b>Producto Terminado</b></p>

      <div>
        <i style="margin-left: 135px; font-size: 150%;" class="fa fa-tags"></i><br>
        <a style="margin-left: 45px;" href="<?= URL; ?>ctrProductoT/existenciasProductoT">Existencias Producto Terminado</a>
      </div>  
</div>
      
    <div class="col-md-4">
        <p style="text-align: center; margin-right: 15%; margin-top: 30px; padding-bottom: 2%;"><i class="fa fa-signal fa-lg" style="font-size: 35px; color: #8C52CE"></i><br> <b>Objetivos</b></p>

       <div>
          <i style="margin-left: 45px; font-size: 150%;" class="fa fa-save"></i> 
          <i style="margin-left: 155px; font-size: 150%;"  class="fa fa-list-ol col-md-offset-4"></i><br>
          <a href="<?= URL; ?>ctrObjetivos/registrarObjetivo">Registrar Objetivos</a>
          <a class="col-md-offset-2" href="<?= URL; ?>ctrObjetivos/listarObjetivos">Listar Objetivos</a>
       </div>   
    </div>

    </div>
</div>


<div class="row col-lg-12" style="margin-top: 30px; padding-bottom: 2%;">
    <div class="col-md-offset-1">

    <div class="col-md-4">
      <p style="text-align: center; margin-right: 15%; margin-top: 30px;"><i class="fa fa-cogs fa-lg" style="font-size: 35px; color: #5452CE"></i><br> <b>Configuración</b></p>

      <div>
          <i style="margin-left: 24px; font-size: 150%;" class="fa fa-save"></i>
          <i style="text-align: bottom; font-size: 150%;" class="fa fa-list-ol col-md-offset-3"></i>
          <i style="margin-left: 65px; font-size: 150%;" class="fa fa-universal-access col-md-offset-3"></i><br>
          <a class="col-md-push-1" href="<?= URL; ?>ctrConfiguracion/listarMedidas">Medidas</a>
          <a class="col-md-offset-2" href="<?= URL; ?>ctrConfiguracion/listarColores">Colores</a>
          <a class="col-md-offset-2" href="<?= URL; ?>ctrConfiguracion/RegistrarRoles">Roles</a>
       </div>

    </div>
</div>

</div>
    <div class="box-footer" style="margin-top: 602px;" >
  </div>
</section>

<style type="text/css">
  
  a{
    color: black;
  }
</style>


<section class="content">
  <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><strong>MAPA DE NAVEGACIÓN</strong></h3>
      </div> 
    <br>

<div class="row col-lg-12">
  <div class="form-group col-md-offset-1">

  <div class="col-md-4">
    <p style="text-align: center; margin-right: 15%;"><i class="fa fa-user fa-lg" style="font-size: 35px;"></i><br> Usuario</p>

     <div>
      <i style="margin-left: 45px;" class="fa fa-sitemap"></i> 
      <i style="text-align: bottom;"  class="fa fa-bars col-md-offset-4"></i><br>
      <a href="<?= URL; ?>ctrUsuario/regUsuario">Registrar Usuario</a> 
      <a class="col-md-offset-1" href="<?= URL; ?>ctrUsuario/consUsuario">Listar Usuario</a>
    </div>

  </div>  

  <div class="col-md-4">
      <p style="text-align: center; margin-right: 15%;"> <i class="fa fa-truck fa-lg" style="font-size: 35px;"></i><br> Bodega</p>
          
     <div>
       <i style="margin-left: 45px;" class="fa fa-sitemap"></i> 
       <i style="text-align: bottom;" class="fa fa-bars col-md-offset-4"></i><br>
       <a href="<?= URL; ?>ctrBodega/registrarInsumo">Registrar Insumo</a>
       <a class="col-md-offset-1" href="<?= URL; ?>ctrBodega/listarInsumos">Listar Insumo</a>
       <i class="fa fa-sitemap col-md-offset-5"></i><br>
       <a class="col-md-offset-3" href="<?= URL; ?>ctrBodega/listExistencias">Existencias Insumos</a>
    </div>        

  </div>
      
    <div class="col-md-4">
         <p style="text-align: center; margin-right: 15%;"><i class="fa fa-puzzle-piece fa-lg" style="font-size: 35px;"></i><br> Ficha Tecnica</p>

        <div>
          <i style="margin-left: 45px;"class="fa fa-sitemap"></i> 
          <i style="text-align: bottom;" class="fa fa-bars col-md-offset-4"></i><br>
          <a href="<?= URL; ?>ctrFicha/regFicha">Registrar Ficha T</a>
          <a class="col-md-offset-1" href="<?= URL; ?>ctrFicha/consFicha">Listar Ficha T</a>
        </div> 
    </div>

  </div>
</div>



<div class="row col-lg-12" style="margin-top: 13px;">
    <div class="form-group col-md-offset-1">

    <div class="col-md-4">
      <p style="text-align: center; margin-right: 15%; margin-top: 30px;"><i class="fa fa-users fa-lg" style="font-size: 35px;"></i><br> Cliente</p>

      <div>  
        <i style="margin-left: 45px;" class="fa fa-sitemap"></i>
        <i style="text-align: bottom;" class="fa fa-bars col-md-offset-4"></i><br>
        <a href="<?= URL; ?>ctrCliente/regCliente">Registrar Cliente</a>
        <a class="col-md-offset-1" href="<?= URL; ?>ctrCliente/consCliente">Listar Cliente</a>
      </div> 
</div>    
    
      <div class="col-md-4">
       <p style="text-align: center; margin-right: 15%; margin-top: 30px;"><i class="fa fa-calculator fa-lg" style="font-size: 35px;"></i><br>Cotización</p>

      <div>
        <i style="margin-left: 45px;" class="fa fa-sitemap"></i> 
        <i style="text-align: bottom;" class="fa fa-bars col-md-offset-5"></i><br>
        <a href="<?= URL; ?>ctrCotizacion/regCotizacion">Registrar Cotización</a>
        <a class="col-md-offset-1" href="<?= URL; ?>ctrCotizacion/consCotizacion">Listar Cotización</a>
      </div>  
</div>
      
    <div class="col-md-4">
        <p style="text-align: center; margin-right: 15%; margin-top: 30px;"><i class="fa fa-calendar fa-lg" style="font-size: 35px;"></i><br> Pedido</p>

       <div>
          <i style="margin-left: 45px;" class="fa fa-sitemap"></i>
          <i style="text-align: bottom;" class="fa fa-bars col-md-offset-4"></i><br>
          <a href="<?= URL; ?>ctrPedido/regPedido">Registrar Pedido</a>
          <a class="col-md-offset-1" href="<?= URL; ?>ctrPedido/consPedido">Listar Pedido</a>
       </div>   
    </div>

    </div>
</div>

<div class="row col-lg-12" style="margin-top: 45px;">
    <div class="form-group col-md-offset-1">

    <div class="col-md-4">
      <p style="text-align: center; margin-right: 15%; margin-top: 30px;"><i class="fa fa-calendar fa-lg" style="font-size: 35px;"></i><br> Producción</p>

      <div>  
        <i style="margin-left: 45px;" class="fa fa-sitemap"></i>
        <i style="text-align: bottom;" class="fa fa-bars col-md-offset-4"></i><br>
        <a href="<?= URL; ?>ctrProduccion/regOrden">Registrar Orden</a>
        <a class="col-md-offset-1" href="<?= URL; ?>ctrProduccion/consOrden">Listar Ordenes</a>
      </div> 
</div>    
    
      <div class="col-md-4">
       <p style="text-align: center; margin-right: 15%; margin-top: 30px;"><i class="fa fa-dropbox fa-lg" style="font-size: 35px;"></i><br>Producto Terminado</p>

      <div>
        <i style="margin-left: 107px;" class="fa fa-sitemap"></i><br>
        <a style="margin-left: 30px;" href="<?= URL; ?>ctrProductoT/existenciasProductoT">Existencias Producto Terminado</a>
      </div>  
</div>
      
    <div class="col-md-4">
        <p style="text-align: center; margin-right: 15%; margin-top: 30px;"><i class="fa fa-signal fa-lg" style="font-size: 35px;"></i><br> Objetivos</p>

       <div>
          <i style="margin-left: 45px;" class="fa fa-sitemap"></i>
          <i style="text-align: bottom;" class="fa fa-bars col-md-offset-5"></i><br>
          <a href="<?= URL; ?>ctrObjetivos/registrarObjetivo">Registrar Objetivos</a>
          <a class="col-md-offset-1" href="<?= URL; ?>ctrObjetivos/listarObjetivos">Listar Objetivos</a>
       </div>   
    </div>

    </div>
</div>


<div class="row col-lg-12" style="margin-top: 30px;">
    <div class="form-group col-md-offset-1">

    <div class="col-md-4">
      <p style="text-align: center; margin-right: 15%; margin-top: 30px;"><i class="fa fa-cogs fa-lg" style="font-size: 35px;"></i><br> Configuración</p>

      <div>
          <i style="margin-left: 24px;" class="fa fa-sitemap"></i>
          <i style="text-align: bottom;" class="fa fa-bars col-md-offset-3"></i>
          <i class="fa fa-sitemap col-md-offset-3"></i><br>
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
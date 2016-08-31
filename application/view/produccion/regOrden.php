
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="../../starter2.html"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Producción</a></li>
    <li class="active">Registrar Orden</li>
  </ol>
</section>

<section class="content">
 <br>
 <div>
  <div  class="box box-info">
    <div class="box-header with-border" style="text-align: center;">
      <h1 class="box-title"><strong>REGISTRAR ORDEN</strong></h1>
    </div>
    <div style="padding-left: 8%;">
    <form class="" role="form">
      <div class="row">
      <div class="form-group col-lg-4">
        <label class="">Fecha Registro</label>
        <div class="">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker" value="20/04/2016" disabled>
          </div>
        </div>
      </div>
      <div class="form-group col-lg-offset-1 col-lg-4">
        <label class="">Fecha de Terminación</label>
        <div class="">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker" >
          </div>
        </div>
      </div>
      <div class="form-group  col-lg-3">
      <div style="">
        <button style="margin-top: 10%;" class="btn btn-info btn-md">Asociar Pedido</button>
      </div>
      </div>
      </div>
      <div class="row">
      <div class="form-group col-lg-4">
        <label for="estado" class="">Estado</label>
        <select class="form-control ">
          <option value="opcion1" selected>Producción</option>
          <option value="opcion2">Cálidad</option>
          <option value="opcion3">Terminado </option>
        </select>
      </div>
     <div class="form-group col-lg-offset-1 col-lg-3">
      <label for="lugar" class="">Lugar</label>
      <select class="form-control ">
        <option value="opcion1" selected>Fábrica</option>
        <option value="opcion2">Satélite</option>
      </select>

    </div>
    </div>
    <div class="table table-responsive">
     <h4>Producto Terminado Seleccionado</h4>

     <table class="table table-hover">
      <thead>
        <tr>
          <th class="col-lg-2">#</th>
          <th class="col-lg-2">Referencia</th>
          <th class="col-lg-2">Talla</th>
          <th class="col-lg-2">Disponible</th>
          <th class="col-lg-2">Cantidad</th>
          <th style="width: 40px">Quitar</th>
          <th><button type="button" class="btn btn-default btn-xs" type="button"><b>+</b></button></th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>1</td>
          <td>201</td>
          <td>S</td>
          <td>30</td>
          <td>10</td>
          <td><button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button></td>
        </tr>


        <tr>
          <td>2</td>
          <td>203</td>
          <td>L</td>
          <td>45</td>
          <td>5</td>
          <td><button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button></td>
        </tr>

      </tbody>
    </table>
    
  </div>
  <div class="box-footer">
    <div class="box-tools">
      <ul class="pagination pagination-sm no-margin pull-right">
        <li class="disabled"><a href="#">«</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">»</a></li>
      </ul>
    </div>
  </div>
  <div class="row text-right" style="margin-right: 2%;">
    <div class="form-group col-lg-04 " >
      <button type="button" class="btn btn-primary  col-lg-offset-9" style="margin-top: 15px;" data-toggle="modal" data-target="#regiOrden">Registrar</button>
      <button type="reset" class="btn btn-danger" style="margin-left: 15px; margin-top: 15px;">Cancelar</button>
    </div>
  </div>
</form>
</div>
<div class="modal fade" id="regiOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
      </div>
      <div class="modal-body">
        Orden de Producción Registrada Existosamente!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</div>
</section>

<div class="modal fade" id="myModaln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Seleccionar Producto Terminado</h4>
        <br>
        
      </div>
      <div class="modal-body">
       <div class="box-body  ">


        <!-- /.box-header -->
        <table class="table table-hover col-lg-12">
          <thead>
            <tr class="info">
              <th class="col-lg-2">#</th>
              <th class="col-lg-2">Referencia</th>
              <th class="col-lg-2">Talla</th>
              <th class="col-lg-2">Disponible</th>
              <th class="col-lg-2">Cantidad</th>
              <th char="col-lg-2" >Seleccionar</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td>201</td>
              <td>S</td>
              <td>30</td>
              <td> <input type="text" class="form-control" id="Numero_de_orden" placeholder="" value="10"></td>
              <td><input type="checkbox"></td>
            </tr>


            <tr>
              <td>2</td>
              <td>203</td>
              <td>L</td>
              <td>45</td>
              <td> <input type="text" class="form-control" id="Numero_de_orden" placeholder="" value="15"></td>
              <td><input type="checkbox"></td>
            </tr>

          </tbody>
        </table>
        <!--Termina tabla colores seleccionados-->
        
        <div class="box-footer">
          <div class="box-tools">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li class="disabled"><a href="#">«</a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">»</a></li>
            </ul>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


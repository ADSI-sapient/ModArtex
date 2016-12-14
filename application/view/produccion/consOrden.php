    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Producción</a></li>
        <li class="active">Consultar Orden</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title" style="margin-top: 0.7%;"><strong>LISTAR ÓRDENES DE PRODUCCIÓN</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaProduccion" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
        </div>
        <div id="ordenesP" class="box-body" style="padding-top: 20px;">
          <?php foreach ($ordenesProduccion as $ordenProduccion): ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
            <?php if ($ordenProduccion["Id_Estado"] == 5): ?>
              <div class="info-box bg-aqua">
            <?php endif ?>
            <?php if ($ordenProduccion["Id_Estado"] == 6): ?>
              <div class="info-box bg-green">
            <?php endif ?>
            <?php if ($ordenProduccion["Id_Estado"] == 4 || $ordenProduccion["Id_Estado"] == 7): ?>
              <div class="info-box bg-gray">
            <?php endif ?>      
              <span class="info-box-icon">
                 <?php if ($ordenProduccion["LugarProduccion"] == "Fábrica"): ?>
                    <i style="margin-top: 10%" class="fa fa-industry">
                      <span class="info-box-text" style="margin-top: 5%">Fábrica</span>
                    </i>
                 <?php endif ?>    
                 <?php if ($ordenProduccion["LugarProduccion"] == "Satélite"): ?>  
                    <i style="margin-top: 15%" class="fa fa-bookmark-o">
                       <span class="info-box-text">Satélite</span>
                    </i>
                 <?php endif ?> 
                 <?php if ($ordenProduccion["LugarProduccion"] == "Fábrica-Satélite"): ?>  
                    <i style="margin-top: 10%" class="fa fa-star-half-o">
                      <span class="info-box-text">Fábrica <br> Satélite</span>
                    </i>
                 <?php endif ?> 
              </span>
  
                <div >
                  <span style="margin-left: 45%;" class="info-box-text">
                  <?php if ($ordenProduccion["Nombre_Estado"] == "Terminado") {
                    echo "Terminada";
                  }else{
                    echo $ordenProduccion["Nombre_Estado"];
                  }
                  ?>
                  </span>
                  <span style="margin-left: 45%;" class="info-box-number"><?= $ordenProduccion["Fecha_Entrega"] ?></span>
  
                  <div class="progress">
                  <?php if ($ordenProduccion["Id_Estado"] == 5): ?>
                    <div class="progress-bar" style="width: 33%"></div>
                  <?php endif ?>
                  <?php if($ordenProduccion["Id_Estado"] == 6): ?>
                    <div class="progress-bar" style="width: 66%"></div>
                  <?php endif ?>
                  <?php if ($ordenProduccion["Id_Estado"] == 7): ?>
                    <div class="progress-bar" style="width: 100%"></div>
                  <?php endif ?>
                    <?php if ($ordenProduccion["Id_Estado"] == 4): ?>
                      <div class="progress-bar" style="width: 1%"></div>
                    <?php endif ?>
                  </div>
                    <span class="progress-description">





                    <?php if ($ordenProduccion["Id_Estado"] == 5): ?>
                      <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#mdlEditOrdenP" id="btnAgregar<?= $b; ?>" onclick="editarOrdeP('<?= $ordenProduccion["Num_Orden"] ?>', '<?= $ordenProduccion["Fecha_Registro"] ?>', '<?= $ordenProduccion["Fecha_Entrega"] ?>', '<?= $ordenProduccion["Id_Estado"] ?>', '<?= $ordenProduccion["LugarProduccion"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>', '<?= $ordenProduccion["Nombre"] ?>', '<?= $ordenProduccion["Id_Solicitudes_Tipo"] ?>'); FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>')"><i style="color: green; font-size: 150%;" class="fa fa-pencil-square-o" name="btncarg"></i></button>  
                    <?php endif ?>

                    <?php if ($ordenProduccion["Id_Estado"] == 6): ?>
                      <button onclick="generarOrden('<?= $ordenProduccion["Num_Orden"] ?>', '<?= $ordenProduccion["LugarProduccion"] ?>', '<?= $ordenProduccion["Fecha_Registro"] ?>', '<?= $ordenProduccion["Fecha_Entrega"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>', '<?= $ordenProduccion["Nombre"] ?>')" type="button" class="btn btn-box-tool" ><i class="fa fa-file-pdf-o fa-lg" style="font-size: 150%;"></i></button>
                    <?php endif ?> 
                    <?php if ($ordenProduccion["Id_Estado"] == 5 || $ordenProduccion["Id_Estado"] == 6): ?>

                      <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool" onclick="cancelarOrdenP('<?= $ordenProduccion["Num_Orden"] ?>', '<?= $ordenProduccion["Id_Solicitud"] ?>');" id="btn-cancel-ord"><i class="fa fa-ban" style="color:red; font-size: 150%"></i></button>

                      <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#detalleOrden" onclick="FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>'); detalleProd('<?= $ordenProduccion["Fecha_Registro"] ?>', '<?= $ordenProduccion["Fecha_Entrega"] ?>', '<?= $ordenProduccion["Nombre_Estado"] ?>', '<?= $ordenProduccion["LugarProduccion"] ?>', '<?= $ordenProduccion["Nombre"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>');"><i style="color: blue; font-size: 150%;" class="fa fa-eye" name="btncarg"></i></button>
                    <?php endif ?>

                    <?php if ($ordenProduccion["Id_Estado"] == 6): ?>
                      <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool" onclick="FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>')" data-toggle="modal" data-target="#seguimientoProduccion"><i class="fa fa-tasks" style="color:white; font-size: 150%"></i></button>
                    <?php endif ?> 

                    <?php if ($ordenProduccion["Id_Estado"] == 5): ?> 
                      <button style="margin: 0; padding: 0" type="button" onclick="cambiarEstadoOrdenPro(<?= $ordenProduccion["Num_Orden"] ?>)" class="btn btn-box-tool"><i class="fa fa-arrow-circle-right" style="color: green; font-size: 150%"></i></button>
                    <?php endif ?>
                    <?php if ($ordenProduccion["Id_Estado"] == 4 || $ordenProduccion["Id_Estado"] == 7): ?>    
                    <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#detalleOrden" onclick="FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>'); detalleProd('<?= $ordenProduccion["Fecha_Registro"] ?>', '<?= $ordenProduccion["Fecha_Entrega"] ?>', '<?= $ordenProduccion["Nombre_Estado"] ?>', '<?= $ordenProduccion["LugarProduccion"] ?>', '<?= $ordenProduccion["Nombre"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>');"><i style="color: blue; font-size: 150%;" class="fa fa-eye" name="btncarg"></i></button>
                    <?php endif ?>    
                    </span>
                </div>
              </div>
          </div>
        <?php endforeach ?>
        </div>
      </div>
    </section> 
  <!-- Incio modal modificar orden -->


    <div class="modal fade" id="mdlEditOrdenP" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div style="width: 70% !important;" class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>MODIFICAR ORDEN DE PRODUCCIÓN</b></h4>
            </div>
            <form role="form" action="" method="post" id="dtllOrden" data-parsley-validate="">
            <input type="hidden" id="idSolPed" name="idSolPed">
            <input type="hidden" id="idSolPedAnt" name="idSolPedAnt">
            <div class="modal-body" style="padding:10px;">
              <input type="hidden" name="numOrdenp" id="numOrdenp">
              <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6">
                <div class="form-group">
                  <label class="">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" readonly type="text" id="fecha_regOp" style="border-radius:5px;">
                  </div>
                  </div>
                </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="">*Fecha Terminación:</label>
                      <div class="input-group">
                        <div class="input-group-addon" style="border-radius:5px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" name="fecha_entregaOp" id="fecha_entregaOp" readonly="" style="border-radius:5px;">
                      </div>
                    </div>
                    </div>
                    </div>
              </div>  
              <div class="row">
              <div class="col-sm-12">
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="estadoOp" class="">Estado:</label>
                    <input type="text" class="form-control" value="Pendiente" readonly="" style="border-radius:5px;">
                </div>
               </div>
                <div class="col-sm-6">
                  <div class="form-group "> 
                     <label for="clienteOrdn" class="">Cliente:</label>
                     <input type="text" id="clienteAsoPedProd" readonly="" name="" class="form-control">
                  </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
               <div class="col-sm-6"> 
                   <div class="form-group">
                    <label for="clienteOrdn" class="">Pedidos:</label>
                    <br>
                    <select onchange="asoPedAOrden(this);" class="form-control" name="clienteOrdn" id="clienteOrdn" style="width: 100%;" >
                      <option selected="selected"></option>
                      <?php foreach ($pedidosCliente as $cliente): ?>
                        <option value="<?= $cliente["Id_Solicitud"] ?>"><?= $cliente["Nombre"] ." - Pedido: ". $cliente["Id_Solicitud"]?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                 </div>
                 <div class="form-group col-sm-6">
                    <div class="form-group">
                    <label for="lugarOp" class="">*Lugar Producción:</label>
                    <select onchange="selLugOrdSol()" class="form-control" name="lugarOp" id="lugarOp" style="border-radius:5px;" >
                      <option value="Fábrica">Fábrica</option>
                      <option value="Satélite">Satélite</option>
                      <option value="Fábrica-Satélite">Fábrica/Satélite</option>
                    </select>
                </div>
                </div>
                </div>
            </div>    
                  <!-- <button type="button" class="btn btn-primary pull-right" style="margin-top: 4.7%; margin-right:2.6%;" data-toggle="modal" data-target="#asociarPedidMod">Asociar Pedido</button> -->
           <div class="row">   
           <div class="col-sm-12">       
           <div class="col-sm-12">      
            <div class="table scrolltablas">
              <div class="table-responsive">
                <table class="table table-hover" id="tblFichasProducc">
                  <thead>
                    <tr class="active">
                      <th style="display: none;"></th>
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Muestra</th>
                      <th>Color</th>
                      <th>Talla</th>
                      <th>Cantidad Total</th>
                      <th>Cantidad Fábrica</th>
                      <th>Cantidad Satélite</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            </div>
          </div>



            </div>
            <div class="modal-footer" >
              <div class="row col-lg-12">
                <div class="row">
                  <div class="col-md-offset-3 col-md-3">
                    <button type="button" onclick="actualizarOrdenProd();" class="btn btn-warning btn-md btn-block" name="btnModificarOrd"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>      
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-default btn-md btn-block" data-dissmis="modal" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>





      <!-- fin modal modificar orden-->
      <!-- Inicio Modal asociar pedidos -->
      <div class="modal fade" id="asociarPedidMod" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>PEDIDOS PARA PRODUCIR</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-responsive table-hover" style="margin-top: 2%;" id="">
                    <thead>
                      <tr class="info">
                        <th style="width: 10px">#</th>
                        <th>Fecha Registro</th>
                        <th>Fecha Entrega</th>
                        <th>Valor Total</th>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th style="width: 7%">Detalle</th>
                        <th style="width: 7%">Agregar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pedidosProdu as $pedido): ?>
                      <tr>
                        <td><?= $pedido["Id_Solicitud"] ?></td>
                        <td class="freg"><?= $pedido["Fecha_Registro"] ?></td>
                        <td class="ftga"><?= $pedido["Fecha_Entrega"] ?></td>
                        <td class="vtal"><?= $pedido["Valor_Total"] ?></td>
                        <td><?= $pedido["Nombre_Estado"] ?></td>
                        <td class="nomclte"><?= $pedido["Nombre"] ?></td>
                        <td>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#" id="" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', 0)"><i class="fa fa-eye fa-lg" style="color:#3B73FF"></i></button>
                        </td>
                        <td>
                          <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', '<?= $pedido["Fecha_Entrega"] ?>', 2)"><i class="fa fa-plus"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php $i++; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="border-top:0px;">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- Fin modal asociar pedidos -->








      <div class="modal fade" id="devolverInsumos" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>PRODUCTOS PENDIENTES</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-md-12 table-responsive">
                  <table class="table table-responsive table-hover" style="margin-top: 2%;" id="">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Referencia</th>
                        <th>Muetra</th>
                        <th>Color</th>
                        <th>Cantidad Pedida</th>
                        <th>Cantidad Realizada</th>
                      </tr>
                    </thead>
                    <tbody id="tbodyDevolverInsumos">
                    </tbody>
                  </table>
                </div>
              </div>     
            </div>
            <div class="modal-footer" style="border-top:0px;">
              <input type="hidden" id="idOrdenHidden" name="">
              <button type="button" onclick="devolverInsumos()" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Aceptar</button>
            </div>
          </div>
        </div>
      </div>






      <div class="modal fade" id="seguimientoProduccion" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>SEGUIMIENTO PRODUCCIÓN</b></h4>
            </div>
          <div class="modal-body">
          <input type="hidden" id="docClienteSeg">          
          <input type="hidden" id="numOrdSegu">          
           <div class="row">       
            <div class="table">
              <div class="col-sm-12 table-responsive" id="scrollSeguProd">
                <table class="table table-responsive table-hover" id="tblSegFichOrdPro">
                <style type="text/css">
                  #scrollSeguProd{
                    height: 300px;
                    overflow-y: scroll;
                  }
                </style>
                  <thead>
                    <tr class="active">
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Muestra</th>
                      <th>Color</th>
                      <th>Talla</th>
                      <th>Cantidad Producir</th>
                      <th>Lugar</th>
                      <th>Estado</th>
                      <th>Progreso</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>  
            <div class="modal-footer">
              <div class="row col-lg-12">
                <div class="row">
                  <div class="col-md-offset-3 col-md-3">
                    <button type="button" onclick="actualizarEstadoSolProducto()" class="btn btn-warning btn-md btn-block" name="btnModificarOrd"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-default btn-md btn-block" data-dissmis="modal" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




<div class="modal fade" id="datosSatelite" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>INFORMACIÓN PARA SATELITE</b></h4>
            </div>
        <form  id="frmGenerarOrden" target="_blank" action="<?= URL ?>ctrProduccion/orden/0/0/0/0/0" method="POST" data-parsley-validate="">
        <input type="hidden" id="numGenOrd" name="numGenOrd">
        <input type="hidden" id="lugGenOrd">
        <div class="modal-body">      
        <div class="row">
          <div class="form-group col-md-12">
            <div class="col-md-6">
              <label  class="">Fecha Actual: </label>
              <input readonly="" type="text" class="form-control" value="<?php echo date("Y-m-d");?>" name="fechaAct">
            </div>
            <div class="col-md-6">
              <label  class="">*Nombre del Responsable: </label>
              <input type="text" data-parsley-required='' class="form-control" placeholder="" name="nombre" maxlength="45">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <div class="col-md-6">
              <label  class="">*Fecha Entrega: </label>
              <input type="text" id="fechaEnt" data-parsley-required='' class="form-control" placeholder="" name="fechaEnt">
            </div>
            <div class="col-md-6">
              <label  class="">*Ciudad/País: </label>
              <input type="text" data-parsley-required='' class="form-control" placeholder="" name="paisCiudad" maxlength="45">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <div class="col-md-12">
              <label  class="">Observaciones: </label>
              <textarea type="text" name="observaciones" class="form-control" maxlength="100"> </textarea>
            </div>  
          </div>
        </div>

          </div>  
            <div class="modal-footer">
              <div class="row col-lg-12">
                <div class="row">
                  <div class="col-md-offset-3 col-md-3">
                    <button type="submit" class="btn btn-warning btn-md btn-block" name="btnModificarOrd"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Generar</b></button>
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-default btn-md btn-block" data-dissmis="modal" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
           </form> 
          </div>
        </div>
      </div>





    <div class="modal fade" id="detalleOrden" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div style="width: 70% !important;" class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>DETALLE ORDEN DE PRODUCCIÓN</b></h4>
            </div>
            <form role="form" action="" method="post" id="dtllOrden" data-parsley-validate="">
            <input type="hidden" id="idSolPed" name="idSolPed">
            <input type="hidden" id="idSolPedAnt" name="idSolPedAnt">
            <div class="modal-body" style="padding:10px;">
              <input type="hidden" name="numOrdenp" id="numOrdenp">
              <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-6">
                <div class="form-group">
                  <label class="">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" readonly type="text" id="fechaRegDetalle" style="border-radius:5px;">
                  </div>
                  </div>
                </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label class="">*Fecha Terminación:</label>
                      <div class="input-group">
                        <div class="input-group-addon" style="border-radius:5px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" readonly="" class="form-control" name="fecha_entregaOp" id="fechaTerDetalle" style="border-radius:5px;">
                      </div>
                    </div>
                    </div>
                    </div>
              </div>  
              <div class="row">
              <div class="col-sm-12">
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="estadoOp" class="">Estado:</label>
                    <input id="estadoDetalle" type="text" class="form-control" value="Pendiente" readonly="" style="border-radius:5px;">
                </div>
               </div>
                <div class="col-sm-6">
                  <div class="form-group "> 
                     <label for="clienteOrdn" class="">Cliente:</label>
                     <input type="text" id="clienteDetalleProd" readonly="" name="" class="form-control">
                  </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                 <div class="form-group col-sm-6">
                    <div class="form-group">
                    <label for="lugarOp" class="">*Lugar Producción:</label>
                    <input  name="" disabled="" class="form-control" name="lugarOp" id="lugarProdDetalle">
                </div>
                </div>
                </div>
            </div>    
           <div class="row">   
           <div class="col-sm-12">       
           <div class="col-sm-12">      
            <div class="table scrolltablas">
              <div class="table-responsive">
                <table class="table table-hover" id="tblFichasProduccDet">
                  <thead>
                    <tr class="active">
                      <th style="display: none;"></th>
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Muestra</th>
                      <th>Color</th>
                      <th>Talla</th>
                      <th>Cantidad Total</th>
                      <th>Cantidad Fábrica</th>
                      <th>Cantidad Satélite</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            </div>
          </div>
            </div>
            <div class="modal-footer" >
              <div class="row col-lg-12">
                <div class="row">
                  <div class="col-md-offset-9 col-md-3">
                    <button type="button" class="btn btn-default btn-md btn-block" data-dissmis="modal" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>


      <div class="modal fade" id="ModAyudaProduccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
            <ol class="c17 lst-kix_list_11-0" start="8"><li class="c1 c16 c2"><h1 id="h.302dr9l" style="display:inline"><span>PRODUCCI&Oacute;N</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En este m&oacute;dulo, se gestiona la informaci&oacute;n del proceso de producci&oacute;n del producto. Solo tendr&aacute; acceso el rol administrador u otro rol que tenga este permiso asignado.</span></p><p class="c0"><span></span></p><h2 class="c0 c2"><span></span></h2><h2 class="c1 c2" id="h.1f7o1he"><span>9.1 REGISTRAR ORDEN DE PRODUCCI&Oacute;N</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Al momento de registrar una orden de producci&oacute;n, el formulario deshabilita los campos para ingresar informaci&oacute;n, por lo que se debe asociar un pedido. Al dar clic en el bot&oacute;n asociar, aparecen los pedidos que se encuentran en estado pendiente, al dar clic en el icono de agregar, los datos del formulario se cargan autom&aacute;ticamente con la informaci&oacute;n del pedido seleccionado. Ver </span><span class="c3">Figura 76. Registrar orden.</span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>&nbsp;</span></p><p class="c6 c1 c2" id="h.3z7bk57"><span class="c5 c4">Figura 76. Registrar orden</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image61.png" style="width: 589.23px; height: 382.15px; margin-left: -0.00px; margin-top: -33.92px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2eclud0"><span class="c4 c3">9.1.1 Seleccionar lugar</span><span>: En el formulario aparece la opci&oacute;n de seleccionar lugar para la orden de producci&oacute;n. Ver </span><span class="c3">Figura 77. Seleccionar lugar de producci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.thw4kt"><span class="c5 c4">Figura 77. Seleccionar lugar de producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image62.png" style="width: 589.23px; height: 415.01px; margin-left: -0.00px; margin-top: -37.93px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3dhjn8m"><span class="c4 c3">9.1.1.1: F&aacute;brica</span><span>. Si se selecciona la opci&oacute;n de f&aacute;brica, significa que la orden va a pasar el proceso de producci&oacute;n dentro de la misma empresa, el sistema no solicita informaci&oacute;n, se le puede dar clic al bot&oacute;n &ldquo;Registrar&rdquo; sin ninguna condici&oacute;n. Ver </span><span class="c3">Figura 78. Lugar-Fabrica.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1smtxgf"><span class="c5 c4">Figura 78. Lugar-Fabrica</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.20px; height: 262.05px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image63.png" style="width: 589.20px; height: 331.27px; margin-left: -0.00px; margin-top: -32.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.4cmhg48"><span class="c4 c3">9.1.1.2 Sat&eacute;lite</span><span>. Al seleccionar la opci&oacute;n de sat&eacute;lite, se da a entender que el proceso de producci&oacute;n de la orden se va a realizar en otro lugar, el sistema no solicita informaci&oacute;n, se le puede dar clic al bot&oacute;n &ldquo;Registrar&rdquo; sin ninguna condici&oacute;n. Ver </span><span class="c3">Figura 79. Lugar-Sat&eacute;lite.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.2rrrqc1"><span class="c5 c4">Figura 79. Lugar-Sat&eacute;lite</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image64.png" style="width: 589.23px; height: 374.73px; margin-left: -0.00px; margin-top: -32.29px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.16x20ju"><span class="c4 c3">9.1.1.3 F&aacute;brica-Sat&eacute;lite</span><span>. Al seleccionar esta opci&oacute;n, el sistema cuenta con que la producci&oacute;n se va a realizar una parte dentro de la empresa y el resto en otro lugar, por esto se solicita ingresar la cantidad que se va a producir en f&aacute;brica y en otro campo la cantidad a producir en el sat&eacute;lite. Ver </span><span class="c3">Figura 80. Lugar Fabrica-Sat&eacute;lite.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.3qwpj7n"><span class="c5 c4">Figura 80. Lugar Fabrica-Sat&eacute;lite</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.20px; height: 271.62px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image65.png" style="width: 589.20px; height: 331.27px; margin-left: -0.00px; margin-top: -29.41px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1" id="h.261ztfg"><span class="c4 c3">9.1.2 Validaciones de campos</span><span>. Al momento de dar clic en el bot&oacute;n &ldquo;Registrar&rdquo; el sistema valida que los campos est&eacute;n completos. En caso de haber una inconsistencia el sistema muestra un mensaje indicando el error. Ver </span><span class="c3">Figura 81. Validaciones de campos de orden.</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.l7a3n9"><span class="c5 c4">Figura 81. Validaciones de campos de orden</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image55.png" style="width: 589.23px; height: 367.59px; margin-left: -0.00px; margin-top: -30.71px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>En caso contrario el sistema muestra un mensaje confirmando el registro exitoso. &nbsp;</span><span class="c8 c3">Ver Figura 82. Registro exitoso de orden de producci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.356xmb2"><span class="c5 c4">Figura 82. Registro exitoso de orden de producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image56.png" style="width: 589.23px; height: 349.89px; margin-left: -0.00px; margin-top: -30.14px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.1kc7wiv"><span>9.2</span><span class="c21">&nbsp;</span><span class="c8">LISTAR &Oacute;RDENES </span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1 c26"><span>Esta opci&oacute;n permite visualizar las &oacute;rdenes de producci&oacute;n de manera &nbsp;general, cada orden es mostrada en un cuadro que contiene el estado, la fecha de terminaci&oacute;n y lugar de producci&oacute;n; tambi&eacute;n cuenta con 3 iconos, que permiten modificar y cancelar o iniciar la producci&oacute;n. A este m&oacute;dulo solo tendr&aacute; acceso el rol administrador, u otro rol que tenga este permiso asignado. Ver </span><span class="c3">Figura 83. Listar &oacute;rdenes de producci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.44bvf6o"><span class="c5 c4">Figura 83. Listar &oacute;rdenes de producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 579.02px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image57.png" style="width: 588.88px; height: 450.62px; margin-left: -0.00px; margin-top: -38.33px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2jh5peh"><span class="c4 c3">9.2.1 Modificar orden</span><span>: Para modificar una orden, se da clic sobre el icono que aparece dentro del cuadro, se permite modificar el pedido asociado y el lugar de producci&oacute;n. Ver </span><span class="c3">Figura 84. </span><span class="c8 c3">Modificar orden</span><span class="c3">. </span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.ymfzma"><span class="c5 c4">Figura 84. Modificar orden</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 388.40px; height: 220.14px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image48.png" style="width: 589.20px; height: 331.27px; margin-left: -97.84px; margin-top: -45.86px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de campos. Ver </span><span class="c3">Figura 81. Validaciones de campos de orden.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><p class="c1" id="h.3im3ia3"><span class="c4 c3">9.2.2 Cancelar orden</span><span class="c3">. </span><span>En caso de solicitar la cancelaci&oacute;n de un pedido, el icono se encuentra dentro del cuadro de cada referencia, al dar clic, sale un mansaje para confirmar la cancelaci&oacute;n. Ver </span><span class="c3">Figura 85. Cancelar orden de producci&oacute;n.</span><span>&nbsp;</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1xrdshw"><span class="c5 c4">Figura 85. Cancelar orden de producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image49.png" style="width: 1460.36px; height: 738.01px; margin-left: -468.21px; margin-top: -220.85px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.4hr1b5p"><span class="c4 c3">9.2.3 Iniciar producci&oacute;n</span><span>: Para iniciar la producci&oacute;n, se da clic en la flecha verde que est&aacute; dentro del cuadro de la referencia, aparece de inmediato un mensaje para confirmar el inicio de la orden. Ver </span><span class="c3">Figura 86. Iniciar producci&oacute;n.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.2wwbldi"><span class="c5 c4">Figura 86. Iniciar producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image50.png" style="width: 1429.93px; height: 749.68px; margin-left: -448.24px; margin-top: -226.76px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><hr style="page-break-before:always;display:none;"><p class="c0"><span></span></p><p class="c0"><span></span></p>
        </div>            
        </div>
         <div class="modal-footer">
            <div class="row">
              <div class="col-md-12">
                <button data-dismiss="modal" type="reset" class="btn btn-default pull-right" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
            </div>
         </div> 
        </div> 
      </div>
</div>
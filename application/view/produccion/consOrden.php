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
          <h3 class="box-title"><strong>LISTAR ÓRDENES DE PRODUCCIÓN</strong></h3>
        </div>
        <div id="ordenesP" class="box-body" style="padding-top: 20px;">

          <!-- <form class="form-horizontal">
            <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-bordered paginate-search-table" id="tblOrdenes">
                  <thead>
                    <tr class="">
                      <th>#</th>
                      <th>Fecha Registro</th>
                      <th>Fecha Terminación</th>
                      <th style="display: none;"></th>
                      <th>Estado</th>
                      <th>Lugar</th>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th style="text-align: center;">Editar</th>
                      <th style="text-align: center;">Generar O.P</th>
                      <th style="text-align: center;">Cancelar</th>
                      <th style="text-align: center;">Iniciar</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  <?php foreach ($ordenesProduccion as $ordenProduccion): ?>
                    <tr>
                      <td><?= $ordenProduccion["Num_Orden"] ?></td>
                      <td><?= $ordenProduccion["Fecha_Registro"] ?></td>
                      <td><?= $ordenProduccion["Fecha_Entrega"] ?></td>
                      <td style="display:none;"><?= $ordenProduccion["Id_Estado"] ?></td>
                      <td><?= $ordenProduccion["Nombre_Estado"] ?></td>
                      <td><?= $ordenProduccion["LugarProduccion"] ?></td>
                      <td style="display: none;"></td>
                      <td style="display:none;"><?= $ordenProduccion["Num_Documento"] ?></td>
                      <td style="display:none;"><?= $ordenProduccion["Id_Solicitud"] ?></td>
                      <td style="display:none;"><?= $ordenProduccion["Nombre"] ?></td>
                      <td style="text-align: center;">
                      <?php if ($ordenProduccion["Id_Estado"] != 5): ?>
                        <button disabled="" type="button" class="btn btn-box-tool"><i class="fa fa-pencil-square-o fa-lg" style="font-size: 150%;"></i></button>
                        <?php else: ?>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#mdlEditOrdenP" id="btnAgregar<?= $b; ?>" onclick="editarOrdeP('<?= $ordenProduccion["Num_Orden"] ?>', this); FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>')"><i  style="font-size: 150%;" class="fa fa-pencil-square-o fa-lg" name="btncarg"></i></button>
                      <?php endif ?>
                      </td>
                      <td style="text-align: center;">
                      <?php if ($ordenProduccion["Id_Estado"] == 4): ?>
                        <button disabled="" type="button" class="btn btn-box-tool" ><i class="fa fa-file-pdf-o fa-lg" style="font-size: 150%;"></i></button>
                        <?php else: ?>
                        <button type="button" class="btn btn-box-tool" ><i class="fa fa-file-pdf-o fa-lg" name="btncarg" style="font-size: 150%;"></i></button>
                      <?php endif ?>
                      </td>
                      <td style="text-align: center;">
                      <?php if ($ordenProduccion["Id_Estado"] == 4): ?>
                        <button disabled="" type="button" class="btn btn-box-tool"><i class="fa fa-ban fa-lg" style="color:red; font-size: 150%;"></i></button>
                      <?php else: ?>
                        <button type="button" class="btn btn-box-tool" onclick="cancelarOrdenP('<?= $ordenProduccion["Num_Orden"] ?>');" id="btn-cancel-ord"><i class="fa fa-ban fa-lg" style="color:red; font-size: 150%;"></i></button>
                      <?php endif ?>
                      </td>
                      <td style="text-align: center;">
                        <?php if ($ordenProduccion["Id_Estado"] != 5): ?>
                          <button disabled="" type="button" class="btn btn-box-tool"><i class=" fa fa-arrow-circle-right" style="color: green; font-size: 150%;"></i></button>
                        <?php else: ?>
                          <button type="button" onclick="cambiarEstadoOrdenPro(<?= $ordenProduccion["Num_Orden"] ?>)" class="btn btn-box-tool"><i class="fa fa-arrow-circle-right" style="color: green; font-size: 150%;"></i></button>
                        <?php endif ?>    
                      </td>
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </form> -->
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
                    <i style="margin-top: 15%" class="fa fa-industry">
                      <span class="info-box-text">Fábrica</span>
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
                  <span style="margin-left: 45%;" class="info-box-text"><?= $ordenProduccion["Nombre_Estado"] ?></span>
                  <span style="margin-left: 45%;" class="info-box-number"><?= $ordenProduccion["Fecha_Entrega"] ?></span>
  
                  <div class="progress">
                    <div class="progress-bar" style="width: 80%"></div>
                  </div>
                    <span class="progress-description">



                    <?php if ($ordenProduccion["Id_Estado"] == 5): ?>
                      <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#mdlEditOrdenP" id="btnAgregar<?= $b; ?>" onclick="editarOrdeP('<?= $ordenProduccion["Num_Orden"] ?>', '<?= $ordenProduccion["Fecha_Registro"] ?>', '<?= $ordenProduccion["Fecha_Entrega"] ?>', '<?= $ordenProduccion["Id_Estado"] ?>', '<?= $ordenProduccion["LugarProduccion"] ?>', '<?= $ordenProduccion["Num_Documento"] ?>', '<?= $ordenProduccion["Nombre"] ?>', '<?= $ordenProduccion["Id_Solicitudes_Tipo"] ?>'); FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>')"><i style="color: green; font-size: 150%;" class="fa fa-pencil-square-o" name="btncarg"></i></button>
                    <?php endif ?>




                    <?php if ($ordenProduccion["Id_Estado"] == 6 || $ordenProduccion["Id_Estado"] == 7): ?>
                      <button disabled="" type="button" class="btn btn-box-tool" ><i class="fa fa-file-pdf-o fa-lg" style="font-size: 150%;"></i></button>
                    <?php endif ?> 
                    <?php if ($ordenProduccion["Id_Estado"] == 5 || $ordenProduccion["Id_Estado"] == 6): ?> 
                      <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool" onclick="cancelarOrdenP('<?= $ordenProduccion["Num_Orden"] ?>');" id="btn-cancel-ord"><i class="fa fa-ban" style="color:red; font-size: 150%"></i></button>
                    <?php endif ?>

                    <?php if ($ordenProduccion["Id_Estado"] == 6): ?>
                      <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool" onclick="FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>')" data-toggle="modal" data-target="#seguimientoProduccion"><i class="fa fa-tasks" style="color:white; font-size: 150%"></i></button>
                    <?php endif ?> 

                    <?php if ($ordenProduccion["Id_Estado"] == 5): ?>    
                      <button style="margin: 0; padding: 0" type="button" onclick="cambiarEstadoOrdenPro(<?= $ordenProduccion["Num_Orden"] ?>)" class="btn btn-box-tool"><i class="fa fa-arrow-circle-right" style="color: green; font-size: 150%"></i></button>
                    <?php endif ?>
                    <?php if ($ordenProduccion["Id_Estado"] == 4): ?>    
                      <button style="margin: 0; padding: 0" type="button" class="btn btn-box-tool"><i class="fa fa-eye" style="color: blue; font-size: 150%"></i></button>
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
            <form role="form" action="<?= URL ?>ctrProduccion/editarOrdenProduccion" method="post" id="dtllOrden">
            <input type="hidden" id="idSolPed" name="idSolPed">
            <input type="hidden" id="idSolPedAnt" name="idSolPedAnt">
            <div class="modal-body" style="padding:10px;">
              <input type="hidden" name="numOrdenp" id="numOrdenp">
              <div class="row col-sm-12">
                <div class="form-group col-sm-6">
                <div class="col-sm-12">
                  <label class="">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" readonly type="text" id="fecha_regOp" style="border-radius:5px;">
                  </div>
                  </div>
                </div>
                <div class="form-group col-sm-6">
                    <div class="col-sm-12">
                    <label class="">*Fecha Terminación:</label>
                      <div class="input-group">
                        <div class="input-group-addon" style="border-radius:5px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input readonly="" type="text" class="form-control" name="fecha_entregaOp" id="fecha_entregaOp" style="border-radius:5px;">
                      </div>
                    </div>
                  </div>
              </div>  
              <div class="row col-sm-12">
              <div class="col-sm-6">
                <div class="form-group col-sm-12">
                    <label for="estadoOp" class="">Estado:</label>
                    <input type="text" class="form-control" value="Pendiente" readonly="" style="border-radius:5px;">
                </div>
               </div>
                <div class="col-sm-6">
                  <div class="form-group col-sm-12 "> 
                     <label for="clienteOrdn" class="">Cliente:</label>
                     <input type="text" id="clienteAsoPedProd" readonly="" name="" class="form-control">
                  </div>
                </div>
            </div>
            <div class="row col-sm-12">
               <div class="col-sm-6"> 
                   <div class="form-group col-sm-12 ">
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
                                    <div class="form-group col-sm-12 ">
                    <label for="lugarOp" class="">*Lugar Producción:</label>
                    <select onchange="selLugOrdSol()" class="form-control" name="lugarOp" id="lugarOp" style="border-radius:5px;" >
                      <option value="Fábrica">Fábrica</option>
                      <option value="Satélite">Satélite</option>
                      <option value="Fábrica-Satélite">Fábrica/Satélite</option>
                    </select>
                </div>
                </div>
            </div>    
                  <!-- <button type="button" class="btn btn-primary pull-right" style="margin-top: 4.7%; margin-right:2.6%;" data-toggle="modal" data-target="#asociarPedidMod">Asociar Pedido</button> -->
           <div class="row">       
           <div class="col-sm-12">       
           <div class="col-sm-12">       
            <div class="table">
              <div class="col-sm-12 table-responsive scrolltablas">
                <table class="table table-responsive table-hover" id="tblFichasProducc">
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
                    <button type="button" onclick="actualizarOrdenProd()" class="btn btn-warning btn-md btn-block" name="btnModificarOrd"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>                    
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
           <div class="row">       
            <div class="table">
              <div class="col-sm-12 table-responsive scrolltablas">
                <table class="table table-responsive table-hover" id="tblSegFichOrdPro">
                  <thead>
                    <tr class="active">
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th>Referencia</th>
                      <th>Muestra</th>
                      <th>Color</th>
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

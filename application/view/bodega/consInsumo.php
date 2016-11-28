    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Listar insumos</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR INSUMOS</strong></h3>
        </div>
        <form class="form-horizontal" id="frm" action="" method="POST">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="tableListInsumos" class="table table-bordered paginate-search-table">
                <thead>
                  <tr class="active" style="color: ">
                    <th style="width: 10px">#</th>
                    <th style="display: none;"></th>
                    <th>Nombre</th>
                    <th>Medida</th>
                    <th>Estado</th>
                    <th>Stock Mínimo</th>
                    <th style="width: 7%">Editar</th>
                    <th style="width: 7%">Estado</th>
                    <th style="width: 7%">Detalle</th>
                    <th style="display: none;"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $cont = 0;?>
                  <?php foreach ($lisInsumos as $valor): ?>  
                  <tr>
                    <td><?= $cont += 1;?></td>
                    <td style="display: none;"><?= $valor["Id_Insumo"]?></td>
                    <td><?= $valor["Nombre"]?></td>
                    <td><?= $valor["NombreMed"]?></td>
                    <?php if ($valor["Estado"] == 1): ?>
                      <td>Habilitado</td>
                    <?php else: ?>
                      <td>Inhabilitado</td>
                    <?php endif ?>  
                    <td><?= $valor["Stock_Minimo"]?></td>
                    <input type="hidden" value="<?= $valor["Estado"]?>" name="est">
                    <td style="text-align: center;">
                    <?php if ($valor["Estado"] == 1): ?>    
                      <button type="button" id="btnEditar" onclick="editInsumos(<?= $valor["Id_Insumo"]?>, this)" class="btn btn-box-tool" data-toggle="modal" data-target="#ModEditIns"><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button>
                    <?php else: ?>
                      <button type="button" disabled="" class="btn btn-box-tool"><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button>
                    <?php endif ?>    
                    </td>
                    <td style="text-align: center;">
                      <?php if ($valor["Estado"] == 1): ?>
                           <button type="button" onclick="camEst(<?= $valor["Id_Insumo"]?>, 0)" class="btn btn-box-tool"><i style="font-size: 150%;" class="fa fa-minus-circle"></i></button> 
                      <?php endif ?>
                      <?php if ($valor["Estado"] == 0): ?>
                           <button type="button" onclick="camEst(<?= $valor["Id_Insumo"]?>, 1)" class="btn btn-box-tool"><i style="font-size: 150%;" class="fa fa-check"></i></button> 
                      <?php endif ?>
                    </td> 
                    <td style="text-align: center;">
                      <button type="button" onclick="verDetalleColIns(<?= $valor["Id_Insumo"]?>)" class="btn btn-box-tool" data-toggle="modal" data-target="#detalleColIns"><i style="font-size: 150%; color: blue;" class="fa fa-eye"></i></button>
                    </td> 
                    <td style="display: none;"><?= $valor['Id_Medida']?></td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer"></div>
        </form>
      </div>
    </section>






<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ModEditIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form data-parsley-validate="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>MODIFICAR INSUMO</strong></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                   <label class="control-label">*Nombre:</label>
                   <input id="nomIns" type="text" class="form-control" data-parsley-required="" name="nombre" maxlength="45">
                </div>
               </div> 
            </div>
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">*Unidad de Medida:</label>
                    <select id="selMedInsCol" class="form-control" style="width: 100%;" data-parsley-required="" name="select">
                     <!-- <option selected=""></option> -->
                      <?php foreach ($listaM as $valor): ?>
                        <option value="<?= $valor["Id_Medida"]; ?>"><?= $valor["Nombre"]; ?></option>  
                      <?php endforeach ?>
                    </select>
                </div>
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" name="id" id="mSel">
                  <label class="control-label" length="80px">*Stock Mínimo:</label>
                    <input id="stockIns" type="number" class="form-control" min="0" data-parsley-required="" name="stock" max="9999999">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-8">
                <label class="control-label" length="80px">Valor:</label>
                <input id="checkValor" type="checkbox" class="">
                <div class="input-group">
                  <span  class="input-group-addon">$</span>
                  <input id="valColIns" readonly="" type="number" class="form-control" data-parsley-required="" min="1" name="valor">
                </div>
              </div>
              <div style="margin-top: 25px;" class="col-md-4">
                <!-- <button onclick="validateColSelec()" type="button" class="btn pull-right" data-toggle="modal"  data-target="#ModelProducto"><i style="font-size: 130%;" class="fa fa-paint-brush circleColor" aria-hidden="true"></i></button> -->
                <button type="button" class="btn pull-right" data-toggle="modal"  data-target="#ModelProducto"><i style="font-size: 130%;" class="fa fa-paint-brush circleColor" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>  
          <div class="row">
            <div class="col-md-12">
            <div class="col-md-12">
             <div class="table-responsive scrolltablas"> 
              <table class="table table-bordered">
                <thead>
                  <tr class="active">
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                    <th style="width: 10px">#</th>
                    <th>Código</th>
                    <th>Muestra</th>
                    <th>Nombre</th>
                    <th style="width: 20%">Valor</th>
                    <th style="width: 40px">Quitar</th>
                    <th style="display: none;"></th>
                  </tr>
                </thead>
                <tbody id="tbodyColIns">
                </tbody>      
              </table>
             </div>
            </div>
            </div> 
         </div>             
        </div>
         <div class="modal-footer">
            <div class="row">
              <div class="col-lg-offset-3 col-lg-3">
                <button type="button" onclick="updateColIns()" class="btn btn-warning btn-md btn-block" style="margin-left: 2%; margin-top: 2%" name="btnRegIns"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
              </div>
              <div class="col-lg-3">
                <button data-dismiss="modal" type="reset" class="btn btn-default btn-md btn-block" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
            </div>
         </div> 
         </form>
        </div> 
      </div>
    </div>




  <div class="modal fade" id="ModelProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><strong>COLORES PARA ASOCIAR</strong></h4>
      </div>
      
      <div class="col-md-6"></div>
      <div class="modal-body">
       <table id="tableCols" class="table table-hover cell-border" style="margin-bottom: 3%;">
        <thead>
          <tr>
            <th style="display: none;"></th>
            <th style="width: 10%">#</th>
            <th>Código</th>
            <th>Muestra</th>
            <th>Nombre</th>
            <th style="width: 40px">Selección</th>
          </tr>
        </thead>
        <tbody>
          <?php $cont = 0; ?>
          <?php foreach ($lista as $value): ?>
            <tr class="box box-solid collapsed-box tr">
             <td style="display: none;"><?= $value["Id_Color"]; ?></td>
             <td><?= $cont += 1; ?></td>
             <td><?= $value["Codigo_Color"]; ?></td>
             <td><i class="fa fa-square" style="color: <?= $value['Codigo_Color']; ?>; font-size: 200%;"></i> </td>
             <td><?= $value["Nombre"]; ?></td>
             <td style="text-align: center;"><button id="btnAgreColAsoc<?= $value["Id_Color"]; ?>" onclick="seleccionCol(this, '<?= $value["Id_Color"]; ?>')" class="btn btn-box-tool"><i class="fa fa-plus" style="color: blue; font-size: 150%;"></i></button></td> 
           </tr>
         <?php endforeach ?>
       </tbody>
     </table>
   </div>
  <div class="modal-footer">
    <button type="reset" class="btn btn-default pull-right btn-lg" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
  </div> 
</div> 
</div>
</div>






<div class="modal fade" data-backdrop="static" data-keyboard="false" id="detalleColIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form data-parsley-validate="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>DETALLE INSUMO</strong></h4>
        </div>
        <div class="modal-body"> 
          <div class="row">
            <div class="col-md-12">
            <div class="col-md-12">
             <div class="table-responsive scrolltablas"> 
              <table class="table table-bordered">
                <thead>
                  <tr class="active">
                    <th style="width: 10px">#</th>
                    <th>Código</th>
                    <th>Muestra</th>
                    <th>Nombre</th>
                    <th style="width: 20%">Valor</th>
                  </tr>
                </thead>
                <tbody id="tbodyDetalleColIns">
                </tbody>      
              </table>
             </div>
            </div>
            </div> 
         </div>             
        </div>
         <div class="modal-footer">
            <button data-dismiss="modal" type="reset" class="btn btn-lg btn-default pull-right" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
         </div> 
         </form>
        </div> 
      </div>
    </div>
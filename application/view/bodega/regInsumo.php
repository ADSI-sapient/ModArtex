<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
    <li><a href="#">Bodega</a></li>
    <li class="active">Registrar insumos</li>
  </ol>
</section>

<form onsubmit="return valiTablaLlenaColIns()" action="<?= URL.'ctrBodega/registrarInsumo'; ?>"  method="POST" data-parsley-validate="">
  <section class="content">
    <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;">
          <h1 class="box-title"><strong>REGISTRAR INSUMO</strong></h1>
        </div>
        <div class="box-body">
          <div class="row col-md-12">
            <div class="col-md-6">
              <div class="col-md-11  off-set-1">
                <div class="form-group">
                  <label class="control-label">*Nombre:</label>
                  <input type="text" class="form-control" required="" name="nombre" data-parsley-required="" autofocus="" maxlength="45">
                </div>
              </div>
            </div> 
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" length="80px">*Stock Mínimo:</label>
                  <input type="number" class="form-control" min="0" required="" name="stock" data-parsley-required="" max="999999">
                </div>
              </div>  
            </div>      
          </div>
          <div class="row col-md-12">
            <div class="col-md-6">
              <div class="col-md-11 off-set-1">
                <div class="form-group">
                  <label class="control-label">*Unidad de Medida:</label>
                  <select class="form-control" style="width: 100%;" required="" name="select" data-parsley-required="">
                     <?php foreach ($listaM as $valor): ?>
                       <option value="<?= $valor["Id_Medida"]; ?>"><?= $valor["Nombre"]; ?></option>  
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-8">
                <label class="control-label" length="80px">*Valor: </label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="number" class="form-control" min="1" name="valor" data-parsley-required="" data-parsley-errors-container="#errorValorInsumoBodega" id="valorIns" max="9999999">
                </div>
              <div id="errorValorInsumoBodega"></div>
              </div>
              <div style="margin-top: 25px;" class="col-md-4">
                <button  type="button" class="btn pull-right" data-toggle="modal" data-target="#SeleColorReg"><i style="font-size: 130%;" class="fa fa-paint-brush circleColor" aria-hidden="true"></i></button>
              </div>
            </div>
          </div> 
       <div class="row col-md-12">
        <div  class="col-md-12">
        <div class="col-md-12">
         <div class="table-responsive"> 
          <table  class="table table-bordered" id="tblRegIns">
            <thead>
              <tr class="active">
                <th style="width: 10px"></th>
                <th>Código</th>
                <th>Muestra</th>
                <th>Nombre</th>
                <th style="display: none; ">Id</th>
                <th style="width: 40px">Quitar</th>
              </tr>
            </thead>
            <tbody id="tbody-colAsocInsumos">
            </tbody>      
          </table>
        </div>
       </div> 
      </div> 
    </div>
  </div>   
  <div style="padding-top: 0" class="box-footer">
    <input type="hidden" name="arreglo[]" id="vecto">
    <div class="row">
      <div class="col-lg-offset-3 col-lg-3">
        <button type="submit" onclick="colores()" class="btn btn-success btn-md btn-block" style="margin-left: 2%; margin-top: 2%" name="btnRegIns"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
      </div>
      <div class="col-lg-3">
        <button onclick="limpiarTableColAsoc()" type="reset" class="btn btn-default btn-md btn-block" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>    
      </div>
    </div>
  <small><b>*Campo requerido</b></small>
  </div>
</div> 
</section> 
</form>


<div class="modal fade" id="SeleColorReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><b>COLORES PARA ASOCIAR</b></h4>
      </div>
      
      <div class="col-md-6"></div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="colAsocRegIns" class="table table-hover cell-border datTableModals" style="margin-bottom: 3%;">
        <thead>
          <tr>
            <th style="width: 10%">#</th>
            <th>Código</th>
            <th>Muestra</th>
            <th>Nombre</th>
            <th style="display: none;">Id</th>
            <th style="width: 40px">Selección</th>
          </tr>
        </thead>
        <tbody>
          <?php $cont = 0; ?>
          <?php foreach ($lista as $value): ?>
            <tr class="box box-solid collapsed-box tr">
             <td><?= $cont += 1; ?></td>
             <td><?= $value["Codigo_Color"]; ?></td>
             <td><i class="fa fa-square" style="color: <?= $value['Codigo_Color']; ?>; font-size: 200%;"></i> </td>
             <td><?= $value["Nombre"]; ?></td>
             <td style="display: none;"><?= $value["Id_Color"]; ?></td>
             <td style="text-align: center;"><button id="btnAgreColAsoc<?= $value["Id_Color"]; ?>" onclick="seleccion(this)" class="btn btn-box-tool"><i style="font-size: 150%; color: blue;" class="fa fa-plus"></i></button></td> 
           </tr>
         <?php endforeach ?>
       </tbody>
     </table>
        </div> 
      </div>
  <div class="modal-footer">
    <button type="reset" class="btn btn-default btn-lg pull-right" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
  </div> 
</div> 
</div>
</div>



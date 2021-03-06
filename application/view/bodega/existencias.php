    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Existencias insumos</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>EXISTENCIAS INSUMOS</strong></h3>
        </div>
  
      <form class="form-horizontal">
         <div class="col-md-12">
           <div class="box">
            <div class="box-body no-padding">
              <div class="table-responsive">

                <table table-responsive class="table example1" id="tblExistencias">
                  <thead>
                    <tr class="active">
                      <th style="display: none;"></th>
                      <th></th>
                      <th style="padding-left: 0;">#</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Medida</th>
                      <th>Cantidad</th>
                      <th>Valor promedio</th>
                      <th>Stock mínimo</th>
                      <th style="width: 7%">Opción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $cont = 0;?>
                    <?php foreach($listEx as $valExt): ?>
                     <tr>
                      <td style="display: none;"><?= $valExt["Id_Existencias_InsCol"]?></td>
                      <td><input type="checkbox" id="chkExi<?= $valExt["Id_Existencias_InsCol"]?>"></td>
                      <td style="padding-left: 0;"><?= $cont += 1;?></td>
                      <td><?= $valExt["NomIns"]?></td>
                      <td><?= $valExt["Nombre"]?></td>
                      <td><?= $valExt["medida"]?></td>
                      <td><?= $valExt["Cantidad_Insumo"]?></td>
                      <td><?= $valExt["Valor_Promedio"]?></td>
                      <td><span class="badge bg-red"> <?= $valExt["Stock_Minimo"]?> </span></td>
                      <td>
                        <button type="button" onclick="existen(<?= $valExt["Id_Existencias_InsCol"]?>, this)" class="btn btn-box-tool" data-toggle="modal" data-target="#ModelEntrada"><i style="color: green;" class="fa fa-arrow-up"></i></button>
                        <button type="button" onclick="salidaUno(this)" class="btn btn-box-tool" data-toggle="modal" data-target="#ModalSalida"><i style="color: red;" class="fa fa-arrow-down"></i></button>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody></table>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <div class="col-md-4">
           <button class="btn btn-primary">Generar reporte</button>
         </div> 
         <div class="col-md-8" style="text-align: right;">
           <button type="button" onclick="tableEntMay()" class="btn btn-box-tool" data-toggle="modal" data-target="#ModalEntradaMayor"><i style="color: green; font-size: 200%;" class="fa fa-arrow-up"></i></button>
           <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#SalidaMuchos" onclick="salidaIns()"><i style="color: red; font-size: 200%;" class="fa fa-arrow-down"></i></button>
         </div>
       </div>
     </form>  
   </div> 
 </section> 

 <div class="modal fade" id="ModelEntrada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="border-radius: 25px;">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-header">
        <h4 class="control-label" style="text-align: center;"><strong>ENTRADA INSUMO</strong></h4>
      </div>

      <form action="<?= URL; ?>ctrBodega/regEntrada" method="POST">
        <div class="modal-body">

        <div class="form-horizontal"> 
        <input type="hidden" name="idExs" id="idExs">
        <input type="hidden" name="cantActual" id="cantActual">
        <input type="hidden" name="valPromedio" id="valPromedio">
        <div class="form-group">
         <h4 class="col-md-3">Fecha: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" name="fechaEnt" value="<?= date("Y/m/d")?>" readonly="">
         </div>
       </div>
       <div class="form-group">
         <h4 class="col-md-3">Nombre: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="nomIns" disabled="true">
         </div>
       </div>




       <div class="form-group">
         <h4 class="col-md-3">Color: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="coloIns" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Medida: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="medIns" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Cantidad: </h4>
         <div class="col-md-9">
          <input required="" type="number" id="cant" name="cant" class="form-control"  min="1"> 
        </div> 
      </div>
      <div class="form-group">
       <h4 class="col-md-3">Valor unitario: </h4>
       <div class="col-md-9">
         <input required="" type="number" id="valUnit" name="valorUni" class="form-control" min="0">
       </div>
     </div>
     <div class="form-group">
       <h4 class="col-md-3">Valor total: </h4>
       <div class="col-md-9">
         <input  required="" type="number" id="valTot" name="valorTot" class="form-control" min="0">
       </div>
     </div>

   </div>
 </div>
 <div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-danger pull-right" style="margin-left: 2%;">Cancelar</button>
  <button type="submit" name="regUno" class="btn btn-primary pull-right">Registrar</button>
</div> 
</form>
</div> 
</div>
</div>





<!-- SALIDA DE INSUMOS DE A UNO -->


 <div class="modal fade" id="ModalSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="border-radius: 25px;">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-header">
        <h4 class="control-label" style="text-align: center;"><strong>ENTRADA INSUMO</strong></h4>
      </div>

      <form action="<?= URL; ?>ctrBodega/regSalida" method="POST">
        <div class="modal-body">

        <div class="form-horizontal"> 
        <input type="hidden" name="idExs" id="idExiSal">
        <input type="hidden" name="cant" id="cantAct">
        <div class="form-group">
         <h4 class="col-md-3">Fecha: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" name="fechaSal" value="<?= date("Y/m/d")?>" readonly="">
         </div>
       </div>
       <div class="form-group">
         <h4 class="col-md-3">Nombre: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="nomInsSal" disabled="true">
         </div>
       </div>
       <div class="form-group">
         <h4 class="col-md-3">Color: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="coloInsSal" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Medida: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="medInsSal" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Cantidad: </h4>
         <div class="col-md-9">
          <input required="" type="number" id="cantSal" name="cantSal" class="form-control"  min="1"> 
        </div> 
      </div>
     <div class="form-group">
       <h4 class="col-md-3">Descripcion: </h4>
       <div class="col-md-9">
         <textarea required="" type="text" id="descripcionSal" name="descripcion" class="form-control"> </textarea>
       </div>
     </div>

   </div>
 </div>
 <div class="modal-footer">

  <button type="button" class="btn btn-danger pull-right" style="margin-left: 2%;">Cancelar</button>
  <button type="submit" name="regUnaSal" class="btn btn-primary pull-right">Registrar</button>
</div> 
</form>
</div> 
</div>
</div>










<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ModalEntradaMayor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 60%;">
    <div class="modal-content" style="border-radius: 20px;">

      <form action="<?= URL;?>ctrBodega/regEntrada" method="POST">
        <div class="modal-header" style="text-align: center;">
          <h3 class="box-title"><strong>Registrar entrada</strong></h3>
        </div>

        <div class="modal-body">
        <div class="col-md-12">
         <div class="box">
          <div class="box-body no-padding">
           <div class="table-responsive"> 
            <table class="table" id="tableEnt" >
              <thead>
                <tr class="active">
                  <th style="display: none;"></th>
                  <th>Nombre</th>
                  <th>Color</th>
                  <th>Medida</th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th>Cantidad</th>
                  <th>Valor Unitario</th>
                  <th>Valor Total</th>
                </tr>
              </thead>
              <tbody id="tbodyEnt">
              </tbody>      
            </table>
          </div>
        </div> 
      </div>
    </div>


     <div class="row">
      <div class="col-md-6">

        <div class="col-md-12">
          <div class="form-group">
           <input type="hidden" name="id" id="mSel">
           <label class="control-label" length="80px">Fecha: </label>
           <input type="text" class="form-control" readonly="" name="fechaEnt" value="<?= date("Y/m/d"); ?>">
         </div>
       </div>    
     </div>
     <div class="col-md-6">
      <div class="col-md-12">
        <div class="form-group">
         <label class="control-label">Valor entrada: </label>
         <input type="number" value="0" class="form-control" id="valEnt" readonly="" name="valorTot">
       </div>
     </div>
   </div>
 </div>
</div>

<input type="hidden" id="vec" name="vec">
<div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-danger pull-right" style="margin-left: 2%; margin-top: 2%">Cancelar</button>
  <button type="submit" class="btn btn-primary pull-right" style="margin-left: 2%; margin-top: 2%" id="regMuchos" name="regMuchos">Registrar</button>
</div> 
</form>
</div> 
</div>
</div>




<!-- SALIDA DE VARIOS INSUMOS -->



 <div class="modal fade" data-backdrop="static" data-keyboard="false" id="SalidaMuchos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 60%;">
    <div class="modal-content" style="border-radius: 20px;">

      <form action="<?= URL;?>ctrBodega/regSalida" method="POST">
        <div class="modal-header" style="text-align: center;">
          <h3 class="box-title"><strong>SALIDA DE INSUMOS</strong></h3>
        </div>

        <div class="modal-body">
        <div class="col-md-12">
         <div class="box">
          <div class="box-body no-padding">
           <div class="table-responsive"> 
            <table class="table" id="tableSalIns" >
              <thead>
                <tr class="active">
                  <th style="display: none;"></th>
                  <th>Nombre</th>
                  <th>Color</th>
                  <th>Medida</th>
                  <th style="display: none;"></th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody id="tbodySalIns">
              </tbody>      
            </table>
          </div>
        </div> 
      </div>
    </div>


     <div class="row">
      <div class="col-md-6">

        <div class="col-md-12">
          <div class="form-group">
           <label class="control-label" length="80px">Fecha: </label>
           <input type="text" class="form-control" readonly="" name="fechaSal" value="<?= date("Y/m/d"); ?>">
         </div>
       </div>    
     </div>
     <div class="col-md-6">
      <div class="col-md-12">
        <div class="form-group">
         <label class="control-label">Descripción: </label>
         <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
       </div>
     </div>
   </div>
 </div>
</div>

<input type="hidden" id="arraySalIns" name="arraySalIns">
<div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-danger pull-right" style="margin-left: 2%; margin-top: 2%">Cancelar</button>
  <button type="submit" class="btn btn-primary pull-right" style="margin-left: 2%; margin-top: 2%" id="salIns" name="salIns">Registrar</button>
</div> 
</form>
</div> 
</div>
</div>

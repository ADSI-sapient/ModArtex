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
                <table table-responsive class="table" id="example1">
                  <thead>
                    <tr class="active">
                      <th></th>
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
                    <td><?= $cont += 1;?></td>
                    <td><?= $valExt["NomIns"]?></td>
                    <td><?= $valExt["Nombre"]?></td>
                  <td><?= $valExt["medida"]?></td>
                  <td><?= $valExt["Cantidad_Insumo"]?></td>
                  <td><?= $valExt["Valor_Promedio"]?></td>
                  <td><span class="badge bg-red"> <?= $valExt["Stock_Minimo"]?> </span></td>
                 <td>
                  <button type="button" onclick="existen(<?= $valExt["Id_Detalle"]?>, this)" class="btn btn-box-tool" data-toggle="modal" data-target="#ModelEntrada"><i class="fa fa-arrow-left"></i></button>
                  <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModelSalida"><i class="fa fa-arrow-right"></i></button>
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
<!--           <div class="form-group">
           <h4 class="col-md-3">Código: </h4>
           <div class="col-md-9">
            <input type="text" id="codIns" class="form-control" disabled="true"> 
          </div> 
        </div> -->
        <input type="hidden" name="idExs" id="idExs">
        <input type="hidden" name="cantActual" id="cantActual">
        <input type="hidden" name="valPromedio" id="valPromedio">
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
  <button type="reset" class="btn btn-danger pull-right" style="margin-left: 2%;">Cancelar</button>
  <button type="submit" class="btn btn-primary pull-right">Registrar</button>
</div> 
</form>
</div> 
</div>
</div>




<div class="modal fade" id="ModelSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="border-radius: 25px;">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-header">
        <h4 class="control-label" style="text-align: center;"><strong>SALIDA INSUMO</strong></h4>
      </div>
      <div class="modal-body">

        <div class="form-horizontal"> 
<!--           <div class="form-group">
           <h4 class="col-md-3">Código: </h4>
           <div class="col-md-9">
            <input type="text" value="001" class="form-control" disabled="true"> 
          </div> 
        </div> -->
        <div class="form-group">
         <h4 class="col-md-3">Nombre: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" value="Hilo" disabled="true">
         </div>
       </div>


       <div class="form-group">
         <h4 class="col-md-3">Color: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" value="Rojo" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Medida: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" value="Decenas" disabled="true">
         </div>
       </div>


       <div class="form-group">
         <h4 class="col-md-3">Cantidad: </h4>
         <div class="col-md-9">
          <input type="number" class="form-control"  min="0" max="3"> 
        </div> 
      </div>



      <div class="form-group">
       <h4 class="col-md-3">Descripción: </h4>
       <div class="col-md-9">
        <textarea rows="4" cols="50" class="form-control">
        </textarea> 
      </div> 
    </div>


  </div>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-danger pull-right" style="margin-left: 2%;">Cancelar</button>
  <button type="submit" class="btn btn-primary pull-right">Registrar</button>

</div> 
</div> 
</div>
</div>
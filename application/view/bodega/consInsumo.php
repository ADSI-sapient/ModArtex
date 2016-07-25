    <section class="content-header"  >
      <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Listar insumos</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-info with-border">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR INSUMOS</strong></h3>
        </div>


        <form class="form-horizontal" id="frm" action="" method="POST">
         <div class="col-md-12">
           <div class="box">

            <div class="box-body no-padding">
              <div class="table-responsive">
                <table class="table" id="example1">
                  <thead>
                    <tr class="active">
                      <th style="width: 10px"></th>
                      <th>Código</th>
                      <th>Nombre</th>
                      <th>Medida</th>
                      <th>Stock mínimo</th>
                      <th style="width: 7%">Opcion</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $cont = 0;?>
                    <?php foreach ($lisInsumos as $valor): ?>  
                      <tr>
                        <input type="hidden" value="<?= $valor["Id"]?>" name="int">
                        <td><?= $cont += 1;?></td>
                        <td><?= $valor["Id_Insumo"]?></td>
                        <td><?= $valor["Nombre"]?></td>
                        <td><option value="<?= $valor['Id_Medida']?>"><?= $valor["NombreMed"]?></option></td>
                        <td><?= $valor["Stock_Minimo"]?></td>
                        <input type="hidden" value="<?= $valor["Estado"]?>" name="est">
                        <td>    
                          <button type="button" id="btnEditar" onclick="editarIns(<?= $valor["Id_Insumo"]?>, this)" class="btn btn-box-tool" data-toggle="modal" data-target="#Modeleditar"><i class="fa fa-pencil-square-o"></i></button>

                          <?php if ($valor["Estado"] == 1): ?>
                           <button type="button" onclick="camEst(<?= $valor["Id_Insumo"]?>, 0)" class="btn btn-box-tool"><i class="fa fa-minus-circle"></i></button> 
                         <?php endif ?>
                         <?php if ($valor["Estado"] == 0): ?>
                           <button type="button" onclick="camEst(<?= $valor["Id_Insumo"]?>, 1)" class="btn btn-box-tool"><i class="fa fa-check"></i></button> 
                         <?php endif ?>
                       </td>
                     </tr>
                   <?php endforeach ?>
                 </tbody></table>
               </div>
             </div>
           </div>
         </div>
         <div class="box-footer">
         </div>
       </form>  
     </div> 
   </section>


   <div class="modal fade" data-backdrop="static" data-keyboard="false" id="Modeleditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 60%;">
      <div class="modal-content" style="border-radius: 20px;">

        <form action="<?= URL;?>ctrBodega/modificarInsumo" method="POST">
          <div class="modal-header" style="text-align: center;">
            <h3 class="box-title"><strong>MODIFICAR INSUMO</strong></h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">

                <div class="col-md-12">
                  <div class="form-group">
                   <input type="hidden" name="id" id="mSel">
                   <label class="control-label" length="80px">*Stock mínimo:</label>
                   <input id="stockIns" type="number" class="form-control" min="0" style="width: 50%; " required="" name="stock">
                 </div>
               </div>    

               <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">*Unidad de medida:</label>
                  <select class="form-control" style="width: 100%;" required="" name="select">
                   <option id="medIns" selected=""></option>
                   <?php foreach ($listaM as $valor): ?>
                    <option value="<?= $valor["Id_Medida"]; ?>"><?= $valor["Nombre"]; ?></option>  
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-group">
               <label class="control-label">*Nombre:</label>
               <input id="nomIns" type="text" class="form-control" required="" name="nombre">
             </div>

             <div class="form-group" style="margin-top: 9%; "> 
              <button  type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ModelProducto">Seleccionar color</button>
            </div>

          </div>
        </div>
      </div>

    </div>
    <div class="col-md-12">
     <div class="box">
      <div class="box-body no-padding">
       <div class="table-responsive"> 
        <table class="table" id="tablaCol" >
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
          <tbody id="tbodyCol">
          </tbody>      
        </table>
      </div>
    </div> 
  </div>
</div>
<input type="hidden" name="arregloCol[]" id="vectorCol">             
<div class="modal-footer">

  <button data-dismiss="modal" onclick="reload()" class="btn btn-danger pull-right" style="margin-left: 2%; margin-top: 2%">Cancelar</button>
  <script type="text/javascript">
    function reload(){
      $('#tbodyCol').empty();
    }
  </script>
<!--   <input type="hidden" name="arreglo[]" id="vector"> -->
  <button type="submit" onclick="coloresVec()" class="btn btn-primary pull-right" style="margin-left: 2%; margin-top: 2%" name="btnRegIns">Registrar</button>
</div> 
</form>
</div> 
</div>
</div>







<div class="modal fade" id="ModelProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="border-radius: 25px;">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-header" style="padding: 1%;">
        <h4 class="box-header" style="text-align: center;"><strong>LISTAR COLORES</strong></h4>
      </div>

      <div class="col-md-6"></div>
      <div class="modal-body">
       <table class="table example1" style="margin-bottom: 3%;">
        <thead>
          <tr>
            <th style="width: 10%"></th>
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
             <td value="<?= $value["Codigo_Color"]; ?>"><?= $cont += 1; ?></td>
             <td><?= $value["Codigo_Color"]; ?></td>
             <td><i class="fa fa-square" style="color: <?= $value['Codigo_Color']; ?>; font-size: 200%;"></i> </td>
             <td><?= $value["Nombre"]; ?></td>
             <td style="display: none;"><?= $value["Id_Color"]; ?></td>
             <td><input type="checkbox" name="check" class="chk<?=$value["Id_Color"];?>"></td> 
           </tr>
         <?php endforeach ?>
       </tbody>
     </table>
   </div>

   <div class="modal-footer">
    <button type="button" onclick="seleccionCol()" class="btn btn-primary pull-right" style="margin-left: 2%;" data-dismiss="modal">Seleccionar</button>
  </div> 
</div> 
</div>
</div>










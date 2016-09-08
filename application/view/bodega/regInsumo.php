    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Registrar insumos</li>
      </ol>
    </section>

    <form action="<?= URL.'ctrBodega/registrarInsumo'; ?>" method="POST">
      <section class="content">
        <div class="box box-primary">
          <div class="box-header with-border" style="text-align: center;">
            <h1 class="box-title"><strong>REGISTRAR INSUMO</strong></h1>
          </div>
          <div class="box-body">

            <div class="row">
              <div class="col-md-6">

                <div class="col-md-12">
                  <div class="form-group">
                   <label class="control-label" length="80px">*Stock mínimo:</label>
                   <input type="number" class="form-control" min="0" style="width: 50%; " required="" name="stock">
                 </div>
               </div>    

               <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">*Unidad de medida:</label>
                  <select class="form-control" style="width: 100%;" required="" name="select">
                    <option selected="select"></option>
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
                 <input type="text" class="form-control" required="" name="nombre">
               </div>
            </div>

            <div class="col-md-6">
                  <div class="form-group">
                   <label class="control-label" length="80px">*Valor: </label>
                   <input type="number" class="form-control" min="0" required="" name="valor">
                 </div>
            </div>

            <div class="col-md-6">
                  <button  type="button" class="btn btn-primary pull-right" data-toggle="modal" style="margin-top: 10%;" data-target="#SeleColorReg">Seleccionar color</button>
            </div>
          </div>
          
        </div> 
      </div>   
      
      <div class="col-md-12">
       <div class="box">
        <!-- /.box-header -->
        <div class="box-body no-padding">
         <div class="table-responsive"> 
          <table class="table" id="tblRegIns" style="display: none;">
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
            <tbody id="tbody">
            </tbody>      
          </table>
        </div>
      </div> 
    </div>
  </div>
  <input type="hidden" name="arreglo[]" id="vecto">
  <div class="box-footer">
    <button type="reset" class="btn btn-danger pull-right" style="margin-left: 2%; margin-top: 2%">Cancelar</button>
    <button type="submit" onclick="colores()" class="btn btn-primary pull-right" style="margin-left: 2%; margin-top: 2%" name="btnRegIns">Registrar</button>
  </div>
</div> 
<div class="row">

</div>
</section> 
</form>




<div class="modal fade" id="SeleColorReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="border-radius: 25px;">
    <div class="modal-content" style="border-radius: 10px;">
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
             <td><?= $cont += 1; ?></td>
             <td><?= $value["Codigo_Color"]; ?></td>
             <td><i class="fa fa-square" style="color: <?= $value['Codigo_Color']; ?>; font-size: 200%;"></i> </td>
             <td><?= $value["Nombre"]; ?></td>
             <td style="display: none;"><?= $value["Id_Color"]; ?></td>
             <td><input type="checkbox" name="check" class="chkReg<?= $value["Id_Color"]; ?>"></td> 
           </tr>
         <?php endforeach ?>
       </tbody>
     </table>
   </div>
   <div class="modal-footer">
    <button type="button" onclick="seleccion()" class="btn btn-primary pull-right" style="margin-left: 2%;" data-dismiss="modal">Seleccionar</button>
  </div> 
</div> 
</div>
</div>



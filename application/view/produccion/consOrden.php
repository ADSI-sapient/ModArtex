    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="../../starter2.html"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Producción</a></li>
        <li class="active">Consultar Orden</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR ÓRDENES</strong></h3>
        </div>
        <div id="ordenesP">
          <form class="form-horizontal">
            <div class="col-md-12">
              <br>
              <div class="table table-responsive">
                <table class="table table-hover" id="tblOrdenes">
                  <thead>
                    <tr class="info">
                      <th># Orden</th>
                      <th>Fecha Registro</th>
                      <th>Fecha Terminación</th>
                      <th>Estado</th>
                      <th>Lugar</th>
                      <th>Editar</th>
                      <th>Generar O.P</th>
                      <th>Cancelar</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  <?php foreach ($ordenesProduccion as $ordenProduccion): ?>
                    <tr>
                      <td><?= $ordenProduccion["Num_Orden"] ?></td>
                      <td><?= $ordenProduccion["Fecha_Registro"] ?></td>
                      <td><?= $ordenProduccion["Fecha_Fin"] ?></td>
                      <td><?= $ordenProduccion["Estado"] ?></td>
                      <td><?= $ordenProduccion["Lugar"] ?></td>
                      <td>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modaldllOrden" id="btncarg" onclick="editarOrdeP('<?= $ordenProduccion["Num_Orden"] ?>', this); FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>')"><i class="fa fa-pencil-square-o fa-lg" name="btncarg"></i></button>
                      </td>
                      <td>
                        <button type="button" class="btn btn-box-tool" ><i class="fa fa-file-pdf-o fa-lg" name="btncarg"></i></button>
                      </td>
                      <td>
                        <button type="button" class="btn btn-box-tool" onclick="cancelarOrdenP('<?= $ordenProduccion["Num_Orden"] ?>');" id="btn-cancel-ord"><i class="fa fa-ban fa-lg" style="color:red"></i></button>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </form>
        </div>
        <div class="box-footer"></div> 
      </div>
    </section> 
  <!-- Incio modal modificar orden -->
      <div class="modal fade" id="modaldllOrden" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Detalle Orden #<i id="numOrdenp"></i></b></h4>
            </div>
           
            <div class="modal-body" style="padding:5px;">
              <form role="form" action="" method="" id="dtllOrden">
                <div class="form-group col-sm-5">
                  <label class="">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" readonly type="text" id="fecha_regOp" style="border-radius:5px;">
                  </div>
                </div>
                <div class="form-group col-sm-offset-2 col-sm-5">
                  <!-- <label for="estadoOp" class="">Estado:</label>
                  <input type="text" id="estadoOp" class="form-control" value="" readonly="" style="border-radius:5px;"> -->
                    <label for="estadoOp" class="">*Lugar Producción:</label>
                    <select class="form-control" name="estadoOp" id="estadoOp" style="border-radius:5px;">
                      <option value="Producción">Producción</option>
                      <option value="Calidad">Calidad</option>
                      <option value="Terminada">Terminada</option>
                      <option value="Cancelada">Cancelada</option>
                    </select>
                </div>

                

                
                  <div class="form-group col-sm-5">
                    <label class="">*Fecha Terminación:</label>
                    <div class="">
                      <div class="input-group date">
                        <div class="input-group-addon" style="border-radius:5px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" name="" id="fecha_entregaOp" style="border-radius:5px;">
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-offset-2 col-sm-5">
                    <label for="doc_cliente" class="">Cliente:</label>
                    <br>
                    <input type="text" class="form-control" name="" id="doc_clienteOp" style="border-radius:5px;" readonly>
                    <!-- <select  readonly class="form-control" id="doc_clienteOp" style="width: 100%; height: 100%;"> -->
                        <!-- <option value=""></option> -->
                      <!-- <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Nombre"]?></option>
                      <?php endforeach ?>-->
                    <!-- </select> -->
                  </div>
                  <div class="form-group col-sm-5">
                    <label for="lugarOp" class="">*Lugar Producción:</label>
                    <select class="form-control" name="lugarOp" id="lugarOp" style="border-radius:5px;">
                      <option value="Fábrica">Fábrica</option>
                      <option value="Satélite">Satélite</option>
                      <option value="Fábrica-Satélite">Fábrica/Satélite</option>
                    </select>
                  </div>
                  
                  <button type="button" class="btn btn-primary pull-right" style="margin-top: 4.7%; margin-right:2.6%;">Generar Orden</button>
                <div class="table">
              <div class="col-sm-12 table-responsive">
                <table class="table table-hover" style="margin-top: 2%;" id="tblFichasProducc">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Color</th>
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
            <div class="modal-footer" style="border-top:none;">
              <div class="form-group col-sm-12">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal modificar orden-->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Cliente</a></li>
      <li class="active">Listar Cliente</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
     <div class="box box-primary">
      <div class="box-header with-border"  style="text-align: center;">
        <h3 class="box-title"><strong>LISTAR CLIENTES</strong></h3>
      </div>
      <div id="users">
        <form class="form-horizontal">
          <div class="col-md-12">
            <div class="table table-responsive">
              <table class="table table-hover cell-border" id="TablaClientes">
                <thead>
                    <tr class="">
                      <th class="col-lg">Tipo de Documento</th>
                      <th>Documento</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Teléfono</th>
                      <th>Dirección</th>
                      <th>Email</th>
                      <th>Estado</th>
                      <th style="width: 7%">Editar</th>
                      <th class="col-lg">Cambiar Estado</th>
                    </tr>
                  </thead>
                  <tbody class="">
                  <?php foreach ($clientes as $cliente): ?>
                  <tr>
                    <td class="Tipo_Documento"><?= $cliente["Tipo_Documento"] ?></td>
                    <td class="Num_Documento"><?= $cliente["Num_Documento"] ?></td>
                    <td class="Nombre"><?= $cliente["Nombre"] ?></td>
                    <td class="Apellido"><?= $cliente["Apellido"] ?></td>
                    <td class="Telefono"><?= $cliente["Telefono"] ?></td>
                    <td class="Direccion"><?= $cliente["Direccion"] ?></td>
                    <td class="Email"><?= $cliente["Email"] ?></td>
                    <td class="estado"><?= $cliente["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td>                           
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModalC" onclick="editarClientes('<?= $cliente["Num_Documento"] ?>', this)"><i class="fa fa-pencil-square-o" style="font-size: 150%;"></i></button>
                      </td>
                      <td style="text-align: center">
                        <?php if ($cliente["Estado"] == 1){ ?>
                        <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoC(<?= $cliente['Num_Documento'] ?>, 0)"><i style="font-size: 150%;" class="fa fa-minus-circle"></i></button>
                        <?php }else{ ?>
                        <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoC(<?= $cliente['Num_Documento'] ?>, 1)"><i class="fa fa-check" style="font-size: 150%;"></i></button>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </form>
        </div>
        <div class="box-footer">
        </div>
      </div>
     </section>   



       <div class="modal fade" id="myModalC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:10px">
              <form role="form" id="myModalC" action="<?= URL ?>ctrCliente/edit" method="post" data-parsley-validate="">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>MODIFICAR CLIENTE</b></h4>
            </div>
            
            <div class="modal-body">
                  <div class="row" style="margin-left:0.5%">
                    <div class="form-group col-sm-6">
                      <label for="tipo_Documento" class="">Tipo de Documento:</label>
                      <input type="text" id="Tipo_Documento" readonly="" class="form-control">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="documento" class="">Número de Documento:</label>
                      <input type="text"  class="form-control" id="Num_Documento" name="Num_Documento" readonly="">
                    </div>
                  </div>
                  <div class="row" style="margin-left:0.5%">
                    <div class="form-group col-sm-6">
                      <label for="nombre" class="">*Nombre:</label>
                      <input type="text" class="form-control" id="Nombre" placeholder="" name="Nombre" data-parsley-required="" maxlength="45">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="apellido" class="">*Apellido</label>
                      <input type="text" class="form-control" id="Apellido" placeholder="" name="Apellido" data-parsley-required="" maxlength="45">
                    </div>
                  </div>
                  <div class="row" style="margin-left:0.5%">
                    <div class="form-group  col-sm-6">
                      <label for="telefono">Teléfono:</label>
                      <input type="text" class="form-control" id="Telefono" name="Telefono" onChange="validarTelefono(this.value);" maxlength="25">
                    </div>
                   <div class="form-group col-sm-6">
                   <label for="direccion ">Dirección:</label>
                      <input type="text" class="form-control" id="Direccion" name="Direccion" maxlength="45">
                   </div>
                 </div>
                 <div class="row" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="email" class="">Email:</label>
                    <input type="text" class="form-control" id="Email" placeholder="" name="Email" onChange="validarEmail(this.value);" data-parsley-required="" maxlength="45">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
            <div class="row">
              <div class="col-lg-offset-3 col-lg-3">
                <button type="submit" class="btn btn-warning btn-md btn-block" name="btnModificar"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
              </div>
              <div class="col-lg-3">
                <button type="button" class="btn btn-default btn-md btn-block" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
              </div>
              <small class="pull-left"><b>*Campo requerido</b></small>
            </div>      
          </form>
          </div>
        </div>
      </div>


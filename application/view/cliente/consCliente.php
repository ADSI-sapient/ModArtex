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
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModalC" onclick="editarClientes('<?= $cliente["Num_Documento"] ?>', this)"><i class="fa fa-pencil-square-o fa-lg"></i></button>
                      </td>
                      <td>
                        <?php if ($cliente["Estado"] == 1){ ?>
                        <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoC(<?= $cliente['Num_Documento'] ?>, 0)"><i class="fa fa-minus-circle fa-lg"></i></button>
                        <?php }else{ ?>
                        <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoC(<?= $cliente['Num_Documento'] ?>, 1)"><i class="fa fa-check fa-lg"></i></button>
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


       <div class="modal fade" id="myModalC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:10px">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Modificar Cliente</h4>
            </div>
            
            <div class="modal-body">
              <form role="form" id="myModalC" action="<?= URL ?>ctrCliente/edit" method="post" data-parsley-validate="">
                  <div class="row form-group col-sm-12" style="margin-left:0.5%">
                    <div class="form-group col-sm-6">
                      <label for="tipo_Documento" class="">Tipo de Documento:</label>
                      <input type="text" id="Tipo_Documento" readonly="" class="form-control">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="documento" class="">Documento:</label>
                      <input type="text"  class="form-control" id="Num_Documento" name="Num_Documento" readonly="">
                    </div>
                  </div>
                  <div class="row form-group col-sm-12" style="margin-left:0.5%">
                    <div class="form-group col-sm-6">
                      <label for="nombre" class="">*Nombre:</label>
                      <input type="text" class="form-control" id="Nombre" placeholder="" name="Nombre" data-parsley-required="">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="apellido" class="">*Apellido</label>
                      <input type="text" class="form-control" id="Apellido" placeholder="" name="Apellido" data-parsley-required="">
                    </div>
                  </div>
                  <div class="row form-group col-sm-12" style="margin-left:0.5%">
                    <div class="form-group  col-sm-6">
                      <label for="telefono">*Teléfono:</label>
                      <input type="text" class="form-control" id="Telefono" name="Telefono" onChange="validarTelefono(this.value);" data-parsley-required="">
                    </div>
                   <div class="form-group col-sm-6">
                   <label for="direccion ">*Dirección:</label>
                      <input type="text" class="form-control" id="Direccion" name="Direccion" data-parsley-required="">
                   </div>
                 </div>
                 <div class="row form-group col-sm-12" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="email" class="">*Email:</label>
                    <input type="text" class="form-control" id="Email" placeholder="" name="Email" onChange="validarEmail(this.value);" data-parsley-required="">
                  </div>
                </div>
                <div class="modal-footer" style="border-top:0px;">
                <div class="row form-group col-sm-12" style="margin-left:1px">
                  <button type="submit" class="btn btn-primary" name="btnModificar" style="margin-top: 15px; padding:5px 24px !important;"><i class="fa fa-save"></i><b> Guardar</b></button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left:15px; margin-top: 15px; padding:5px 24px !important;"><i class="fa fa-times-circle"></i> Cerrar</button>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>

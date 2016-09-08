
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Usuario</a></li>
    <li class="active">Listar Usuarios</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border"  style="text-align: center;">
      <h3 class="box-title"><strong>LISTAR USUARIOS</strong></h3>
    </div>
    <div id="users">
      <form class="form-horizontal">
        <div class="col-md-12">
          <div class="box">
            <!-- /Tabla que treae los datos -->
            <div class="box-body no-padding">
             <div class="table-responsive"> 
              <table class="table table-hover cell-border" id="TablaUsuarios">
                <thead>
                  <tr class="">
                    <th style="display:none;"></th>
                    <th>Tipo de Documento</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Nombre de Usuario</th>
                    <!--<th>Clave</th>-->
                    <th>Email</th>
                    <th>Rol</th>
                    <th style="display: none;"></th>
                    <th style="width: 7%">Opciones</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php foreach ($usuarios as $usuario): ?>
                    <tr >
                      <td style="display:none;"><?= $usuario["Id_Usuario"] ?></td>
                      <td class="tipo_documento"><?= $usuario["Tipo_Documento"] ?></td>
                      <td class="documento"><?= $usuario["Num_Documento"] ?></td>
                      <td class="nombre"><?= $usuario["Nombre"] ?></td>
                      <td class="apellido"><?= $usuario["Apellido"] ?></td>
                      <td class="estado"><?= $usuario["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td class="nombre_usuario"><?= $usuario["Usuario"] ?></td>
                      <!-- <td class="clave"><?= $usuario["Clave" ] ?></td> -->
                      <td class="email"><?= $usuario["Email"] ?></td>
                      <td class="rol" ><?= $usuario["rol"] ?></td>
                      <td style="display: none;"><?= $usuario["idRol"] ?></td>
<!--                       <td class="r" style="display: none;"><?= $usuario["Id"] ?></td> -->
                      <td>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal3" onclick="editarUsuarios('<?= $usuario["Num_Documento"] ?>', this)"><i class="fa fa-pencil-square-o fa-lg"></i></button>

                        <?php if ($usuario["Estado"] == 1){ ?>
                          
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstado(<?= $usuario['Num_Documento'] ?>, 0)"><i class="fa fa-minus-circle fa-lg"></i></button>
                          
                          <?php }else{ ?>
                            <button type="button" class="btn btn-box-tool" onclick="cambiarEstado(<?= $usuario['Num_Documento'] ?>, 1)"><i class="fa fa-check fa-lg"></i></button>

                            <?php } ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Termina la tabla-->
        <div class="box-footer">
        </div>
      </form>

      <!-- inicia el Modal que permite modificar-->  
      <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Modificar Usuario</h4>
            </div>
            <div class="modal-body">
              <form role="form" id="myModal3" action="<?= URL ?>ctrUsuario/edit" method="post" data-parsley-validate="">
                <div class="row form-group col-sm-12" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="tipo_Documento" class="">Tipo de Documento:</label>
                   <input type="text" name="Tipo_Documento" id="tipo_documento" disabled="" class="form-control">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="documento" class="">Documento:</label>
                    <input type="text" class="form-control" id="documento" placeholder="" name="documento" readonly="">
                  </div>
                </div>
                <div class="row form-group col-sm-12" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="nombre" class="">*Nombre:</label>
                    <input type="text" class="form-control" id="nombre" placeholder="" name="nombre" data-parsley-required="">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="apellido" class="">*Apellido:</label>
                    <input type="text" class="form-control" id="apellido" placeholder="" name="apellido" data-parsley-required="">
                  </div>
                </div>
                <div class="row form-group col-sm-12" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="nombre_Usuario" class="">*Nombre de Usuario:</label>
                    <input type="text" class="form-control" id="nombre_usuario" placeholder="" name="nombre_usuario" data-parsley-required="">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="rol" class="">*Rol:</label>
                    <select class="form-control" name="rol" id="rol" data-parsley-required="">
                      <?php foreach ($rol as $value): ?>
                        <option value="<?= $value['Id_Rol']?>"><?= $value['Nombre']?></option>
                      <?php endforeach ?> 
                    </select>
                  </div>
                </div>
                <div class="row form-group col-sm-12" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="email" class="">*Email:</label>
                    <input type="text" class="form-control" id="email" placeholder="" name="email" data-parsley-required="">
                  </div>
                </div>
                <input type="hidden" id="codigo" name="codigo"></input>
                <div class="modal-footer" style="border-top:0px;">
                <div class="row form-group col-sm-12" style="margin-left:1px">
                  <button type="submit" class="btn btn-primary" name="btonModificar" style="margin-top: 15px; padding:5px 24px !important;"><b>Guardar</b></button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="cancelar()" style="margin-left:15px; margin-top: 15px; padding:5px 24px !important;">Cancelar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</section>

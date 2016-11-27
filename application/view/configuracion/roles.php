<section class="content-header"> 
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
    <li><a href="#">Configuración</a></li>
    <li class="active">Roles</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <!--Registrar Rol-->
    <div class="col-md-6">
      <div class="box box-primary" >
        <div class="box-header with-border" style="text-align: center;"> 
          <h4 class="control-label"><strong>REGISTRAR ROL</strong></h4>       
        </div>
        <form onsubmit="return validarRol();" action="<?= URL.'ctrConfiguracion/RegistrarRoles'?>" method="POST" data-parsley-validate="" style="height: 385px;">
          <div class="box-body">
            <div class="row col-lg-12">
              <div class="form-group col-md-8">
                <label for="nombre" class="control-label">*Nombre: </label>
                <input type="text" class="form-control" name="nombre" data-parsley-required="">
              </div>
              <div style="margin-top: 25px;" class="col-md-4">
                <!--             <label for="nombre" class="pull-right"></label> -->
                <button type="button" class="btn btn-primary pull-right" style="margin-left: 2%;" data-toggle="modal" data-target="#permisosm"><b>Asignar Permisos</b></button>
              </div>
            </div>
            <div class="row col-lg-12">
              <div  class="form-group" id="permisosasig">
                <div class="table">
                  <div class="col-lg-12 table-responsive scrolltablas">
                    <table class="table table-hover table-bordered" style="margin-top:2%;" id="tablaPermisos">
                      <thead>
                        <tr class="active">
                          <th>Módulo</th>
                          <th>Permiso</th>
                          <th>Quitar</th>
                        </tr>
                      </thead>
                      <tbody id="tblPas">
                        <tr>
                          <td id="tblpermisosvacia" colspan="3" style="text-align:center;"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="row">
              <div class="col-md-offset-3 col-md-3">
                <button type="submit" class="btn btn-success btn-md btn-block" style="margin-top: 15px;"  name="btnRegistrarR"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
              </div>
              <div class="col-md-3">
                <button type="reset" onclick="limpiarTablePermisosRoles()" class="btn btn-default btn-md btn-block" data-toggle="modal" data-target="#rolReg" style="margin-top: 15px;"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Listar Rol-->
      <div class="col-md-6" >
        <div class="box box-primary" style="height:444px;">
          <div class="box-header with-border" style="text-align: center;"> 
            <h4 class="control-label"><strong>LISTAR ROLES</strong></h4>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <div class="box-tools">   
                <form action="#" method="get" class="form-horizontal no-margin"></form> 
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="col-lg-12 table-responsive">
              <table class="table table-hover col-lg-12" id="tablaListarRoles">
                <thead>
                  <tr class="info">
                    <th class="col-lg-2">#</th>
                    <th class="col-lg-2">Nombre</th>
                    <th class="col-lg-2">Estado</th>
                    <th>Modificar</th>
                    <th>Cambiar Estado</th>
                    <th style="width: 15%">Permisos Asignados</th>
                  </tr>
                </thead>
                <tbody class="list">
                <?php $c = 1; ?>
                  <?php foreach ($roles as $rol): ?>
                    <tr >
                      <td class="Id_Rol"><?= $rol["Id_Rol"] ?></td>
                      <td class="Nombre"><?= $rol["Nombre"] ?></td>
                      <td class="estado"><?= $rol["Estado"]==1?"Habilitado":"Inhabilitado"?></td>
                     <td>
                     <?php if ($rol["Id_Rol"] == 1): ?>
                       <button type="button" class="btn btn-box-tool" disabled="s"><i class="fa fa-pencil-square-o" style="font-size: 150%;"></i></button>
                     <?php else: ?>
                      <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModificarRol"onclick="editarRoles('<?= $rol["Id_Rol"] ?>', '<?= $rol["Nombre"] ?>', this, '<?= $c ?>')"><i class="fa fa-pencil-square-o" style="font-size: 150%;"></i></button>
                      <?php endif ?>
                    </td>
                    <td>
                    <?php if ($rol["Id_Rol"] == 1): ?>

                        <?php if ($rol["Estado"] == 1): ?>
                        <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-minus-circle" style="font-size: 150%;"></i></button>
                        <?php else: ?>
                          <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-check" style="font-size: 150%;"></i></button>
                        <?php endif ?>
                  <?php else: ?>
                    <?php if ($rol["Estado"] == 1): ?>
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoRol(<?= $rol['Id_Rol'] ?>, 0)"><i class="fa fa-minus-circle" style="font-size: 150%;"></i></button>
                        <?php else: ?>
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoRol(<?= $rol['Id_Rol'] ?>, 1)"><i class="fa fa-check" style="font-size: 150%;"></i></button>
                          <?php endif ?>

                      <?php endif ?>
                        </td>
                        <td>
                       <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModificarR"onclick="listarRoles('<?= $rol["Id_Rol"] ?>', '<?= $rol["Nombre"] ?>', this)"><i class="fa fa-eye" style="color:#3B73FF; font-size: 150%;"></i></button>
                     </td>
                      </tr>
                    <?php $c++; ?>
                    <?php endforeach; ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div> 
    <!-- Button trigger modal -->

    <!-- Modal -->

    <div class="modal fade" id="ModificarRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <form onsubmit="return validarRolEdit();"  data-parsley-validate="" role="form" id="ModificarRol" action="<?= URL ?>ctrConfiguracion/RegistrarRoles" method="post">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 10px;">
         <div class="modal-header with-border" style="text-align: center;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><strong>MODIFICAR ROL</strong></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group col-md-8">
                <label for="nombre" class="col-sm- control-label">*Nombre: </label>
                <input type="hidden" id="idRol" name="idRol">
                <input data-parsley-required="" type="text" class="form-control" name="Nombre" id="nombre_rol" maxlength="45">
              </div> 
              <div style="margin-top: 25px;" class="col-md-4">
                <button type="button" class="btn btn-primary pull-right" style="margin-left: 2%;" data-toggle="modal" data-target="#permisosN"><b>Asignar Permisos</b></button>
              </div>
            </div> 
          </div> 
          <!-- /.box-header -->
          <div class="row">
            <div class="col-lg-12">
              <div  class="table">
                <div class="table-responsive scrolltablas">
                <table class="table table-hover table-bordered" id="tablaR">
                    <thead>
                      <tr class="info">
                        <th>Módulo</th>
                        <th>Privilegio</th>
                        <th>Retirar</th>
                      </tr>
                    </thead>
                    <tbody id="fila">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
         <div class="row">
           <div class="col-md-offset-3 col-md-3">
             <button name="btnModificarRol" type="submit" class="btn btn-warning btn-md btn-block"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
           </div>
           <div class="col-md-3">
             <button type="button" data-dismiss="modal" class="btn btn-default btn-md btn-block"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
           </div>
         </div>
       </div>
     </div>
   </div>
 </form>
</div>

<div class="modal fade" id="ModificarR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
     <div class="modal-header with-border" style="text-align: center;"> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title"><strong>PERMISOS ASIGNADOS</strong></h4>
     </div>
    <div class="modal-body">
      <!-- /.box-header -->
      <div class="table table-responsive scrolltablas">
        <table class="table table-hover table-bordered" id="">
          <thead>
            <tr class="info">
              <th class="col-lg-4">Módulo</th>
              <th class="col-lg-4">Permiso</th>
            </tr>
          </thead>
          <tbody id="filass">
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default btn-lg" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times-circle"></i> Cerrar</button>
    </div>
  </div>
</div>
</div>


<!-- Modal Agregar mas permisos -->
<div class="modal fade" id="permisosN" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>PERMISOS PARA ASIGNAR</b></h4>
      </div>
      <div class="modal-body">
        <div class="table">
          <div class="col-sm-12 table-responsive">
            <table class="table table-hover cell-border datTableModals" style="margin-top: 2%;">
              <thead>
                <tr class="active">
                  <th>Módulo</th>
                  <th>Privilegio</th>
                  <th>Agregar</th>
                </tr>
              </thead>
              <tbody>
               <?php $i = 1; ?>
               <?php foreach ($permisos as $permiso): ?>
                <tr >
                  <td><?= $permiso["modulos"] ?></td>
                  <td><?= $permiso["Nombre"] ?></td>
                  <td>
                    <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarPermisosNuevos('<?= $permiso["Id_Permiso"] ?>', '<?= $permiso["modulos"] ?>','<?= $permiso["Nombre"] ?>', '<?= $i ?>')"><i style="font-size:150%; color:blue;" class="fa fa-plus"></i></button>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Inicio Modal asociar permisos -->
<div class="modal fade" id="permisosm" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>ASIGNAR PERMISOS</b></h4>
      </div>
      <div class="modal-body">
        <div class="table">
          <div class="table-responsive">
            <table class="table table-hover cell-border datTableModals" style="margin-top: 2%;" id="permisos">
              <thead>
                <tr class="active">
                  <th>Módulo</th>
                  <th>Permiso</th>
                  <th>Agregar</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($permisos as $permiso): ?>
                  <tr>
                    <td><?= $permiso["modulos"] ?></td>
                    <td><?= $permiso["Nombre"] ?></td>
                    <td>
                      <button id="bt<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarPermisos('<?= $permiso["Id_Permiso"] ?>', '<?= $permiso["modulos"] ?>','<?= $permiso["Nombre"] ?>', '<?= $i ?>')"><i style="font-size:150%; color:blue;" class="fa fa-plus"></i></button>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

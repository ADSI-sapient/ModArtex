<section class="content-header"> 
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
    <li><a href="#">Configuración</a></li>
    <li class="active">Roles</li>
  </ol>
</section>
<section class="content">
  <div class="row col-md-12">
    <!--Registrar Rol-->
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;"> 
          <h4 class="control-label"><strong>REGISTRAR ROL</strong></h4>       
        </div>
        <form onsubmit="return validarRol();" action="<?= URL.'ctrConfiguracion/RegistrarRoles'?>" method="POST" data-parsley-validate="">
          <div class="box-body">
            <div class="row col-lg-12">
              <div class="form-group col-lg-6">
                <label for="nombre" class="control-label">*Nombre: </label>
                <input type="text" class="form-control" name="nombre" data-parsley-required="">
              </div> 
              <div style="margin-top: 25px;" class="col-md-6">
                <!--             <label for="nombre" class="pull-right"></label> -->
                <button type="button" class="btn btn-primary pull-right" style="margin-left: 2%;" data-toggle="modal" data-target="#permisosm">Permisos</button>
              </div>
            </div>


            <div class="row col-lg-12">
              <div  class="form-group" id="permisosasig">
                <div class="table scrolltablas">
                  <div class="col-lg-12 table-responsive">
                    <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tablaPermisos">
                      <thead>
                        <tr class="active">
                          <th>Id Permiso</th>
                          <th>Módulo</th>
                          <th>Permisos</th>
                          <th>Quitar</th>
                        </tr>
                      </thead>
                      <tbody id="tblPas">
                        <tr>
                          <td id="tblpermisosvacia" colspan="4" style="text-align:center;"></td>
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
              <div class="col-lg-12"> 
                <button type="reset" onclick="limpiarTablePermisosRoles()" class="btn btn-default pull-right" data-toggle="modal" data-target="#rolReg" style="margin-top: 15px; margin-left: 2%;"><i class="fa fa-eraser" aria-hidden="true"></i> Limpiar</button>
                <button type="submit" class="btn btn-success pull-right" style="margin-top: 15px;"  name="btnRegistrarR"><i class="fa fa-check-circle" aria-hidden="true"></i> Registrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Listar Rol-->
      <div class="col-md-6" >
        <div class="box box-primary" style="height:462px;">
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
                    <th style="width: 15%">Permisos</th>
                    <th>Modificar</th>
                    <th>Modificar Estado</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php foreach ($roles as $rol): ?>
                    <tr >
                      <td class="Id_Rol"><?= $rol["Id_Rol"] ?></td>
                      <td class="Nombre"><?= $rol["Nombre"] ?></td>
                      <td class="estado"><?= $rol["Estado"]==1?"Habilitado":"Inhabilitado"?></td>
                      <td>
                       <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModificarR"onclick="listarRoles('<?= $rol["Id_Rol"] ?>', '<?= $rol["Nombre"] ?>', this, 2)"><i class="fa fa-eye fa-lg" style="color:#3B73FF"></i></button>
                     </td>
                     <td>
                     <?php if ($rol["Id_Rol"] == 1): ?>
                       <button type="button" class="btn btn-box-tool" disabled="s"><i class="fa fa-pencil-square-o fa-lg"></i></button>
                     <?php else: ?>
                      <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModificarRol"onclick="editarRoles('<?= $rol["Id_Rol"] ?>', '<?= $rol["Nombre"] ?>', this, 1)"><i class="fa fa-pencil-square-o fa-lg"></i></button>
                      <?php endif ?>
                    </td>
                    <td>
                    <?php if ($rol["Id_Rol"] == 1): ?>

                        <?php if ($rol["Estado"] == 1): ?>
                        <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-minus-circle fa-lg"></i></button>
                        <?php else: ?>
                          <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-check fa-lg"></i></button>
                        <?php endif ?>
                  <?php else: ?>
                    <?php if ($rol["Estado"] == 1): ?>
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoRol(<?= $rol['Id_Rol'] ?>, 0)"><i class="fa fa-minus-circle fa-lg"></i></button>
                        <?php else: ?>
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoRol(<?= $rol['Id_Rol'] ?>, 1)"><i class="fa fa-check fa-lg"></i></button>
                          <?php endif ?>

                      <?php endif ?>
                        </td>
                      </tr>
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
     <form data-parsley-validate="" role="form" id="ModificarRol" action="<?= URL ?>ctrConfiguracion/RegistrarRoles" method="post">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 25px;">
         <div class="modal-header with-border" style="text-align: center;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><strong>MODIFICAR ROL</strong></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group col-lg-6">
                <label for="nombre" class="col-sm- control-label">*Nombre: </label>
                <input type="hidden" id="idRol" name="idRol">
                <input data-parsley-required="" type="text" class="form-control" name="Nombre" id="nombre_rol" >
              </div> 
              <div style="margin-top: 25px;" class="col-md-6">
                <button type="button" class="btn btn-primary pull-right" style="margin-left: 2%;" data-toggle="modal" data-target="#permisosN">Permisos</button>
              </div>
            </div> 
          </div> 
          <!-- /.box-header -->
          <div class="row">
            <div class="col-lg-12">
              <div class="table">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablaR">
                    <thead>
                      <tr class="info">
                        <th>Id</th>
                        <th>Modulo</th>
                        <th>Privilegios</th>
                        <th>Eliminar</th>
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
         <button type="button" data-dismiss="modal" class="btn btn-default pull-right" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
         <button name="btnModificarRol" type="submit" class="btn btn-warning pull-right"><i class="fa fa-refresh" aria-hidden="true"></i>  Actualizar</button>
       </div>
     </div>
   </div>
 </form>
</div>

<div class="modal fade" id="ModificarR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <form role="form" id="ModificarRol" action="<?= URL ?>ctrConfiguracion/RegistrarRoles" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 25px;">
     <div class="modal-header with-border" style="text-align: center;"> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title"><strong>Permisos asignados</strong></h4>
     </div>

     <div class="box-body">
      <div class="form-group col-lg-5">
        <label for="nombre" class="col-sm- control-label">Nombre</label>
        <input type="hidden" id="id_Rol" name="id_Rol">
        <input type="text" class="form-control" name="Nombre" id="nombreRol" >
      </div> 
    </div>
    <div class="box-body  ">
      <div class="box-header">
        <h3 class="box-title"><strong>Permisos</strong></h3>
      </div>
      <!-- /.box-header -->
      <table class="table table-hover col-lg-12" id="">
        <thead>
          <tr class="info">
            <th class="col-lg-2">Id</th>
            <th class="col-lg-4">Modulo</th>
            <th class="col-lg-4">Privilegios</th>
          </tr>
        </thead>
        <tbody id="filass">
        </tbody>
      </table>

    </div>
  </div>
</div>
</form>
</div>


<!-- Modal Agregar mas permisos -->
<div class="modal fade" id="permisosN" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>PERMISOS</b></h4>
      </div>
      <div class="modal-body">
        <div class="table">
          <div class="col-sm-12 table-responsive">
            <table class="table table-hover table-bordered dtaTablerolPermisos" style="margin-top: 2%;">
              <thead>
                <tr class="active">
                  <th>Id</th>
                  <th>Modulo</th>
                  <th>Privilegios</th>
                  <th>Agregar</th>
                </tr>
              </thead>
              <tbody>
               <?php $i = 1; ?>
               <?php foreach ($permisos as $permiso): ?>
                <tr >
                  <td><?= $permiso["Id_Permiso"]?></td>
                  <td><?= $permiso["modulos"] ?></td>
                  <td><?= $permiso["Nombre"] ?></td>
                  <td>
                    <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarPermisosNuevos('<?= $permiso["Id_Permiso"] ?>', '<?= $permiso["modulos"] ?>','<?= $permiso["Nombre"] ?>', $i)"><i class="fa fa-plus"></i></button>
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
        <h4 class="modal-title"><b>PERMISOS</b></h4>
      </div>
      <div class="modal-body">
        <div class="table">
          <div class="table-responsive">
            <table class="table table-hover table-bordered dtaTablerolPermisos" style="margin-top: 2%;" id="permisos">
              <thead>
                <tr class="active">
                  <th>Id</th>
                  <th>Modulo</th>
                  <th>Privilegios</th>
                  <th>Agregar</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($permisos as $permiso): ?>
                  <tr>
                    <td><?= $permiso["Id_Permiso"]?></td>
                    <td><?= $permiso["modulos"] ?></td>
                    <td><?= $permiso["Nombre"] ?></td>
                    <td>
                      <button id="bt<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarPermisos('<?= $permiso["Id_Permiso"] ?>', '<?= $permiso["modulos"] ?>','<?= $permiso["Nombre"] ?>', '<?= $i ?>')"><i class="fa fa-plus"></i></button>
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

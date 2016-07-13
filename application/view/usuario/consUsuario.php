
<section class="content-header">
  <br>
  <ol class="breadcrumb">
    <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Usuario</a></li>
    <li class="active">Listar Usuarios</li>
  </ol>
</section>

<section class="content">
  <div class="box box-info">
    <div class="box-header with-border"  style="text-align: center;">
      <h3 class="box-title"><strong>LISTAR USUARIOS</strong></h3>
    </div>
    <div id="users">
      <div class="row box-header">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <div class="form-group">
            <div class="box-tools pull-right">   
              <form action="#" method="get" class="form-horizontal">
                <div class="input-group">
                  <input type="text" class="form-control search" placeholder="Buscar">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="sort btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
      <form class="form-horizontal">
        <div class="col-md-12">
          <div class="box">
            <!-- /Tabla que treae los datos -->
            <div class="box-body no-padding">
             <div class="table-responsive"> 
              <table class="table">
                <thead>
                  <tr class="active">
                    <th>Codigo</th>
                    <th>tipo_documento</th>
                    <th>Documento</th>
                    <th>Estado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nombre de usuario</th>
                    <!--        <th>Clave</th> -->
                    <th>email</th>
                    <th>Rol</th>
                    <th style="width: 7%">Opcion</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php foreach ($usuarios as $usuario): ?>
                    <tr >
                      <td><?= $usuario["codigo"] ?></td>
                      <td class="tipo_documento"><?= $usuario["tipo_documento"] ?></td>
                      <td class="documento"><?= $usuario["documento"] ?></td>
                      <td class="estado"><?= $usuario["estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td class="nombre"><?= $usuario["nombre"] ?></td>
                      <td class="apellido"><?= $usuario["apellido"] ?></td>
                      <td class="nombre_usuario"><?= $usuario["nombre_usuario"] ?></td>
                      <!-- <td class="clave"><?= $usuario["clave" ] ?></td> -->
                      <td class="email"><?= $usuario["email"] ?></td>
                      <td class="rol" value=""><?= $usuario["Nombre"] ?></td>
                      <td class="r" style="display: none;"><?= $usuario["Id"] ?></td>

                      <td>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal3" onclick="editar('<?= $usuario["codigo"] ?>', this)"><i class="fa fa-pencil-square-o"></i></button>

                        <?php if ($usuario["estado"] == 1){ ?>
                          
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstado(<?= $usuario['codigo'] ?>, 0)"><i class="fa fa-minus-circle"></i></button>
                          
                          <?php }else{ ?>
                            <button type="button" class="btn btn-box-tool" onclick="cambiarEstado(<?= $usuario['codigo'] ?>, 1)"><i class="fa fa-check"></i></button>

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
              <form role="form" id="myModal3" action="<?= URL ?>ctrUsuario/edit" method="post">
                <div class="box-body">
                  <div class="form-group col-sm-5">
                    <label for="tipo_Documento" class="">Tipo de documento</label>
                    <select class="form-control" name="tipo_documento" id="tipo_documento"  disabled="">
                      <option value="C.C" >C.C</option>
                      <option value="C.E">C.E</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-offset-1 col-sm-5">
                    <label for="documento" class="">Documento</label>
                    <input type="text" class="form-control" id="documento" placeholder="" name="documento"  disabled=""  >
                  </div>
                  <div class="form-group col-sm-5">
                    <label for="nombre" class="">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="" name="nombre">
                  </div>
                  <div class="form-group col-sm-offset-1 col-sm-5">
                    <label for="apellido" class="">Apellido</label>
                    <input type="text" class="form-control" id="apellido" placeholder="" name="apellido">
                  </div>
                  <div class="form-group col-sm-5">
                    <label for="nombre_Usuario" class="">Nombre de usuario</label>
                    <input type="text" class="form-control" id="nombre_usuario" placeholder="" name="nombre_usuario">
                  </div>

                  <div class="form-group col-sm-offset-1 col-sm-5">
                    <label for="rol" class="">Rol</label>

                    <select class="form-control" name="rol" id="rol">
                      <?php foreach ($rol as $value): ?>
                        <option value="<?= $value['Id']?>"><?= $value['Nombre']?></option>
                      <?php endforeach ?> 
                    </select>
                  </div>
                  <div class="form-group col-sm-5">
                    <label for="email" class="">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="" name="email">
                  </div>
                </div>
                <input type="hidden" id="codigo" name="codigo"></input>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="btnModificar">Guardar</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  <?= $mensaje ?>
</script>

<script type="text/javascript">
  <?= $mensaje2 ?>

  function editar(codigo, usuarios){
    var campos = $(usuarios).parent().parent();
    $("#codigo").val(campos.find("td").eq(0).text());
    $("#tipo_documento").val(campos.find("td").eq(1).text());
    $("#documento").val(campos.find("td").eq(2).text());
    $("#estado").val(campos.find("td").eq(3).text());
    $("#nombre").val(campos.find("td").eq(4).text());
    $("#apellido").val(campos.find("td").eq(5).text());
    $("#nombre_usuario").val(campos.find("td").eq(6).text());
              // $("#clave").val(campos.find("td").eq(7).text());
              $("#email").val(campos.find("td").eq(7).text());   
              $("#rol").val(campos.find("td").eq(9).text());
              $("#myModal3").show();
            }

            $(document).ready(function() {
              $('.table').DataTable();
            });

            $('.table').DataTable( {
              searching:false,
              lengthChange: false,
              searching: false,
              info: false,
              ordering: false

            });
            var options = {
              valueNames: ['documento', 'tipo_Documento', 'nombre', 'apellido', 'rol']
            };
            var userList = new List('users', options);
          </script>

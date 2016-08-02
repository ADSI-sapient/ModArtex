  <!-- Content Header (Page header) -->
  <section class="content-header">
  <br>
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
  <!-- <div class="col-md-offset-8 col-md-4">
         <div class="row box-header">
            <div class="form-group">
              <div class="box-tools pull-right">
                <form action="#" method="get" class="form-horizontal">
                  <div class="input-group">
                    <input type="text" class="form-control search" placeholder="Buscar">
                    <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="sort btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </form> 
              </div>
          </div>
        </div>
        </div> -->
        <form class="form-horizontal">
          <div class="col-md-12">
            <!-- <div class="box"> -->
            <br>
              <div class="table table-responsive">
                <table class="table table-hover" id="TablaClientes">
                  <thead>
                    <tr class="info">
                      
                      <th>Tipo de documento</th>
                      <th>Número de documento</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Telefono</th>
                      <th>Dirección</th>
                      <th>Email</th>
                      <th>Estado</th>
                      <th style="width: 7%">Opción</th>
                    </tr>
                  </thead>
                  <tbody class="list">
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
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModalC" onclick="editarClientes('<?= $cliente["Num_Documento"] ?>', this)"><i class="fa fa-pencil-square-o"></i></button>

                        <?php if ($cliente["Estado"] == 1){ ?>
                          
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoC(<?= $cliente['Num_Documento'] ?>, 0)"><i class="fa fa-minus-circle"></i></button>
                          
                          <?php }else{ ?>
                            <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoC(<?= $cliente['Num_Documento'] ?>, 1)"><i class="fa fa-check"></i></button>

                            <?php } ?>
                          </td>
                       
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <!-- </div> -->
          </div>
          </form>
        </div>
        <div class="box-footer">
        </div>
      </div>


       <div class="modal fade" id="myModalC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Modificar Cliente</h4>
            </div>
            
            <div class="modal-body">
              <form role="form" id="myModalC" action="<?= URL ?>ctrCliente/edit" method="post">
                <div class="box-body">
                  <div class="form-group col-sm-5">
                    <label for="tipo_Documento" class="">Tipo de documento</label>
                    <input type="text" id="Tipo_Documento" disabled="" class="form-control">
                  </div>
                  <div class="form-group col-sm-offset-1 col-sm-5">
                    <label for="documento" class="">Documento</label>
                    <input type="text"  class="form-control" id="Num_Documento" name="Num_Documento">
                  </div>
                  <div class="form-group col-sm-5">
                    <label for="nombre" class="">Nombre</label>
                    <input type="text" class="form-control" id="Nombre" placeholder="" name="Nombre">
                  </div>
                  <div class="form-group col-sm-offset-1 col-sm-5">
                    <label for="apellido" class="">Apellido</label>
                    <input type="text" class="form-control" id="Apellido" placeholder="" name="Apellido">
                  </div>
                  <div class="form-group  col-sm-5">
                    <label for="telefono">Telefono </label>
                    <input type="text" class="form-control" id="Telefono" name="Telefono">
                  </div>
                 <div class="form-group col-sm-offset-1 col-sm-5">
                 <label for="direccion ">Direccion </label>
                    <input type="text" class="form-control" id="Direccion" name="Direccion">
                 </div>
                  <div class="form-group col-sm-5">
                    <label for="email" class="">Email</label>
                    <input type="text" class="form-control" id="Email" placeholder="" name="Email">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="btnModificar">Guardar</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>

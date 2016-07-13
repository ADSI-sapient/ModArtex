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
    <div class="box box-info">
      <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR CLIENTES</strong></h3>
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
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Telefono</th>
                      <th>email</th>
                      <th>Estado</th>
                      <th style="width: 7%">Opcion</th>
                    </tr>
                  </thead>
                  <tbody class="lista">
                  <?php foreach ($clientes as $cliente): ?>
                    <tr >
                      <td><?= $cliente["codigo"] ?></td>
                      <td class="tipo_documento"><?= $cliente["tipo_documento"] ?></td>
                      <td class="documento"><?= $cliente["documento"] ?></td>
                      <td class="nombre"><?= $cliente["nombre"] ?></td>
                      <td class="apellido"><?= $cliente["apellido"] ?></td>
                      <td class="telefono"><?= $cliente["telefono"] ?></td>
                      <td class="email"><?= $cliente["email"] ?></td>
                      <td class="estado" value=""><?= $cliente["estado"] ?></td>
                
                      <td>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal3" onclick="editar('<?= $cliente["codigo"] ?>', this)"><i class="fa fa-pencil-square-o"></i></button>

                    
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
       
      <!--Final del modal-->
      </div>
    </div>
  </section>

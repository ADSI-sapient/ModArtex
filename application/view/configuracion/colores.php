  <div class="content-wrapper">
    <section class="content-header">
      <br>  
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Configuración</a></li>
        <li class="active">Colores</li>
      </ol>
    </section>


    <section class="content">
     <div class="row">

      
        <div class="col-xs-6">

          <div class="box box-primary">
            <form action="<?= URL.'ctrlConfiguracion/registrarColor'?>" method="POST">
              <div class="box-header with-border" style="text-align: center;"> 
                     <h4 class="control-label"><strong>REGISTRAR COLOR</strong></h4>
              </div>
                <div class="box-body">
                   <div class="form-group">
                     <h4>Código: </h4>
                      
                      <div class="input-group my-colorpicker2 colorpicker-element">
                          <input type="text" name="codigo" class="form-control" readonly="" value="#0000ff">
                          <div class="input-group-addon">
                            <i type="input"></i>
                          </div>
                      </div>
                  </div>
                 
                  <div class="form-group">
                     <h4>Nombre: </h4>
                    <input type="text" name="nombre" class="form-control" required="">
                  </div>
              </div>
              <div class="box-footer" style="margin-top: 1%;">
                  <button type="reset" onclick="alerta();" class="btn btn-danger pull-right"  style="margin-left: 2%;">Cancelar</button>
                  <button type="submit" class="btn btn-primary pull-right">Guardar</button>   
              </div> 
            </form>
          </div>
        </div>


        <div class="col-xs-6">
          <div class="box box-warning">
              <div class="box-header with-border" style="text-align: center;"> 
                   <h4 class="control-label"><strong>LISTAR COLORES</strong></h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr class="active">
                      <th style="width: 10%"></th>
                      <th>Código</th>
                      <th>Muestra</th>
                      <th>Nombre</th>
                      <th style="display:none;"></th>
                      <th style="width: 15%">Opción</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $cont = 0?>
                      <?php foreach ($lista as $valor): ?>
                        <tr class="box box-solid collapsed-box">
                          <td><?= $cont += 1; ?></td>
                          <td><?= $valor["codigo"]; ?></td>
                          <td> <i class="fa fa-square" style="color:<?= $valor["codigo"]; ?>; font-size: 200%;"></i></td>
                          <td><?= $valor["nombre"]; ?></td>
                          <td style="display: none; "><?= $valor["id"]; ?></td>
                          <td>
                             <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditColor" onclick="editar('<?= $valor["codigo"]; ?>', this)"><i class="fa fa-pencil-square-o"></i></button> 

                            <button type="button" onclick="confirmacion(<?= $valor['id']; ?>)" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
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
    </section>
  </div>





    <div class="modal fade" id="modalEditColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document"; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="box-header with-border" style="text-align: center;"> 
                   <h4 class="control-label"><strong>MODIFICAR COLOR</strong></h4>
              </div>
              <form action="<?= URL.'ctrlConfiguracion/modificarColor'; ?>" method="POST">
                <div class="modal-body">

                  <div class="form-horizontal"> 
                      <input id="id" name="id" style="display: none;">
                      <div class="form-group"> 
                       <h4 class="col-md-3">Código: </h4>
                         <div class="col-md-9">
                          <div class="input-group my-colorpicker2 colorpicker-element">
                            <input type="text" class="form-control" name="codigo" id="codigo" readonly="">
                            <div class="input-group-addon">
                              <i id="i"></i>
                            </div>
                          </div>
                         </div> 
                      </div>
                      <div class="form-group">
                         <h4 class="col-md-3">Nombre: </h4>
                         <div class="col-md-9">
                         <input type="text" class="form-control" id="inputNom" name="nombre" required="">
                       </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 2%;">Cancelar</button>
                  <button type="submit" class="btn btn-primary pull-right">Guardar</button>          
              </div> 
            </form> 
          </div>
        </div>
    </div>

     <script type="text/javascript">
        function editar(codigo, colores){
          var campos = $(colores).parent().parent();
          $("#codigo").val(campos.find("td").eq(1).text());
          $("#i").css("background-color", campos.find("td").eq(1).text());
          $("#inputNom").val(campos.find("td").eq(3).text());
          $("#id").val(campos.find("td").eq(4).text());
          $("#modalEditColor").show();
        }

        function confirmacion($id){
          swal({
            title: "¿Seguro que desea eliminar el color?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si, borrar color",
            closeOnConfirm: false
          },
          function(){
            location.href = '<?= URL; ?>ctrlConfiguracion/eliminarColor?id='+$id+'; ?>';
          });
        }
      </script>


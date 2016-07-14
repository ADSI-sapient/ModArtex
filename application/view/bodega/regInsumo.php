  <div class="content-wrapper">
    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Registrar insumos</li>
      </ol>
    </section>

    <form action="<?= URL.'ctrlBodega/registrarInsumo'; ?>" method="POST">
    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border" style="text-align: center;">
          <h1 class="box-title"><strong>REGISTRAR INSUMO</strong></h1>
        </div>


        <div class="box-body">

          <div class="row">
            <div class="col-md-6">

              <div class="col-md-12">
                <div class="form-group">
                   <label class="control-label" length="80px">*Stock mínimo:</label>
                  <input type="number" class="form-control" min="0" style="width: 50%; " required="" name="stock">
                </div>
              </div>    

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">*Unidad de medida:</label>
                    <select class="form-control" style="width: 100%;" required="" name="select">
                      <option selected="select"></option>
                      <?php foreach ($listaM as $valor): ?>
                        <option value="<?= $valor["codigo"]; ?>"><?= $valor["nombre"]; ?></option>  
                      <?php endforeach ?>
                    </select>
                </div>
              </div>
          </div>

     
            <div class="col-md-6">
              <div class="col-md-12">
              <div class="form-group">
                 <label class="control-label">*Nombre:</label>
                 <input type="text" class="form-control" required="" name="nombre">
              </div>
  
              <div class="form-group" style="margin-top: 9%; "> 
                <button  type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ModelProducto">Seleccionar color</button>
              </div>
            </div>
            </div>
          
       </div> 
      </div>   
      
         <div class="col-md-12">
           <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
             <div class="table-responsive"> 
              <table class="table" id="tabla1" style="display: none;">
                <thead>
                  <tr class="active">
                    <th style="width: 10px"></th>
                    <th>Código</th>
                    <th>Muestra</th>
                    <th>Nombre</th>
                    <th style="display: none; ">Id</th>
                    <th style="width: 40px">Quitar</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                </tbody>      
              </table>
          </div>
            </div> 
          </div>
        </div>

       <input type="hidden" name="arreglo[]" id="vector">
      <div class="box-footer">
        <button type="reset" class="btn btn-danger pull-right" style="margin-left: 2%; margin-top: 2%">Cancelar</button>
        <button type="submit" onclick="colores()" class="btn btn-primary pull-right" style="margin-left: 2%; margin-top: 2%" name="btnRegIns">Registrar</button>
      </div>
    </div> 
    <div class="row">

    </div>
  </section> 
  </form>
</div>




<div class="modal fade" id="ModelProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header" style="padding: 1%;">
                  <h4 class="box-header" style="text-align: center;"><strong>LISTAR COLORES</strong></h4>
              </div>
              
              <div class="col-md-6"></div>
              <div class="modal-body">
               <table class="table example1" style="margin-bottom: 3%;">
                <thead>
                  <tr>
                    <th style="width: 10%"></th>
                    <th>Código</th>
                    <th>Muestra</th>
                    <th>Nombre</th>
                    <th style="display: none;">Id</th>
                    <th style="width: 40px">Selección</th>
                  </tr>
                </thead>
                <tbody>
                <?php $cont = 0; ?>
                <?php foreach ($lista as $value): ?>
                <tr class="box box-solid collapsed-box tr">
                 <td><?= $cont += 1; ?></td>
                  <td><?= $value["codigo"]; ?></td>
                  <td><i class="fa fa-square" style="color: <?= $value['codigo']; ?>; font-size: 200%;"></i> </td>
                  <td><?= $value["nombre"]; ?></td>
                  <td style="display: none;"><?= $value["id"]; ?></td>
                  <td><input type="checkbox" name="check" class="chk<?= $cont; ?>"></td> 
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
            </div>
              
            <div class="modal-footer">
                <button type="button" onclick="seleccion()" class="btn btn-primary pull-right" style="margin-left: 2%;" data-dismiss="modal">Seleccionar</button>
            </div> 
            </div> 
         </div>
</div>

<script type="text/javascript">
        function seleccion(){
          $("#tabla1").removeAttr("style");
          $(".tr").each( function(){
            var rg = false;
            if ($(".chk"+$(this).find("td").eq(0).html()).is(':checked')) {
              var cod = $(this).find("td").eq(0).html();
              $("#tabla1 tr").find('td:eq(0)').each(function(){
                  if (cod == $(this).html()) {
                    rg = true;
                  }
              });
            if (rg == false) {
              var fila = '<tr class="box box-solid collapsed-box"><td>'+$(this).find("td").eq(0).html()+'</td><td>'+$(this).find("td").eq(1).html()+'</td><td>'+$(this).find("td").eq(2).html()+'</td><td>'+$(this).find("td").eq(3).html()+'</td><td style="display: none; ">'+$(this).find("td").eq(4).html()+'</td><td><button type="button" class="btn btn-box-tool" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button></td></tr>';
            $("#tbody").append(fila);
            }
            $(".chk"+$(this).find("td").eq(0).html()).prop("checked", "");
          }
          });
        }
</script>
<script type="text/javascript">
  function colores(){
          var vec = [];
          $("#tabla1 tr").find('td:eq(4)').each(function(){
            vec.unshift([$(this).html()]);
          });
          $("#vector").val(vec);
  }
</script>
  
  <div class="content-wrapper">
    <section class="content-header"  >
    <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Listar insumos</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-info with-border">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR INSUMOS</strong></h3>
        </div>


      <form class="form-horizontal" id="frm" action="" method="POST">
         <div class="col-md-12">
           <div class="box">
           
            <div class="box-body no-padding">
              <div class="table-responsive">
              <table class="table" id="example1">
              <thead>
                <tr class="active">
                  <th style="width: 10px"></th>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Medida</th>
                  <th>Stock mínimo</th>
                  <th style="width: 7%">Opcion</th>
                </tr>
                </thead>
                <tbody>

                <?php $cont = 0;?>
                <?php foreach ($lisInsumos as $valor): ?>  
                <tr>
                  <input type="hidden" value="<?= $valor["Id"]?>" name="int">
                  <td><?= $cont += 1;?></td>
                  <td><?= $valor["Id"]?></td>
                  <td><?= $valor["Nombre"]?></td>
                  <td><option value="<?= $valor['codigo']?>"><?= $valor["nombre"]?></option></td>
                  <td><?= $valor["stockMinimo"]?></td>
                  <input type="hidden" value="<?= $valor["Estado"]?>" name="est">
                   <td>    
                    <button type="button" id="btnEditar" onclick="editar(<?= $valor["Id"]?>, this)" class="btn btn-box-tool" data-toggle="modal" data-target="#Modeleditar"><i class="fa fa-pencil-square-o"></i></button>

                    <?php if ($valor["Estado"] == 1): ?>
                         <button type="button" onclick="camEst(<?= $valor["Id"]?>, 0)" class="btn btn-box-tool"><i class="fa fa-minus-circle"></i></button> 
                    <?php endif ?>
                    <?php if ($valor["Estado"] == 0): ?>
                         <button type="button" onclick="camEst(<?= $valor["Id"]?>, 1)" class="btn btn-box-tool"><i class="fa fa-check"></i></button> 
                    <?php endif ?>
                  </td>
                </tr>
                <?php endforeach ?>
              </tbody></table>
            </div>
            </div>
          </div>
        </div>
      <div class="box-footer">
      </div>
     </form>  
    </div> 
  </section>
</div>








          
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="Modeleditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document" style="width: 60%;">
        <div class="modal-content" style="border-radius: 20px;">

        <form action="<?= URL;?>ctrlBodega/modificarInsumo" method="POST">
          <div class="modal-header" style="text-align: center;">
            <h3 class="box-title"><strong>MODIFICAR INSUMO</strong></h3>
          </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-md-6">

              <div class="col-md-12">
                <div class="form-group">
                   <input type="hidden" name="id" id="mSel">
                   <label class="control-label" length="80px">*Stock mínimo:</label>
                  <input id="3" type="number" class="form-control" min="0" style="width: 50%; " required="" name="stock">
                </div>
              </div>    

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">*Unidad de medida:</label>
                    <select class="form-control" style="width: 100%;" required="" name="select">
                     <option id="2" selected=""></option>
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
                 <input id="1" type="text" class="form-control" required="" name="nombre">
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
            <div class="box-body no-padding">
             <div class="table-responsive"> 
              <table class="table" id="tabla1" >
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
         <div class="modal-footer">

            <button data-dismiss="modal" onclick="reload()" class="btn btn-danger pull-right" style="margin-left: 2%; margin-top: 2%">Cancelar</button>
            <script type="text/javascript">
              function reload(){
              $('#tbody').empty();
              }
            </script>
            <input type="hidden" name="arreglo[]" id="vector">
            <button type="submit" onclick="colores()" class="btn btn-primary pull-right" style="margin-left: 2%; margin-top: 2%" name="btnRegIns">Registrar</button>
         </div> 
         </form>
        </div> 
      </div>
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
                 <td value="<?= $value["codigo"]; ?>"><?= $cont += 1; ?></td>
                  <td><?= $value["codigo"]; ?></td>
                  <td><i class="fa fa-square" style="color: <?= $value['codigo']; ?>; font-size: 200%;"></i> </td>
                  <td><?= $value["nombre"]; ?></td>
                  <td style="display: none;"><?= $value["id"]; ?></td>
                  <td><input type="checkbox" name="check" class="chk<?=$value["id"];?>"></td> 
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
          function camEst(cod, est){
              $.ajax({
                  dataType: 'json',
                  type: 'POST',
                  url: "<?= URL; ?>ctrlBodega/cambiarEstado", 
                  data:{id: cod, estado: est},
              }).done(function(respuesta){
                if (respuesta.v == 1) {
                  location.href = "<?= URL; ?>ctrlBodega/listarInsumos"; 
                }
              }).fail(function(){
              });
          } 
    </script>
 <script type="text/javascript">
     function editar(id, insumos){
          var campos = $(insumos).parent().parent();
          $.ajax({
                  dataType: 'json',
                  type: 'POST',
                  url: "<?= URL; ?>ctrlBodega/lisColInsu", 
                  data:{id: id},
              }).done(function(respuesta){
                if (respuesta) {
                  var cont = 0;
                  $.each(respuesta, function(i){
                  var fila = '<tr class="box box-solid collapsed-box"><td>'+(cont+=1)+'</td><td>'+respuesta[i]["codigo"]+'</td><td><i class="fa fa-square" style="color: '+respuesta[i]["codigo"]+'; font-size: 200%;"></i> </td><td>'+respuesta[i]["nombre"]+'</td><td style="display: none; ">'+respuesta[i]["id"]+'</td><td><button type="button" class="btn btn-box-tool" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button></td></tr>';
                  $("#tbody").append(fila);  
                  });
                }
              }).fail(function(){
              });
          $("#mSel").val(campos.find("td").eq(1).text());    
          $("#1").val(campos.find("td").eq(2).text());
          $("#2").val(campos.find("td").eq(3).find("option").val());
          $("#2").text(campos.find("td").eq(3).find("option").text());
          $("#3").val(campos.find("td").eq(4).text());
          $("#Modeleditar").show();
        }
 </script>
 <script type="text/javascript">
        function seleccion(){
         
          $("#tabla1").removeAttr("style");
          $(".tr").each( function(){
            var rg = false;
            // console.log($(".chk"+$(this).find("td").eq(4).html()));
            if ($(".chk"+$(this).find("td").eq(4).html()).is(':checked')) {
              var cod = $(this).find("td").eq(4).html();
              $("#tabla1 tr").find('td:eq(4)').each(function(){
                  if (cod == $(this).html()) {
                    rg = true;
                  }
              });
            if (rg == false) {
              var fila = '<tr class="box box-solid collapsed-box"><td>'+$(this).find("td").eq(0).html()+'</td><td>'+$(this).find("td").eq(1).html()+'</td><td>'+$(this).find("td").eq(2).html()+'</td><td>'+$(this).find("td").eq(3).html()+'</td><td style="display: none; ">'+$(this).find("td").eq(4).html()+'</td><td><button type="button" class="btn btn-box-tool" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button></td></tr>';
            $("#tbody").append(fila);
            }
            $(".chk"+$(this).find("td").eq(4).text()).prop("checked", "");
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








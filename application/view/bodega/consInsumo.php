    <section class="content-header"  >
    <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Listar insumos</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-primary with-border">
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
                <tr class="active" style="color: ">
                  <th style="width: 10px"></th>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Medida</th>
                  <th>Stock mínimo</th>
                  <th style="width: 7%">Editar</th>
                  <th style="width: 7%">Inhabilitar</th>
                </tr>
                </thead>
                <tbody>

                <?php $cont = 0;?>
                <?php foreach ($lisInsumos as $valor): ?>  
                <tr>
                  <input type="hidden" value="<?= $valor["Id_Insumo"]?>" name="int">
                  <td><?= $cont += 1;?></td>
                  <td><?= $valor["Id_Insumo"]?></td>
                  <td><?= $valor["Nombre"]?></td>
                  <td><option value="<?= $valor['Id_Medida']?>"><?= $valor["NombreMed"]?></option></td>
                  <td><?= $valor["Stock_Minimo"]?></td>
                  <input type="hidden" value="<?= $valor["Estado"]?>" name="est">
                  <td style="text-align: center;">    
                    <button type="button" id="btnEditar" onclick="editInsumos(<?= $valor["Id_Insumo"]?>, this)" class="btn btn-box-tool" data-toggle="modal" data-target="#ModEditIns"><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button>
                  </td>
                  <td style="text-align: center;">
                    <?php if ($valor["Estado"] == 1): ?>
                         <button type="button" onclick="camEst(<?= $valor["Id_Insumo"]?>, 0)" class="btn btn-box-tool"><i style="font-size: 150%;" class="fa fa-minus-circle"></i></button> 
                    <?php endif ?>
                    <?php if ($valor["Estado"] == 0): ?>
                         <button type="button" onclick="camEst(<?= $valor["Id_Insumo"]?>, 1)" class="btn btn-box-tool"><i style="font-size: 150%;" class="fa fa-check"></i></button> 
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









<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ModEditIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 60%;">
    <div class="modal-content" style="border-radius: 20px;">
      <form action="<?= URL;?>ctrBodega/modificarInsumo" method="POST">
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
                    <input id="stockIns" type="number" class="form-control" min="0" style="width: 50%; " required="" name="stock">
                </div>
              </div>    
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">*Unidad de medida:</label>
                    <select class="form-control" style="width: 100%;" required="" name="select">
                     <option id="medIns" selected=""></option>
                      <?php foreach ($listaM as $valor): ?>
                        <option value="<?= $valor["Id_Medida"]; ?>"><?= $valor["Nombre"]; ?></option>  
                      <?php endforeach ?>
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                   <label class="control-label">*Nombre:</label>
                   <input id="nomIns" type="text" class="form-control" required="" name="nombre">
                </div>
              </div>
              <div class="col-md-6">
                    <div class="form-group">
                     <label class="control-label" length="80px">*Valor: </label>
                     <input type="number" class="form-control" min="0" required="" name="valor">
                   </div>
              </div>
            <div class="col-md-6">
              <button  type="button" class="btn btn-primary pull-right" data-toggle="modal" style="margin-top: 15%;" data-target="#ModelProducto">Seleccionar color</button>
            </div>
          </div>


       </div>
            
        </div>
            <div class="col-md-12">
           <div class="box">
            <div class="box-body no-padding">
             <div class="table-responsive"> 
              <table class="table" id="tablaCol" >
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
                <tbody id="tbodyColIns">
                </tbody>      
              </table>
             </div>
           </div> 
          </div>
         </div>             
         <div class="modal-footer">

            <button data-dismiss="modal" onclick="reload()" class="btn btn-danger pull-right" style="margin-left: 2%; margin-top: 2%">Cancelar</button>
            <script type="text/javascript">
              function reload(){
              $('#tbodyColIns').empty();
              }
            </script>
            <input type="hidden" name="arregloCol[]" id="vectorCol">
            <button type="submit" onclick="coloresVec()" class="btn btn-primary pull-right" style="margin-left: 2%; margin-top: 2%" name="btnRegIns">Registrar</button>
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
                 <td value="<?= $value["Codigo_Color"]; ?>"><?= $cont += 1; ?></td>
                  <td><?= $value["Codigo_Color"]; ?></td>
                  <td><i class="fa fa-square" style="color: <?= $value['Codigo_Color']; ?>; font-size: 200%;"></i> </td>
                  <td><?= $value["Nombre"]; ?></td>
                  <td style="display: none;"><?= $value["Id_Color"]; ?></td>
                  <td><input type="checkbox" name="check" class="chk<?=$value["Id_Color"];?>"></td> 
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
            </div>
              
            <div class="modal-footer">
                <button type="button" onclick="seleccionCol()" class="btn btn-primary pull-right" style="margin-left: 2%;" data-dismiss="modal">Seleccionar</button>
            </div> 
            </div> 
         </div>
</div>

    <script type="text/javascript">
          function camEst(cod, est){
              alert(cod, est);
              $.ajax({
                  dataType: 'json',
                  type: 'POST',
                  url: "<?= URL; ?>ctrBodega/cambiarEstado", 
                  data:{id: cod, estado: est},
              }).done(function(respuesta){
                if (respuesta.v == 1) {
                  location.href = "<?= URL; ?>ctrBodega/listarInsumos"; 
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
                  url: "<?= URL; ?>ctrBodega/lisColInsu", 
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
<!--  <script type="text/javascript">
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
</script> -->
<!-- <script type="text/javascript">
  function colores(){
          var vec = [];
          $("#tabla1 tr").find('td:eq(4)').each(function(){
            vec.unshift([$(this).html()]);
          });
          $("#vector").val(vec);
  }
</script> -->






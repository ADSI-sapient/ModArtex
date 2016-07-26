    </div>
    <aside class="control-sidebar control-sidebar-dark">
      <div class="tab-content">
      </div>
    </aside>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        Anything you want
      </div>
      <strong>Copyright &copy; 2016 <a href="#">ModArtex</a>.</strong> Todos los derechos reservados.
    </footer>

    <script src="<?= URL;?>js/jQuery-2.2.0.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script> -->
    <script src="<?= URL;?>js/select2.full.min.js"></script>
    <script src="<?= URL;?>js/jquery.inputmask.js"></script>
    <script src="<?= URL;?>js/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= URL;?>js/jquery.inputmask.extensions.js"></script>
    <script src="<?= URL;?>js/daterangepicker.js"></script>
    <script src="<?= URL;?>js/bootstrap-datepicker.js"></script>
    <script src="<?= URL;?>css/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="<?= URL;?>js/bootstrap-timepicker.min.js"></script>
    <script src="<?= URL;?>js/jquery.slimscroll.min.js"></script>
    <script src="<?= URL;?>js/icheck.min.js"></script>
    <script src="<?= URL;?>js/fastclick.js"></script>
    <script src="<?= URL;?>js/application.js"></script>
    <script src="<?= URL;?>js/bootstrap.js"></script>
    <script src="<?= URL;?>js/Chart.min.js"></script>
    <script src="<?= URL;?>js/app.js"></script>
    <script src="<?= URL;?>js/demo.js"></script>
    <script src="<?= URL;?>js/moment.min.js"></script>
    <script src="<?= URL;?>js/jquery.dataTables.min.js"></script>
    <script src="<?= URL;?>js/sweetalert.js"></script>
    
    <!-- <script src="<?= URL;?>js/lobibox.min.js"></script> -->
    <script type="text/javascript">
      var uri = "<?= URL;?>";
    </script>

    <script src="<?= URL;?>js/ficha-pedido.js"></script>
    <script src="<?= URL;?>js/bodega.js"></script>
    <script src="<?= URL;?>js/configuracion.js"></script>
    <script src="<?= URL;?>js/application.js"></script>
    <script src="<?= URL;?>js/cotizacion.js"></script>
    <script type="text/javascript">

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
          $('.TablaU').DataTable();
          });

          $('.TablaU').DataTable( {
              
              info: false,
              ordering: false

          });

           var options = {
            valueNames: ['documento', 'tipo_Documento', 'nombre', 'apellido', 'rol']
          };

          var userList = new List('users', options);
    </script>
 

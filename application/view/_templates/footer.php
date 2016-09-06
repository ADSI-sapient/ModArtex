    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      </div>
      <strong>Copyright &copy; 2016 <a href="#">ModArtex</a>.</strong> Todos los derechos reservados.
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
      <div class="tab-content">
      </div>
    </aside>
    <div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>


    <!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script> -->
    <script src="<?= URL;?>js/select2.full.min.js"></script>
    <script src="<?= URL;?>js/jquery.inputmask.js"></script>
    <script src="<?= URL;?>js/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= URL;?>js/jquery.inputmask.extensions.js"></script>
    <script src="<?= URL;?>js/daterangepicker.js"></script>
    <script type="text/javascript" src="<?= URL;?>js/bootstrap-datepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?= URL;?>js/bootstrap-datepicker.es.js" charset="UTF-8"></script>
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
    <script src="<?= URL;?>js/moment-with-locales.js"></script>
    <script src="<?= URL;?>js/jquery.dataTables.min.js"></script>
    <script src="<?= URL;?>js/sweetalert.js"></script>
    <!-- Lobibox -->
    <script src="<?= URL;?>js/lobibox.min.js"></script>
    <script src="<?= URL;?>js/messageboxes.min.js"></script>
    <script src="<?= URL;?>js/notifications.min.js"></script>
    <script src="<?= URL;?>Parsley.js-2.4.4/dist/parsley.min.js"></script>
    <script src="<?= URL;?>Parsley.js-2.4.4/dist/i18n/es.js"></script>

    <script type="text/javascript">
      var uri = "<?= URL;?>";
      <?php if(isset($_SESSION['alert']) && $_SESSION['alert'] !== null ){
        echo $_SESSION['alert'];    
        $_SESSION['alert'] = null;
      } ?>
    </script>

    <script src="<?= URL;?>js/ficha.js"></script>
    <script src="<?= URL;?>js/pedido.js"></script>
    <script src="<?= URL;?>js/bodega.js"></script>
    <script src="<?= URL;?>js/configuracion.js"></script>
    <script src="<?= URL;?>js/application.js"></script>
    <script src="<?= URL;?>js/cotizacion.js"></script>
    <script src="<?= URL;?>js/persona.js"></script>
    <script src="<?= URL;?>js/productoT.js"></script>
    <script src="<?= URL;?>js/produccion.js"></script>

      <script type="text/javascript">
        $(function(){ 
          <?= isset($_SESSION["mensaje"])?$_SESSION["mensaje"]:""; ?>
          <?php $_SESSION["mensaje"] = null; ?>
        });
      </script>
<!--     <script src="<?= URL;?>js/roles.js"></script> -->
  </body>
</html>


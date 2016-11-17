<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ModArtex - Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <!--   <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans'> -->
<!--   <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">

  <link rel="stylesheet" href="<?= URL; ?>css/styleLogin.css"> -->
  <link rel="stylesheet" href="<?= URL; ?>css/bootstrap.css">
  <link rel="stylesheet" href="<?= URL; ?>css/lobibox.min.css">
  <link rel="stylesheet" href="<?= URL; ?>Parsley.js-2.4.4/src/parsley.css">
  <link rel="stylesheet" href="<?= URL; ?>css/font-awesome-4.6.1/css/font-awesome.css">
  <script src="<?= URL;?>js/jQuery-2.2.0.min.js"></script>
  </head>
<body>
<div style="text-align: center;  margin: auto; margin-top: 10%; width: 368px;">
  <div>
    <div>
      <form data-parsley-validate="" action="<?= URL; ?>ctrLogin/login" method="POST">
      <!-- <div style="border-bottom: solid 1px #cbd2d6; margin-bottom: 25px;"> -->
      <div style="margin-bottom: 25px;">
        <h1 style="color: #337ab7;">ModArtex</h1>
        <hr>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon" style="background: transparent;"><i class="fa fa-user fa-lg" aria-hidden="true"></i></div>
          <input style="height: 44px; border-left: none" class="form-control" name="txtUsuario" value="" placeholder="Usuario" autofocus="" data-parsley-required="" data-parsley-errors-container="#msjErrorUsu">
        </div>
        <div id="msjErrorUsu"></div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon" style="background: transparent;"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></div>
          <input style="height: 44px;  border-left: none" class="form-control" type="password" name="txtClave" value="" placeholder="Contraseña" data-parsley-required="" data-parsley-errors-container="#msjErrorPass">
        </div>
        <div id="msjErrorPass"></div>
      </div>
      <div class="form-group">
        <style type="text/css">
          #btnIngresar:hover{
            background-color: #2e699c;
          }
        </style>  
        <button  id="btnIngresar" style="width: 368px; padding: 10px; height: 44px" class="btn btn-primary btn-lg" type="submit" name="btnLogin" value="Login">Ingresar</button>
      </div>  
        <p><a href="<?= URL; ?>ctrLogin/recuperarPass">Recuperar contraseña</a></p>
      </form>
    </div>
  </div>
</div>
<footer>
</footer>
  <script src="<?= URL;?>js/application.js"></script>
  <script src="<?= URL;?>js/lobibox.js"></script>
  <script src="<?= URL;?>Parsley.js-2.4.4/dist/parsley.min.js"></script>
  <script src="<?= URL;?>Parsley.js-2.4.4/dist/i18n/es.js"></script>
      <script type="text/javascript">
        $(function(){ 
          <?= isset($_SESSION["mensaje"])?$_SESSION["mensaje"]:""; ?>
          <?php $_SESSION["mensaje"] = null; ?>
        });
      </script>
  </body>
</html>

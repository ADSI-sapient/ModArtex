<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Formulario de recuperación</title>
<!--   <link rel="stylesheet" href="<?= URL; ?>css/styleLogin.css">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?= URL; ?>css/bootstrap.css">
  <link rel="stylesheet" href="<?= URL; ?>css/font-awesome-4.6.1/css/font-awesome.css">
  <link rel="stylesheet" href="<?= URL; ?>css/lobibox.min.css">
  <link rel="stylesheet" href="<?= URL; ?>Parsley.js-2.4.4/src/parsley.css">
  <link rel="stylesheet" href="<?= URL; ?>css/font-awesome-4.6.1/css/font-awesome.css">
  <script src="<?= URL;?>js/jQuery-2.2.0.min.js"></script>
</head>
<body>
  <div style="text-align: center;  margin: auto; margin-top: 10%; width: 368px;">
  <div>
    <div>
      <form data-parsley-validate="" action="<?= URL; ?>ctrLogin/recuperarPass" method="POST">
      <!-- <div class="login__check1"></div> -->
      <div style="border-bottom: solid 1px #cbd2d6; margin-bottom: 25px;">
        <h1 style="color: #337ab7;">ModArtex</h1>
      </div>
      <div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon" style="background: transparent;"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></div>
            <input style="height: 44px; border-left: none" class="form-control" type="email" name="txtEmail" value="" placeholder="Correo electronico" autofocus="" data-parsley-required="">
          </div>  
        </div>
        <div class="form-group">
          <button style="width: 368px; padding: 10px; height: 44px" class="btn btn-primary btn-lg" type="submit" name="btnRecuperar" value="Recuperar"><b>Recuperar</b></button>
        </div>
        <p class="login__signup"><a href="<?= URL; ?>ctrLogin/login">Regresar al login</a></p>
      </div>
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

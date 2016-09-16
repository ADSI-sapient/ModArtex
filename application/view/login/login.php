<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login/Logout animation concept</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <!--   <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans'> -->
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">

  <link rel="stylesheet" href="<?= URL; ?>css/styleLogin.css">
  <link rel="stylesheet" href="<?= URL; ?>css/lobibox.min.css">
  <link rel="stylesheet" href="<?= URL; ?>Parsley.js-2.4.4/src/parsley.css">
  <link rel="stylesheet" href="<?= URL; ?>css/font-awesome-4.6.1/css/font-awesome.css">
  <script src="<?= URL;?>js/jQuery-2.2.0.min.js"></script>
  </head>
<body>
<div class="cont">
  <div class="demo" style="height: 380px; border-radius:10px;">
    <div class="login">
      <form data-parsley-validate="" action="<?= URL; ?>ctrLogin/login" method="POST">
      <div class="row" style="position: absolute; top: 5%; left: 17%;  text-align: center; ">
        <p style="font-family: 'Dancing Script', cursive; color: #ffffff; font-size: 900%">ModArtex</p>
      </div>
      <div class="login__form">
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input class="login__input name" name="txtUsuario" value="" placeholder="Usuario" autofocus="" data-parsley-required="">
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input class="login__input pass" type="password" name="txtClave" value="" placeholder="Contraseña" data-parsley-required="">
        </div>
        <button type="submit" class="login__submit" name="btnLogin" value="Login" style="cursor:pointer;"><b>Ingresar</b></button>
        <p class="login__signup"><a href="<?= URL; ?>ctrLogin/recuperarPass">Recuperar contraseña</a></p>
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

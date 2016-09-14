<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Formulario de recuperación</title>
  <link rel="stylesheet" href="<?= URL; ?>css/styleLogin.css">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= URL; ?>css/font-awesome-4.6.1/css/font-awesome.css">
  <link rel="stylesheet" href="<?= URL; ?>css/lobibox.min.css">
</head>
<body>
<!--   <section class="container">
    <div class="login">
      <h1>Recuperar contraseña</h1>
      <form method="POST" action="">
        <p><input type="text" name="txtEmail" value="" placeholder="Correo electronico"></p>
        <p class="remember_me">
          <a style="color: #81BEF7;" href="<?= URL; ?>ctrLogin/login">regresar al login</a> 
        </p>
        <p class="submit"><input type="submit" name="btnRecuperar" value="Recuperar"></p>
      </form>
    </div>
  </section> -->






  <div class="cont">
  <div class="demo" style="height: 380px; border-radius:10px;">
    <div class="login">
      <form action="<?= URL; ?>ctrLogin/recuperarPass" method="POST">
      <!-- <div class="login__check1"></div> -->
      <div class="row" style="position: absolute; top: 5%; left: 17%;  text-align: center; ">
        <p style="font-family: 'Dancing Script', cursive; color: #ffffff; font-size: 900%">ModArtex</p>
      </div>
      <div class="login__form">
        <div class="login__row">
          <svg class="login__icon name svg-icon">
            <!-- <path d="M101.3 141.6v228.9h0.3 308.4 0.8V141.6H101.3zM375.7 167.8l-119.7 91.5 -119.6-91.5H375.7zM127.6 194.1l64.1 49.1 -64.1 64.1V194.1zM127.8 344.2l84.9-84.9 43.2 33.1 43-32.9 84.7 84.7L127.8 344.2 127.8 344.2zM384.4 307.8l-64.4-64.4 64.4-49.3V307.8z" /> -->
          </svg>
          <input type="email" class="login__input name" name="txtEmail" value="" placeholder="Correo electronico" autofocus="">
        </div>
        <button type="submit" class="login__submit" name="btnRecuperar" value="Recuperar" style="cursor:pointer;"><b>Recuperar</b></button>
        <p class="login__signup"><a href="<?= URL; ?>ctrLogin/login">Regresar al login</a></p>
      </div>
    </form>
    </div>
  </div>
</div>
<footer>
  
</footer>
<script src="<?= URL;?>js/lobibox.js"></script>
      <script type="text/javascript">
        $(function(){ 
          <?= isset($_SESSION["mensaje"])?$_SESSION["mensaje"]:""; ?>
          <?php $_SESSION["mensaje"] = null; ?>
        });
      </script>
</body>
</html>

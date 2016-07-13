<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Formulario de ingreso</title>

  <link rel="stylesheet" href="<?= URL; ?>css/Style-login.css">
  <link rel="stylesheet" href="<?php echo URL; ?>fonts/font-awesome-4.6.1/css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/lobibox.min.css">

</head>
<body>
  <section class="container">
   
  </section>
  <section class="container">
    <div class="login">
      <h1>Ingreso a ModArtex</h1>
      <form method="post" action="">
        <p><input type="text" name="txtUsuario" value="" placeholder="Usuario"></p>
        <p><input type="password" name="txtClave" value="" placeholder="Contraseña"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Recortar contraseña 
          </label>
        </p>
        <p class="submit"><input type="submit" name="btnLogin" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p style="font-size: 120%">¿Olvidaste tu contraseña?</p> <a href="<?= URL; ?>ctrLogin/recuperarPass">Click aquí para restaurarla</a>
    </div>
  </section>

  <script src="<?php echo URL; ?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <script src= "<?php echo URL ?>js/lobibox.min.js"></script>
</body>
</html>

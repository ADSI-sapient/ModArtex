<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Formulario de ingreso</title>

  <link rel="stylesheet" href="<?= URL; ?>css/Style-login.css">
  <link rel="stylesheet" href="<?php echo URL; ?>plugins/font-awesome-4.6.1/css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URL; ?>css/lobibox.min.css">

</head>
<body>
  <section class="container">
   
  </section>
  <section class="container">
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
  </section>

  <script src="<?php echo URL; ?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <script src= "<?php echo URL ?>js/lobibox.min.js"></script>
  <script type="text/javascript">
          <?= $alerta ?>
  </script>
</body>
</html>

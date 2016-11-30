<section class="content-header">
<!--       <h1>
        <?= $_SESSION['user']['Nombre']; ?> <?= $_SESSION['user']['Apellido']; ?>
        <small>Preview</small>
      </h1> -->
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
</section>

<section class="content">
	<div class="row">
    <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mi Perfil</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">*Contraseña anterior</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">*Nueva contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">*Repeir nueva contraseña</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
              </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary ">Submit</button>
              </div>
            </form>

          </div>
        </div>
	</div>

<!-- 	<p><?= $_SESSION['user']['Nombre']; ?></p>
	<p><?= $_SESSION['user']['Apellido']; ?></p>
	<p><?= $_SESSION['user']['Usuario']; ?></p>
	<p><?= $_SESSION['user']['Clave']; ?></p>
	<p><?= $_SESSION['user']['Email']; ?></p>
	<p><?= $_SESSION['user']['Estado']; ?></p>
	<p><?= $_SESSION['user']['Tbl_Roles_Id_Rol']; ?></p>
	<p><?= $_SESSION['user']['nombreR']; ?></p> -->
</section>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="../../starter2.html"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Cliente</a></li>
      <li class="active">Registrar Cliente</li>
    </ol>
  </section>
  <br>

  <section class="content">
    <div class="box box-primary" style="padding-right: 15px;">
      <div class="box-header with-border">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><strong>REGISTRAR ClIENTE</strong></h3>
        </div>
        <br>
        <br>
        <form action="<?php echo URL; ?>ctrCliente/regCliente" method="POST">
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">Estado:</label>
              <select class="form-control" name="estado" required="">
                <option value="Habilitado" >Habilitado</option>
                <option value="Inhabilitado">Inhabilitado</option>
              </select>
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">*Tipo de Documento:</label>
              <select class="form-control" name="tipo_documento">
                <option value="CC">CC</option>
                <option value="CW">CE</option>
                <option value="NIT">NIT</option>
              </select>
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">*Documento:</label>
              <input type="text" class="form-control" id="documento" placeholder="" name="documento">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">*Nombre:</label>
              <input type="text" class="form-control" id="nombre" placeholder="" name="nombre">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">*Apellido:</label>
              <input type="text" class="form-control" id="apellido" placeholder="" name="apellido">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">Email:</label>
              <input type="text" class="form-control" id="email" placeholder="" name="email">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">Teléfono:</label>
              <input type="text" class="form-control" id="telefono" placeholder="" name="telefono">
            </div>
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-primary col-lg-offset-9" style="margin-top: 15px;"               name="btnRegistrarC">Registrar</button>
              <button type="reset" class="btn btn-danger" style="margin-left: 15px; margin-top: 15px;">Cancelar</button>
            </div>
          </form>
      </div>
    </div>
  </section>
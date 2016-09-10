<!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?php echo URL;?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Cliente</a></li>
      <li class="active">Registrar Cliente</li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><strong>REGISTRAR CLIENTE</strong></h3>
        </div>
        <div class="box-body">
        <form data-parsley-validate="" action="<?php echo URL; ?>ctrCliente/regCliente" method="POST">
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <label class="">*Nombre:</label>
              <input type="text" class="form-control" id="nombre" placeholder="" name="nombre" autofocus="" data-parsley-required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">*Apellido:</label>
              <input type="text" class="form-control" id="apellido" placeholder="" name="apellido" data-parsley-required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-3">
              <label class="">Estado:</label>
              <input type="text" name="Estado" class="form-control" value="Habilitado" disabled="">
              <!-- <select class="form-control" name="estado" required="" disabled="">
                <option value="Habilitado" >Habilitado</option>
                <option value="Inhabilitado">Inhabilitado</option>
              </select> -->
            </div>
          </div>
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <label class="">*Tipo de Documento:</label>
              <select class="form-control" name="tipo_documento" data-parsley-required="">

                <option value="CC">CC</option>
                <option value="CW">CE</option>
                <option value="NIT">NIT</option>
              </select>
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">*Documento:</label>

              <input type="text" class="form-control" id="documento" placeholder="" name="documento" onChange="validarSiDocumento(this.value);" data-parsley-required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-3">
              <label class="">*Email:</label>
              <input type="text" class="form-control" id="email" placeholder="" name="email" onChange="validarEmail(this.value);" data-parsley-required="">
            </div>
          </div>
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <label class="">*Teléfono:</label>
              <input type="text" class="form-control" id="telefono" placeholder="" name="telefono" onChange="validarTelefono(this.value);" data-parsley-required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">*Dirección:</label>
              <input type="text" class="form-control" id="direccion" placeholder="" name="direccion" data-parsley-required="">
            </div>
          </div>
          <div class="row"> 
            <div class="form-group col-lg-12" style="margin-left:14px">
              <button type="submit" class="btn btn-primary col-lg-offset-9" style="" name="btnRegistrarC"><b>Registrar</b></button>
              <button type="reset" class="btn btn-danger" style="">Limpiar</button> 
            </div>
          </div>
          </form>
        </div>
    </div>
  </section>


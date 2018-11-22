<div class="col-md-12 aLoad">
  <div class="titular">
    <h3>Mi Cuenta</h3>               
  </div>
  <?php
  $data = Usuario_TraerPorId($_SESSION["user"]["id"]);
  if (isset($_POST["registrarmeBtn"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["password1"]) && !empty($_POST["password2"]) && !empty($_POST["email"])) {
      if ($_POST["password1"] == $_POST["password2"]) {
        if($data["email"] != $_POST["email"]) {
          $emailRevisar = Revisar_Email("usuarios", "email", $_POST["email"]);  
        } else {
          $emailRevisar = "no";
        }

        if ($emailRevisar != "si") {
          $id = $_SESSION['user']['id'];
          $nombre = $_POST["nombre"];
          $dni = $_POST["dni"];
          $email = $_POST["email"];
          $pass = $_POST["password1"];
          $telefono = $_POST["telefono"];
          $domicilio = $_POST["domicilio"];
          $localidad = $_POST["localidad"];
          $provincia = $_POST["provincia"];
          $postal = $_POST["postal"];

          $sql =  "
          UPDATE `usuarios`
          SET
          `nombre` = '$nombre',
          `email` = '$email',
          `pass` = '$pass',
          `cuit` = '$dni',
          `postal` = '$postal',
          `telefono` = '$telefono',
          `direccion` = '$domicilio',
          `localidad` = '$localidad',
          `provincia` = '$provincia'
          WHERE `id` = $id ";
          $link = Conectarse();
          $r = mysqli_query($link, $sql);

          RLogin($email, $pass);

          headerMove(BASE_URL."/sesion.php?op=mi-cuenta");

          echo '<div class="alert alert-success animated fadeInDown" id="" role="alert">Muchas gracias ' . strtoupper(strtoupper($nombre)) . ', se modificó exitosamente!.</div>';
        } else {
          echo "<div class='alert alert-danger'>Lo sentimos el correo electrónico ya existe.</div>";
        }
      } else {
        echo "<div class='alert alert-danger'>Lo sentimos las contraseñas no coindicen.</div>";
      }
    } else {
      echo '<div class="alert alert-danger animated fadeInDown" id="" role="alert">Te pedimos disculpas , pero no podemos enviar tu mensaje , porque son necesarios todos los datos.</div>';
    }
  }
  ?>
  <form method="post" autocomplete="off" class="formFilterMiCuenta">
    <div class="row">
      <label class="mb-20 col-md-12 col-xs-12">
        Nombre y Apellido
        <div class="input-group">
          <input class="form-control" type="text" value="<?php echo isset($data["nombre"]) ? $data["nombre"] : '' ?>" placeholder="Escribir tu nombre" name="nombre" required/>
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-user"></i>
          </span>
        </div>
      </label> 
      <label class="mb-20 col-md-12 col-xs-12">
        Email
        <div class="input-group">
          <input class="form-control" type="email" value="<?php echo isset($data["email"]) ? $data["email"] : '' ?>" placeholder="Escribir tu email" name="email" required/>
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-envelope"></i>
          </span>
        </div>
      </label> 
      <label class="mb-20 col-md-6 col-xs-12">
        Contraseña
        <div class="input-group">
          <input class="form-control" type="password" value="<?php echo isset($data["pass"]) ? $data["pass"] : '' ?>" placeholder="Escribir tu password"  name="password1" required/>
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock"></i>
          </span>
        </div>
      </label>
      <label class="mb-20 col-md-6 col-xs-12">
        Repetir Contraseña
        <div class="input-group">
          <input class="form-control" type="password" value="<?php echo isset($data["pass"]) ? $data["pass"] : '' ?>" placeholder="Escribir tu repassword"  name="password2" required/>
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock"></i>
          </span>
        </div>
      </label> 
      <label class="mb-20 col-md-6 col-xs-12">
        DNI
        <div class="input-group">
          <input class="form-control" type="text" value="<?php echo isset($data["cuit"]) ? $data["cuit"] : '' ?>" placeholder="Escribir tu dni"  onkeypress="return onlyNumbersDano(event)" name="dni"/>
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-barcode"></i>
          </span>
        </div>
      </label>  
      <label class="mb-20 col-md-6 col-xs-12">
        Teléfono 
        <div class="input-group">
          <input class="form-control" type="text" value="<?php echo isset($data["telefono"]) ? $data["telefono"] : '' ?>" placeholder="Escribir tu teléfono"  onkeypress="return onlyNumbersDano(event)" name="telefono" required/>
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-earphone"></i>
          </span>
        </div>
      </label>  
      <label class="mb-20 col-md-6 col-xs-12">
        Domicilio
        <div class="input-group">
          <input class="form-control" type="text" value="<?php echo isset($data["direccion"]) ? $data["direccion"] : '' ?>" placeholder="Escribir tu domicilio"  name="domicilio"/>
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-home"></i>
          </span>
        </div>
      </label>
      <label class="mb-20 col-md-6 col-xs-12">
        Código Postal
        <div class="input-group">
          <input class="form-control" type="text" value="<?php echo isset($data["postal"]) ? $data["postal"] : '' ?>" placeholder="Escribir tu código postal"  name="postal" onkeypress="return onlyNumbersDano(event)"/>
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-map-marker"></i>
          </span>
        </div>
      </label>
      <label class="mb-20 col-md-6 col-xs-12">
        Provincia
        <div class="input-group">
         <select class="pull-right form-control" name="provincia" id="provincia"  required>
          <option value="<?php echo isset($data["provincia"]) ? $data["provincia"] : '' ?>"><?php echo isset($data["provincia"]) ? $data["provincia"] : '' ?></option>
          <?php Provincias_Read_Front() ?>
        </select>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-map-marker"></i>
        </span>
      </div>
    </label>
    <label class="mb-20 col-md-6 col-xs-12">
      Localidad
      <div class="input-group">
        <select class="form-control" name="localidad" id="localidad"  required>    
          <option value="<?php echo isset($data["localidad"]) ? $data["localidad"] : '' ?>"><?php echo isset($data["localidad"]) ? $data["localidad"] : '' ?></option>
        </select>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-map-marker"></i>
        </span>
      </div>
    </label>
    <label class="col-md-12 col-xs-12"><br/>
      <input class="btn btn-success" type="submit" value="Modificar" name="registrarmeBtn" />
    </label>         
  </div>
</form>
</div>
<div class="clearfix"></div><br><br>
</div>
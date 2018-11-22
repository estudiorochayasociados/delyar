<div ><h3 class="mb-20 mt-0 pull-left">Registrate para la compra</h3><a href="<?php echo BASE_URL ?>/inc/login.inc.php"  data-title="Iniciar Sesión" class="linkModal pull-right btn btn-info">Ya tenés tu cuenta de cliente, <b>ingresá ahora</b></a></div>
<div class="clearfix"></div>
<?php
if(isset($_SESSION["user"])) {
  headerMove(BASE_URL."/checkout/finalizar-carrito");  
}

if (isset($_POST["registrarmeBtn"])) {
  $nombre = antihack_mysqli(isset($_POST["nombre"]) ? $_POST["nombre"] : '');
  $apellido = antihack_mysqli(isset($_POST["apellido"]) ? $_POST["apellido"] : '');
  $nombreFinal = $nombre." ".$apellido;
  $email = antihack_mysqli(isset($_POST["email"]) ? $_POST["email"] : '');
  $telefono = antihack_mysqli(isset($_POST["telefono"]) ? $_POST["telefono"] : '');
  $localidad = antihack_mysqli(isset($_POST["localidad"]) ? $_POST["localidad"] : '');
  $provincia = antihack_mysqli(isset($_POST["provincia"]) ? $_POST["provincia"] : '');
  $crear = antihack_mysqli(isset($_POST["crear"]) ? $_POST["crear"] : '1');
  $password1 = antihack_mysqli(isset($_POST["password1"]) ? $_POST["password1"] : '');
  $password2 = antihack_mysqli(isset($_POST["password2"]) ? $_POST["password2"] : '');

  if($crear == 0) {
    if (!empty($nombre) && !empty($password1) && !empty($password2) && !empty($email)) {
      if ($password1 == $password2) {
        $emailRevisar = Revisar_Email("usuarios", "email", $_POST["email"]);
        $revision = @count($emailRevisar);
        if ($revision == 0) {
          $array = array(
            'properties' => array(
              array('property' => 'email','value' => $email),
              array('property' => 'firstname','value' =>  $nombre),
              array('property' => 'lastname','value' =>  $apellido),
              array('property' => 'phone','value' => $telefono)
            )
          );

          $url = "https://api.hubapi.com/contacts/v1/contact";
          Hubspot_Dev($array,$url,"NOTES");

          $sql = "INSERT INTO `usuarios`
          (`nombre`, `email`, `pass`, `telefono`, `localidad`, `provincia`, `inscripto`,`invitado`) 
          VALUES
          ('$nombreFinal','$email', '$password1','$telefono', '$localidad','$provincia', NOW(), '$crear')";
          
          $link = Conectarse();
          $r = mysqli_query($link,$sql);
          RLogin($email, $password1);
          if($r) {
            headerMove(BASE_URL."/checkout/finalizar-carrito");
          }
        } else {
          echo "<div class='alert alert-danger'>Lo sentimos el correo electrónico ya existe.</div>";
        }
      } else {
        echo "<div class='alert alert-danger'>Lo sentimos las contraseñas no coindicen.</div>";
      }
    } else {
      echo '<div class="alert alert-danger animated fadeInDown" id="" role="alert">Te pedimos disculpas , pero no podemos registrate porque son necesarios todos los datos.</div>';
    }
  }  else {
   if (!empty($nombre) && !empty($email)) {
    $emailRevisar = Revisar_Email("usuarios", "email", $email);
    $revision = @count($emailRevisar);
    if ($revision == 0) {
      $sql = "INSERT INTO `usuarios`
      (`nombre`, `email`,   `telefono`, `localidad`, `provincia`, `direccion`, `inscripto`,`invitado`) 
      VALUES
      ('$nombreFinal','$email',  '$telefono', '$localidad','$provincia', '$domicilio',NOW(), '$crear')";
      $link = Conectarse();
      $r = mysqli_query($link,$sql);
      $idUsuario=mysqli_insert_id($link);
      $_SESSION["user"] = Usuario_TraerPorId($idUsuario);  
      if($r) {
        headerMove(BASE_URL."/checkout/finalizar-carrito");
      }
    } else {
      $_SESSION["user"] = Usuario_TraerPorId($emailRevisar["id"]);  
      headerMove(BASE_URL."/checkout/finalizar-carrito");
    }

    $array = array(
      'properties' => array(
        array('property' => 'email','value' => $email),
        array('property' => 'firstname','value' =>  $nombre),
        array('property' => 'lastname','value' =>  $apellido),
        array('property' => 'phone','value' => $telefono)
      )
    );

    $url = "https://api.hubapi.com/contacts/v1/contact";
    //Hubspot_Dev($array,$url,"NOTES");

  } else {
    echo '<div class="alert alert-danger animated fadeInDown" id="" role="alert">Te pedimos disculpas , pero no podemos registrate porque son necesarios todos los datos.</div>';
  }
} 
}

?>
<form method="post" >
  <div class="row">
    <div class="col-md-6 col-xs-6">
      Nombre
      <div class="input-group">
        <input class="form-control" type="text" value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : '' ?>" placeholder="Escribir nombre" name="nombre" required/>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-user"></i>
        </span>
      </div>
    </div>
    <div class="col-md-6 col-xs-6">
      Apellido
      <div class="input-group">
        <input class="form-control" type="text" value="<?php echo isset($_POST["apellido"]) ? $_POST["apellido"] : '' ?>" placeholder="Escribir apellido" name="apellido" required/>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-user"></i>
        </span>
      </div>
    </div>
    <div class="col-md-6 col-xs-12">
      Email
      <div class="input-group">
        <input class="form-control" type="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : '' ?>" placeholder="Escribir email" name="email" required/>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-envelope"></i>
        </span>
      </div>
    </div>     
    <div class="col-md-6 col-xs-6">
      Teléfono
      <div class="input-group">
        <input class="form-control" type="text" value="<?php echo isset($_POST["telefono"]) ? $_POST["telefono"] : '' ?>" placeholder="Escribir telefono"  name="telefono" required/>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-earphone"></i>
        </span>
      </div>
    </div> 
    <div class="col-md-6 col-xs-6">
      Provincia
      <div class="input-group">
        <select class="pull-right form-control" name="provincia" id="provincia" placeholder="Escribir tu provincia" required>
          <option>Provincia</option>
          <?php Provincias_Read_Front() ?>
        </select>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-map-marker"></i>
        </span>
      </div>
    </div>   
    <div class="col-md-6 col-xs-6">
      Localidad
      <div class="input-group">
        <select class="form-control" name="localidad" id="localidad"  required>    
          <option>Localidad</option>        
        </select>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-map-marker"></i>
        </span>
      </div>
    </div>
    <div class="col-md-12 col-xs-12">
      Domicilio
      <div class="input-group">
        <input class="form-control" type="text" value="<?php echo isset($_POST["domicilio"]) ? $_POST["domicilio"] : '' ?>" placeholder="Escribir domicilio" name="domicilio" required/>
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-home"></i>
        </span>
      </div>
    </div>     
    <label  class="col-md-12 col-xs-12 mt-10 mb-10" style="font-size:16px">
      <input type="checkbox" name="crear" value="0" checked="checked" onchange="$('.password').slideToggle()"> Deseo crear una cuenta de cliente para futuras compras
    </label>       
    <div class="col-md-6 col-xs-6 password">
      Contraseña
      <div class="input-group">
        <input class="form-control " type="password" value="<?php echo isset($_POST["password1"]) ? $_POST["password1"] : '' ?>" placeholder="Escribir contraseña"  name="password1" />
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-lock"></i>
        </span>
      </div>
    </div>
    <div class="col-md-6 col-xs-6 password">
      Repetir contraseña
      <div class="input-group">
        <input class="form-control " type="password" value="<?php echo isset($_POST["password2"]) ? $_POST["password2"] : '' ?>" placeholder="Repetir contraseña"  name="password2" />
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-lock"></i>
        </span>
      </div>
    </div>  
    <div class="col-md-12 col-xs-12">
      <br/><input class="btn btn-success" type="submit" value="Registrarme" name="registrarmeBtn" />
    </div>      
  </div>
</form>
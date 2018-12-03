<?php
session_start();
if(!isset($_SESSION["carrito"]) ){
  $_SESSION["carrito"] = array();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("inc/header.inc.php"); ?> 
  <?php 
  if(!empty($_SESSION["user"]["id"])) {
    header("location:sesion.php");  }
    ?>
    <title>Ingreso de Usuarios - Delyar </title>  
  </head>
  <body>
    <div id="page">
      <header class="header">
        <?php include("inc/nav.inc.php"); ?>
      </header>

      <div class="row encabezado wow fadeInUp">
        <div class="container">
          <div>
            <h1>  <i class="material-icons">label_outline</i>Ingreso usuarios</h1>
          </div>
        </div>
      </div>
      <div class="container cuerpoContenedor"> 
        <div class="col-md-5">
          <div id="inicio"><h3>Iniciar Sesión</h3></div>
          <hr/>
          <?php
          if (isset($_POST["ingresarBtn"])) {
            $password = antihack_mysqli($_POST["password"]);
            $email = antihack_mysqli($_POST["email"]);
            if (!empty($password) && !empty($email)) {
              $data = RLogin($email, $password);
              if($data == 1){
                echo "<script> document.location.href='".BASE_URL."/productos.php';</script>";
              }
            }
          }  
          ?>
          <form method="post" action="<?= BASE_URL ?>/usuarios#inicio">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <b>Email</b>
                <div class="input-group">
                  <input class="form-control" type="email" placeholder="Escribir email" name="email" required/>
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                  </span>
                </div>
              </div>     
              <div class="col-md-12 col-xs-12"><br/>
                <b>Contraseña</b>
                <div class="input-group">
                  <input class="form-control" type="password" placeholder="Escribir contraseña"  name="password" />
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                  </span>
                </div>
              </div>
              <div class="col-md-12 col-xs-12 mt-10 mb-0">
                <a href="<?php echo BASE_URL ?>/olvidar-contrasena.php" class="linkModal"  data-title="Recordar contraseña">
                  <i class="fa fa-user">
                  </i> ¿Olvidaste tu contraseña?
                </a>
              </div>
              <div class="clearfi"></div>
              <div class="col-md-12 col-xs-12 mt-10">                 
                <input class="btn btn-success" type="submit" value="Iniciar Sesión" name="ingresarBtn" />
              </div>      
            </div>
          </form>
        </div>
        <div class="col-md-7">
          <div id="registro"><h3>Registrarme</h3></div>
          <hr/>
          <?php
          if (isset($_POST["registrarmeBtn"])) {

           $nombre = antihack_mysqli(isset($_POST["nombre"]) ? $_POST["nombre"] : '');
           $apellido = antihack_mysqli(isset($_POST["apellido"]) ? $_POST["apellido"] : '');
           $nombreFinal = $nombre." ".$apellido;
           $email = antihack_mysqli(isset($_POST["email"]) ? $_POST["email"] : '');
           $dni = antihack_mysqli(isset($_POST["dni"]) ? $_POST["dni"] : '');
           $postal = antihack_mysqli(isset($_POST["postal"]) ? $_POST["postal"] : '');
           $telefono = antihack_mysqli(isset($_POST["telefono"]) ? $_POST["telefono"] : '');
           $direccion = antihack_mysqli(isset($_POST["domicilio"]) ? $_POST["domicilio"] : '');
           $localidad = antihack_mysqli(isset($_POST["localidad"]) ? $_POST["localidad"] : '');
           $provincia = antihack_mysqli(isset($_POST["provincia"]) ? $_POST["provincia"] : '');
           $crear = antihack_mysqli(isset($_POST["crear"]) ? $_POST["crear"] : '1');
           $password1 = antihack_mysqli(isset($_POST["password1"]) ? $_POST["password1"] : '');
           $password2 = antihack_mysqli(isset($_POST["password2"]) ? $_POST["password2"] : '');

           $mensaje = 'Nuevo usuario registrado con los datos:<br/>';
           $mensaje .= "<b>NOMBRE Y APELLIDO:</b> ".$nombreFinal."<br/>";
           $mensaje .= "<b>EMAIL:</b> ".$email."<br/>";
           $mensaje .= "<b>CUIT / DNI:</b> ".$dni."<br/>";
           $mensaje .= "<b>POSTAL:</b> ".$postal."<br/>";
           $mensaje .= "<b>TELÉFONO:</b> ".$telefono."<br/>";
           $mensaje .= "<b>DIRECCIÓN:</b> ".$direccion."<br/>";
           $mensaje .= "<b>LOCALIDAD:</b> ".$localidad."<br/>";
           $mensaje .= "<b>PROVINCIA:</b> ".$provincia."<br/>";
           $mensaje .= "<b>CONTRASEÑA:</b> ".$password1."<br/>";

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
              (`nombre`, `email`, `pass`, `cuit`, `postal`, `telefono`, `direccion`, `localidad`, `provincia`, `inscripto`,`invitado`) 
              VALUES
              ('$nombreFinal','$email', '$password1','$dni', '$postal', '$telefono','$direccion', '$localidad','$provincia', NOW(), '$crear')";

              $link = Conectarse();
              $r = mysqli_query($link,$sql);

              Enviar_User("Gracias por tu registro", "Gracias por registrate en nuestra plataforma.<br/>Nuestros vendedores se comunicarán con vos para poder confirmar los datos que nos brindaste y darte la herramienta de comercio electrónico para que gestiones tus compras donde quieras.", $email);

              Enviar_User_Admin("Nuevo usuario registrado", $mensaje, "mhaspert@delyar.com.ar");

              echo "<div class='alert alert-success'>Excelente! Tu cuenta fue creada exitosamente, nuestros vendedores se comunicarán con vos para poder confirmar los datos que nos brindaste y darte la herramienta de comercio electrónico para que gestiones tus compras donde quieras.</div>";
            } else {
              echo "<div class='alert alert-danger'>Lo sentimos el correo electrónico ya existe.</div>";
            }
          } else {
            echo "<div class='alert alert-danger'>Lo sentimos las contraseñas no coindicen.</div>";
          }
        } else {
          echo '<div class="alert alert-danger animated fadeInDown" id="" role="alert">Te pedimos disculpas , pero no podemos registrate porque son necesarios todos los datos.</div>';
        }
      }
      ?>
      <form method="post" action="<?= BASE_URL ?>/usuarios#registro">
        <div class="row">
          <label class="mb-20 col-md-6 col-xs-12">
            Nombre
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Escribir tu nombre" name="nombre" value="<?= isset($_POST["nombre"]) ? $_POST["nombre"] : ''; ?>" required/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-user"></i>
              </span>
            </div>
          </label> 
          <label class="mb-20 col-md-6 col-xs-12">
            Apellido
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Escribir tu nombre" name="apellido" value="<?= isset($_POST["apellido"]) ? $_POST["apellido"] : ''; ?>" required/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-user"></i>
              </span>
            </div>
          </label> 
          <label class="mb-20 col-md-12 col-xs-12">
            Email
            <div class="input-group">
              <input class="form-control" type="email" placeholder="Escribir tu email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-envelope"></i>
              </span>
            </div>
          </label> 
          <label class="mb-20 col-md-6 col-xs-12">
            Contraseña
            <div class="input-group">
              <input class="form-control" type="password" placeholder="Escribir tu contraseña"  name="password1" value="<?= isset($_POST["password1"]) ? $_POST["password1"] : ''; ?>" required/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-lock"></i>
              </span>
            </div>
          </label>
          <label class="mb-20 col-md-6 col-xs-12">
            Repetir Contraseña
            <div class="input-group">
              <input class="form-control" type="password" placeholder="Repetir tu contraseña"  name="password2" value="<?= isset($_POST["password2"]) ? $_POST["password2"] : ''; ?>" required/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-lock"></i>
              </span>
            </div>
          </label> 
          <label class="mb-20 col-md-6 col-xs-12">
            CUIT / DNI
            <div class="input-group">
              <input class="form-control" required type="text" placeholder="Escribir tu DNI"  onkeypress="return onlyNumbersDano(event)" name="dni" value="<?= isset($_POST["dni"]) ? $_POST["dni"] : ''; ?>"/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-barcode"></i>
              </span>
            </div>
          </label>  
          <label class="mb-20 col-md-6 col-xs-12">
            Teléfono 
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Escribir tu teléfono"  onkeypress="return onlyNumbersDano(event)" name="telefono" value="<?= isset($_POST["telefono"]) ? $_POST["telefono"] : ''; ?>" required/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-earphone"></i>
              </span>
            </div>
          </label>  
          <label class="mb-20 col-md-6 col-xs-12">
            Domicilio
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Escribir tu direccion"  name="domicilio" value="<?= isset($_POST["domicilio"]) ? $_POST["domicilio"] : ''; ?>"/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-home"></i>
              </span>
            </div>
          </label>
          <label class="mb-20 col-md-6 col-xs-12">
            Código Postal
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Escribir tu código postal"  name="postal" value="<?= isset($_POST["postal"]) ? $_POST["postal"] : ''; ?>" onkeypress="return onlyNumbersDano(event)"/>
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-map-marker"></i>
              </span>
            </div>
          </label>
          <label class="mb-20 col-md-6 col-xs-12">
            Provincia
            <div class="input-group">
             <select class="pull-right form-control" name="provincia" id="provincia"  required>
              <?php if(isset($_POST["provincia"])) { ?>
                <option value="<?= $_POST["provincia"] ?>" selected><?= $_POST["provincia"] ?></option>
              <?php } ?>
              <option value="" >Provincia</option>
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
              <?php if(isset($_POST["localidad"])) { ?>
                <option value="<?= $_POST["localidad"] ?>" selected><?= $_POST["localidad"] ?></option>     
              <?php } ?>
              <option value="" >Localidad</option>        
            </select>
            <span class="input-group-addon">
              <i class="glyphicon glyphicon-map-marker"></i>
            </span>
          </div>
        </label>
        <label class="col-md-12 col-xs-12"><br/>
          <input class="btn btn-success" type="submit" value="Registrarme" name="registrarmeBtn" />
        </label>         
      </div>
    </form>
  </div>
  <div class="clearfix"></div><br><br>
</div>  
<?php include("inc/footer.inc.php"); ?>
</body>
</html>
<?php
@ob_end_flush();
?>
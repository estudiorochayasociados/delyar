<?php
$index     = antihack(strpos($_SERVER['REQUEST_URI'], "index"));
$empresa   = antihack(strpos($_SERVER['REQUEST_URI'], "empresa"));
$servicios = antihack(strpos($_SERVER['REQUEST_URI'], "servicios"));
$productos = antihack(strpos($_SERVER['REQUEST_URI'], "productos"));
$novedades = antihack(strpos($_SERVER['REQUEST_URI'], "novedades"));
$nota      = antihack(strpos($_SERVER['REQUEST_URI'], "nota"));
$videos    = antihack(strpos($_SERVER['REQUEST_URI'], "videos"));
$contacto  = antihack(strpos($_SERVER['REQUEST_URI'], "contacto"));
if ($index == "" && $empresa == "" && $servicios == "" && $productos == "" && $novedades == "" && $nota == "" && $videos == "" && $contacto == "") {
    $vacio = "ok";
}
//if($contacto) {echo "class='active'";}
?>
<div class="pre-head">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-xs-12 hidden-xs hidden-sm">
      </div>
      <div class="col-sm-7 col-xs-12 headerTop zindex text-right">
        <span class="mr-20 hidden-xs hidden-sm">03564 427633 / 437047 / 436226</span>
         <?php if (isset($_SESSION["user"]["id"])) {?>
          <a  class="mr-10" href="<?php echo BASE_URL ?>/usuarios" >
            <b><i class="fa fa-user"></i> <?=$_SESSION["user"]["nombre"]?></b>
          </a> |
          <a    href="<?php echo BASE_URL; ?>/sesion?op=salir" >
            <b><i class="fa fa-sign-out" aria-hidden="true"></i> SALIR</b>
          </a>
        <?php } else {?>
          <a  class="mr-10" href="<?php echo BASE_URL ?>/usuarios#inicio" >
            <b><i class="fa fa-user"></i>  Ingresá </b>
          </a>
          <a class="mr-10">o</a>
          <a    href="<?php echo BASE_URL ?>/usuarios#registro" >
            <b> <i class="fa fa-user"></i>  Registrate!</b>
          </a>
        <?php }?>

        <?php if (isset($_SESSION["carrito"][0])) {?>
         | <a href="<?php echo BASE_URL ?>/carrito" >
          <b><i class="fa fa-shopping-cart"></i> PEDIDO</b>
        </a>
      <?php }
       
      ?>
    </div>
  </div>
</div>
</div>
<nav class="navbar navbar-static-top">
  <div class="container">
    <div class="mg-top-n50">
    <a class="navbar-brand pt-10 pb-10" href="<?php echo BASE_URL; ?>/index">
      <img class="paddlogo" alt="logo" src="<?php echo BASE_URL; ?>/img/logo.png" width="200" />
    </a>
  </div>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header mg-top-50">
     <button name="mobile" role="" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
  </div>
  <div class=" pd-navv collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   <ul class="mg-top-10 nav navbar-nav navbar-right">
    <li><a class="nava <?php if ($index || $vacio) {echo 'active';}?>" href="<?php echo BASE_URL ?>/index" alt="INICIO" title="INICIO"><img class="mg-top-n10" src="<?php echo BASE_URL; ?>/img/png/home.png" width="30" /> INICIO</a></li>
    <li><a class="nava <?php if ($empresa) {echo 'active';}?>" href="<?php echo BASE_URL ?>/empresa" alt="EMPRESA" title="EMPRESA"><img class="mg-top-n10" src="<?php echo BASE_URL; ?>/img/png/heart.png" width="30" /> EMPRESA</a></li>
    <li><a class="nava <?php if ($servicios) {echo 'active';}?>" href="<?php echo BASE_URL ?>/servicios" alt="SERVICIOS" title="SERVICIOS"><img class="mg-top-n10" src="<?php echo BASE_URL; ?>/img/png/light-bulb.png" width="30" />SERVICIOS</a></li>

    <li><a class="nava <?php if ($productos) {echo 'active';}?>" href="<?php echo BASE_URL ?>/productos" alt="PRODUCTOS" title="PRODUCTOS"><img class="mg-top-n10" src="<?php echo BASE_URL; ?>/img/png/shopping-cart.png" width="30" />PRODUCTOS</a></li>

    <li><a class="nava <?php if ($novedades || $nota) {echo 'active';}?>" href="<?php echo BASE_URL ?>/novedades" alt="NOVEDADES" title="NOVEDADES"><img class="mg-top-n10" src="<?php echo BASE_URL; ?>/img/png/book.png" width="30" />NOVEDADES</a></li>
    <li><a class="nava <?php if ($videos) {echo 'active';}?>" href="<?php echo BASE_URL ?>/videos" alt="VIDEOS" title="VIDEOS"><img class="mg-top-n10" src="<?php echo BASE_URL; ?>/img/png/book.png" width="30" />VIDEOS</a></li>
    <li><a class="nava <?php if ($contacto) {echo 'active';}?>" href="<?php echo BASE_URL ?>/contacto" alt="CONTACTO" title="CONTACTO"><img class="mg-top-n10" src="<?php echo BASE_URL; ?>/img/png/message.png" width="30" />CONTACTO</a></li>
    <li><a class="" style="background: #fff;padding:5px 10px;color:#1371B9 !important;font-weight: bold" href="<?php echo BASE_URL ?>/pdf.pdf" target="_blank" alt="PDF INSTITUCIONAL" title="PDF INSTITUCIONAL">PDF INSTITUCIONAL</a></li>
    <li style="display:none" ><a class="nava" href="<?php echo BASE_URL ?>/clientes"   alt="INGRESO CLIENTES" title="INGRESO CLIENTES"><img class="mg-top-n10" src="img/png/avatar-1.png" width="30" />CLIENTES</a></li>
  </ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
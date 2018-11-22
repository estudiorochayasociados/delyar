<?php
session_start();
ob_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("inc/header.inc.php"); 
  $title = TITULO;
  $keywords = "productos, agropecuario, veterinaria, campo, san francisco, semillas";
  $description = "Todos los productos de Delyar S.A. disponibles de manera online.";
  $imagen = LOGO;
  ?>
  <title>Productos | <?php echo $title; ?></title>
  <meta http-equiv="title" content="<?php echo $title; ?>" />
  <meta name="description" lang=es content="<?php echo $description; ?>" />
  <meta name="keywords" lang=es content="<?php echo $keywords; ?>" />
  <link href="<?php echo $imagen ?>" rel="Shortcut Icon" />
  <meta name="DC.title" content="<?php echo $title; ?>" />
  <meta name="DC.subject" content="<?php echo $description; ?>" />
  <meta name="DC.description" content="<?php echo $description; ?>" />

  <meta property="og:title" content="<?php echo $title; ?>" />
  <meta property="og:description" content="<?php echo $description; ?>" />
  <meta property="og:image" content="<?php echo $imagen ?>" />

  <?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $palabra = antihack_mysqli(isset($_GET["palabra"]) ? $_GET["palabra"] : '');      
  $modelo = antihack_mysqli(isset($_GET["modelo"]) ? $_GET["modelo"] : '');      
  $marca = antihack_mysqli(isset($_GET["marca"]) ? $_GET["marca"] : '');      
  $variable = antihack_mysqli(isset($_GET["variable"]) ? $_GET["variable"] : '');      
  $categoriaA = antihack_mysqli(isset($_GET["categoria"]) ? $_GET["categoria"] : '');      
  ?>
</head>
<body>

 <div id="page" class="index">
  <div class="navbar-fixed nav2">
    <?php include("inc/nav.inc.php"); ?>    
  </div>

  <div class="row encabezado wow fadeInUp">
    <div class="container">
      <div>
        <h1>  <i class="material-icons">label_outline</i> Productos</h1>
      </div>
    </div>
  </div><br/><br/>

  <form class="container"  role="search" method="get" action="<?php echo BASE_URL ?>/productos.php">   
    <div class="col-md-6">
      <input type="text"  name="palabra" value="<?php echo $palabra ?>"  placeholder="Buscar..." class="form-control">
    </div>
    <div class="clearfix hidden-lg hidden-md"></div>
    <div class="col-md-6">
      <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> BUSCAR</button>
    </div>
  </form>  
  <main class="main main-home">
    <div class="container pt-20 pb-20">
      <div id="resultados"></div>
      <?php if($palabra != '' || $marca != '' || $categoriaA != '') { ?>
        <div class="col-md-12 ">
          <div class="alert alert-info text-uppercase">              
            Estás buscando por:<br/>
            <?php
            if($palabra != '') { echo "<b> $palabra </b><br/>";};
            ?>
          </div>
        </div>
      <?php } ?>
      <div class="col-md-12 col-lg-12 flex-wrap hidden-sm hidden-xs"> 
        <?php 
        Productos_Front($palabra);
        ?>
      </div>     

      <div class="col-sm-12 col-xs-12 flex-wrap hidden-md hidden-lg"> 
        <?php 
        Productos_Front_Mobile($palabra);
        ?>
      </div>   

    </div>
  </main>
  
  <?php include("inc/footer.inc.php"); ?> 
</div>
</body>
</html>

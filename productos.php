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
  $filter = array();
  $leyenda = '';
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 

  $palabra = antihack_mysqli(isset($_POST["palabra"]) ? $_POST["palabra"] : '');      
  if($palabra != '') {
    array_push($filter,'patron_producto = "'.$palabra.'"');
    $leyenda .= "<b>Palabra:</b> ".$palabra." <button class='btn btn-sm btn-warning' onclick=\"unset('palabra')\"><i class='fa fa-remove'></i></button><br/>"; 
  }
  $marca = antihack_mysqli(isset($_POST["marca"]) ? $_POST["marca"] : '');      
  if($marca != '') {
    array_push($filter,'marca_producto = "'.$marca.'"');
    $leyenda .= "<b>Marca:</b> ".$marca." <button class='btn btn-sm btn-warning' onclick=\"unset('marca')\"><i class='fa fa-remove'></i></button><br/>"; 
  }
  $categoria = antihack_mysqli(isset($_POST["categoria"]) ? $_POST["categoria"] : '');      
  if($categoria != '') {
    array_push($filter,'categoria_producto = "'.$categoria.'"');
    $leyenda .= "<b>Categoría:</b> ".$categoria." <button class='btn btn-sm btn-warning' onclick=\"unset('categoria')\"><i class='fa fa-remove'></i></button><br/>"; 
  }
  $subcategoria = antihack_mysqli(isset($_POST["subcategoria"]) ? $_POST["subcategoria"] : '');      
  if($subcategoria != '') {
    array_push($filter,'subcategoria_producto = "'.$subcategoria.'"');
    $leyenda .= "<b>Subcategoria:</b> ".$subcategoria." <button class='btn btn-sm btn-warning' onclick=\"unset('subcategoria')\"><i class='fa fa-remove'></i></button><br/>"; 
  } 
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
  <div class="container">
    <form class="row"  role="search" method="POST" action="<?php echo BASE_URL ?>/productos.php">   
      <div class="col-md-2">
        <b>Palabra:</b><br/>
        <input type="text"  name="palabra" id="palabra" value="<?php echo $palabra ?>"  placeholder="Buscar..." class="form-control">
      </div>    
      <div class="col-md-3">
        <b>Categoría:</b><br/>
        <select  onchange="$('form').submit()" name="categoria" id="categoria" class="form-control">
          <option value=''>Seleccionar Categoria</option>
          <?php Traer_Filtros_Option($categoria, "categoria_producto",$filter); ?>
        </select>      
      </div>
      <div class="col-md-3">
        <b>Subcategoria:</b><br/>
        <select  onchange="$('form').submit()" name="subcategoria" id="subcategoria" class="form-control">
          <option value=''>Seleccionar Subcategoria</option>
          <?php Traer_Filtros_Option($subcategoria, "subcategoria_producto",$filter); ?>
        </select>      
      </div>
      <div class="col-md-3">
        <b>Marca:</b><br/>
        <select  onchange="$('form').submit()" name="marca" id="marca" class="form-control">
          <option value=''>Seleccionar Marca</option>
          <?php Traer_Filtros_Option($marca, "marca_producto",$filter); ?>
        </select>      
      </div>
      <div class="col-md-1"><br/>
        <button type="submit"  class="btn btn-info"><i class="fa fa-search"></i> BUSCAR</button>
      </div>
    </form>  
  </div>
  <main class="main main-home">
    <div class="container pt-20 pb-20">
      <div id="resultados"></div>
      <?php if($palabra != '' || $marca != '' || $categoria != '' || $subcategoria != '') { ?>
        <div class=" ">
          <div class="alert alert-info text-uppercase">              
            Estás buscando por:<br/>
            <?= $leyenda; ?>
          </div>
        </div>
      <?php } ?>
      <div class="hidden-sm hidden-xs"> 
        <?php 
        Productos_Front($filter);
        ?>
      </div>     

      <div class="hidden-md hidden-lg"> 
        <?php 
        Productos_Front_Mobile($filter);
        ?>
      </div>   

    </div>
  </main>
  
  <?php include("inc/footer.inc.php"); ?> 
</div>
</body>
</html>

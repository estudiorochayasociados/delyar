<?php
include 'cnx.php';
//UPDATE `portfolio` SET  `imagen1_portfolio`= CONCAT('archivos/productos/',`cod_portfolio`,'.jpg')  WHERE `imagen2_portfolio` = ''
$op     = isset($_GET['op']) ? $_GET['op'] : '';
$pagina = isset($_GET['pag']) ? $_GET['pag'] : '';

/* * **************************** READ DE TABLAS */

function Videos_Read()
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM videos ORDER BY IdVideos DESC";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {

    ?>
    <tr>
      <td><?php echo $row['TituloVideos'] ?></td>
      <td>
       <div style="width:60px;margin: auto;display:block">
        <a href="index.php?op=modificarVideos&id=<?php echo $row['IdVideos'] ?>" style="width:20px" data-toggle="tooltip" alt="Modificar" title="Modificar"><i class="glyphicon glyphicon-cog" ></i></a>
        <a href="index.php?op=verVideos&borrar=<?php echo $row['IdVideos'] ?>" style="width:20px" data-toggle="tooltip" alt="Eliminar" title="Eliminar" onClick="return confirm('¿Seguro querés eliminar el video?')" ><i class="glyphicon glyphicon-trash"></i></a>
      </div></td>
    </tr>

    <?php
  }
}

function Videos_Read_Front()
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM videos ORDER BY IdVideos DESC";
  $resultado = mysqli_query($idConn, $sql);

  while ($row = mysqli_fetch_array($resultado)) {
    ?>
    <div class="col-md-4" style="height:350px">
     <iframe width="100%" height="215" src="https://www.youtube.com/embed/<?php echo $row["UrlVideos"] ?>" frameborder="0" allowfullscreen></iframe>
     <hr/>
     <h4><?php echo $row["TituloVideos"] ?></h4>
   </div>
   <?php
 }
}

function Videos_Read_Front_Index()
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM videos  ORDER BY IdVideos DESC LIMIT 4 ";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
  while ($row = mysqli_fetch_array($resultado)) {
    ?>
    <div class="col-md-6">
     <iframe width="100%" height="215" src="https://www.youtube.com/embed/<?php echo $row["UrlVideos"] ?>" frameborder="0" allowfullscreen></iframe>
     <h4 class="titularVideo"><?php echo $row["TituloVideos"] ?></h4>
   </div>
   <?php
 }
}

function Videos_Read_Side()
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM videos ORDER BY RAND() LIMIT 0,1";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {
    ?>

    <iframe width="100%" height="250px" src="//www.youtube.com/embed/<?php echo $row["UrlVideos"] ?>" frameborder="0" allowfullscreen></iframe>

    <?php
  }
}

function Slider_Read($tipo)
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM sliderbase WHERE EstadoSlider = 0 AND TipoSlider = '$tipo' ORDER BY IdSlider DESC";
  $resultado = mysqli_query($idConn, $sql);
  $i         = 0;
  while ($row = mysqli_fetch_array($resultado)) {
    $pos       = strpos($row["LinkSlider"], "http");
    $titulo    = trim($row["TituloSlider"]);
    $imagen    = BASE_URL . "/" . $row["ImgSlider"];
    $subtitulo = trim($row["SubtituloSlider"]);
    $link      = trim($row["LinkSlider"]);
    ?>


    <div class="item <?php if ($i == 0) {echo 'active';}?>">
      <img src="<?php echo $imagen; ?>" alt="slide">
    </div>

    <?php
    $i++;
  }
}

function Slider_Read_Admin()
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM sliderbase ORDER BY IdSlider DESC";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
  $i = 0;
  while ($row = mysqli_fetch_array($resultado)) {
    ?>
    <tr>
      <td><?php echo $row['IdSlider'] ?></td>
      <td><?php echo $row['TituloSlider'] ?></td>
      <td style="text-transform:uppercase !important"><?php echo $row['TipoSlider'] ?></td>
      <td>
       <center>
        <?php
        switch ($row['EstadoSlider']) {
          case 0:
          ?><a href="index.php?op=verSlider&upd=1&borrar=<?php echo $row[0] ?>"
           id="tooltip<?php echo $i++ ?>" style="width:20px"><i
           class="glyphicon glyphicon-ok-circle"></i></a><?php
           break;
           case 1:
           ?><a href="index.php?op=verSlider&upd=0&borrar=<?php echo $row[0] ?>"
             id="tooltip<?php echo $i++ ?>" style="width:20px"><i
             class="glyphicon glyphicon-ban-circle"></i></a><?php
             break;
           }
           ?>
         </center>
       </td>
       <td>
         <center>
          <a href="index.php?op=modificarSlider&id=<?php echo $row[0] ?>"><i
           class="glyphicon glyphicon-cog"></i></a>
           <a href="index.php?op=verSlider&borrar=<?php echo $row[0] ?>"><i
            class="glyphicon glyphicon-trash"></i></a>
          </center>
        </td>
      </tr>

      <?php

    }
  }
  function Leer_Pedidos($id_usuario)
  {
    $idConn    = Conectarse();
    $sql       = "SELECT * FROM pedidos WHERE usuario_pedido =  '2' ORDER BY estado_pedido ASC";
    $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
    $i = 0;
    while ($row = mysqli_fetch_array($resultado)) {
      ?>
      <li class="listado" <?php
      if ($row["estado_pedido"] == 1) {
        echo "style='background:#4393C3'";
      } else {
        echo "style='background:#2166AC'";
      }
      ?>>
      <p><?php echo "Pedido &rarr; " . strtoupper($row["categoria_pedido"]) . "<br/>Solicitado &rarr; " . $row["fecha_pedidos"] ?> </p>
      <button onclick=($("#pedido<?php echo $i ?>").slideToggle('500'))>Ver +</button>   </li>
      <span class="listadoSpan" id="pedido<?php echo $i ?>" style="display:none">
        <?php echo $row["contenido_pedido"] ?>
        <?php
        if ($row["estado_pedido"] == 1) {
          echo "Presupuesto &rarr; $" . $row["costo_pedido"] . " <a href='pedido.php?op=pagar'>PAGAR</a>";
        }
        ?>
      </span>

      <?php
      $i++;
    }
  }

  function Notas_Read()
  {
    $idConn = Conectarse();
    $sql    = "
    SELECT *
    FROM notabase
    ORDER BY IdNotas DESC
    ";
    $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

    while ($row = mysqli_fetch_array($resultado)) {
      ?>
      <tr>
       <td class="maxwidth"><?php echo ($row['IdNotas']) ?></td>
       <td style="text-transform:uppercase"><?php echo strtoupper($row['TituloNotas']) ?></td>
       <td style="text-transform:uppercase"><?php echo strtoupper($row['CategoriaNotas']) ?></td>
       <td>

         <Center>
           <a href="index.php?op=modificarNotas&id=<?php echo $row['IdNotas'] ?>" style="width:20px" data-toggle="tooltip" alt="Modificar" title="Modificar"><i class="glyphicon glyphicon-cog" ></i></a>
           <a href="index.php?op=verNotas&borrar=<?php echo $row["CodNotas"] ?>" style="width:20px" data-toggle="tooltip" alt="Eliminar" title="Eliminar" onClick="return confirm('¿Seguro querés eliminar la novedad?')" ><i class="glyphicon glyphicon-trash"></i></a>
         </Center>
       </td>
     </tr>
     <?php
   }
 }

 function Portfolio_Read()
 {
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM portfolio
  ORDER BY id_portfolio DESC
  ";
  $resultado = mysqli_query($idConn, $sql);

  while ($row = mysqli_fetch_array($resultado)) {
    $categoria = $row['categoria_portfolio'];
    $estado    = $row['estado_portfolio'];
    $id        = $row['id_portfolio'];
    $cod       = $row['cod_portfolio'];
    ?>
    <tr>
     <td><?php echo $cod; ?></td>
     <td style="text-transform:uppercase"><?php echo substr(strtoupper($row['nombre_portfolio']), 0, 50) ?></td>
     <td style="text-transform:uppercase"><?php echo strtoupper($categoria); ?></td>
     <td style="text-transform:uppercase">
      <?php
      if ($estado == 0) {
        echo "<a href='index.php?op=verPortfolio&id=$id&estado=1'><i class='fa fa-check-square'></i></a>";
      } else {
        echo "<a href='index.php?op=verPortfolio&id=$id&estado=0'><i class='fa fa-square-o'></i></a>";
      }
      ?>
    </td>
    <td style="text-align:center">
     <a href="index.php?op=modificarPortfolio&id=<?php echo $row['id_portfolio'] ?>" data-toggle="tooltip" alt="Modificar" title="Modificar"><i class="glyphicon glyphicon-cog"></i></a>
     <a href="index.php?op=verPortfolio&borrar=<?php echo $row["id_portfolio"] ?>" onClick="return confirm('¿Seguro querés eliminar el producto?')" data-toggle="tooltip" alt="Eliminar" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
   </td>
 </tr>
 <?php
}
}
function Portfolio_Read_Front($categoria)
{
  require_once "paginacion/Zebra_Pagination.php";
  $con = Conectarse_Mysqli();
  if ($categoria == '') {
    $query          = "SELECT * FROM  `portfolio` where estado_portfolio = 0  and stock_portfolio > 0 ORDER BY id_portfolio Desc";
    $res            = $con->query($query);
    $num_registros  = mysqli_num_rows($res);
    $resul_x_pagina = 12;
    $paginacion     = new Zebra_Pagination();
    $paginacion->records($num_registros);
    $paginacion->records_per_page($resul_x_pagina);
    $consulta = "SELECT * FROM  `portfolio` where estado_portfolio = 0  and stock_portfolio > 0 ORDER BY  id_portfolio Desc
    LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
  } else {
    $query          = "SELECT * FROM  `portfolio` where categoria_portfolio = '$categoria' and estado_portfolio = 0  and stock_portfolio > 0 ORDER BY id_portfolio Desc";
    $res            = $con->query($query);
    $num_registros  = mysqli_num_rows($res);
    $resul_x_pagina = 12;
    $paginacion     = new Zebra_Pagination();
    $paginacion->records($num_registros);
    $paginacion->records_per_page($resul_x_pagina);
    $consulta = "SELECT * FROM  `portfolio` where categoria_portfolio = '$categoria' and estado_portfolio = 0  and stock_portfolio > 0 ORDER BY  id_portfolio Desc
    LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
  }

  $result = $con->query($consulta);

  while ($row = mysqli_fetch_array($result)) {
    if ($row["imagen1_portfolio"] != '') {
      if (is_file($row["imagen1_portfolio"])) {
        $imagen = $row["imagen1_portfolio"];
      } else {
        $imagen = 'img/producto_sin_imagen.jpg';
      }
    }
    $fecha  = explode("-", $row["fecha_portfolio"]);
    $titulo = utf8_encode($row["nombre_portfolio"]);
    ?>
    <div class="col-md-4 product-box">
      <a href="productos.php?id=<?php echo strtoupper($row["id_portfolio"]) ?>">
        <div class="product-wrap" style="height:150px;overflow:hidden;background:url('<?php echo $imagen ?>') no-repeat center center;background-size:contain"></div>
      </a>
      <h1 class="tituloProducto"><a href="productos.php?id=<?php echo $row["id_portfolio"] ?>"  style="font-size:25px"><?php echo htmlspecialchars($titulo); ?></a></h1>
      <span class="precioProducto"><b>Categoría: </b><br/><a href='productos.php?buscar=<?php echo $row["categoria_portfolio"] ?>'><?php echo $row["categoria_portfolio"] ?></a></span><br/>
      <!--<span class="precioProducto"><b>Stock: </b><?php echo $row["stock_portfolio"] ?> unidades</span><br/> -->
      <span class="precioProducto"><b>Precio: </b><?php echo "$" . $row["precio_portfolio"] ?> <span class="iva">+ iva</span></span>
      <div class="clearfix"></div><br/>
      <a href="productos.php?id=<?php echo $row["id_portfolio"] ?>" class="btn btn-default"  ><i class="fa fa-plus"></i> VER MÁS</a>
    </div>
    <?php
  }
  echo '<div class="col-md-12 blog-pagination"><br/><br/><br/><br/>';
  $paginacion->render();
  echo '<br/><br/></div>';
}

function Portfolio_Read_Slide()
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM portfolio
  WHERE estado_portfolio = 0 and stock_portfolio > 0
  ORDER BY RAND()
  LIMIT 25
  ";
  $resultado = mysqli_query($idConn, $sql);
  mb_internal_encoding('UTF-8');
  while ($row = mysqli_fetch_array($resultado)) {
    if ($row["imagen1_portfolio"] != '') {
      if (is_file($row["imagen1_portfolio"])) {
        $imagen = $row["imagen1_portfolio"];
      } else {
        $imagen = 'img/producto_sin_imagen.jpg';
      }
    }

    $titulo = htmlentities($row["nombre_portfolio"]);
    $fecha  = explode("-", $row["fecha_portfolio"]);
    ?>
    <div class="productosMasVistos">
      <a href="productos.php?id=<?php echo strtoupper($row["id_portfolio"]) ?>">
        <div class="product-wrap" style="height:180px;overflow:hidden;background:url('<?php echo $imagen ?>') no-repeat center center;background-size:contain"></div>
      </a>
      <h1 class="tituloProducto"><a href="productos.php?id=<?php echo $row["id_portfolio"] ?>"  style="font-size:25px"><?php echo ($titulo) ?></a></h1>
      <span class="precioProducto"><b>Categoría: </b><br/><a href='productos.php?buscar=<?php echo $row["categoria_portfolio"] ?>'><?php echo $row["categoria_portfolio"] ?></a></span><br/>
      <!--<span class="precioProducto"><b>Stock: </b><?php echo $row["stock_portfolio"] ?> unidades</span> · -->
      <span class="precioProducto"><b>Precio: </b><?php echo "$ " . $row["precio_portfolio"] ?></span>
      <div class="clearfix"></div><br/>
      <a href="productos.php?id=<?php echo $row["id_portfolio"] ?>" class="btn btn-default"  ><i class="fa fa-plus"></i> VER MÁS</a>
    </div>
    <?php
  }
}

function Portfolio_Read_Front_Relacionados($categoria)
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM portfolio
  WHERE categoria_portfolio = $categoria
  ORDER BY RAND()
  LIMIT 4
  ";
  $resultado = mysqli_query($idConn, $sql);
  while ($row = mysqli_fetch_array($resultado)) {
    ?>
    <div class="col-md-4 product-box">
      <a href="repuestos.php?id=<?php echo $row["id_portfolio"] ?>">
        <div class="product-wrap" style="background:url(<?php echo $row["imagen1_portfolio"] ?>)no-repeat center center;background-size:cover;height:160px;width:100%"></div>
      </a>
      <h2><a href="repuestos.php?id=<?php echo $row["id_portfolio"] ?>"><?php echo utf8_encode($row["nombre_portfolio"]) ?></a></h2>
      <a href="repuestos.php?id=<?php echo $row["id_portfolio"] ?>" class="btn btn-outline"><i class="fa fa-plus"></i>VER  MÁS</a>
    </div>
    <?php
  }
}

function Portfolio_Read_Front_Side()
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM portfolio
  ORDER BY RAND()";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
  while ($row = mysqli_fetch_array($resultado)) {
    ?>
    <div class="row product-box">
      <div class="col-md-4"style="overflow:hidden;height:60px"><!-- product photo -->
        <div class="product-wrap">
          <img src="<?php echo $row["imagen1_portfolio"] ?>" width="100%" class="img-responsive" />
        </div>
      </div>
      <div class="col-md-8"><!-- product info -->
        <h3><a href="repuestos.php?id=<?php echo $row["id_portfolio"] ?>"><?php echo htmlspecialchars($row["nombre_portfolio"]) ?></a></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <?php
  }
}

function Portfolio_Read_Front_Busqueda($palabra)
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM portfolio
  WHERE categoria_portfolio LIKE '%$palabra%'
  ORDER BY 'id_portfolio' ASC
  ";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
  while ($row = mysqli_fetch_array($resultado)) {
    ?>
         <!-- <div class="col-sm-4 col-md-3" >
        <div class="thumbnail" style="height:400px">
          <h3 style="text-transform:uppercase;font-size:16px"><?php echo utf8_encode($row["nombre_portfolio"]) ?></h3>
          <a href="productos.php?id=<?php echo $row["id_portfolio"] ?>" title="<?php echo utf8_encode($row["nombre_portfolio"]) ?>" ><div style="background: url(<?php echo $row["imagen1_portfolio"] ?>) center center;background-size:cover;height:200px;"></div></a>
          <div class="caption">
            <p><a href="productos.php?id=<?php echo $row["id_portfolio"] ?>" title="<?php echo utf8_encode($row["nombre_portfolio"]) ?>" class="btn btn-primary2" style="background: #E64A50" role="button">Ver más</a><br /><br />
              <a href="#" class="btn btn-default" disabled role="button" style="border:none"><i class="glyphicon glyphicon-chevron-right" style="margin-right:10px"></i><?php echo strtoupper($row["categoria_portfolio"]) ?></a></p>
            </div>
          </div>
        </div> -->

        <div class="column dt-sc-one-third catelog-menu all-sort non-veg-receipes-sort soups-sort isotope-item" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);"><!--catelog-menu Starts Here-->
         <a href="images/shop-item1.jpg" data-gal="prettyPhoto[gallery]">
          <div class="catelog-thumb">
            <img src="images/shop-item1.jpg" alt="" title="The Buffet Corner">
          </div>
        </a>
        <h5><a href="#">Turkish Cream Delight</a></h5>
        <span class="price">$14.55</span>
      </div>
      <?php
    }
  }

  function Ver_Control($cod)
  {
    $idConn = Conectarse();

    if ($cod != 0) {
      $sql = "
      SELECT *
      FROM `interno`
      WHERE `control` = '$cod'
      ORDER BY `fecha` DESC
      ";
    } else {
      $sql = "
      SELECT *
      FROM interno
      ORDER BY fecha DESC
      ";
    }

    $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

    while ($row = mysqli_fetch_array($resultado)) {
      $f     = explode(" ", $row["fecha"]);
      $fecha = explode("-", $f[0]);
      ?>
      <tr>
       <?php if ($row["control"] != 0) {?>
         <td><?php echo $row["control"] ?></td>
       <?php } else {
        echo "<td>Sin Orden</td>";
      }
      ?>
      <td><?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?></td>
      <td><?php echo $row["cliente"] ?></td>
      <td><?php echo $row["tiempo"] ?></td>
      <td><?php echo $row["estado"] ?></td>
      <td><center>
        <a href="index.php?op=infoControl&id=<?php echo $row["id"] ?>"><img src="img/ver.jpg" width="20" style="margin:2px"></a>
        <a href="index.php?pag=control&op=e&id=<?php echo $row["id"] ?>"><img src="img/elim.jpg" width="15" style="margin:2px"></a>
      </center></td>
    </tr>
    <?php
  }
}

function Ver_Orden($estado)
{
  $idConn = Conectarse();
  $sql    = "
  SELECT nombre_usuario,id_orden,cliente_orden,trabajo_orden,area_orden,cod_orden,pedido_orden,estado_usuario,estado_orden
  FROM orden, empleados
  WHERE user_orden = id_usuario AND estado_orden = $estado
  ORDER BY id_orden DESC
  ";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {
    $fecha   = explode("-", $row["pedido_orden"]);
    $usuario = explode(" ", $row["nombre_usuario"]);
    ?>
    <tr>
     <td><?php echo strtoupper($row["id_orden"]) ?></td>
     <td><?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?></td>
     <td><?php echo strtoupper($usuario[0]) ?></td>
     <td><?php echo strtoupper($row["cliente_orden"]) ?></td>
     <td><?php echo strtoupper(substr($row["trabajo_orden"], 0, 22)) ?>...</td>
     <td><?php echo strtoupper($row["area_orden"]) ?></td>
     <td>
       <center>
         <a href="index.php?op=agregarControl&id=<?php echo $row["cod_orden"] ?>"><img src="img/add.jpg" width="20" style="margin:2px"></a>
         <a href="index.php?op=modificarOrden&id=<?php echo $row["cod_orden"] ?>"><img src="img/modif.png" width="20" style="margin:2px"></a>
         <a href="index.php?op=verControl&id=<?php echo $row["cod_orden"] ?>"><img src="img/repo.jpg" width="20" style="margin:2px"></a>


         <?php
         if ($_SESSION["usuario"]["estado_usuario"] != 0) {
          ?>
          <a href="index.php?pag=orden&op=e&id=<?php echo $row["id_orden"] ?>"><img src="img/elim.jpg" width="15" style="margin:2px"></a>
          <a href="index.php?pag=orden&op=infoOrden&id=<?php echo $row["id_orden"] ?>"><img src="img/info.jpg" width="20" style="margin:2px"></a><?php }?>
        </center>
      </td>
      <td><center>
        <?php switch ($row["estado_orden"]) {
          case 1: ?>
          <a href="index.php?op=verOrden&es=<?php echo $row["id_orden"] ?>&estado=0"><img src="img/estado2.jpg"></a>
          <?php
          break;
          case 0:
          ?>
          <a href="index.php?op=verOrden&es=<?php echo $row["id_orden"] ?>&estado=1"><img src="img/estado.jpg"></a>
          <?php
          break;
          case 2:
          ?>
          <a href="index.php?op=verOrden&es=<?php echo $row["id_orden"] ?>&estado=1"><img src="img/estado3.jpg"></a>
          <?php
          break;
        }
        ?>

      </center>
    </td>
  </tr>
  <?php
}
}

function Ver_Resumen()
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM  `subcategorias` ,  `categorias` ,  `usuarios` ,  `pedidos`
  WHERE  `usuario_pedido` =  `id`
  AND  `categoria_pedido` =  `id_categoria`
  ";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {
    $fecha   = explode("-", $row["pedido_orden"]);
    $usuario = explode(" ", $row["nombre_usuario"]);
    ?>
    <tr>
     <td><?php echo strtoupper($row["id_orden"]) ?></td>
     <td><?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?></td>
     <td><?php echo strtoupper($usuario[0]) ?></td>
     <td><?php echo strtoupper($row["cliente_orden"]) ?></td>
     <td><?php echo strtoupper(substr($row["trabajo_orden"], 0, 22)) ?>...</td>
     <td><?php echo strtoupper($row["area_orden"]) ?></td>
     <td>
       <center>
         <a href="index.php?op=agregarControl&id=<?php echo $row["cod_orden"] ?>"><img src="img/add.jpg" width="20" style="margin:2px"></a>
         <a href="index.php?op=modificarOrden&id=<?php echo $row["cod_orden"] ?>"><img src="img/modif.png" width="20" style="margin:2px"></a>
         <a href="index.php?op=verControl&id=<?php echo $row["cod_orden"] ?>"><img src="img/repo.jpg" width="20" style="margin:2px"></a>


         <?php
         if ($_SESSION["usuario"]["estado_usuario"] != 0) {
          ?>
          <a href="index.php?pag=orden&op=e&id=<?php echo $row["id_orden"] ?>"><img src="img/elim.jpg" width="15" style="margin:2px"></a>
          <a href="index.php?pag=orden&op=infoOrden&id=<?php echo $row["id_orden"] ?>"><img src="img/info.jpg" width="20" style="margin:2px"></a><?php }?>
        </center>
      </td>
      <td><center>
        <?php switch ($row["estado_orden"]) {
          case 1: ?>
          <a href="index.php?op=verOrden&es=<?php echo $row["id_orden"] ?>&estado=0"><img src="img/estado2.jpg"></a>
          <?php
          break;
          case 0:
          ?>
          <a href="index.php?op=verOrden&es=<?php echo $row["id_orden"] ?>&estado=1"><img src="img/estado.jpg"></a>
          <?php
          break;
          case 2:
          ?>
          <a href="index.php?op=verOrden&es=<?php echo $row["id_orden"] ?>&estado=1"><img src="img/estado3.jpg"></a>
          <?php
          break;
        }
        ?>

      </center>
    </td>
  </tr>
  <?php
}
}

function Ver_Orden_RRHH()
{
  $idConn = Conectarse();
  $sql    = "
  SELECT nombre_usuario,id_orden,cliente_orden,busqueda_orden,puesto_orden,cod_orden,ingreso_orden,estado_usuario,estado_orden
  FROM rrhh, empleados
  WHERE user_orden = id_usuario
  ORDER BY id_orden DESC
  ";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {
    $fecha   = explode("-", $row["ingreso_orden"]);
    $usuario = explode(" ", $row["nombre_usuario"]);
    ?>
    <tr>
     <td><?php echo strtoupper($row["id_orden"]) ?></td>
     <td><?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?></td>
     <td><?php echo strtoupper($usuario[0]) ?></td>
     <td><?php echo strtoupper($row["cliente_orden"]) ?></td>
     <td><?php echo strtoupper(substr($row["busqueda_orden"], 0, 22)) ?>...</td>
     <td><?php echo strtoupper($row["puesto_orden"]) ?></td>
     <td>
       <center>
         <a href="index.php?op=modificarRRHH&id=<?php echo $row["cod_orden"] ?>"><img src="img/modif.png" width="20" style="margin:2px"></a>
         <?php
         if ($_SESSION["usuario"]["estado_usuario"] != 0) {
          ?>
          <a href="index.php?pag=orden&op=infoRRHH&id=<?php echo $row["id_orden"] ?>"><img src="img/info.jpg" width="20" style="margin:2px"></a><?php
        }
        ?>
      </center>
    </td>
    <td><center>
      <?php if ($row["estado_orden"] != 0) {?>
        <a href="index.php?op=verRRHH&es=<?php echo $row["id_orden"] ?>&estado=0"><img src="img/estado2.jpg"></a>
      <?php } else {?>
        <a href="index.php?op=verRRHH&es=<?php echo $row["id_orden"] ?>&estado=1"><img src="img/estado.jpg"></a>
      <?php }?>
    </center>
  </td>
</tr>
<?php
}
}

function Buscar($palabra)
{

  $sql = "SELECT * FROM notabase WHERE `TituloNotas` LIKE '%$palabra%' ";

  $link   = Conectarse();
  $result = mysqli_query($link, $sql);

  while ($row = mysqli_fetch_array($result)) {
    ?>
    <div class="span4">
     <div class="blog-post-overview-2 alt fixed">
      <div class="blog-post-title">
       <img src="_layout/images/icons/45x45/white/pen.png" alt="">
       <h3><a href="notas.php?id=<?php echo $row["IdNotas"] ?>"><?php echo $row["TituloNotas"] ?></a></h3>
     </div><!-- .blog-post-title -->

     <p><?php echo (substr(strip_tags($row["DesarrolloNotas"]), 0, 250)) . "..." ?></p>

     <img src="<?php echo $row["ImgPortadaNotas"] ?>" alt="">
     <div class="blog-post-readmore">
       <a href="notas.php?id=<?php echo $row["IdNotas"] ?>"> <img src="_layout/images/icons/icon-arrow-8.png" alt=""> ver más </a>
       <div class="arrow"></div>
     </div><!-- end .blog-post-readmore -->
   </div><!-- blog-post-overview-2 -->
 </div>
 <?php
}

}

function Notas_Read_Front($categoria)
{
  require_once "paginacion/Zebra_Pagination.php";
  $con = Conectarse_Mysqli();
  if ($categoria == '') {
    $query          = "SELECT * FROM  `notabase` ORDER BY IdNotas Desc";
    $res            = $con->query($query);
    $num_registros  = mysqli_num_rows($res);
    $resul_x_pagina = 6;
    $paginacion     = new Zebra_Pagination();
    $paginacion->records($num_registros);
    $paginacion->records_per_page($resul_x_pagina);
    $consulta = "SELECT * FROM  `notabase` ORDER BY IdNotas Desc
    LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;

  } else {
    echo "<div class='col-md-12'><div class='alert alert-success'><b>Categoria:</b> $categoria </div></div>";
    $query          = "SELECT * FROM  `notabase` WHERE `CategoriaNotas` LIKE '%" . $categoria . "%' ORDER BY IdNotas Desc";
    $res            = $con->query($query);
    $num_registros  = mysqli_num_rows($res);
    $resul_x_pagina = 6;
    $paginacion     = new Zebra_Pagination();
    $paginacion->records($num_registros);
    $paginacion->records_per_page($resul_x_pagina);
    $consulta = "SELECT * FROM  `notabase` WHERE `CategoriaNotas` LIKE '%" . $categoria . "%' ORDER BY IdNotas Desc
    LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;

  }

  $result = $con->query($consulta);

  while ($row = mysqli_fetch_array($result)) {
    $fecha = explode("-", $row["FechaNotas"]);

    $cod             = $row["CodNotas"];
    $sqlImagen       = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
    $idConn          = Conectarse();
    $resultadoImagen = mysqli_query($idConn, $sqlImagen);
    while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
      $imagen = BASE_URL . "/" . $imagenes[0];
    }

    ?>
    <div class="col-md-6 col-sm-12  notas">
      <div class="blog-thumbnail">
        <a href="notas.php?id=<?php echo $row["IdNotas"] ?>">
          <div style="height:250px;overflow:hidden;background:url('<?php echo $imagen ?>') center center; background-size:cover !important">
          </div>
        </a>
      </div>
      <a href="notas.php?id=<?php echo $row["IdNotas"] ?>" style="margin-top:10px">
        <h4 class="blog-box-title"><?php echo ($row['TituloNotas']); ?></h4>
      </a>
      <div class="row">
        <div class="col-md-12" >
          <span class="left meta-date"><i class="fa fa-tags"></i> <?php echo utf8_encode($row["CategoriaNotas"]) ?></span>
          <span class="right meta-date"><i class="fa fa-calendar"></i> <?php echo $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0] ?></span>
        </div>
      </div>
      <div class="blog-content">
        <div><?php echo strip_tags(substr($row["DesarrolloNotas"], 0, 150)) ?>...<br/><br/></div>
        <a href="notas.php?id=<?php echo $row["IdNotas"] ?>" class="btn btn-success darken-3 waves-effect"><i class="fa fa-caret-right"></i> Ver más</a>
      </div>
    </div>
    <?php
  }
  echo "<center class='Zebra_Pagination col-md-12 '><hr/>";
  $paginacion->render();
  echo "</center><br/><br/>";
}

function Videos_Read_Front_Categoria($categoria)
{
  require_once "paginacion/Zebra_Pagination.php";
  $con            = Conectarse_Mysqli();
  $query          = "SELECT * FROM  `videos` WHERE `CategoriaVideos` = '$categoria' ORDER BY IdVideos Desc";
  $res            = $con->query($query);
  $num_registros  = mysqli_num_rows($res);
  $resul_x_pagina = 5;
  $paginacion     = new Zebra_Pagination();
  $paginacion->records($num_registros);
  $paginacion->records_per_page($resul_x_pagina);
  $consulta = "SELECT * FROM  `videos` WHERE `CategoriaVideos` = '$categoria' ORDER BY IdVideos Desc
  LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
    //////

  $result = $con->query($consulta);

  while ($row = mysqli_fetch_array($result)) {

    if ($row['CategoriaVideos'] == 1) {
      $categoria = "Nutrición";
      $verMas    = "nutricion";
    } elseif ($row['CategoriaVideos'] == 2) {
      $categoria = "Conservación de Forrajes";
      $verMas    = "forrajes";
    } elseif ($row['CategoriaVideos'] == 3) {
      $categoria = "Efluentes";
      $verMas    = "efluentes";
    }
    ?>
    <div class="col-md-6 blog-post">
      <div class="blog-thumbnail">
        <iframe width="100%" height="350px" src="//www.youtube.com/embed/<?php echo $row["UrlVideos"] ?>" frameborder="0" allowfullscreen></iframe>
      </div>
      <h2 class="blog-title"><?php echo ($row['TituloVideos']); ?></h2>
      <div class="meta">
        <p><span><i class="fa fa-archive"></i> <?php echo $categoria ?></span></p>
      </div>
      <div class="blog-content"></div>
    </div>
    <?php
  }
  echo '<div class="clearfix"></div>';
  echo '<div class="col-md-12">';
  $paginacion->render();
  echo '</div>';
  echo '<div class="clearfix"></div><br/>';
}

function Notas_Read_Front_Side()
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM notabase
  ORDER BY IdNotas DESC
  LIMIT 0,5
  ";
  $resultado = mysqli_query($idConn, $sql);
  while ($row = mysqli_fetch_array($resultado)) {
    $date    = $row["FechaNotas"];
    $explode = explode("-", $date);

    $cod             = $row["CodNotas"];
    $sqlImagen       = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
    $idConn          = Conectarse();
    $resultadoImagen = mysqli_query($idConn, $sqlImagen);
    while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
      $imagen = $imagenes[0];
    }

    $fecha = $explode[2] . "-" . $explode[1] . "-" . $explode[0];
    ?>
    <li class="notasSide clearfix">
      <div class="col-md-3"><a href="notas.php?id=<?php echo $row["IdNotas"] ?>"><div style="width:100%;height:60px;background:url('<?php echo $imagen ?>') no-repeat center center;background-size:cover !important"></div></a></div>
      <div class="col-md-9 align-left"><a href="notas.php?id=<?php echo $row["IdNotas"] ?>"><?php echo substr(strtoupper(($row["TituloNotas"])), 0, 40) . "..." ?></a><br/>
        <span class="meta-date" style="font-size:13px"><i class="fa fa-calendar"></i> <?php echo $fecha ?></span> </div>
      </li>
      <?php
    }
  }

  function Notas_Read_Front_Index()
  {
    setlocale(LC_ALL, "ES_ES");
    $idConn = Conectarse();
    $sql    = "
    SELECT *
    FROM notabase
    ORDER BY IdNotas DESC
    LIMIT 0,4
    ";
    $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
    while ($row = mysqli_fetch_array($resultado)) {
      $fechaDate       = explode("-", $row["FechaNotas"]);
      $cod             = $row["CodNotas"];
      $sqlImagen       = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
      $idConn          = Conectarse();
      $resultadoImagen = mysqli_query($idConn, $sqlImagen);
      while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
        $imagen = $imagenes[0];
      }
      ?>
      <div class="col col-md-3 col-xs-12   wow fadeInDown" >
        <div class="blog-box">
          <a href="notas.php?id=<?php echo $row["IdNotas"] ?>">
            <div class="imgNovedades " style="background:url(<?php echo BASE_URL . "/" . $imagen; ?>) no-repeat center center;background-size:cover !important;"></div></a>
            <div class="blog-box-title">
              <a href="notas.php?id=<?php echo $row["IdNotas"] ?>"><?php echo $row["TituloNotas"] ?></a><br/>
              <span class="categoria"><?php echo $row["CategoriaNotas"] ?></span>
            </div>
            <div class="clearfix"></div><br/><br/>
            <p  style="overflow:hidden;"><?php echo strip_tags(substr($row["DesarrolloNotas"], 0, 220)); ?>...</p>
            <div class="post-meta">
              <i class="fa fa-calendar"></i> <b>Fecha:</b> <span class="post-date"><?php echo $fechaDate[2] . "/" . $fechaDate[1] . "/" . $fechaDate[0] ?></span>
              <div class="clearfix"></div><br/>
              <a  href="notas.php?id=<?php echo $row["IdNotas"] ?>" class="btn btn-info orange darken-3">Ver más</a>
            </div>
          </div>
        </div>
        <?php
      }
    }

    function Notas_Read_Carousel()
    {
      $idConn = Conectarse();
      $sql    = "
      SELECT *
      FROM notabase
      ORDER BY IdNotas DESC
      LIMIT 0,12
      ";
      $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
      $i = 1;
      while ($row = mysqli_fetch_array($resultado)) {
        if ($i == 1 || $i == 5 || $i == 9) {
          if ($i == 1) {
            echo '
            <div class="item active">
            <div class="row text-center">';
          } else {
            echo '
            <div class="item">
            <div class="row text-center">';
          }
        }

        $cod             = $row["CodNotas"];
        $sqlImagen       = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
        $idConn          = Conectarse();
        $resultadoImagen = mysqli_query($idConn, $sqlImagen);
        while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
          $imagen = $imagenes[0];
        }?>

        <div class="col-md-3">
          <div class="thumbnail product-item" style="background:url('<?php echo $imagen ?>') no-repeat center top;background-size:cover;height:200px">
          </div>
          <h3><?php echo $row["TituloNotas"] ?></h3>
          <p><a class="btn btn-large btn-block" href="notas.php?id=<?php echo $row["IdNotas"] ?>">ver nota »</a></p>
        </div>

        <?php
        if ($i == 4 || $i == 8 || $i == 12) {
          echo '
          </div>
          </div>';
        }
        $i++;
      }
    }

    function Capacitaciones_Read_Front_Side()
    {
      $idConn = Conectarse();
      $sql    = "
      SELECT *
      FROM cursos
      ORDER BY IdCursos DESC
      LIMIT 0,4
      ";
      $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
      while ($row = mysqli_fetch_array($resultado)) {

        ?>
        <div class="boxInfo">
         <div style="width:100%;max-width:82px;height:60px;overflow:hidden;float:left;">
          <img class="fwidth" src="<?php echo $row["ImgCursos"] ?>" alt="" style="position:relative;bottom:10%;float:right;">
        </div>
        <p><a  href="capacitacion.php?cap=<?php echo $row["IdCursos"] ?>"><?php echo substr(strtoupper($row["TituloCursos"]), 0, 40) . "..." ?></a></p>
        <span><?php echo $fecha ?></span>
      </div>
      <?php
    }
  }

  function Contar_Notas()
  {
    $idConn = Conectarse();
    $sql    = "
    SELECT IdNotas
    FROM notabase
    ";
    $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
    $row = mysqli_num_rows($resultado);
    return $row;
  }

  function Notas_Recientes()
  {
    $idConn = Conectarse();
    $sql    = "
    SELECT IdNotas, ImgPortadaNotas , TituloNotas, DesarrolloNotas
    FROM notabase
    ORDER BY IdNotas DESC
    LIMIT 0,4
    ";
    $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
    while ($row = mysqli_fetch_array($resultado)) {
      ?>
      <li>
       <figure class="thumb" style="width:150px;height:150px;overflow:hidden">
        <a href="notas.php?id=<?php echo $row["IdNotas"] ?>"><img src="<?php echo $row["ImgPortadaNotas"] ?>" alt="" class="alignnone" hieght="100%"></a>
      </figure>
      <h5 class="post-title"><a href="notas.php?id=<?php echo $row["IdNotas"] ?>""><?php echo $row["TituloNotas"] ?></a></h5>
    </li>
    <?php
  }
}

function Notas_Read_Front_2($a)
{
  $idConn = Conectarse();
  $sql    = "
  SELECT IdNotas, ImgPortadaNotas , TituloNotas, DesarrolloNotas, FiltroNotas, FechaNotas, ClienteNotas
  FROM notabase
  ORDER BY IdNotas DESC
  LIMIT $a, 4
  ";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {

    switch ($row["FiltroNotas"]) {
      case "mkt":
      $filtro = "Marketing";
      break;
      case "publi":
      $filtro = "Publicidad";
      break;
      case "web":
      $filtro = "Web";
      break;
      case "rrhh":
      $filtro = "RR.HH";
      break;
      case "comer":
      $filtro = "Comercialización";
      break;
      case "pymes":
      $filtro = "Pymes";
      break;
      case "eventos":
      $filtro = "Eventos";
      break;
      case "global":
      $filtro = "Global";
      break;
    }
    ?>
    <li>
     <div class="thumb-hover">
       <figure>
        <a href="notas.php?id=<?php echo $row["IdNotas"] ?>">
          <div class="cover">
            <div class="plus-hover"></div>
            <div class="cover-background"></div>
          </div>
          <img src="<?php echo $row["ImgPortadaNotas"] ?>" width="710" />
        </a>
      </figure>
    </div>
    <div class="blog-details">
      <h2><a href="blog-single.html"><?php echo $row["TituloNotas"] ?></a></h2>
      <p><?php echo strip_tags(substr($row["DesarrolloNotas"], 0, 250)) . "..." ?></p>
      <div class="bottom-active">
        <nav class="blog-meta">
          <span class="status">Cliente</span><span class="blog-meta-details"><?php echo $row["ClienteNotas"] ?></span>
          <span class="status">Fecha</span><span class="blog-meta-details"><?php echo $row["FechaNotas"] ?></span>
          <span class="status">Área</span><span class="blog-meta-details"><?php echo $filtro ?></span>
        </nav>
        <a href="notas.php?id=<?php echo $row["IdNotas"] ?>">
          <div class="readmore-button">
            <span>Ver más</span>
          </div>
        </a>
      </div>
    </div>
  </li>
  <?php
}
}

function Productos_Front($palabra)
{
  if ($palabra != '') {
    $buscar = "AND descripcion_producto LIKE '%$palabra%'";
    $buscar .= " OR categoria_producto LIKE '%$palabra%'";
    $buscar .= " OR patron_producto LIKE '%$palabra%'";
    $buscar .= " OR subcategoria_producto LIKE '%$palabra%'";
  } else {
    $buscar = '';
  }

  require_once "paginacion/Zebra_Pagination.php";
  $con = Conectarse_Mysqli();

  $query = "SELECT * FROM `productos` WHERE categoria_producto != '' $buscar ORDER BY id_producto Desc";
  $res   = $con->query($query);

  $num_registros  = mysqli_num_rows($res);
  $resul_x_pagina = 50;
  $paginacion     = new Zebra_Pagination();
  $paginacion->records($num_registros);
  $paginacion->records_per_page($resul_x_pagina);
  $consulta = "SELECT * FROM  `productos` WHERE categoria_producto != '' $buscar ORDER BY id_producto Desc

  LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
  $result = $con->query($consulta);
  ?>
  <table class="tablap" width="100%">
    <tr><th>Código</th><th>Producto</th><th>Descripción</th><th>Línea</th><th>Marca</th><th>Stock</th><th>Precio</th><th></th></tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {

      $id      = trim($row["id_producto"]);
      $urlLink = str_replace('"', '', strtolower(trim($row["descripcion_producto"])));

      $cod          = (trim($row["cod_producto"]));
      $patron       = (trim($row["patron_producto"]));
      $descripcion  = (trim($row["descripcion_producto"]));
      $categoria    = ($row["categoria_producto"]);
      $subcategoria = ($row["subcategoria_producto"]);
      $stock        = (trim($row["stock_producto"]));
      $precio       = (trim($row["precio".$_SESSION["user"]["lista"]."_producto"]));
      ?>

      <tr>
        <td><?php echo $cod; ?></td>
        <td><?php echo $patron; ?></td>
        <td><?php echo $descripcion; ?></td>
        <td><?php echo $categoria; ?></td>
        <td><?php echo $subcategoria; ?></td>
        <td><?php echo $stock; ?></td>
        <td>
          <?php if(isset($_SESSION["user"])) { echo $precio; } else { echo "<a href='".BASE_URL."/usuarios'  class='btn btn-default' data-toggle='tooltip' data-placement='top' title='Para visualizar los precios de nuestros productos debe estar registrado en nuestro base de clientes.'>Registrarme!</a>";}; ?>            
        </td>
        <td>
         <?php if(isset($_SESSION["user"])) { ?>
          <a href="<?php echo BASE_URL ?>/api/carrito/agregar_a_carrito.php?idProducto=<?php echo $id ?>" class="linkModal  btn btn-info btn-sm" data-title="Agregar a Carrito">
            <i class="fa fa-shopping-cart"></i> Comprar
          </a>
        <?php } ?>
      </td>
    </tr>

    <?php
  }
  ?>
</table>
<?php
echo "<center><br/><br/>";
$paginacion->render();
echo "</center><br/><br/>";
}

function Productos_Front_Mobile($palabra)
{
  if ($palabra != '') {
    $buscar = "AND descripcion_producto LIKE '%$palabra%'";
    $buscar .= " OR categoria_producto LIKE '%$palabra%'";
    $buscar .= " OR patron_producto LIKE '%$palabra%'";
    $buscar .= " OR subcategoria_producto LIKE '%$palabra%'";
  } else {
    $buscar = '';
  }

  require_once "paginacion/Zebra_Pagination.php";
  $con = Conectarse_Mysqli();

  $query = "SELECT * FROM `productos` WHERE categoria_producto != '' $buscar ORDER BY id_producto Desc";
  $res   = $con->query($query);

  $num_registros  = mysqli_num_rows($res);
  $resul_x_pagina = 50;
  $paginacion     = new Zebra_Pagination();
  $paginacion->records($num_registros);
  $paginacion->records_per_page($resul_x_pagina);
  $consulta = "SELECT * FROM  `productos` WHERE categoria_producto != '' $buscar ORDER BY id_producto Desc

  LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
  $result = $con->query($consulta);
  ?>
  <?php
  while ($row = mysqli_fetch_array($result)) {

    $id      = trim($row["id_producto"]);
    $urlLink = str_replace('"', '', strtolower(trim($row["descripcion_producto"])));

    $cod          = (trim($row["cod_producto"]));
    $patron       = (trim($row["patron_producto"]));
    $descripcion  = (trim($row["descripcion_producto"]));
    $categoria    = ($row["categoria_producto"]);
    $subcategoria = ($row["subcategoria_producto"]);
    $stock        = (trim($row["stock_producto"]));
    $precio       = (trim($row["precio".$_SESSION["user"]["lista"]."_producto"]));
    ?>

    <br/><div class="boxcompra col-sm-12" >
      <p>Código: <?php echo $cod; ?></p>
      <p>Patrón: <?php echo $patron; ?></p>
      <p>Descripción: <?php echo $descripcion; ?></p>
      <p>Línea: <?php echo $categoria; ?></p>
      <p>Marca: <?php echo $subcategoria; ?></p>
      <p>Stock: <?php echo $stock; ?></p>
      <p>Precio: $<?php echo $precio; ?></p>
      <a href="<?php echo BASE_URL ?>/api/carrito/agregar_a_carrito.php?idProducto=<?php echo $id ?>" class="linkModal  btn btn-info btn-sm" data-title="Agregar a Carrito">
        <i class="fa fa-shopping-cart"></i> Comprar
      </a>
    </div>

    <?php
  }
  ?>

  <?php
  echo "<center><br/><br/>";
  $paginacion->render();
  echo "</center><br/><br/>";
}

function TraerPedidos($id)
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM `pedidos` WHERE `usuario_pedidos` = '$id' ORDER BY id_pedidos DESC";
  $resultado = mysqli_query($idConn, $sql);
  $contacto  = Contenido_TraerPorId("contacto");
    //Carga del array de datos
  if (mysqli_num_rows($resultado) != 0) {
    while ($row = mysqli_fetch_array($resultado)) {
      $fecha   = explode(" ", $row["fecha_pedidos"]);
      $fechaF  = explode("-", $fecha[0]);
      $leyenda = 'No se pudo realizar el pedido';
      ?>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading<?php echo $row["cod_pedido"]; ?>" >
          <h5 class="panel-title" >
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row["cod_pedidos"]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row["cod_pedidos"]; ?>" >
             <i class="fa fa-angle-right"></i> Cod. Pedido nº: <?php echo $row["cod_pedidos"]; ?> - <i class="fa fa-calendar"></i> <?php echo $fechaF[2] . "-" . $fechaF[1] . "-" . $fechaF[0] ?>
             <?php
             switch ($row["estado_pedidos"]) {
              case 0:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-warning pull-right'>Estado: Pago pendiente</span>";
              $leyenda = "<b>Estaríamos necesitando el pago para poder proseguir con el pedido solicitado.</b>
              <br/>Por favor comunicarse a: <br/><br/>" . $contacto[1];
              break;
              case 1:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-success fRight'>Estado: Pago exitoso</span>";
              $leyenda = "<b>Excelente el pago fue acreditado, para poder proseguir con el pedido solicitado.</b>
              <br/>Por favor comunicarse a:<br/><br/>
              <b>" . TITULO . "</b>" . $contacto[1];
              break;
              case 2:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-danger pull-right'>Estado: Pago erroneo</span>";
              $leyenda = "<b>Tuvimos problemas con el pago para poder proseguir con el pedido solicitado.</b><br/>Por favor comunicarse a:<br/><br/><b>" . TITULO . "</b>" . $contacto[1];
              break;
              case 3:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-info pull-right'>Estado: Enviado</span>";
              $leyenda = "<b>Excelente el pago y el envío fueron exitosos.<br/>Muchas gracias por su compra.</b>" . $contacto[1];
              break;
            }
            ?>

          </a>
        </h5>
      </div>
      <div id="collapse<?php echo $row["cod_pedidos"]; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <th>Nombre producto</th>
              <th>Cantidad</th>
              <th>Precio unidad</th>
              <th>Precio total</th>
            </thead>
            <tbody>
              <?php echo $row["productos_pedidos"]; ?>
            </tbody>
          </table>
          <hr/>
          <?php echo $leyenda ?>
        </div>
      </div>
    </div>
    <?php
  }
} else {
  ?><div class="alert alert-danger animated fadeInDown" role="alert">¡No tenés ningún pedido añadido! <a href="productos.php" class="btn btn-default" style="float:right;position:relative;bottom:7px;">AÑADIR PRODUCTOS</a></div><?php
}
}

function TraerPedidos_Admin($tipo)
{
  $idConn = Conectarse();
  if ($tipo == '') {
    $sql = "SELECT * FROM `usuarios`, `pedidos` WHERE `usuario_pedidos` = `id` and `estado_pedidos` != 3  ORDER BY id_pedidos DESC";
  } else {
    $sql = "SELECT * FROM `usuarios`, `pedidos` WHERE `usuario_pedidos` = `id` and `estado_pedidos` = '$tipo' ORDER BY id_pedidos DESC";
  }
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos
  if (mysqli_num_rows($resultado) != 0) {
    while ($row = mysqli_fetch_array($resultado)) {
      $fecha   = explode(" ", $row["fecha_pedidos"]);
      $fechaF  = explode("-", $fecha[0]);
      $usuario = "<h3>Datos del usuario</h3><b>Nombre y Apellido</b> " . $row['nombre'] . "<br/> <b>Email:</b> " . $row['email'] . "<br/> <b>Teléfono:</b> " . $row['telefono'] . "<br/> <b>Domicilio:</b> " . $row['direccion'] . "<br/> <b>Localidad:</b> " . $row['localidad'] . "<br/> <b>Provincia:</b> " . $row['provincia'] . "<br/> <b>Fecha de inscripción:</b> " . $row['inscripto'] . "<br/>";
      ?>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading<?php echo $row["id_pedido"]; ?>" >
          <h5 class="panel-title" >
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row["id_pedidos"]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row["id_pedidos"]; ?>" >
             <i class="fa fa-angle-right"></i> Cod. Pedido nº: <?php echo $row["cod_pedidos"]; ?> - <i class="fa fa-calendar"></i> <?php echo $fechaF[2] . "-" . $fechaF[1] . "-" . $fechaF[0] ?>
             <?php
             switch ($row["estado_pedidos"]) {
              case 0:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-warning fRight'>Estado: Pago pendiente</span>";
              $leyenda = "<b>Estaríamos necesitando el pago para poder proseguir con el pedido solicitado.</b>";
              break;
              case 1:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-success fRight'>Estado: Pago exitoso</span>";
              $leyenda = "<b>Excelente el pago fue acreditado, para poder proseguir con el pedido solicitado.</b>";
              break;
              case 2:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-danger fRight'>Estado: Pago erroneo</span>";
              $leyenda = "<b>Tuvimos problemas con el pago para poder proseguir con el pedido solicitado.</b>";
              break;
              case 3:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-info fRight'>Estado: Enviado</span>";
              $leyenda = "<b>Excelente el pago y el envío fueron exitosos.<br/>Muchas gracias por su compra.</b>";
              break;
              case 9:
              echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-info fRight'>Estado: Carrito no cerrado</span>";
              $leyenda = "Carrito no finalizado";
              break;
            }
            ?>

          </a>
        </h5>
      </div>
      <div id="collapse<?php echo $row["id_pedidos"]; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <th>Nombre producto</th>
              <th>Cantidad</th>
              <th>Precio unidad</th>
              <th>Precio total</th>
            </thead>
            <tbody>
              <?php echo $row["productos_pedidos"]; ?>
            </tbody>
          </table>
          <hr/>
          <div class="col-md-12 col-xs-12">
            <?php echo $leyenda ?>
          </div>
          <div class="col-md-12 col-xs-12">
            <br/>
            <span>Cambiar estado por:</span>
            <div class="clearfix"></div><br/>
            <a href="index.php?op=verPedidos&estado=0&id=<?php echo $row["id_pedidos"]; ?>" class=" btnPedidosAdmin <?php if ($row["estado_pedidos"] == 0) {echo "btnPedidosAdminOk";}?> btn btn-warning">Pago pendiente</a>

            <a href="index.php?op=verPedidos&estado=1&id=<?php echo $row["id_pedidos"]; ?>" class=" btnPedidosAdmin <?php if ($row["estado_pedidos"] == 1) {echo "btnPedidosAdminOk";}?> btn btn-success">Pago exitoso</a>

            <a href="index.php?op=verPedidos&estado=2&id=<?php echo $row["id_pedidos"]; ?>"  class=" btnPedidosAdmin <?php if ($row["estado_pedidos"] == 2) {echo "btnPedidosAdminOk";}?> btn btn-danger">Pago erróneo</a>

            <a href="index.php?op=verPedidos&estado=3&id=<?php echo $row["id_pedidos"]; ?>"  class=" btnPedidosAdmin <?php if ($row["estado_pedidos"] == 3) {echo "btnPedidosAdminOk";}?> btn  btn-info">Pedido enviado</a>

          </div>
          <div class="clearfix"></div>
          <hr/>
          <div class="col-md-12 col-xs-12">
            <?php echo $usuario ?>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
} else {
  ?><div class="alert alert-danger animated fadeInDown" role="alert">¡No tenés ningún pedido añadido!</div><?php
}
}

function Banner_A_Create()
{
  $idConn = Conectarse();

  $nombre = $_POST["link"];

  $imgInicio  = "";
  $destinoImg = "";
  $prefijo    = substr(md5(uniqid(rand())), 0, 6);
  $imgInicio  = $_FILES["archivo_subir"]["tmp_name"];
  $tucadena   = $_FILES["archivo_subir"]["name"];
  $partes     = explode(".", $tucadena);
  $dominio    = $partes[1];
  $destinoImg = "../bannerF/" . $prefijo . "." . $dominio;
  move_uploaded_file($imgInicio, $destinoImg);
  $destinoFinal = "bannerF/" . $prefijo . "." . $dominio;
  chmod($destinoImg, 0777);

  $sql =
  "INSERT INTO `banner_animado`
  (`LinkBanner`, `RutaBanner`)
  VALUES
  ('$nombre', '$destinoFinal')";
  $resultado = mysqli_query($idConn, $sql);
}

function Categoria_Create()
{

  $TituloSuplemento = $_POST["titulo"];

  $sql =
  "INSERT INTO `categoriabase`
  (`IdSuplementos`,`TituloSuplementos`)
  VALUES
  (NULL, '$TituloSuplemento')";
  $idConn = Conectarse();

  $resultado = mysqli_query($idConn, $sql);
  echo "<script language=Javascript> location.href=\"index.php?pag=notas&op=A\"; </script>";

}

function CategoriaPro_Create()
{

  $nombre = $_POST["titulo"];

  $sql =
  "INSERT INTO `categoriaproducto`
  (`IdCategoriaProducto`,`NombreCategoriaProducto`)
  VALUES
  (NULL, '$nombre')";
  $idConn = Conectarse();

  $resultado = mysqli_query($idConn, $sql);
  echo "<script language=Javascript> location.href=\"index.php?pag=productos&op=A\"; </script>";

}

function Video_Create()
{

  $TituloSuplemento = $_POST["titulo"];

  $sql =
  "INSERT INTO `videosbase` VALUES
  (NULL, '$TituloSuplemento')";
  $idConn = Conectarse();

  $resultado = mysqli_query($idConn, $sql);
  echo "<script language=Javascript> location.href=\"index.php?pag=videos&op=A\"; </script>";

}

function Registro_Create()
{

  $nombre    = $_POST["nombre"];
  $email     = $_POST["email"];
  $pass      = $_POST["pass"];
  $direccion = $_POST["direccion"];
  $provincia = $_POST["provincia"];
  $localidad = $_POST["localidad"];
  $telefono  = $_POST["telefono"];

  $sql =
  "INSERT INTO `registrobase`
  (`NombreRegistro`, `EmailRegistro`,`PasswordRegistro`  , `ProvinciaRegistro`, `LocalidadRegistro`,`DireccionRegistro`,  `TelefonoRegistro`)
  VALUES
  ('$nombre' , '$email' ,'$pass' , '$provincia' , '$localidad' ,'$direccion' ,'$telefono')";
  $idConn = Conectarse();

  $resultado = mysqli_query($idConn, $sql);
  echo "<script language=Javascript> location.href=\"index.php?pag=registros&op=A\"; </script>";

}

function Precio_Create()
{

  $titulo  = $_POST["titulo"];
  $periodo = $_POST["periodo"
];
$precio      = $_POST["precio"];
$descripcion = $_POST["caracteristicas"];

$sql =
"INSERT INTO `preciosbase`
VALUES
(NULL,'$titulo' , '$periodo' ,'$descripcion' , '$precio')";
$idConn = Conectarse();

$resultado = mysqli_query($idConn, $sql);
echo "<script language=Javascript> location.href=\"index.php?pag=precios&op=A\"; </script>";

}

function Revisar_Registro($email)
{
  $sql = "SELECT  `EmailRegistro`
  FROM registrobase
  WHERE  `EmailRegistro` = '$email'";

  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);
  return $data;
}

function Revisar_Compras($email)
{
  $sql = "SELECT  *
  FROM `registrobase`, `comprasbase`
  WHERE  `EmailRegistro` = `email` AND `IdRegistro` = $email";

  $link   = Conectarse();
  $result = mysqli_query($link, $sql);

  while ($row = mysqli_fetch_array($result)) {
    $f     = explode(" ", $row["fecha"]);
    $fecha = explode("-", $f[0]);
    ?>
    <tr>
      <td><?php echo strtoupper($row["descripcion"]) ?></td>
      <td>$<?php echo $row["total"] ?></td>
      <td><?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] . " " . $f[1] ?></td>
      <td>
        <?php
        switch ($row['estado']) {
          case "0":
          echo "Exitoso";
          break;
          case "1":
          echo "Pendiente";
          break;
          case "2":
          echo "Proceso";
          break;
          case "3":
          echo "Rechazado";
          break;
          case "4":
          echo "Anulado";
          break;
        }
        ?>
      </td>
    </tr>

    <?php
  }
}

function Registro_Create_Front()
{

  $nombre    = $_POST["nombre"];
  $email     = $_POST["email"];
  $pass      = $_POST["pass"];
  $direccion = $_POST["direccion"];
  $provincia = $_POST["provincia"];
  $localidad = $_POST["localidad"];
  $telefono  = $_POST["telefono"];

  $sql =
  "INSERT INTO `registrobase`
  (`NombreRegistro`, `UsuarioRegistro`, `EmailRegistro`,`PasswordRegistro`  , `ProvinciaRegistro`, `LocalidadRegistro`,`DireccionRegistro`,  `TelefonoRegistro`)
  VALUES
  ('$nombre' , '$email' , '$email' ,'$pass' , '$provincia' , '$localidad' ,'$direccion' ,'$telefono')";
  $idConn = Conectarse();

  $resultado = mysqli_query($idConn, $sql);

}

function Suscripto_Create()
{

  if (isset($_POST['Enviar'])) {
    $fecha = date("j, n, Y");
    $email = $_POST['suscripto'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $idConn = Conectarse();

      $sql       = "INSERT INTO `suscriptobase`(`EmailSuscriptos`, `FechaSuscriptos`)VALUES ('$email', '$fecha')";
      $resultado = mysqli_query($idConn, $sql);

      unset($email);
    }
  }
}

/* * **************************** ELIMINAR DE TABLAS */

if ($pagina == "notas" && $op == "e") {
  $idCategoria = $_GET["id"];
  $Base        = "notabase";
  $Tabla       = "IdNotas";
  Categoria_Eliminar($idCategoria, $Base, $Tabla, $pagina);

} elseif ($pagina == "videos" && $op == "e"
) {
  $idNota = $_GET["id"];
  $Base   = "videosbase";
  $Tabla  = "IdVideo";
  Categoria_Eliminar($idNota, $Base, $Tabla, $pagina);
} elseif ($pagina == "banner" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "banner_fijo";
  $Tabla       = "IdBanner";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "slider" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "sliderbase";
  $Tabla       = "IdSlider";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "registros" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "registrobase";
  $Tabla       = "IdRegistro";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "productos" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "productobase";
  $Tabla       = "IdProducto";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "promociones" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "promocionbase";
  $Tabla       = "id";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "home" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "consultasbase";
  $Tabla       = "id";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "compra" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "comprasbase";
  $Tabla       = "id";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "precios" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "preciosbase";
  $Tabla       = "id";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "control" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "interno";
  $Tabla       = "id";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "orden" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "orden";
  $Tabla       = "id_orden";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
} elseif ($pagina == "portfolio" && $op == "e") {
  $idSuscrpito = $_GET["id"];
  $Base        = "portfolio";
  $Tabla       = "IdPortfolio";
  Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
}

function Categoria_Eliminar($id, $base, $tabla, $pagina)
{
  $sql  = "DELETE FROM $base WHERE $tabla = $id";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
  return $r;
  echo "<script language=Javascript> location.href=\"index.php?pag=$pagina&op=A\"; </script>";
}

function Contenidos_Read()
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM contenidos
  ORDER BY id ASC
  ";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {
    $codigo = $row['codigo'];
    ?>
    <tr>
     <td class="maxwidth"><?php echo ($row['id']) ?></td>
     <td style="text-transform:uppercase"><?php echo strtoupper($codigo) ?></td>
     <td>
      <center>
       <a href="index.php?op=modificarContenidos&id=<?php echo $row['id'] ?>" style="width:20px"
        data-toggle="tooltip" alt="Modificar" title="Modificar"><i
        class="glyphicon glyphicon-cog"></i></a>

      </center>
    </td>
  </tr>
  <?php
}
}

/* * ***************************** */

function Categoria_Read_Solo($id)
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM categoriabase WHERE IdSuplementos = $id";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  return $resultado;

  $row = mysqli_fetch_row($resultado);
}

function Precio_Envio($peso, $tipo)
{
  $cnx    = Conectarse();
  $peso   = mysqli_real_escape_string($cnx, $peso);
  $tipo   = mysqli_real_escape_string($cnx, $tipo);
  $sql    = "SELECT precio FROM `envio`  WHERE `peso` = '$peso' AND `tipo` = '$tipo'";
  $result = mysqli_query($cnx, $sql);
  $data   = mysqli_fetch_array($result);
  return $data[0];
}

function Productos_TraerPorCod($id)
{
  $sql    = "SELECT DISTINCT * FROM productos WHERE id_producto = '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);
  return $data;
}

function Contenido_TraerPorId($id)
{
  $sql = "SELECT *
  FROM contenidos
  WHERE codigo = '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Contenido_TraerPorIdAdmin($id)
{
  $sql = "SELECT *
  FROM contenidos
  WHERE id = '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Traer_Contenidos($codigo)
{
  $sql = "SELECT *
  FROM contenidos
  WHERE codigo = '$codigo'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  while ($data = mysqli_fetch_array($result)) {
    echo $data["contenido"];
  }
}

function Portfolio_TraerPorCod($id)
{
  $sql = "SELECT *
  FROM productos
  WHERE  id_producto = '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Slider_TraerPorId($id)
{
  $sql = "SELECT *
  FROM sliderbase
  WHERE IdSlider = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Promociones_TraerPorId($id)
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM promociones
  WHERE IdPromociones = $id
  ";
  $resultado = mysqli_query($idConn, $sql);

  $data = mysqli_fetch_array($resultado);

  return $data;
}

function Traer_Subcategorias($id)
{
  $sql = "SELECT *
  FROM subcategorias
  WHERE categorias = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  while ($data = mysqli_fetch_array($result)) {
    echo "<span style='margin-right:10px;'>" . strtoupper($data["nombre_subcategorias"]) . " <a href='index.php?op=subCategoria&borrar=" . $data['id_subcategorias'] . "'><img src='img/borrar2.png' width='12'></a></span> ";
  }
}

function TraerDatos_DB($db)
{
  $sql = "SELECT COUNT(*)
  FROM $db";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;

}

function Usuario_TraerPorId($id)
{
  $sql = "SELECT *
  FROM usuarios
  WHERE id = '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}


function Usuario_TraerPorEmail($email)
{
  $sql    = "SELECT * FROM usuarios WHERE email = '$email' AND invitado = 0";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}


function Cursos_TraerPorId($id)
{
  $sql = "SELECT *
  FROM cursos
  WHERE IdCursos = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Agencias_TraerPorId($id)
{
  $sql = "SELECT *
  FROM agencias
  WHERE id = '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Publicidad_TraerPorId($id)
{
  $sql = "SELECT *
  FROM publicidad
  WHERE id_publicidad = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Micrositio_TraerPorId($id)
{
  $sql = "SELECT *
  FROM agencias, micrositio
  WHERE cod_agencia = cod_micrositio  AND cod_micrositio = '$id' ";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function TraerServer($id)
{
  $sql = "SELECT *
  FROM server
  WHERE id = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Precios_TraerPorId($id)
{
  $sql = "SELECT *
  FROM preciosbase
  WHERE id = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function porcentaje($cantidad, $porciento, $decimales)
{
  return number_format($cantidad * $porciento / 100, $decimales, '.', '');
}

function TraerCodigo($id)
{
  $sql = "SELECT *
  FROM productobase
  WHERE SubCategoriaProducto = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Promocion_TraerPorId($id)
{
  $sql = "SELECT *
  FROM promocionbase
  WHERE promocionbase.id = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Registro_TraerPorId($id)
{
  $sql = "SELECT *
  FROM usuarios
  WHERE id = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);
  return $data;
}

function Categoria_TraerPorId($id)
{
  $sql = "SELECT *
  FROM categoriabase
  WHERE IdSuplementos = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Banner_TraerPorId($id)
{
  $sql = "SELECT *
  FROM banner_fijo, bannersize
  WHERE IdSizeBanner = SizeBanner && IdBanner = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Banner_A_TraerPorId($id)
{
  $sql = "SELECT *
  FROM banner_animado
  WHERE IdBanner = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Nota_TraerPorId($id)
{
  $sql = "SELECT *
  FROM notabase
  WHERE  IdNotas = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Portfolio_TraerPorId($id)
{
  $sql = "SELECT *
  FROM portfolio
  WHERE  id_portfolio = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Imagenes_Reconstruidos_TraerPorId($id)
{
  $sql = "SELECT ruta
  FROM `imagenes_maquinas`
  WHERE  `maquina` = '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  while ($data = mysqli_fetch_array($result)) {
    @$imagenes .= $data[0] . "-";
  }
  ;
  return $imagenes;
}

function Imagenes_TraerPorId($id)
{
  $sql = "SELECT ruta
  FROM `imagenes`
  WHERE  `codigo` = '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  while ($data = mysqli_fetch_array($result)) {
    @$imagenes .= $data[0] . "-";
  }
  ;
  return $imagenes;
}

function Reconstruidos_TraerPorId($id)
{
  $sql = "SELECT *
  FROM maquinas
  WHERE  id_portfolio = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Nota_TraerPorId_Front($id)
{
  $sql = "SELECT *
  FROM notabase
  WHERE IdNotas = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Producto_TraerPorId($id)
{
  $sql = "SELECT *
  FROM productobase
  WHERE IdProducto = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Control_TraerPorId($id)
{
  $sql = "SELECT *
  FROM interno
  WHERE id = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Orden_TraerPorId($id)
{
  $sql = "SELECT *
  FROM orden
  WHERE cod_orden = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function RRHH_TraerPorId($id)
{
  $sql = "SELECT *
  FROM rrhh
  WHERE cod_orden = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Orden_TraerPorId_Info($id)
{
  $sql = "SELECT *
  FROM orden, `interno`
  WHERE `cod_orden` = `control` AND `id_orden` = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Orden_TraerPorId_Info2($id)
{
  $sql = "SELECT *
  FROM orden
  WHERE `id_orden` = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function RRHH_TraerPorId_Info($id)
{
  $sql = "SELECT *
  FROM rrhh
  WHERE `id_orden` = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Suma_Tiempo_Orden($id)
{
  $sql = "SELECT SUM(tiempo)
  FROM orden, interno
  WHERE cod_orden = control AND id_orden = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Video_TraerPorId($id)
{
  $sql = "SELECT *
  FROM videos
  WHERE  IdVideos = $id";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Suplemendo_Modificar($arrData)
{
  $sql =
  "UPDATE categoriabase
  SET
  TituloSuplementos='$arrData[TituloSuplementos]'
  , FechaSuplementos='$arrData[FechaSuplementos]'
  , AutorSuplemento = '$arrData[AutorSuplemento]'
  , DescripcionSuplemento='$arrData[DescripcionSuplemento]'
  WHERE IdSuplementos=$arrData[IdSuplementos]";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
}

function ModificarServer($server)
{
  $sql =
  "UPDATE server
  SET
  server='$server'
  WHERE id=1";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
}

function Actualizar_Stock($id, $stock)
{
  $sql =
  "UPDATE productobase
  SET
  FiltroProducto='$stock'
  WHERE IdProducto= '$id'";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
  echo "<script language=Javascript> location.href=\"index.php?pag=productos&op=A\"; </script>";
}

function Sumar_Micrositio($id)
{
  $sql =
  "UPDATE micrositio
  SET
  visitas_micrositio = visitas_micrositio+1
  WHERE cod_micrositio = '$id'"
  ;
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
}

function Sumar_Visitas($pag)
{
  $link      = Conectarse();
  $ip        = getenv('REMOTE_ADDR');
  $consulta  = "select * from  `visitas` where `ip_visita`='$ip' AND `pag_visita` = $pag AND fecha_visita = NOW()";
  $resultado = mysqli_query($link, $consulta);
  $fila      = mysqli_fetch_array($resultado);
  if ($fila == "") {
    $consulta2  = "INSERT INTO `visitas`(`fecha_visita`, `pag_visita`, `ip_visita`) VALUES (NOW(), '$pag', '$ip')";
    $resultado2 = mysqli_query($link, $consulta2);
  }
}

function Actualizar_Estado($id, $estado)
{
  $sql =
  "UPDATE cursos
  SET DestacarCurso = '$estado'
  WHERE IdCursos = '$id'";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
}

function Actualizar_Estado_Publi($id, $estado)
{
  $sql =
  "UPDATE publicidad
  SET estado_publicidad = '$estado'
  WHERE cod_publicidad = '$id'";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
}

function Actualizar_Tipo($id, $estado)
{
  $sql =
  "UPDATE agencias
  SET tipo_agencia = '$estado'
  WHERE cod_agencia = '$id'";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
}

function Actualizar_Estado_RRHH($id, $estado)
{
  $sql =
  "UPDATE rrhh
  SET
  estado_orden = '$estado'
  WHERE id_orden = '$id'";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
  header("Location: index.php?op=verRRHH");
}

function Pasar_Vistos($id, $categoria)
{
  $sql =
  "UPDATE consultasbase
  SET
  categoria = '$categoria'
  WHERE id= '$id'";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
  header("Refresh: 2; URL='index.php?pag=consultas'");
}

function Restar_Stock($id, $stock)
{
  $sql =
  "UPDATE productobase
  SET
  FiltroProducto='$stock'
  WHERE IdProducto= '$id'";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);

}

function Slider_Modificar($arrData)
{
  $sql =
  "UPDATE sliderbase
  SET
  TituloSlider='$arrData[TituloSlider]'
  , DescripcionSlider='$arrData[DescripcionSlider]'
  , ImgSlider='$arrData[ImgSlider]'
  WHERE IdSlider=$arrData[IdSlider]";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);
}

function Banner_Modificar($arrData)
{
  $sql =
  "UPDATE banner_fijo
  SET
  LinkBanner='$arrData[LinkBanner]'
  , RutaBanner='$arrData[RutaBanner]'
  WHERE IdBanner=$arrData[IdBanner]";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);

  echo "<script language=Javascript> location.href=\"index2.php?pagina=bannerTodos\"; </script>";
}

function Banner_Modificar_A($arrData)
{
  $sql =
  "UPDATE banner_animado
  SET
  LinkBanner='$arrData[LinkBanner]'
  , RutaBanner='$arrData[RutaBanner]'
  WHERE IdBanner=$arrData[IdBanner]";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);

  echo "<script language=Javascript> location.href=\"index2.php?pagina=animadoTodos\"; </script>";
}

function Nota_Modificar($arrData)
{
  $sql =
  "UPDATE notabase
  SET
  TituloNotas='$arrData[TituloNotas]'
  , CitasNotas='$arrData[CitasNotas]'
  , FechaNotas='$arrData[FechaNotas]'
  , IdSumplemento=''
  , AutorNotas = '$arrData[AutorNotas]'
  , DesarrolloNotas='$arrData[DesarrolloNotas]'
  , ImgNotas='$arrData[ImgNotas]'
  WHERE IdNotas=$arrData[IdNotas]";
  $link = Conectarse();
  $r    = mysqli_query($link, $sql);

}

/* * **************************** USUARIO */

function Usuario_Login($user, $pass)
{
  $sql = "
  SELECT  *
  FROM  `empleados`
  WHERE  `usuario_usuario` =  '$user'
  AND  `pass_usuario` =  '$pass'
  ";

  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  return $result;
}

function Registros_Login($user, $pass)
{
  $sql = "
  SELECT  *
  FROM  `usuarios`
  WHERE  `email` =  '$user'
  AND  `pass` =  '$pass' 
  ";

  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  return $result;
}

function RLogin($usuario, $clave)
{
  $result = Registros_Login($usuario, $clave);
  $data   = mysqli_fetch_array($result);
  if ($data) {
    if($data["estado"] == 1) {
      $_SESSION["user"] = $data;
      return 1;
    } else {
      echo "<span class='alert alert-warning btn-block'><i class='fa fa-info-circle'></i> Tu cuenta no fue verificada por nuestros vendedores. Envianos un email y te respondemos por qué no fue activada. (<a href='mailto:administracion@delyar.com.ar' target='_blank'>administracion@delyar.com.ar</a>)</span>";
      return 0;  
    }    
  } else {
    echo "<span class='alert alert-danger btn-block'>Los datos son incorrectos</span>";
    return 0;
  }
}

function Login($usuario, $clave)
{
  $result = Usuario_Login($usuario, $clave);
  $data   = mysqli_fetch_array($result);
  if ($data) {
    $_SESSION['usuario'] = $data;
    echo "<script>location.reload();</script>";
  } else {
    ?>
    <script>alert("No puede ingresar ya que los datos no son los correctos.")</script>
  <?php }
}

function normaliza($cadena)
{
  $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
  ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
  $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
  bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
  $cadena = utf8_decode($cadena);
  $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
  $cadena = strtolower($cadena);
  return utf8_encode($cadena);
}

function LogOut()
{
  unset($_SESSION['usuario']);
  session_unset();
  session_destroy();
}

function Revisar_Email($base, $tabla, $email)
{
  $sql = "
  SELECT  *
  FROM  `$base`
  WHERE  `$tabla` =  '$email'";

  $link   = Conectarse_Mysqli();
  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);
  return $data;
}

function Crear_PDF_S($nombre, $socio, $email, $cargo, $cod, $archivo)
{
  $nombreF = iconv('UTF-8', 'windows-1252', strtoupper($nombre));
  $socioF  = iconv('UTF-8', 'windows-1252', strtoupper($socio));
  $cargoF  = iconv('UTF-8', 'windows-1252', strtoupper($cargo));
  $emailF  = iconv('UTF-8', 'windows-1252', strtolower($email));

  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', '', 11);
    //inserto la cabecera poniendo una imagen dentro de una celda
  $pdf->SetMargins(105, 140);

  $pdf->Cell(700, 85, $pdf->Image('img/entrada_socios.jpg', 30, 12, 160), 0, 0, 'C');
  $pdf->Ln(50);
  $pdf->Cell(40, 12, date('d/m/Y'), 0, "L");
  $pdf->Cell(60, 12, $cod, 0, "R");
  $pdf->Ln(7);
  $pdf->Cell(100, 12, "Nombre : " . $nombreF);
  $pdf->Ln(7);
  $pdf->Cell(100, 12, "Email: " . $emailF);
  $pdf->Ln(7);
  $pdf->Cell(100, 12, "Cargo / Puesto: " . $cargoF);
  $pdf->Ln(7);
  $pdf->Cell(100, 12, "Asociado: " . $socioF);
  $pdf->Ln(7);

  $pdf->SetFont('Arial', '', 8);

  $pdf->Output($archivo);

}

function Crear_PDF_I($empresa, $nombre, $email, $archivo, $cod)
{
  $nombreF  = iconv('UTF-8', 'windows-1252', strtoupper($nombre));
  $emailF   = iconv('UTF-8', 'windows-1252', strtolower($email));
  $empresaF = iconv('UTF-8', 'windows-1252', strtoupper($empresa));

  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', '', 11);
    //inserto la cabecera poniendo una imagen dentro de una celda
  $pdf->SetMargins(105, 140);

  $pdf->Cell(700, 85, $pdf->Image('img/entrada_usuarios.jpg', 30, 12, 160), 0, 0, 'C');
  $pdf->Ln(47);
  $pdf->Ln(3);
  $pdf->Cell(40, 12, date('d/m/Y'), 0, "L");
  $pdf->Cell(60, 12, $cod, 0, "R");
  $pdf->Ln(12);
  $pdf->Cell(100, 12, "Empresa : " . $empresaF);
  $pdf->Ln(7);
  $pdf->Cell(100, 12, "Nombre : " . $nombreF);
  $pdf->Ln(7);
  $pdf->Cell(100, 12, "Email: " . $emailF);

  $pdf->SetFont('Arial', '', 8);

  $pdf->Output($archivo);

}

/* * ************************ ARCHIVOS */

function Subir_Archivos_Suplementos()
{
  $img        = "";
  $pdf        = "";
  $destinoImg = "";
  $destinoPdf = "";
    //img
  $img        = $_FILES["img_suplemento"]["tmp_name"];
  $destinoImg = "suplemento/img_suplemento/" . $_FILES["img_suplemento"]["name"];
  move_uploaded_file($img, $destinoImg);
  echo "Imagen Subida";
    //pdf
  $pdf        = $_FILES["pdf_suplemento"]["tmp_name"];
  $destinoPdf = "suplemento/pdf_suplemento/" . $_FILES["pdf_suplemento"]["name"];
  move_uploaded_file($pdf, $destinoPdf);
  echo "Suplemento Subido";
}

/* * ****** ORDENAR DATOS */

function reordenar()
{
  if (isset($_POST['Reordenar'])) {
    $sql    = "ALTER TABLE notabase AUTO_INCREMENT=1";
    $link   = Conectarse();
    $result = mysqli_query($link, $sql);
    return $result;
    echo "<script language=Javascript> location.href=\"index2.php?pagina=notasTodas\"; </script>";
  }
}

/************************************** PAGINA ****************************************/

function Propiedades_Read()
{
  $idConn = Conectarse();
  $sql    = "
  SELECT *
  FROM productobase, categoriaproducto
  WHERE CategoriaProducto = IdCategoriaProducto
  ORDER BY IdProducto DESC
  ";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {
    $descripcion = ucfirst(strtolower(trim(strip_tags($row["DescripcionProducto"]))));
    ?>
    <div class="anuncio">
     <center class="contImg">
      <img src="../admin/<?php echo $row["ImgProducto1"] ?>" width="200">
    </center>
    <center>
      <h4 class="robo azul"><?php echo $row["NombreProducto"] ?></h4>
      <img src="img/separador.png" width="90%" />
      <span class="abajo robo"><?php echo strtoupper($row["LocalidadProducto"]) ?></span>
      <p class="noto">

       <?php echo substr($descripcion, 0, 200) ?>
     </p>
     <div class="boton noto">
       <a href="index.php?pag=propiedad&id=<?php echo $row["IdProducto"] ?>&op=1">QUIERO VIVIR ACÁ</a>
       <a href="index.php?pag=propiedad&id=<?php echo $row["IdProducto"] ?>">VER +</a>
     </div>
   </center>
 </div>



 <?php
}
}

function Propiedad_Cada_Read($id)
{
  $link = Conectarse();
  $sql  = "
  SELECT *
  FROM productobase, categoriaproducto
  WHERE IdProducto = $id
  ";

  $result = mysqli_query($link, $sql);
  $data   = mysqli_fetch_array($result);

  return $data;
}

function Localidades_Read($palabra)
{
  $idConn = Conectarse();
  $sql    = "SELECT  `localidad_agencia`
  FROM  `agencias`
  WHERE  `provincia_agencia` LIKE  '%$palabra%'
  GROUP BY `localidad_agencia`
  ";
  $resultado = mysqli_query($idConn, $sql);

  while ($row = mysqli_fetch_array($resultado)) {
    $contar       = "SELECT COUNT('localidad_agencia') FROM  `agencias` WHERE  `localidad_agencia` LIKE  '%" . $row['localidad_agencia'] . "%'  GROUP BY  `localidad_agencia`";
    $resultContar = mysqli_query($idConn, $contar);
    $row2         = mysqli_fetch_row($resultContar)
    ?>
    <option value="<?php echo $row['localidad_agencia'] ?>"><?php echo strtoupper($row['localidad_agencia']) ?> (<?php echo ($row2[0]) ?>)</option>
    <?php
  }
}

function Traer_Options($palabra)
{
  $idConn = Conectarse();
  $sql    = "SELECT *
  FROM  `categorias`
  WHERE  `trabajo_categoria` LIKE  '%$palabra%'
  GROUP BY `nombre_categoria`
  ";
  $resultado = mysqli_query($idConn, $sql);

  while ($row = mysqli_fetch_array($resultado)) {
    ?>
    <option value="<?php echo $row['nombre_categoria'] ?>"><?php echo strtoupper($row['nombre_categoria']) ?></option>
    <?php
  }
}

function Provincias_Read_Front()
{
  $idConn    = Conectarse_Mysqli();
  $sql       = "SELECT `nombre` FROM  `_provincias` ORDER BY nombre";
  $resultado = mysqli_query($idConn, $sql);
  while ($row = mysqli_fetch_row($resultado)) {
    ?>
    <option value="<?php echo limpiar_caracteres_especiales($row[0]) ?>"><?php echo mb_strtoupper($row[0]) ?></option>
    <?php
  }
}

function Calles_Read($prov, $loc)
{
  $idConn = Conectarse();
  $sql    = "SELECT  `direccion_agencia`
  FROM  `agencias`
  WHERE  `provincia_agencia` LIKE  '%$prov%' AND `localidad_agencia` LIKE  '%$loc%'
  ORDER BY `direccion_agencia` ASC
  ";
  $resultado = mysqli_query($idConn, $sql);

  while ($row = mysqli_fetch_array($resultado)) {
    ?>
    <option value="<?php echo $row['direccion_agencia'] ?>"><?php echo strtoupper($row['direccion_agencia']) ?> </option>
    <?php
  }
}

function Promociones_Option()
{
  $idConn    = Conectarse();
  $sql       = "SELECT * FROM  `promocionbase`";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_row($resultado)) {
    ?>

    <option value="<?php echo $row[1] ?>"><?php echo strtoupper($row[1]) ?></option>


    <?php
  }
}

function Provincias_Read()
{
  $idConn    = Conectarse();
  $sql       = "SELECT nombre FROM  `provincias` ORDER BY nombre";
  $resultado = mysqli_query($idConn, $sql);
  while ($row = mysqli_fetch_row($resultado)) {
    ?>
    <li class="listProv"><a href="busqueda.php?prov=<?php echo $row[0] ?>"><?php echo strtoupper($row[0]) ?></a></li>
    <?php
  }
}

function Contar_Agencias($estado)
{
  $idConn = Conectarse();

  $sql2       = "SELECT COUNT('id_agencia') FROM  `agencias` WHERE estado_agencia = $estado";
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);
  echo "(" . $row2[0] . ")";
}

function Contar_Publicidad($estado)
{
  $idConn = Conectarse();

  $sql2       = "SELECT COUNT('id_publicidad') FROM  `publicidad` WHERE estado_publicidad = $estado";
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);
  echo "(" . $row2[0] . ")";
}

function Contar_Notas_Categoria($categoria)
{
  $idConn = Conectarse();

  $sql2       = "SELECT COUNT('IdNotas') FROM  `notabase` WHERE CategoriaNotas = $categoria AND VipNotas = 0";
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);
  echo $row2[0];
}

function Contar_Videos_Categoria($categoria)
{
  $idConn = Conectarse();

  $sql2       = "SELECT COUNT('IdVideos') FROM  `videos` WHERE CategoriaVideos = $categoria";
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);
  echo $row2[0];
}

function Contar_Reconstruidos_Categoria($categoria)
{
  $idConn = Conectarse();

  $sql2       = "SELECT COUNT('id_portfolio') FROM  `maquinas` WHERE categoria_portfolio = $categoria AND tipo_portfolio = 1";
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);

  return $row2;

}

function Contar_Usados_Categoria($categoria)
{
  $idConn = Conectarse();

  $sql2       = "SELECT COUNT('id_portfolio') FROM  `maquinas` WHERE categoria_portfolio = $categoria AND tipo_portfolio = 2";
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);

  return $row2;

}

function Pedidos_Read_Admin($estado)
{
  $idConn = Conectarse();

  $sql  = "SELECT * FROM  `pedidos`,`usuarios`  WHERE estado_pedido = $estado AND usuario_pedido = id ORDER BY `id_pedido` DESC";
  $sql2 = "SELECT COUNT('id_pedido') FROM  `pedidos` WHERE estado_pedido = $estado ORDER BY `id_pedido` DESC";

  $resultado  = mysqli_query($idConn, $sql);
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);

  $count = $row2[0];
  $i     = 1;
  if ($count != 0) {
    while ($row = mysqli_fetch_array($resultado)) {
      ?>
      <dd class="">
        <a href="#panel<?php echo $i ?>b">Pedido de: <?php echo $row["nombre"] ?> </a>
        <div id="panel<?php echo $i ?>b" class="content">
         <?php echo $row["contenido_pedido"] ?>
         <?php
         if ($row["costo_pedido"] != '') {
          echo "Presupuestado: $" . $row["costo_pedido"];
        }
        ?>
        <form method="post">
          <input type="hidden" value="<?php echo $row["cod_pedido"] ?>" name="cod">
          <input type="number" name="presupuesto" placeholder="Costo" style="width:50%;float:left;">
          <input type="submit" name="enviar" class="button" value="Modificar">
        </form>
      </div>
    </dd>
    <?php
    $i++;
  }
} else {
  echo "No se ha encontrado ningún registro.";
}
}

function Usuarios_Read_Admin()
{
  $idConn = Conectarse();

  $sql  = "SELECT * FROM  `usuarios` ORDER BY `id` DESC";
  $sql2 = "SELECT count(id) FROM  `usuarios` ORDER BY `id` DESC";

  $resultado  = mysqli_query($idConn, $sql);
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);

  $count = $row2[0];

  if ($count != 0) {
    while ($row = mysqli_fetch_array($resultado)) {
      ?>
      <tr>
        <td><?php echo strtoupper($row["nombre"]) ?></td>
        <td><?php echo $row["email"] ?></td>
        <td><?php if($row["estado"]==1){echo "SI";}else{echo "NO";} ?></td>
        <td><?php if($row["lista"]==1){echo "Selecta";}else{echo "Normal";} ?></td>
        <td style="text-align: right">
         <a href="index.php?op=modUsuarios&id=<?php echo $row["id"] ?>" style="margin:5px" data-toggle="tooltip" alt="Modificar" title="Modificar">
          <i class="fa fa-cog"></i>
        </a>
        <a href="index.php?op=verUsuarios&borrar=<?php echo $row["id"] ?>" style="margin:5px" data-toggle="tooltip" alt="Borrar" title="Borrar" onClick="return confirm('¿Seguro querés eliminar el usuario?')" >
         <i class="fa fa-trash"></i>
       </a>
     </td>
   </tr>
   <?php
 }
} else {
  echo "No se ha encontrado ningún registro.";
}
}

function Publicidad_Read_Sesion($id)
{
  $idConn = Conectarse();

  $sql  = "SELECT * FROM  `publicidad` WHERE  `usuario_publicidad` = '$id' ORDER BY `id_publicidad` DESC";
  $sql2 = "SELECT COUNT('id') FROM  `agencias`";

  $resultado  = mysqli_query($idConn, $sql);
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);

  $count = $row2[0];

  if ($count != 0) {
    while ($row = mysqli_fetch_array($resultado)) {
      $fecha = explode("-", $row["cierre_publicidad"]);
      ?>
      <tr>
        <td><a href="http://<?php echo $row["url_publicidad"] ?>" target="_blank"><?php echo $row["url_publicidad"] ?></a></td>
        <td><a href="<?php echo $row["img_publicidad"] ?>" target="_blank" rel="lightbox">IMAGEN</a></td>
        <td><?php echo $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0] ?></td>
        <td style="text-align: center">
         <?php switch ($row["estado_publicidad"]) {
          case 1:
          ?><img src="img/estado1.png" title="Acreditado y anuncio activado" width="20" /><?php
          break;
          case 2:
          ?><img src="img/estado2.png" title="Pendiente y Revisión" width="20" /><?php
          break;
          case 0:
          ?><img src="img/estado0.png" title="Rechazado" width="20" />
          <?php
          break;
        }
        ?>
      </td>
      <td style="text-align: right">
       <a href="<?php echo $row["img_publicidad"] ?>" rel="lightbox"><img src="img/anuncio.png" width="20" style="margin-right:7px;" title="Ver Anuncio"/></a>
       <a href="sesion.php?op=publicidad&mod=<?php echo $row["id_publicidad"] ?>"><img src="img/ajustes.png" width="20" style="margin-right:7px;" title="Ajustes Anuncio"/></a>
       <a href="sesion.php?op=publicidad&pagar=<?php echo $row["id_publicidad"] ?>" <?php
       if ($row["estado_publicidad"] != 0) {
        echo "style='display:none'";
      }
      ?>>
      <img src="img/pagar.png" width="20" style="margin-right:7px;" title="Pagar Anuncio"/></a>
      <a href="sesion.php?op=publicidad&msj=borrar&cod=<?php echo $row["id_publicidad"] ?>"><img src="img/borrar2.png" width="15" style="margin-right:7px;" title="Borrar Anuncio"/></a>
    </td>
  </tr>
  <?php
}
}
}

function Inventario_Traer_Por_Usuario($id)
{
  $con                = Conectarse();
  $consultaInventario = "SELECT * FROM `productos_inventarios` WHERE `inventario_productoInv` =  $id ";
  $resultInventario   = mysqli_query(con, $consultaInventario);
  while ($rowInventario = mysqli_fetch_array($resultInventario)) {
    $cod       = $rowInventario["codigo_productoInv"];
    $consulta  = "SELECT * FROM `productos_final` WHERE `cod` =  '$cod'";
    $resultado = mysqli_query(con, $consulta);
    ?>
    <div class='row' style="padding-top:20px;padding-bottom:20px;border-top:1px solid #e1e1e1">
      <div class='col-md-6'>
        <?php
        while ($rowA = mysqli_fetch_array($resultado)) {
          echo "<b>(" . $rowA["cod"] . ")" . $rowA["titulo"] . "</b><br/>";
          echo "<span class='descripcionTd'>" . $rowA["descripcion"] . "-" . $rowA["proovedor"] . "</span>";
        }
        ?>
      </div>
      <div class='col-md-6'>
        <?php echo $rowInventario["cantidad_productoInv"] ?>
      </div>
    </div>
    <?php
  }
}

function Publicidad_Read_Admin($estado)
{
  $idConn = Conectarse();

  $sql  = "SELECT * FROM  `publicidad` WHERE  `estado_publicidad` = '$estado' ORDER BY `id_publicidad` DESC";
  $sql2 = "SELECT COUNT('id_publicidad') FROM  `publicidad`";

  $resultado  = mysqli_query($idConn, $sql);
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);

  $count = $row2[0];

  if ($count != 0) {
    while ($row = mysqli_fetch_array($resultado)) {
      $fecha = explode("-", $row["cierre_publicidad"]);
      ?>
      <tr>
        <td><a href="http://<?php echo $row["url_publicidad"] ?>" target="_blank"><?php echo $row["url_publicidad"] ?></a></td>
        <td><?php echo $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0] ?></td>
        <td style="text-align: center">
         <?php switch ($row["estado_publicidad"]) {
          case 1:
          ?><img src="img/estado1.png" title="Acreditado y anuncio activado" width="20" /><?php
          break;
          case 2:
          ?><a href="index.php?op=verPublicidad&act=<?php echo $row["cod_publicidad"] ?>"><img src="img/estado2.png" title="Pendiente y Revisión" width="20" /></a><?php
          break;
          case 0:
          ?><img src="img/estado0.png" title="Rechazado" width="20" />
          <?php
          break;
        }
        ?>
      </td>
      <td style="text-align: right">
       <a href="../<?php echo $row["img_publicidad"] ?>" rel="lightbox"><img src="img/anuncio.png" width="20" style="margin-right:7px;" title="Ver Anuncio"/></a>
       <a href="index.php?op=publicidad&mod=<?php echo $row["id_publicidad"] ?>"><img src="img/ajustes.png" width="20" style="margin-right:7px;" title="Ajustes Anuncio"/></a>
       <a href="index.php?op=verPublicidad&borrar=<?php echo $row["id_publicidad"] ?>"><img src="img/borrar2.png" width="15" style="margin-right:7px;" title="Borrar Anuncio"/></a>
     </td>
   </tr>
   <?php
 }
}
}

function Publicidad_Read_Front($tipo)
{
  $idConn = Conectarse();

  switch ($tipo) {
    case 1:
    $sql  = "SELECT * FROM publicidad WHERE tipo_publicidad = $tipo AND cierre_publicidad >= NOW()  ORDER BY RAND() LIMIT 7";
    $sql2 = "SELECT COUNT(*) FROM publicidad WHERE tipo_publicidad = $tipo AND cierre_publicidad >= NOW() ";
    break;
    case 2:
    $sql  = "SELECT * FROM publicidad WHERE tipo_publicidad = $tipo AND cierre_publicidad >= NOW() ORDER BY RAND() LIMIT 2";
    $sql2 = "SELECT COUNT(*) FROM publicidad WHERE tipo_publicidad = $tipo AND cierre_publicidad >= NOW() ";
    break;
    case 3:
    $sql  = "SELECT * FROM publicidad WHERE tipo_publicidad = $tipo AND cierre_publicidad >= NOW() ORDER BY RAND() LIMIT 3";
    $sql2 = "SELECT COUNT(*) FROM publicidad WHERE tipo_publicidad = $tipo AND cierre_publicidad >= NOW() ";
    break;
  }

  $resultado  = mysqli_query($idConn, $sql);
  $resultado2 = mysqli_query($idConn, $sql2);

  $row2 = mysqli_fetch_row($resultado2);

  $count = $row2[0];

  if ($count != 0) {
    switch ($tipo) {
      case 1:
      while ($row = mysqli_fetch_array($resultado)) {
        ?>
        <div class="hide-for-medium-down" style="width:200px;overflow:hidden;">
         <hr width="200px" class="right"/>
         <a href="http://<?php echo $row['url_publicidad'] ?>" target="_blank"><img src="<?php echo $row['img_publicidad'] ?>" style="width:200px;" class="right"/></a>
       </div>
       <?php
     }
     break;
     case 2:
     while ($row = mysqli_fetch_array($resultado)) {
      ?>
      <div class="large-6 column" style="height:100px; overflow:hidden;">
        <a href="http://<?php echo $row['url_publicidad'] ?>" target="_blank"><img src="<?php echo $row['img_publicidad'] ?>" heigth="100%"/></a>
      </div>
      <div class="clearfix show-for-medium-down">&zwnj;</div>
      <?php
    }
    break;
    case 3:
    while ($row = mysqli_fetch_array($resultado)) {
      ?>
      <center class="large-4 column" style="max-width:300px;height:120px; overflow:hidden;">
        <a href="http://<?php echo $row['url_publicidad'] ?>" target="_blank"><img src="<?php echo $row['img_publicidad'] ?>" heigth="100%" style="margin: auto"/></a>
      </center>
      <center class="clearfix hide-for-large">
        &zwnj;
      </center>
    <?php }
    break;
  }
}
}

function Productos_Read_Front($query)
{
  $idConn = Conectarse();
  if ($query == '') {
    $sql = "
    SELECT *
    FROM productos_final
    ORDER BY titulo ASC
    ";
  } else {
    $sql = "
    SELECT *
    FROM productos_final
    WHERE titulo != ''
    $query
    ORDER BY titulo ASC
    ";
  }
  $resultado = mysqli_query($idConn, $sql);

  while ($row = mysqli_fetch_array($resultado)) {
    echo "<tr>
    <td>" . $row["titulo"] . "  </td>
    <td>" . $row["descripcion"] . "</td>
    <td>" . $row["categoria"] . "</td>
    <td>" . $row["proovedor"] . "</td>
    </tr>";
  }
}

function Armar_Select($buscar)
{
  $idConn = Conectarse();
  $sql    = "
  SELECT $buscar
  FROM productos_final
  GROUP BY $buscar
  ";
  $resultado = mysqli_query($idConn, $sql);

  while ($row = mysqli_fetch_array($resultado)) {
    ?>
    <option value="<?php echo $row[0] ?>" ><?php echo $row[0] ?></option>
    <?php
  }
}

function Recomendacion_Read($categoria)
{
  $idConn = Conectarse();

  $sql = "
  SELECT *
  FROM productobase, categoriaproducto
  WHERE `CategoriaProducto` = $categoria
  GROUP BY IdProducto
  ORDER BY IdProducto DESC
  LIMIT 0,3
  ";

  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {
    $fecha = explode("-", $row['LocalidadProducto']);
    ?>
    <div class="col_4">
      <center class="recomendaciones" style='background-repeat:no-repeat;background-size:110%;background-position:bottom;background-image:url("<?php echo $row["ImgProducto1"] ?>" );'>
       <div class="encaRecom">
        <h3><?php echo strtoupper($row['NombreProducto']) ?></h3>
        <p>
         Salida el <?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?>
       </p>
     </div>
     <a href="index.php?op=pasajeros&id=<?php echo $row["IdProducto"] ?>" class="boton_ver botonRe">Reservar ahora</a>
   </center>
 </div>
<?php }
}

function Productos_Read_Front_Busqueda($filtro)
{
  $idConn = Conectarse();

  $sql = "
  SELECT *
  FROM productobase, categoriaproducto
  WHERE  `DescripcionProducto` LIKE '%$filtro%' OR `NombreProducto` LIKE '%$filtro%'
  GROUP BY IdProducto
  ORDER BY IdProducto DESC
  ";

  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {
    $fecha = explode("-", $row['LocalidadProducto']);
    if ($row["FiltroProducto"] != 0) {
      ?>
      <div class="col_6 viaje">
       <h1><?php echo strtoupper($row['NombreProducto']) ?></h1>
       <h3>Salida el <?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?></h3>
       <div class="overImg">
        <img src="<?php echo $row["ImgProducto1"] ?>" width="100%"  />
      </div>
      <h2><?php echo $row["DireccionProducto"] ?></h2>
      <hr class="alt1" />
      <p><?php echo substr(strip_tags($row["DescripcionProducto"]), 0, 200) . "..." ?></p>
      <div class="clear"></div>
      <a href="index.php?op=viaje&id=<?php echo $row["IdProducto"] ?>" class="boton_ver" alt="Más Info" title="Más Info">Más Info</a>
      <a href="index.php?op=pasajeros&id=<?php echo $row["IdProducto"] ?>" class="boton_reser" alt="Reservá Ahora" title="Reservá Ahora">Reservá Ahora</a>
      <img src="img/sombra.png" class="sombra hide-phone  hide-tablet ">
    </div>
    <?php
  }
}
}

function Operacion_Read()
{
  $idConn    = Conectarse();
  $sql       = "SELECT CategoriaProducto, NombreCategoriaProducto FROM  `productobase`, `categoriaproducto` WHERE `IdCategoriaProducto` = `CategoriaProducto` GROUP BY CategoriaProducto";
  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_row($resultado)) {
    ?>

    <option value="<?php echo $row[0] ?>"><?php echo strtoupper($row[1]) ?></option>


    <?php
  }
}

function Filtrado_Busqueda($tipo, $pcia, $localidad)
{
  $idConn = Conectarse();

  if ($tipo != '' && $pcia != '' && $localidad == '') {
    $sql = "
    SELECT * FROM  `productobase`, `categoriaproducto`
    WHERE `IdCategoriaProducto` = `CategoriaProducto` AND `CategoriaProducto` = '$tipo' AND `ProvinciaProducto` = '$pcia'";
  } elseif ($tipo != '' && $localidad != '' && $pcia == '') {
    $sql = "
    SELECT * FROM  `productobase`, `categoriaproducto`
    WHERE `IdCategoriaProducto` = `CategoriaProducto` AND `CategoriaProducto` = '$tipo' AND `LocalidadProducto` = '$localidad'";
  } elseif ($tipo != '' && $localidad != '' && $pcia != '') {
    $sql = "
    SELECT * FROM  `productobase`, `categoriaproducto`
    WHERE `IdCategoriaProducto` = `CategoriaProducto` AND `CategoriaProducto` = '$tipo' AND `LocalidadProducto` = '$localidad' AND `ProvinciaProducto` = '$pcia'";
  } elseif ($tipo != '' && $pcia == '' && $localidad == '') {
    $sql = "
    SELECT * FROM  `productobase`, `categoriaproducto`
    WHERE `IdCategoriaProducto` = `CategoriaProducto` AND `CategoriaProducto` = '$tipo'";
  } elseif ($localidad != '' && $pcia != '' && $tipo == '') {
    $sql = "
    SELECT * FROM  `productobase`, `categoriaproducto`
    WHERE `IdCategoriaProducto` = `CategoriaProducto` AND `ProvinciaProducto` = '$pcia' AND `LocalidadProducto` = '$localidad'";
  } elseif ($localidad != '' && $pcia == '' && $tipo == '') {
    $sql = "
    SELECT * FROM  `productobase`, `categoriaproducto`
    WHERE `IdCategoriaProducto` = `CategoriaProducto` AND `LocalidadProducto` = '$localidad'";
  } elseif ($pcia != '' && $localidad == '' && $tipo == ''
) {
    $sql = "
    SELECT * FROM  `productobase`, `categoriaproducto`
    WHERE `IdCategoriaProducto` = `CategoriaProducto` AND `ProvinciaProducto` = '$pcia' ";
  }

  $resultado = mysqli_query($idConn, $sql);
    //Carga del array de datos

  while ($row = mysqli_fetch_array($resultado)) {

    $descripcion = ucfirst(strtolower(trim(strip_tags($row["DescripcionProducto"]))));
    ?>
    <div class="anuncio">
     <center class="contImg">
      <img src="../admin/<?php echo $row["ImgProducto1"] ?>" width="200">
    </center>
    <center>
      <h4 class="robo azul"><?php echo $row["NombreProducto"] ?></h4>
      <img src="img/separador.png" width="90%" />
      <span class="abajo robo"><?php echo strtoupper($row["LocalidadProducto"]) ?></span>
      <p class="noto">

       <?php echo substr($descripcion, 0, 200) ?>
     </p>
     <div class="boton noto">
       <a href="index.php?pag=propiedad&id=<?php echo $row["IdProducto"] ?>&op=1">QUIERO VIVIR ACÁ</a>
       <a href="index.php?pag=propiedad&id=<?php echo $row["IdProducto"] ?>">VER +</a>
     </div>
   </center>
 </div>

<?php }
}

/**** EMAIL ****/

function Enviar($sPara, $sAsunto, $sTexto, $sDe)
{
  $bHayFicheros   = 0;
  $sCabeceraTexto = "";
  $sAdjuntos      = '';
  if ($sDe) {
    $sCabeceras = "From:" . $sDe . "n";
  } else {
    $sCabeceras = "";
  }

  $sCabeceras .= "MIME-version: 1.0n";
  foreach ($_POST as $sNombre => $sValor) {
    $sTexto = $sTexto . "n" . $sNombre . " = " . $sValor;
  }

  foreach ($_FILES as $vAdjunto) {
    if ($bHayFicheros == 0) {
      $bHayFicheros = 1;
      $sCabeceras .= "Content-type: multipart/mixed;";
      $sCabeceras .= "boundary="-"n";
      $sCabeceraTexto = "----_Separador-de-mensajes_--n";
      $sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1n";
      $sCabeceraTexto .= "Content-transfer-encoding: 7BITn";
      $sTexto = $sCabeceraTexto . $sTexto;
    }
    if ($vAdjunto["size"] > 0) {
      $sAdjuntos .= "nn----_Separador-de-mensajes_--n";
      $sAdjuntos .= "Content-type: " . $vAdjunto["type"] . ";name=" . $vAdjunto['name'] . "n";
      $sAdjuntos .= "Content-Transfer-Encoding: BASE64n";
      $sAdjuntos .= "Content-disposition: attachment;filename=" . $vAdjunto['name'] . "nn";
      $oFichero   = fopen($vAdjunto["tmp_name"], 'r');
      $sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"]));
      $sAdjuntos .= chunk_split(base64_encode($sContenido));
      fclose($oFichero);
    }
  }
  if ($bHayFicheros) {
    $sTexto .= $sAdjuntos . "nn----_Separador-de-mensajes_----n";
  }

  return (mail($sPara, $sAsunto, $sTexto, $sCabeceras));
}

function Enviar_User($asunto, $mensaje, $receptor)
{
  $mail          = new PHPMailer();
  $mail->CharSet = 'UTF-8';
  $mail->IsSMTP();
  $mail->SMTPDebug = 1;
  $mail->SMTPAuth  = true;
  $mail->Host      = SMTP_EMAIL;
  $mail->Port      = 587;
  $mail->Username  = EMAIL;
  $mail->Password  = PASS_EMAIL;
  $mail->SetFrom(EMAIL, TITULO);
  $fecha    = date("Y-m-d H:i:s");
  $pie      = Contenido_TraerPorId("pie email");
  $cabecera = Contenido_TraerPorId("cabecera email");

  $cuerpo = "
  <body style='background:#fff fixed;  font-family: Tahoma,Verdana,Segoe,sans-serif; '>
  <div style='min-height:900px;height:100% !important;margin:0 !important;padding:0 !important'>
  <div style='width:700px;margin:auto;padding:20px;background:#fff;'>
  <img src='" . LOGO . "' style='width:230px'>
  </div>
  <div style='width:700px;margin:auto;padding:20px;background:#fff;'>
  <h3>¡Hola! ¿cómo estás?</h3>
  <p style='font-size:14px'>$mensaje</p><br/>
  <span style='font-size:13px'>
  <b>" . TITULO . "</b>
  <hr/>
  $pie[1]
  <br/>
  </span><br/><br/>
  <hr/>
  <p>Fecha del email:" . $fecha . "</p>
  </div>
  </div>
  </body>
  ";

  $cuerpo = $cuerpo;
  $mail->AddReplyTo(EMAIL, TITULO);
  $mail->Subject = $asunto;
  $mail->AltBody = "Para ver el mensaje, por favor use Thunderbird o algún programa que vea HTML!";
  $mail->MsgHTML($cuerpo);
  $mail->AddAddress($receptor, "");

  if (!$mail->Send()) {
    echo "<script>alert('Su mensaje no se ha podido enviar, vuelva a intentarlo')</script>";
  } else {
    echo "<script>alert('Su mensaje se ha podido enviar, muchas gracias')</script>";
  }
}

function Enviar_User_Admin($asunto, $mensaje, $receptor)
{
  $mail          = new PHPMailer();
  $mail->CharSet = 'UTF-8';

  $mail->IsSMTP();
  $mail->SMTPDebug = 1;
  $mail->SMTPAuth  = true;
  $mail->Host      = SMTP_EMAIL;
  $mail->Port      = 587;
  $mail->Username  = EMAIL;
  $mail->Password  = PASS_EMAIL;
  $mail->SetFrom(EMAIL, TITULO);
  $fecha    = date("Y-m-d H:i:s");
  $pie      = Contenido_TraerPorId("pie email");
  $cabecera = Contenido_TraerPorId("cabecera email");

  $cuerpo = "
  <body style='background:#fff fixed;  font-family: Tahoma,Verdana,Segoe,sans-serif; '>
  <div style='min-height:900px;height:100% !important;margin:0 !important;padding:0 !important'>
  <div style='width:700px;margin:auto;padding:20px;background:#fff;'>
  <img src='" . LOGO . "' style='width:230px'>
  </div>
  <div style='width:700px;margin:auto;padding:20px;background:#fff;'>
  <h3>¡Hola! ¿cómo estás?</h3>
  <p style='font-size:14px'>$mensaje</p><br/>
  <span style='font-size:13px'>
  <b>" . TITULO . "</b>
  <hr/>
  $pie[1]
  <br/>
  </span><br/><br/>
  <hr/>
  <p>Fecha del email:" . $fecha . "</p>
  </div>
  </div>
  </body>
  ";

  $cuerpo = $cuerpo;
  $mail->AddReplyTo(EMAIL, TITULO);
  $mail->Subject = $asunto;
  $mail->AltBody = "Para ver el mensaje, por favor use Thunderbird o algún programa que vea HTML!";
  $mail->MsgHTML($cuerpo);
  $mail->AddAddress($receptor, "");

  if (!$mail->Send()) {
        //echo "<script>alert('Su mensaje no se ha podido enviar, vuelva a intentarlo')</script>";
  } else {
        //echo "<script>alert('Su mensaje se ha podido enviar, muchas gracias')</script>";
  }
}

function EscalarImagen($ancho, $alto, $imagen, $guardar, $calidad)
{
  $image = new Zebra_Image();

  $image->source_path = $imagen;

  $image->target_path = $guardar;

  $image->jpeg_quality = $calidad;

  $image->preserve_aspect_ratio  = true;
  $image->enlarge_smaller_images = true;
  $image->preserve_time          = true;

  if (!$image->resize($ancho, $alto, ZEBRA_IMAGE_NOT_BOXED)) {

        // if there was an error, let's see what the error is about
    switch ($image->error) {

      case 1:
      echo 'Source file could not be found!';
      break;
      case 2:
      echo 'Source file is not readable!';
      break;
      case 3:
      echo 'Could not write target file!';
      break;
      case 4:
      echo 'Unsupported source file format!';
      break;
      case 5:
      echo 'Unsupported target file format!';
      break;
      case 6:
      echo 'GD library version does not support target file format!';
      break;
      case 7:
      echo 'GD library is not installed!';
      break;
    }
  }
}

function Verificar_Evento($email)
{
  $sql = "
  SELECT  *
  FROM  `evento`
  WHERE  `email_evento` =  '$email'";

  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $i      = 0;
  while ($data = mysqli_fetch_array($result)) {
    $i++;
  }
  return $i;
}

function Revisar_Tipo_Lista($id)
{
  $sql    = "SELECT  lista FROM  `usuarios` WHERE  `id` =  '$id'";
  $link   = Conectarse();
  $result = mysqli_query($link, $sql);
  $row    = mysqli_fetch_array($result);
  if ($_SESSION["lista"] != $row["lista"]) {
    $_SESSION["lista"] = $row["lista"];
  }
}

function limpiar_caracteres_especiales($s)
{
  $s = str_replace("á", "a", $s);
  $s = str_replace("Á", "A", $s);
  $s = str_replace("é", "e", $s);
  $s = str_replace("É", "E", $s);
  $s = str_replace("í", "i", $s);
  $s = str_replace("Í", "I", $s);
  $s = str_replace("ó", "o", $s);
  $s = str_replace("Ó", "O", $s);
  $s = str_replace("ú", "u", $s);
  $s = str_replace("Ú", "U", $s);
  $s = str_replace("ñ", "n", $s);
  $s = str_replace("Ñ", "N", $s);
    //para ampliar los caracteres a reemplazar agregar lineas de este tipo:
    //$s = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$s);
  return $s;
}

function normaliza_acentos($s)
{
  $s = str_replace("á", "a", $s);
  $s = str_replace("Á", "A", $s);
  $s = str_replace("é", "e", $s);
  $s = str_replace("É", "E", $s);
  $s = str_replace("í", "i", $s);
  $s = str_replace("Í", "I", $s);
  $s = str_replace("ó", "o", $s);
  $s = str_replace("Ó", "O", $s);
  $s = str_replace("ú", "u", $s);
  $s = str_replace("Ú", "U", $s);
  $s = str_replace(" ", "-", $s);
  $s = str_replace("ñ", "n", $s);
  $s = str_replace("Ñ", "N", $s);
    //para ampliar los caracteres a reemplazar agregar lineas de este tipo:
    //$s = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$s);
  return $s;
}

function antihack_mysqli($var)
{
  $cnx = Conectarse();
  $var = stripslashes($var);
  $var = strip_tags($var);
  $var = htmlentities($var);
  $var = mysqli_real_escape_string($cnx, $var);
  return $var;
}

function antihack($var)
{
  $var = stripslashes($var);
  $var = strip_tags($var);
  $var = htmlentities($var);
  return $var;
}

function headerMove($l)
{
  echo "<script> document.location.href='" . $l . "';</script>";
}

function Hubspot_Dev($arr, $url)
{
  $post_json = json_encode($arr);
  $hapikey   = HUBSPOT;
  $endpoint  = $url . '?hapikey=' . $hapikey;
  $ch        = @curl_init();
  @curl_setopt($ch, CURLOPT_POST, true);
  @curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
  @curl_setopt($ch, CURLOPT_URL, $endpoint);
  @curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response    = @curl_exec($ch);
  $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $curl_errors = curl_error($ch);
  @curl_close($ch);
    //echo "<pre>curl Errors: " . $curl_errors."</pre>";
    //echo "<pre>\nStatus code: " . $status_code."</pre>";
    //echo "<pre>\nResponse: " . $response."</pre>";
    // var_dump($response);
}

function Hubspot_Get($url)
{
  $hapikey  = HUBSPOT;
  $endpoint = $url . '?hapikey=' . $hapikey;
  $json     = file_get_contents($endpoint);
  $obj      = json_decode($json);
  return $obj;
}

function Hubspot_Note($id, $body, $type)
{
  $array = array(
    "engagement"   => array(
      "active"  => true,
      "ownerId" => 1,
      "type"    => $type,
    ),
    "associations" => array(
      "contactIds" => $id,
    ),
    "metadata"     => array(
      "body" => $body,
    ),
  );
  $url = "https://api.hubapi.com/engagements/v1/engagements";
  Hubspot_Dev($array, $url);
}

function Hubspot_AddContact($email, $nombre, $apellido, $telefono, $localidad, $provincia)
{
  $array = array(
    'properties' => array(
      array('property' => 'firstname', 'value' => $nombre),
      array('property' => 'lastname', 'value' => $apellido),
      array('property' => 'email', 'value' => $email),
      array('property' => 'phone', 'value' => $telefono),
      array('property' => 'city', 'value' => $localidad),
      array('property' => 'state', 'value' => $provincia),
    ),
  );
  $url = "https://api.hubapi.com/contacts/v1/contact";
  Hubspot_Dev($array, $url, "NOTES");
}

?>
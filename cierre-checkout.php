<?php
session_start();
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "inc/header.inc.php";?>
  <title>Finalizar tu carrito - Delyar</title>
</head>
<body>
  <div id="page">
    <header class="header">
      <?php include "inc/nav.inc.php";?>
  </header>

  <div class="row encabezado wow fadeInUp">
      <div class="container">
        <div>
            <h1>  <i class="material-icons">label_outline</i> Compra</h1>
        </div>
    </div>
</div>
<div class="container cuerpoContenedor">
  <div class="col-md-12">
    <?php

    $con = Conectarse_Mysqli();

    $pago         = isset($_GET["pago"]) ? $_GET["pago"] : '';
    $cupon        = isset($_GET["collection_id"]) ? $_GET["collection_id"] : '';
    $status       = isset($_GET["collection_status"]) ? $_GET["collection_status"] : '';
    $payment_type = isset($_GET["payment_type"]) ? $_GET["payment_type"] : '';
    $cod          = isset($_GET["cod"]) ? $_GET["cod"] : '';

    $contacto       = Contenido_TraerPorId("contacto");
    $datosBancarios = Contenido_TraerPorId("datos bancarios");
    $carrito        = $_SESSION["carritoFinal"];

    if ($carrito == '') {
        headerMove(BASE_URL . "/productos");
    }

    $descripcionHubspot = str_replace("<td>", "", $_SESSION["carritoFinal"]);
    $descripcionHubspot = str_replace("</td>", " ", $descripcionHubspot);
    $descripcionHubspot = str_replace("<tr>", "", $descripcionHubspot);
    $descripcionHubspot = str_replace("<b>", "", $descripcionHubspot);
    $descripcionHubspot = str_replace("</b>", "", $descripcionHubspot);
    $descripcionHubspot = str_replace("</tr>", "\n", $descripcionHubspot);

    switch ($pago) {
// Tipo 1 transferencia - 2 tarjeta - 3 acordar con vendedor
    // Estado 0 pendiente de pago - 1 pago exitoso - 2 problemas con el pago - 3 enviado
        case 1:
        $_SESSION["carritoFinal"] .= '</table><hr><b>Datos del pago:</b><br/><span style="font-size:12px">Transferencia Bancaria</span>';
        echo "<div class='mb-10 alert alert-success btn-block'><b>¡Excelente, finalizaste tu carrito!.</b> <br/>A continuación vas a ver los datos de las cuentas bancarias y también te llegará un correo para que te comuniques con nosotros.</div>";
        echo '<table class="table table-hovered table-bordered"><thead><th>Productos</th><th>Cantidad</th><th>Precio unidad</th><th>Precio total</th></thead>';
        echo $_SESSION["carritoFinal"];
        echo '<div class="clearfix"></div><br/>';
        echo $datosBancarios[1];
        echo '<div class="clearfix"></div>';
        echo $contacto[1];
        echo '<div class="clearfix"></div><br/>';
        echo '<a href="sesion.php?op=pedidos" class="btn btn-success"><i class="fa fa-list"></i> Ver mis pedidos</a>';
        echo '<div class="clearfix"></div><br/>';
        $user         = $_SESSION["user"]["id"];
        $contaCarrito = count($_SESSION["carrito"]);
        $precioFinal  = 0;
        $carroFinal   = '';

        $sql       = "UPDATE `pedidos` SET `tipo_pedidos`=1,`estado_pedidos`=0 WHERE `cod_pedidos`= '$cod'";
        $resultado = mysqli_query($con, $sql);

        break;
        case 2:
        $cupon        = isset($_GET["collection_id"]) ? $_GET["collection_id"] : '';
        $status       = isset($_GET["collection_status"]) ? $_GET["collection_status"] : '';
        $payment_type = isset($_GET["payment_type"]) ? $_GET["payment_type"] : '';

        if ($status == "approved") {
            $estado     = "1";
            $estadoPago = "aprobado";
            $alert      = "alert alert-success";
        } elseif ($status == "pending") {
            $estado     = "0";
            $estadoPago = "pendiente";
            $alert      = "alert alert-warning";
        } elseif ($status == "rejected") {
            $estado     = "2";
            $estadoPago = "rechazado";
            $alert      = "alert alert-danger";
        }

        $descripcion = "Cupón de mercadopago: " . $cupon . " / ";
        $descripcion .= "Estado del pago: " . $estadoPago . " / ";
        $descripcion .= "Tipo de pago: " . $payment_type . " / ";

        $_SESSION["carritoFinal"] .= '</table><hr><b>Datos del pago:</b><br/><span style="font-size:12px">' . $descripcion . "</span>";

        echo "<div class='mb-10 " . $alert . " btn-block'><b>¡Excelente, finalizaste tu carrito!.</b> Tu pago se encuentra en estado: <b>$estadoPago</b>.</div>";
        echo '<table class="table table-hovered table-bordered" style="text-align:left;width:100%;font-size:13px !important"><thead><th>Productos</th><th>Cantidad</th><th>Precio unidad</th><th>Precio total</th></thead>';
        echo $_SESSION["carritoFinal"];
        echo '<div class="clearfix"></div><br/>';
        echo $contacto[1];
        echo '<div class="clearfix"></div><br/>';
        echo '<a href="sesion.php?op=pedidos" class="btn btn-success"><i class="fa fa-list"></i> Ver mis pedidos</a>';
        echo '<div class="clearfix"></div><br/>';
        $user = $_SESSION["user"]["id"];

        $contaCarrito = count($_SESSION["carrito"]);
        $precioFinal  = 0;
        $carroFinal   = '';

        $sql       = "UPDATE `pedidos` SET `tipo_pedidos`=2,`estado_pedidos`='$estado' WHERE `cod_pedidos`= '$cod'";
        $resultado = mysqli_query($con, $sql);

        break;
        case 3:
        $_SESSION["carritoFinal"] .= '</table><hr><b>Datos del pago:</b><br/><span style="font-size:12px">De Contado en Sucursal</span>';

        echo "<div class='mb-10 alert alert-success btn-block'><b>¡Excelente, finalizaste tu carrito!.</b> <br/>A continuación vas a ver nuestros datos y también te llegará un correo para que te comuniques con nosotros.</div>";
        echo '<table class="table table-hovered table-bordered" style="text-align:left;width:100%;font-size:13px !important"><thead><th>Productos</th><th>Cantidad</th><th>Precio unidad</th><th>Precio total</th></thead>';
        echo $_SESSION["carritoFinal"];
        echo '<div class="clearfix"></div><br/>';
        echo $contacto[1];
        echo '<div class="clearfix"></div><br/>';
        echo '<a href="sesion.php?op=pedidos" class="btn btn-success"><i class="fa fa-list"></i> Ver mis pedidos</a>';
        echo '<div class="clearfix"></div><br/>';
        $user = $_SESSION["user"]["id"];

        $contaCarrito = count($_SESSION["carrito"]);
        $precioFinal  = 0;
        $carroFinal   = '';

        $sql       = "UPDATE `pedidos` SET `tipo_pedidos`=3,`estado_pedidos`=0 WHERE `cod_pedidos`= '$cod'";
        $resultado = mysqli_query($con, $sql);

        break;
    }

    if ($carrito != '') {
        $asuntoUsuario = $_SESSION["user"]["nombre"] . " gracias por tu nueva compra";
        $asunto        = "Nueva compra de productos";
        $receptor      = "mhaspert@delyar.com.ar";
        $emailUsuario  = $_SESSION["user"]["email"];

        $mensaje = 'Nuevo pedido de productos <br/>';
        $mensaje .= '<table border="1" style="text-align:left;width:100%;font-size:13px !important"><thead><th>Productos</th><th>Cantidad</th><th>Precio unidad</th><th>Precio total</th></thead>';
        $mensaje .= $_SESSION["carritoFinal"];
        $mensaje .= '</table>';
        $mensaje .= '<br/><hr/>';
        $mensaje .= '<br/><b>Datos del usuario:</b><br/>';
        $mensaje .= "<b>Nombre y apellido</b>: " . $_SESSION["user"]["nombre"] . "<br/>";
        $mensaje .= "<b>Email</b>: " . $_SESSION["user"]["email"] . "<br/>";
        $mensaje .= "<b>Provincia</b>: " . $_SESSION["user"]["provincia"] . "<br/>";
        $mensaje .= "<b>Localidad</b>: " . $_SESSION["user"]["localidad"] . "<br/>";
        $mensaje .= "<b>Domicilio</b>: " . $_SESSION["user"]["direccion"] . "<br/>";
        $mensaje .= "<b>Teléfono</b>: " . $_SESSION["user"]["telefono"] . "<br/>";

        $mensajeUsuario = 'Gracias por tu compra<br/><hr/>';
        $mensajeUsuario .= '<table border="1" style="text-align:left;width:100%;font-size:13px !important"><thead><th>Productos</th><th>Cantidad</th><th>Precio unidad</th><th>Precio total</th></thead>';
        $mensajeUsuario .= $_SESSION["carritoFinal"];
        $mensajeUsuario .= '</table>';
        $mensajeUsuario .= '<br/><hr/>';
        if($pago == 1) {
            $mensajeUsuario .= '<b>Datos bancarios para realizar tu pago:</b><br/>';
            $mensajeUsuario .= $datosBancarios[1]."<br/>";
        }
        $mensajeUsuario .= "<br><i><b>Muchas gracias por tu compra, en el transcurso de las 24 hs un representante se estará comunicando con vos.</b></i>";

        Enviar_User_Admin($asunto, $mensaje, $receptor);
        Enviar_User($asuntoUsuario, $mensajeUsuario, $emailUsuario);

        unset($_SESSION["carrito"]);
        unset($_SESSION["carritoFinal"]);
        unset($_SESSION["precioFinal"]);
    }
    ?>

</div>
</div>
<?php include "inc/footer.inc.php";?>
</body>
</html>
<?php
@ob_end_flush();
?>
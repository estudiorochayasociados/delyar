<?php
$descuentoSacar        = isset($_GET["descuento"]) ? $_GET["descuento"] : '';
$_SESSION["envioTipo"] = isset($_SESSION["envioTipo"]) ? $_SESSION["envioTipo"] : '';
$_SESSION["envio"]     = isset($_SESSION["envio"]) ? $_SESSION["envio"] : '';
$displockEnvio         = "block";
if (empty($_SESSION["carrito"])) {
    headerMove(BASE_URL . "/productos");
}

$codPedido = substr(md5(uniqid(rand())), 0, 15);
$finalizar = isset($_GET["finalizar"]) ? $_GET["finalizar"] : '';
$pago      = isset($_GET["pago"]) ? $_GET["pago"] : '';

$asunto   = "Nueva compra de productos desde la web";
$receptor = EMAIL;
//$emailUsuario = $_SESSION["user"]["email"];
$asuntoUsuario  = "¡Gracias por tu compra!";
$bancos         = Contenido_TraerPorId("bancos");
$datosBancarios = $bancos[1];
$error          = 0;
?>

<div>
    <h3 class="mb-20 mt-0"> Carrito de compra</h3>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <th>Nombre producto</th>
        <th>Cantidad</th>
        <th>Precio unidad</th>
        <th>Precio total</th>
        <th></th>
    </thead>
    <?php

$eliminar = isset($_GET["eliminar"]) ? $_GET["eliminar"] : '';
if ($eliminar != '') {
    unset($_SESSION["carrito"][$eliminar]);
    $_SESSION["envioTipo"] = '';
    $_SESSION["envio"]     = '';
    headerMove(BASE_URL . "/carrito");
}

$contaCarrito = count($_SESSION["carrito"]);
end($_SESSION["carrito"]);
$contaCarrito    = key($_SESSION["carrito"]);
$precioFinal     = 0;
$carroFinal      = '';
$codigoDescuento = isset($_SESSION["codigoDescuento"]) ? $_SESSION["codigoDescuento"] : '';

for ($i = 0; $i <= $contaCarrito; $i++) {
    if (isset($_SESSION["carrito"][$i])) {
        @$carrito     = explode("|", $_SESSION["carrito"][$i]);
        $dataProducto = Portfolio_TraerPorCod($carrito[0]);
        //var_dump($_SESSION["carrito"][$i]);
        $pesoProducto = $dataProducto["peso_producto"];
        @$peso += $pesoProducto * $carrito[1];
        $moneda = "ARS";
        $precio = ($dataProducto["precio".$_SESSION["user"]["lista"]."_producto"]);
        $precio = number_format($precio, 2, '.', '');

        $precioTotal = $precio * $carrito[1];
        $precioTotal = number_format($precioTotal, 2, '.', '');
        $precioFinal = $precioFinal + $precioTotal;
        $precioFinal = number_format($precioFinal, 2, '.', '');
        $carroFinal .= "<tr><td>" . $dataProducto["descripcion_producto"] . "</td><td>" . $carrito[1] . "</td><td>$" . $precio . "</td><td>$" . $precioTotal . "</td></tr>";
        ?>

            <td>
                <a href="producto.php?id=<?php echo $dataProducto["id_producto"] ?>"><?php echo $dataProducto["descripcion_producto"] ?></a>
            </td>
            <td>
                <?php echo $carrito[1] ?>
            </td>
            <td>
                <?php echo "$" . $precio ?>
            </td>
            <td>
                <?php echo "$" . $precioTotal ?>
            </td>
            <td>
                <a href="carrito.php?eliminar=<?php echo $i ?>"><i class="fa fa-close"></i></a>
            </td>
        </tr>
        <?php
}
}

$precioEnvio = '';

if ($peso <= 1) {
    $precioEnvioDomicilio = Precio_Envio(1, "dom");
    $precioEnvioSucursal  = Precio_Envio(1, "suc");
} elseif ($peso <= 3) {
    $precioEnvioDomicilio = Precio_Envio(3, "dom");
    $precioEnvioSucursal  = Precio_Envio(3, "suc");
} elseif ($peso <= 5) {
    $precioEnvioDomicilio = Precio_Envio(5, "dom");
    $precioEnvioSucursal  = Precio_Envio(5, "suc");
} elseif ($peso <= 10) {
    $precioEnvioDomicilio = Precio_Envio(10, "dom");
    $precioEnvioSucursal  = Precio_Envio(10, "suc");
} elseif ($peso <= 15) {
    $precioEnvioDomicilio = Precio_Envio(15, "dom");
    $precioEnvioSucursal  = Precio_Envio(15, "suc");
} elseif ($peso <= 20) {
    $precioEnvioDomicilio = Precio_Envio(20, "dom");
    $precioEnvioSucursal  = Precio_Envio(20, "suc");
} elseif ($peso <= 30) {
    $precioEnvioDomicilio = Precio_Envio(30, "dom");
    $precioEnvioSucursal  = Precio_Envio(30, "suc");
}

$ivaTotal    = 0;
$precioFinal = $ivaTotal + $precioFinal;

if (isset($_POST["envio"])) {
    $envioExplotado         = explode("|", $_POST["envio"]);
    $envioFinal             = $envioExplotado[0];
    @$_SESSION["envioTipo"] = $envioExplotado[1];
    @$_SESSION["envio"]     = $envioFinal;
    $displockEnvio          = "none";
}

if (isset($_SESSION["descuento"])) {
    if ($_SESSION["descuento"] != '') {
        if ($precioFinal <= $_SESSION["descuento"]["minimo"]) {
            $descuento             = 0;
            $_SESSION["descuento"] = '';
            header("location:sesion.php?op=ver-carrito");
        }
    }
}

if ($peso <= 30) {?>
  <div id="formEnvio" class="alert alert-warning animated fadeIn"
  style="display: <?php echo $displockEnvio ?>">
  <b>Elegí el tipo de envío para tus productos:  </b><i style="float:right;font-size:12px">* Seleccionar la mejor opción y presionar Finalizar Carrito</i><br/>
  <form method="post">
    <select name="envio" class="form-control" id="envio" onchange="this.form.submit()">
        <option value="" selected disabled>Elegir envío</option>
        <!--<option value="<?php echo $precioEnvioSucursal ?>|Correo Argentino a Sucursal <?php echo $peso ?>kg" <?php if (isset($_POST["envio"])) {if ($_POST["envio"] == $precioEnvioSucursal) {echo "selected";}}?>>
            Correo Argentino a Sucursal $<?php echo $precioEnvioSucursal ?>
        </option>
        <option value="<?php echo $precioEnvioDomicilio ?>|Correo Argentino a Domicilio <?php echo $peso ?>kg" <?php if (isset($_POST["envio"])) {if ($_POST["envio"] == $precioEnvioDomicilio) {echo "selected";}}?>>
            Correo Argentino a Domicilio $<?php echo $precioEnvioDomicilio ?>
        </option> -->
        <option value="0|Retiro en Sucursal San Francisco" <?php if (isset($_POST["envio"])) {if ($_POST["envio"] == "0|Retiro en Sucursal San Francisco") {echo "selected";}}?>>
            Retiro en Sucursal San Francisco
        </option>
        <option value="0|Coordinar con el vendedor" <?php if (isset($_POST["envio"])) {if ($_POST["envio"] == "0|Coordinar con el vendedor") {echo "selected";}}?>>
            Coordinar con el vendedor
        </option>
    </select>
</form>
</div>
<?php
} else {
    @$_SESSION["envioTipo"] = "Envío especial por cuenta del cliente";
    @$_SESSION["envio"]     = "0";
    ?>
    <div id="formEnvio" class="alert alert-danger animated fadeIn">
        Tu pedido necesita ENVÍO ESPECIAL, debemos contactarnos con un transporte que pueda realizar tu envío.
    </div>
    <?php
}
?>

<?php
if (!is_numeric($_SESSION["envio"])) {
    $error = 1;
}

if ($descuentoSacar == 1) {
    $_SESSION["descuento"] = '';
    $descuento             = 0;
    headerMove(BASE_URL . "/carrito");
}

if (isset($_SESSION["descuento"])) {
    if ($_SESSION["descuento"] != '') {
        if ($precioFinal <= $_SESSION["descuento"]["minimo"]) {
            $descuento             = 0;
            $_SESSION["descuento"] = '';
            headerMove(BASE_URL . "/carrito");
        }
    }
}

?>

<?php
if (@isset($_SESSION["descuento"])) {
    if (@$_SESSION["descuento"]["descuento"] != '') {
        echo "<tr>";
        if ($_SESSION["descuento"]["tipo"] == 0) {
            $descuento = (($precioFinal * $_SESSION["descuento"]["descuento"]) / 100);
            echo "<td><b>Descuento: " . $_SESSION["descuento"]["codigo"] . " - " . $_SESSION["descuento"]["descuento"] . "% de descuento</b></td><td></td>";
            echo "<td></td>";
            echo "<td>$" . $descuento . "</td>";
        } else {
            $descuento = ($precioFinal - $_SESSION["descuento"]["descuento"]);
            echo "<td><b>Descuento: " . $_SESSION["descuento"]["codigo"] . " - $" . $_SESSION["descuento"]["descuento"] . " de descuento</b></td><td></td>";
            echo "<td></td>";
            echo "<td>$" . $descuento . "</td>";
        }
        echo '<td><a href="' . BASE_URL . '/carrito&descuento=1" data-toggle="tooltip" title="Borrar Descuento"><i class="fa fa-close"></i></a></td></tr>';
    } else {
        $descuento = 0;
    }
} else {
    $descuento = 0;
}
?>

<tr>
    <td><b>Tipo de envío: <?php echo $_SESSION["envioTipo"]; ?></b></td>
    <td></td>
    <td></td>
    <td>
        <?php
if (isset($_SESSION["envio"])) {
    if ($_SESSION["envio"] != '') {
        if ($_SESSION["envio"] === 0) {
            echo "Gratis";
        } else {
            echo "$" . $_SESSION["envio"];
        }
    }
}
?>
 </td>
 <td><a href="#" onclick="$('#formEnvio').show()"><i class="fa fa-refresh"></i></a></td>
</tr>

<tr>
    <td><b>Precio Final Total</b></td>
    <td></td>
    <td></td>
    <td id="precioFinalFinal"><b>$<?php echo @(($precioFinal - $descuento) + $_SESSION["envio"]); ?></b></td>
    <td></td>
</tr>
</table>

<?php
$displayCodigo = 'block';

if (isset($_POST["btn_codigo"])) {
    $codigo = isset($_POST["codigoDescuento"]) ? $_POST["codigoDescuento"] : '';
    if ($codigo != '') {
        $dataCodigo = Buscar_Codigo_Descuento($codigo);
        if ($dataCodigo[0] != '') {
            if ($precioFinal >= $dataCodigo["minimo"]) {
                $_SESSION["descuento"] = $dataCodigo;
                if ($dataCodigo["tipo"] == 0) {
                    ?>
             <span class="alert alert-success" style="display: block">¡Excelente! tenes un<?echo $dataCodigo["descuento"] ?>% de descuento en tus compras.</span>
             <div class="clearfix"></div>
             <?php
headerMove(BASE_URL . "/carrito");
                } else {
                    ?>
             <span class="alert alert-success" style="display: block">¡Excelente! tenes un descuento de $<?echo $dataCodigo["descuento"] ?> pesos en tus compras.</span>
             <div class="clearfix"></div>
             <?php
headerMove(BASE_URL . "/carrito");
                }
            } else {
                ?><span class="alert alert-danger" style="display: block">Lo sentimos este cupón es para compras mayores a $<?echo $dataCodigo["minimo"] ?> pesos en tus compras.</span><?php
}
        }
    }
}
?>
<?php
if (@!isset($_SESSION["descuento"]) || $_SESSION["descuento"] == '') {
    if (@$_SESSION["descuento"]["codigo"] == '') {
        ?>
    <form method="post" class="row" style="display: none">
        <div class="col-md-6 text-right">
            <p style="margin-top: 7px"><b>¿Tenés algún código de descuento para tus compras?</b></p>
        </div>
        <div class="col-md-4">
            <input type="text" name="codigoDescuento" class="form-control" placeholder="CÓDIGO DE DESCUENTO">
        </div>
        <div class="col-md-2">
            <input type="submit" value="USAR CÓDIGO" name="btn_codigo" class="btn btn-info" />
        </div>
    </form>
    <?php
}
}
?>

<a href="<?php echo BASE_URL ?>/productos" class="btn btn-info pull-left hidden-xs hidden-sm">
    <i class="fa fa-shopping-cart"></i> Seguir comprando
</a>
<a href="<?php echo BASE_URL ?>/checkout/crear-usuario" class="btn btn-success pull-right"<?php if ($error == 1) {echo 'data-toggle="tooltip" alt="ELEGÍ TU FORMA DE ENVÍOS" title="ELEGÍ TU FORMA DE ENVÍOS" disabled onclick="return false;"';}?>>
    <i class="fa fa-check"></i> Proceder a pagar tu carrito
</a>

<?php
$precioFinal              = @(($precioFinal - $descuento) + $_SESSION["envio"]);
$_SESSION["precioFinal"]  = number_format($precioFinal, 2, '.', '');
$_SESSION["carritoFinal"] = $carroFinal;
if (@isset($_SESSION["descuento"])) {
    if (@$_SESSION["descuento"]["descuento"] != '') {
        $_SESSION["carritoFinal"] .= "<tr>";
        if ($_SESSION["descuento"]["tipo"] == 0) {
            $_SESSION["carritoFinal"] .= "<td><b>Descuento: " . $_SESSION["descuento"]["codigo"] . " - " . $_SESSION["descuento"]["descuento"] . "% de descuento</b></td><td></td>";
            $_SESSION["carritoFinal"] .= "<td></td>";
            $_SESSION["carritoFinal"] .= "<td>$" . $descuento . "</td>";
        } else {
            $_SESSION["carritoFinal"] .= "<td><b>Descuento: " . $_SESSION["descuento"]["codigo"] . " - $" . $_SESSION["descuento"]["descuento"] . " de descuento</b></td><td></td>";
            $_SESSION["carritoFinal"] .= "<td></td>";
            $_SESSION["carritoFinal"] .= "<td>$" . $descuento . "</td>";
        }
        $_SESSION["carritoFinal"] .= '</tr>';
    } else {
        $descuento = 0;
    }
} else {
    $descuento = 0;
}
$_SESSION["carritoFinal"] .= "<tr><td><b>" . $_SESSION["envioTipo"] . "</b></td><td></td><td></td><td><b>$" . $_SESSION["envio"] . "</b></td></tr>";
$_SESSION["carritoFinal"] .= "<tr><td><b>Precio Final Total</b></td><td></td><td></td><td><b>$$precioFinal</b></td></tr>";
?>


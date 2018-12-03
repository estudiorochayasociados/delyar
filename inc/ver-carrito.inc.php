<?php
$_SESSION["envioTipo"] = isset($_SESSION["envioTipo"]) ? $_SESSION["envioTipo"] : '';
$_SESSION["envio"]     = isset($_SESSION["envio"]) ? $_SESSION["envio"] : '';

$codPedido = substr(md5(uniqid(rand())), 0, 15);
$finalizar = isset($_GET["finalizar"]) ? $_GET["finalizar"] : '';
$pago      = isset($_GET["pago"]) ? $_GET["pago"] : '';

if (empty($_SESSION["carrito"])) {
    headerMove(BASE_URL . "/productos");
}

if (!is_numeric($_SESSION["envio"])) {
    $error = 1;    
    $displockEnvio = "block";
}  else {
    $error = 0;
    $displockEnvio = "none";
} 

?>

<div>
    <h3 class="mb-20 mt-0"> Tu pedido online</h3>
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

    for ($i = 0; $i <= $contaCarrito; $i++) {
        if (isset($_SESSION["carrito"][$i])) {
            @$carrito     = explode("|", $_SESSION["carrito"][$i]);
            $dataProducto = Portfolio_TraerPorCod($carrito[0]);
            $moneda = "ARS";
            $precio = ($dataProducto["precio".$_SESSION["user"]["lista"]."_producto"]);
            $precio = number_format($precio, 2, '.', '');
            $precioTotal = $precio * $carrito[1];
            $precioTotal = number_format($precioTotal, 2, '.', '');
            $precioFinal = $precioFinal + $precioTotal;
            $precioFinal = number_format($precioFinal, 2, '.', '');
            $carroFinal .= "<tr><td>"."(".$dataProducto["cod_producto"].") ".$dataProducto["patron_producto"]." - ".$dataProducto["marca_producto"] . "</td><td>" . $carrito[1] . "</td><td>$" . $precio . "</td><td>$" . $precioTotal . "</td></tr>";
            ?>

            <td>
                <a href="<?= BASE_URL ?>/producto.php?id=<?php echo $dataProducto["id_producto"] ?>"><?php echo "(".$dataProducto["cod_producto"].") ".$dataProducto["patron_producto"]." - ".$dataProducto["marca_producto"] ?></a>
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
                <a href="<?= BASE_URL ?>/carrito.php?eliminar=<?php echo $i ?>"><i class="fa fa-close"></i></a>
            </td>
        </tr>
        <?php
    }
}


$ivaTotal    = 0;
$precioFinal = $ivaTotal + $precioFinal;

if (isset($_POST["envioProducto"])) {
    $envioExplotado         = explode("|", $_POST["envioProducto"]);
    $envioFinal             = $envioExplotado[0];
    $_SESSION["envioTipo"] = $envioExplotado[1];
    $_SESSION["envio"]     = $envioFinal;
    $displockEnvio          = "none";
    headerMove(BASE_URL."/carrito");
}
?>

<div id="formEnvio" class="alert alert-warning animated fadeIn" style="display: <?php echo $displockEnvio ?>">
    <b>Elegí el tipo de envío para tus productos:  </b><i style="float:right;font-size:12px">* Seleccionar la mejor opción y presionar Finalizar Carrito</i><br/>
    <form method="post">
        <select name="envioProducto" class="form-control" id="envio" onchange="this.form.submit()">
            <option value="" selected disabled>Elegir envío</option>
            <option value="0|Retiro en Sucursal San Francisco" <?php if (isset($_POST["envio"])) {if ($_POST["envio"] == "0|Retiro en Sucursal San Francisco") {echo "selected";}}?>>
                Retiro en Sucursal San Francisco
            </option>
            <option value="0|Coordinar con el vendedor" <?php if (isset($_POST["envio"])) {if ($_POST["envio"] == "0|Coordinar con el vendedor") {echo "selected";}}?>>
                Coordinar con el vendedor
            </option>
        </select>
    </form>
</div> 


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

<a href="<?php echo BASE_URL ?>/productos" class="btn btn-info pull-left hidden-xs hidden-sm">
    <i class="fa fa-shopping-cart"></i> Seguir comprando
</a>
<a href="<?php echo BASE_URL ?>/checkout/crear-usuario" class="btn btn-success pull-right"<?php if ($error == 1) {echo ' data-toggle="tooltip" alt="ELEGÍ TU FORMA DE ENVÍOS" title="ELEGÍ TU FORMA DE ENVÍOS" onclick="alert(\'Debes seleccionar una forma de envío \');$(\'#formEnvio\').addClass(\'alert-danger\');return false;"';}?>>
    <i class="fa fa-check"></i> Proceder a pagar tu carrito
</a>

<?php
$precioFinal              = @(($precioFinal - $descuento) + $_SESSION["envio"]);
$_SESSION["precioFinal"]  = number_format($precioFinal, 2, '.', '');
$_SESSION["carritoFinal"] = $carroFinal;
$_SESSION["carritoFinal"] .= "<tr><td><b>" . $_SESSION["envioTipo"] . "</b></td><td></td><td></td><td><b>$" . $_SESSION["envio"] . "</b></td></tr>";
$_SESSION["carritoFinal"] .= "<tr><td><b>Precio Final Total</b></td><td></td><td></td><td><b>$$precioFinal</b></td></tr>";
?>


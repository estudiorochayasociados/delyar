<div class="clear">
	&zwnj;
</div>
<div class="large-12 columns">
	<h3>Pedidos</h3>
	<hr/>
	<?php
	$est = isset($_GET["est"]) ? $_GET["est"] : '0';
	$act = isset($_GET["act"]) ? $_GET["act"] : '';
	$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';
	?>
	<ul class="button-group right">		
		<li>
			<a href="index.php?op=verPedidos&est=1" class="<?php
			if ($est == 1) {echo "active";
			} else {echo "button";
			}
			?>" style="padding:10px;margin-right:2px" >FINALIZADAS</a>
		</li>
		<li>
			<a href="index.php?op=verPedidos&est=0" class="<?php
			if ($est == 0) {echo "active";
			} else {echo "button";
			}
			?>" style="padding:10px;margin-right:2px" >PENDIENTES</a>
		</li>
	</ul>
	<div class="clearfix">
		&zwnj;
	</div>

	<dl class="accordion" data-accordion="">
		<?php
		switch ($est) {
			case 1 :
				Pedidos_Read_Admin(1);
				break;
			case 2 :
				Pedidos_Read_Admin(2);
				break;
			case 3 :
				Pedidos_Read_Admin(3);
				break;
			case 0 :
				Pedidos_Read_Admin(0);
				break;
			default :
				Pedidos_Read_Admin(2);
				break;
		}
		?>
	</dl>

	<?php
	if ($act != '') {
		Actualizar_Estado($act, 1);
		header("location: index.php?op=verPedidos");
	}

	if (isset($_POST["enviar"])) {
		if($_POST["cod"] != '' && $_POST["presupuesto"] != '') {
		$costo = 	$_POST['presupuesto'];
		$cod = 	$_POST['cod'];
		$sql = "UPDATE pedidos
				SET	costo_pedido = '$costo ',
				estado_pedido = '1'
				WHERE cod_pedido = '$cod'";
		$link = Conectarse();
		$r = mysql_query($sql, $link);
		header("location: index.php?op=verPedidos&est=0");
		}
	}

	if ($borrar != '') {
		$sql = "DELETE FROM `pedidos` WHERE `cod_pedido` = '$borrar'";
		$link = Conectarse();
		$r = mysql_query($sql, $link);
		header("location: index.php?op=verPedidos&est=$est");
	}
	?>
</div>

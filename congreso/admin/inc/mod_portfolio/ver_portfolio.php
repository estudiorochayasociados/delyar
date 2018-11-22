<div class="large-12 columns">
	<h4>Galería</h4>
	<hr/>
	<div class="tabs-content">
		<div class="content active" id="panel2-1">
			<table>
				<thead>
					<th width="100%">Título</th>
					<th>Ajustes</th>
				</thead>
				<tbody>
					<?php
					Portfolio_Read();
					$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';

					if ($borrar != '') {
						$sql = "DELETE FROM `portfolio` WHERE `id_portfolio` = '$borrar'";
						$link = Conectarse();
						$r = mysql_query($sql, $link);
						header("location: index.php?op=verPortfolio");
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>


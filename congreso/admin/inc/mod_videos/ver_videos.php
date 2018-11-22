<div class="clear">
	&zwnj;
</div>

<div class="large-12 columns">
	<br/>
	<h4>Videos</h4>
	<hr/>
	<div class="tabs-content">
		<div class="content active" id="panel2-1">
			<table  >
				<thead >
					<th width="100%">Titulo</th>
					<th>Ajustes</th>
				</thead>
				<tbody>
					<?php
					Videos_Read();
					$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';

					if ($borrar != '') {
						$sql = "DELETE FROM `videos` WHERE `IdVideos` = '$borrar'";
						$link = Conectarse();
						$r = mysql_query($sql, $link);
						header("location: index.php?op=verVideos");
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>


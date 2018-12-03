<?php
$error = 0;
$query = '';
$con = Conectarse();

$headerTabla = "<thead><th>Articulo</th><th>Producto</th><th>Descripcion</th><th>Precio Selecto</th><th>Precio Lista</th><th>Marca</th><th>Categoria</th><th>Subcategoria</th></thead>";
$columnaImagen = 0;
$columnaDescripcion = 1;
$maximoColumnas = "H";
?>
<div class="col-md-12">
	<form action="index.php?op=importarProductos" method="post" enctype="multipart/form-data">
		<h3>Importar productos de Excel a la Web (<a href="uploads/modelo.xlsx" target="_blank">descargar modelo</a>)</h3>
		<hr/>
		<div class="row">
			<div class="col-md-6">
				<input type="file" name="uploadFile" class="form-control" value="" /><br/>
			</div>
			<div class="col-md-6">
				<input type="submit" name="submit" value="Ver archivo de Excel"  class='btn  btn-info' />
			</div>
		</div>
	</form>
	<?php
	if(isset($_POST['submit'])) {
		if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'] != "") {
			$allowedExtensions = array("xls","xlsx");
			$ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
			if(in_array($ext, $allowedExtensions)) {
				$file_size = $_FILES['uploadFile']['size'] / 1024;
				$file = "uploads/".$_FILES['uploadFile']['name'];
				$isUploaded = copy($_FILES['uploadFile']['tmp_name'], $file);
				if($isUploaded) {
					include("Classes/PHPExcel/IOFactory.php");
					try {
						$objPHPExcel = PHPExcel_IOFactory::load($file);
					} catch (Exception $e) {
						die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
					}		
					$sheet = $objPHPExcel->getSheet(0);
					$total_rows = $sheet->getHighestRow();
					$highest_column = $sheet->getHighestColumn();	

					if($highest_column != $maximoColumnas) {
						echo 'Error en el formato del excel, hay más de las columnas permitidas';
						$error = 1;
					}	

					if($error == 0) {
						echo "<form method='post'><input type='submit' class='btn  btn-success' name='subir' value='Ya lo revisé solo queda guardar'></form>";
					} else  {
						echo "hay algun error para poder subir";
					}		

					echo "<hr/>Total de Productos: ".($total_rows-1);

					echo '<h4>Datos traídos del excel:</h4>';
					echo '<table cellpadding="5" cellspacing="1"   class=" table table-hover table-bordered responsive">';
					echo $headerTabla;
					//Artículo	Descripción	Moneda	Pr.s/iva	Pr.c/iva	Línea	Rubro

					$query = "insert into `productos` (`cod_producto`, `patron_producto`, `descripcion_producto`, `precio0_producto`, `precio1_producto`,`marca_producto`, `categoria_producto`, `subcategoria_producto`) VALUES ";
					$i=0;
					for($row =0; $row <= $total_rows; $row++) {									 
						$single_row = $sheet->rangeToArray('A' . $row . ':' . $highest_column . $row, NULL, TRUE, FALSE);
						if ($single_row[0][2]!= '' && $single_row[0][1]!= '' && $single_row[0][3]!= '') {
							echo "<tr>";		
							$query .= "(";						
							foreach($single_row[0] as $key=>$value) {
								echo "<td>".$value."</td>";
								$query .= "'".mysqli_real_escape_string($con, trim($value))."',";	
							}
							$query = substr($query, 0, -1);
							$query .= "),";
							echo "</tr>";
							$i++;
						}
					}
					$query = substr($query, 0, -1);
					echo '</table>';
					var_dump($query);
					unlink($file);		
					$_SESSION["query"] = $query;			
				} else {
					echo '<span class="alert alert-danger">Archivo no subido</span>';
				}					 
			} else {
				echo '<span class="alert alert-danger">El tipo de archivo no es aceptado</span>';
			}
		} else {
			echo '<span class="alert alert-danger">Seleccionar primero el archivo a subir.</span>';
		}
	}


	if(isset($_POST["subir"])) {
		if(!empty($_SESSION["query"])) {
			mysqli_query($con, "truncate productos");
			mysqli_query($con, $_SESSION["query"]);
			if(mysqli_affected_rows($con) > 0) {
				echo '<span class="alert alert-success">Base de dato actualizada!</span>';
			} else {
				echo '<span class="alert alert-danger">No se pudo subir la base de datos.</span>';
			}
		} 
	}
	?>
</div>
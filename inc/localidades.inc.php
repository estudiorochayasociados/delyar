<?php
include "../admin/dal/data.php";
$connId  = Conectarse();
$palabra = ($_GET["elegido"]);
$sql     = "
SELECT  distinct `_provincias`.`nombre`,`_localidades`.`nombre`
FROM  `_localidades` , `_provincias`
WHERE  `_localidades`.`provincia_id` =  `_provincias`.`id`
AND `_provincias`.`nombre`  LIKE '%$palabra%'
AND `_localidades`.`nombre` != ''
ORDER BY `_localidades`.`nombre` ASC
";

$resultado = mysqli_query($connId, $sql);
while ($row = mysqli_fetch_array($resultado)) {
    echo strtoupper($row["nombre"]) . ";";

}

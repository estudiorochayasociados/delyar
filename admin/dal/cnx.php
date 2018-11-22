<?php
define("TITULO", "DELYAR");
define("BASE_URL_ANTERIOR", "http://192.168.0.14:8888//delyar/site");
define("BASE_URL", "http://" . $_SERVER['HTTP_HOST'] . "/delyar/site");
define("TELEFONOS", "+54-3564-423407");
define("WHATSAPP", "0"); /**/
define("EMAIL", "web@estudiorochayasoc.com.ar");
define("DIRECCION", "Colón 1150 - X2400ISX - Ciudad de San Francisco - Provincia de Córdoba - República Argentina");
define("LOGO", BASE_URL . "/img/logo.png");
define("PASS_EMAIL", "weAr2010");
define("SMTP_EMAIL", "mail.estudiorochayasoc.com.ar");
define("PUERTO_EMAIL", "587");
define("APP_ID_FACEBOOK", "687357508322489");
define("META_POSITION", "");
define("META_COPY", "2018");
define("META_PLACE", "");
define("META_PAIS", "ARGENTINA");
define("CANONICAL", $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"]);
define("USUARIO_DB", "root");
define("PASS_DB", "");
define("BASE_DB", "delyar_site");

function Conectarse()
{
    $connId = mysqli_connect("localhost", USUARIO_DB, PASS_DB, BASE_DB) or die("Error en el server" . mysqli_error($connId));
    mysqli_set_charset($connId, 'utf8');
    return $connId;
}

function Conectarse_Mysqli()
{
    $connId = mysqli_connect("localhost", USUARIO_DB, PASS_DB, BASE_DB) or die("Error en el server" . mysqli_error($connId));
    mysqli_set_charset($connId, 'utf8');
    return $connId;
}

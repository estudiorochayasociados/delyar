<?php
ob_start();
session_start();
include("admin/dal/data.php");
include("PHPMailer/class.phpmailer.php");
$op = isset($_GET["op"]) ? $_GET["op"] : '';
if ($op != '') {
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $data = Usuario_TraerPorEmail($email);
    if ($data) {
        echo "<span class='alert alert-success btn-block'>Excelente, te enviamos a tu correo la contraseña que habías utilizado.</span>";
        Enviar_User("Recuperar contraseña","Hola <b>".$data['nombre']."</b>.<br/>La contraseña que habías elegido para tu cuenta era <b>".$data['pass']."</b>.<br/> En caso de seguir con problemas para acceder a tu cuenta te recomendamos llamar a los números que tiene al pie del correo electrónico.",$email);
    } else {
        echo "<div class='alert alert-danger'>No existe este usuario.</div>";
    }
} else {
    ?>
    <div id="resultado">
    </div>
    <form method="post" id="formAjax" onsubmit="ajaxPost('<?php echo BASE_URL ?>/olvidar-contrasena.php?op=1');">
        Escribinos tu correo electrónico:<br/>
        <input type="email" name="email" class="form-control" required />
        <input type="submit" name="olvidasteBoton" class="btn btn-success mt-20" value="Recuperar mi contraseña">
    </form>
    <?php
}
?> 
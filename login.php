<?php
$usuario_correcto = "admin";
$contrasenia_correcta = "1234";

$usuario = $_POST["usuario"];
$contrasenia = $_POST["contrasenia"];
# Luego de haber obtenido los valores, ya podemos comprobar:
if ($usuario === $usuario_correcto && $contrasenia === $contrasenia_correcta) {
    session_start();
    $_SESSION["usuario"] = $usuario;
    header("Location:home.php");
} else {
    header("Location:index.php");
}
?>
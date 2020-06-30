<?php
require_once ("../conexion/db.php");
require_once ("../conexion/conexion.php");

$fecha = $_POST["fecha"];
$cuenta = $_POST["cuenta"];
$beneficiario = $_POST["beneficiario"];
$concepto = $_POST["concepto"];
$forma_pago = $_POST["forma_pago"];
$obs = $_POST["obs"];
$n_cheque = $_POST["n_cheque"];
$importe = $_POST["importe"];
 
$sql = "INSERT INTO orden (fecha, cuenta, beneficiario, concepto, forma_pago, obs, n_cheque, importe) VALUES ('$fecha','$cuenta', '$beneficiario', '$concepto', '$forma_pago', '$obs', '$n_cheque', '$importe')";
if ($conn->query($sql) === TRUE) {
	header("Location:../home.php");
} else {
	echo "Error: " . $sql . "<br>" . $conn->error; //Redireccion de la página
}
$conn->close();
?>
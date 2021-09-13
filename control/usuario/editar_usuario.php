<?php
include("../../modelo/usuario.php");

$id_usuario = $_POST[id_usuario];
$correo = $_POST[correo];
$cuenta = utf8_decode($_POST[cuenta]);
$password = utf8_decode($_POST[password]);

$nombre_ap = utf8_decode($_POST[nombre_ap]);

$fecha_actualizacion = date("Y-m-d H:i:s");

$nivel = $_POST[nivel];

$usuario = new usuario();
$result = $usuario->modificar_usuario($id_usuario, $correo, $cuenta, $nombre_ap, $password, $nivel, $fecha_actualizacion);

if($result){
    echo "Datos actualizados.";
}else{
    echo "Ocuri&oacute; un Error.";
}
?>
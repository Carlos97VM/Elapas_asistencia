<?php
include("../../modelo/usuario.php");

$correo = $_POST[correo];
$cuenta = utf8_decode($_POST[cuenta]);
$password = md5(utf8_decode($_POST[password]));

$nombre_ap = utf8_decode($_POST[nombre_ap]);

$fecha_registro = date("Y-m-d H:i:s");
$fecha_actualizacion = date("Y-m-d H:i:s");
$fecha_ultimo_ingreso = '';
$ip_actual = '';
$ip_ultimo = '';
$estado_usuario = 1;
$nivel = $_POST[nivel];

$usuario = new usuario();
$result = $usuario->registrar_usuario($correo, $cuenta, $nombre_ap, $password, $nivel, $fecha_registro, $fecha_actualizacion, $fecha_ultimo_ingreso, $ip_actual, $ip_ultimo, $estado_usuario);

if($result)
{
    echo "Datos registrados.";
}
else
{
    echo "Ocuri&oacute; un Error. El usuario ya existe.";
}

?>
<?php 
include("../../modelo/marcaciones_zktECO_continuo.php");
$asistencia_reloj = new asistencia_reloj();

$id_marcaciones=$_POST['id_marcaciones'];
$fecha_personal=$_POST['fecha_personal'];
$hora_personal=$_POST['hora_personal'];

$result = $asistencia_reloj ->modificar_asistencia_zktECO($id_marcaciones, $fecha_personal, $hora_personal);
if($result)
{
    echo "Datos actualizados correctamente";
}
else
{
    echo "Error...";
}
?>
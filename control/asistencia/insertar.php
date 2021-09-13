<?php 
include("../../modelo/activos.php");
$activo = new activo();

$iactivo=$_POST['iactivo'];
$nombre=$_POST['nombre'];
$detalle=$_POST['detalle'];
$coston=$_POST['coston'];
$ubicacionn=$_POST['ubicacionn'];
$custodio=$_POST['custodio'];
$custodion=$_POST['custodion'];
$tipobienn=$_POST['tipobienn'];
$fechaalta=$_POST['fechaalta'];
$fechabaja=$_POST['fechabaja'];

$result = $activo ->registrar_activo($iactivo, $nombre, $detalle, $coston, $ubicacionn, $custodio,$custodion,$tipobienn,$fechaalta,$fechabaja);
if($result)
{
    echo "Datos insertados correctamente";
}
else
{
    echo "Error...";
}
?>
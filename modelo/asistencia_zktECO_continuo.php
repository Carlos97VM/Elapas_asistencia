<?php
if(!class_exists("conexion"))
	include ("conexion.php");
class asistencia_zktECO
{
	public $numero;
	public $nombre;
	public $tiempo;
	public $estado;
	public $dispositivo;
	public $tipo_registro;
	private $bd;

	function asistencia_zktECO()
	{
		$this->bd = new conexion();
	}
	function registrar_asistencia_zktECO($nombre, $tiempo, $estado, $dispositivo, $tipo_registro)
	{
		$registros = $this->bd->Consulta("insert into bruto_zktECO_continuo values('','$nombre','$tiempo', '$estado', '$dispositivo', '$tipo_registro')");
		if($this->bd->numFila_afectada()>0)
			return true;
		else
			return false;
	}
	
	function modificar_asistencia_zktECO($numero,$nombre, $tiempo, $estado, $dispositivo, $tipo_registro)
	{
		$registros = $this->bd->Consulta("update bruto_zktECO_continuo set nombre='$nombre', tiempo='$tiempo', estado='$estado', dispositivo='$dispositivo', tipo_registro='$tipo_registro' where numero=$numero");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
	
	function eliminar($numero)
	{
		$registros = $this->bd->Consulta("delete from bruto_zktECO_continuo where numero=$numero ");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
	function get_asistencia_zktECO()
	{
		$registros = $this->bd->Consulta("select * from bruto_zktECO_continuo");
		$registro = $this->bd->getFila($registros);

		$this->numero = $registro[numero];
		$this->nombre = $registro[nombre];
		$this->tiempo = $registro[tiempo];
		$this->estado = $registro[estado];
		$this->dispositivo = $registro[dispositivo];
		$this->tipo_registro = $registro[tipo_registro];
	}
	function get_all($criterio)
	{
		if(empty($criterio)) $where = ""; else $where = " $criterio";
		$registros = $this->bd->Lista("select * from bruto_zktECO_continuo $where");
			return $registros;
	}
	function __destroy()
	{
		$registros = $this->bd->Cerrar();
	}
}
 
?>
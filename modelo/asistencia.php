<?php
if(!class_exists("conexion"))
	include ("conexion.php");
class asistencia
{
	public $id_asistencia;
	public $departamento_asistencia;
	public $nombre_asistencia;
	public $carnet_asistencia;
	public $fecha_hora_asistencia;
	public $locacion_id_asistencia;
	public $id_numero_asistencia;
	public $verificaCod_asistencia;
	public $nro_tarjeta_asistencia;
	private $bd;

	function asistencia()
	{
		$this->bd = new conexion();
	}
	function registrar_asistencia($departamento_asistencia, $nombre_asistencia, $carnet_asistencia, $fecha_hora_asistencia, $locacion_id_asistencia, $id_numero_asistencia,$verificaCod_asistencia,$nro_tarjeta_asistencia)
	{
		$registros = $this->bd->Consulta("insert into asistencia values('','$departamento_asistencia','$nombre_asistencia', '$carnet_asistencia', '$fecha_hora_asistencia', '$locacion_id_asistencia', '$id_numero_asistencia','$verificaCod_asistencia','$nro_tarjeta_asistencia')");
		if($this->bd->numFila_afectada()>0)
			return true;
		else
			return false;
	}
	
	function modificar_asistencia($id_asistencia,$departamento_asistencia, $nombre_asistencia, $carnet_asistencia, $fecha_hora_asistencia, $locacion_id_asistencia, $id_numero_asistencia,$verificaCod_asistencia,$nro_tarjeta_asistencia)
	{
		$registros = $this->bd->Consulta("update asistencia set departamento_asistencia='$departamento_asistencia', nombre_asistencia='$nombre_asistencia', carnet_asistencia='$carnet_asistencia', fecha_hora_asistencia='$fecha_hora_asistencia', locacion_id_asistencia='$locacion_id_asistencia', id_numero_asistencia='$id_numero_asistencia',verificaCod_asistencia='$verificaCod_asistencia', nro_tarjeta_asistencia='$nro_tarjeta_asistencia' where id_asistencia=$id_asistencia");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
	
	function eliminar($id_asistencia)
	{
		$registros = $this->bd->Consulta("delete from asistencia where id_asistencia=$id_asistencia ");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
	function get_asistencia($id_asistencia)
	{
		$registros = $this->bd->Consulta("select * from asistencia where id_asistencia=$id_asistencia");
		$registro = $this->bd->getFila($registros);

		$this->id_asistencia = $registro[id_asistencia];
		$this->departamento_asistencia = $registro[departamento_asistencia];
		$this->nombre_asistencia = $registro[nombre_asistencia];
		$this->carnet_asistencia = $registro[carnet_asistencia];
		$this->fecha_hora_asistencia = $registro[fecha_hora_asistencia];
		$this->locacion_id_asistencia = $registro[locacion_id_asistencia];
		$this->id_numero_asistencia = $registro[id_numero_asistencia];
		$this->verificaCod_asistencia = $registro[verificaCod_asistencia];
		$this->nro_tarjeta_asistencia = $registro[nro_tarjeta_asistencia];
	}
	function get_all($criterio)
	{
		if(empty($criterio)) $where = ""; else $where = " $criterio";
		$registros = $this->bd->Lista("select * from asistencia $where");
			return $registros;
	}
	function __destroy()
	{
		$registros = $this->bd->Cerrar();
	}
}
 
?>
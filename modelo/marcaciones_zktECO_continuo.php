<?php
if(!class_exists("conexion"))
	include ("conexion.php");
class asistencia_reloj
{
    public $id_asistencia;
	public $numero;
	public $nombre;
	public $fecha_personal;
	public $hora_personal;
	public $asistencia;
	public $estado;
	private $bd;

	function asistencia_reloj()
	{
		$this->bd = new conexion();
	}
	function registrar_asistencia_reloj($numero, $nombre, $fecha_personal, $hora_personal, $estado)
	{
		// $registros = $this->bd->Consulta("insert into asistencia_reloj values '',".implode(",", $asistencia));
		
		$registros = $this->bd->Consulta("insert into marcaciones_zakteco_continuo values('', '$numero', '$nombre', '$fecha_personal', '$hora_personal', '$estado')");
		if($this->bd->numFila_afectada()>0)
			return true;
		else
			return false;
	}
	
	function modificar_asistencia_zktECO($id_marcaciones, $fecha_personal, $hora_personal)
	{
		$registros = $this->bd->Consulta("update marcaciones_zakteco_continuo set fecha_personal='$fecha_personal', hora_personal='$hora_personal' where id_asistencia='$id_asistencia'");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
	
	function eliminar($id_asistencia)
	{
		$registros = $this->bd->Consulta("delete from marcaciones_zakteco_continuo where id_asistencia=$id_asistencia ");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
	function get_asistencia_reloj($id)
	{
		$registros = $this->bd->Consulta("select * from marcaciones_zakteco_continuo where id_asistencia = $id");
		$registro = $this->bd->getFila($registros);

		$this->id_asistencia  = $registro[$id_asistencia];
		$this->numero         = $registro[numero];
        $this->nombre         = $registro[nombre];
		$this->fecha_personal = $registro[fecha_personal];
		$this->hora_personal  = $registro[hora_personal];
	}
	function get_all($criterio)
	{
		if(empty($criterio)) $where = ""; else $where = " $criterio";
		$registros = $this->bd->Lista("select * from marcaciones_zakteco_continuo $where");
			return $registros;
	}
	function __destroy()
	{
		$registros = $this->bd->Cerrar();
	}
}
 
?>
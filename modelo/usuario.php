<?php
if(!class_exists("conexion"))
	include ("conexion.php");
class usuario
{
	public $id_usuario;
	public $cuenta;
	public $password;
	public $fecha_ultimo_ingreso;
	public $nivel;
	public $estado_usuario;
	public $id_trabajador;
	private $bd;

	function usuario()
	{
		$this->bd = new Conexion();
	}
	function registrar_usuario($cuenta, $password, $fecha_ultimo_ingreso, $nivel, $estado_usuario, $id_trabajador)
	{
		$registros = $this->bd->Consulta("insert into usuario values('','$cuenta', '$password', '$fecha_ultimo_ingreso', '$nivel','$estado_usuario', '$id_trabajador')");
		if($this->bd->numFila_afectada()>0)
			return true;
		else
			return false;
	}
	function modificar_usuario($id_usuario, $cuenta, $password, $nivel, $fecha_ultimo_ingreso)
	{
	   if(empty($password))
            $registros = $this->bd->Consulta("update usuario set fecha_ultimo_ingreso='$fecha_ultimo_ingreso', nivel='$nivel' where id_usuario=$id_usuario");
       else        
            $registros = $this->bd->Consulta("update usuario set password=md5('$password'), fecha_ultimo_ingreso='$fecha_ultimo_ingreso', nivel='$nivel' where id_usuario=$id_usuario");
        
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
	function get_usuario($id_usuario)
	{
		$registros = $this->bd->Consulta("select * from usuario where id_usuario=$id_usuario");
		$registro = $this->bd->getFila($registros);

		$this->id_usuario = $registro[id_usuario];
		$this->cuenta = $registro[cuenta];
		$this->password = $registro[password];
		$this->fecha_ultimo_ingreso = $registro[fecha_ultimo_ingreso];
		$this->nivel = $registro[nivel];
		$this->estado_usuario = $registro[estado_usuario];
	}
	function get_all($criterio)
	{
		if(empty($criterio)) $where = ""; else $where = " where $criterio";
		$registros = $this->bd->Lista("select * from usuario $where");
			return $registros;
	}    
    function bloquear($id_usuario)
	{
		$registros = $this->bd->Consulta("update usuario set estado_usuario=0 where id_usuario=$id_usuario");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
    function habilitar($id_usuario)
	{
		$registros = $this->bd->Consulta("update usuario set estado_usuario=1 where id_usuario=$id_usuario");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}
    function eliminar($id_usuario)
	{
		$registros = $this->bd->Consulta("delete from usuario where id_usuario=$id_usuario");
		if($this->bd->numFila_afectada($registros)>0)
			return true;
		else
			return false;
	}    
	function __destroy()
	{
		$registros = $this->bd->Cerrar();
	}
}
 
?>
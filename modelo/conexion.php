<?php
    class conexion
    {
        private $servidor = 'localhost';
        private $base_datos = 'bd_asistencia';
        private $usuario = 'root';
        private $password = '';
        private $enlace;
        
        function conexion()
        {            
            date_default_timezone_set("America/La_Paz");
            $this->Conectar();            
        }
        //
        function Conectar()
        {
            $this->enlace = mysql_connect($this->servidor,$this->usuario,$this->password);
            if($this->enlace)//si existe enlace
            {
                if(mysql_select_db($this->base_datos))//selecion la base de datos
                    return $this->enlace;
                else
                    return false;
            }
            else
                return false;
        }
        //Este metodo ejecuta una consulta sql
        function Consulta($sql)        
        {
            return mysql_query($sql,$this->enlace);
        }
        //Este metodo recorre fila por fila devolviendo los datos como vector 
        function getFila($datos)
        {
            return mysql_fetch_array($datos);
        }
        //
        function getFilaObject($datos)
        {
            return mysql_fetch_object($datos);
        }
        //fcuncion pa obtener el numero de resultados de una consulta
        function numFila($datos)
        {
            return mysql_num_rows($datos);        
        }
        //cuando se usa una consulta de tipo update o delete se verifica el num de filas afectadas
        function numFila_afectada()
        {
            return mysql_affected_rows($this->enlace);            
        }
        //
        function Lista($sql)
        {
        	$result = mysql_query($sql,$this->enlace);
        	$tmp_array = array();
        	$return_array=array();
            if($result)			
        	while ($obj = mysql_fetch_object($result)) {
        		foreach($obj as $key => $value) {				
        			$tmp_array[$key]=$value;								
        		} 
        		$return_array[]=$tmp_array;
        	}		
        	return $return_array;
        }
        //
        function Cerrar()
        {
            mysql_close($this->enlace);
        }
                    
    }        
        
?>
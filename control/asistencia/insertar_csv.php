<?php
require_once("conexion2.php");

	$ruta = 'archivos/';	
    if(!file_exists($ruta))
        mkdir($ruta);
		foreach ($_FILES as $key) {

			$nombre=$key["name"];
			$ruta_temporal=$key["tmp_name"];		
			
			$fecha=getdate();
			$nombre_v=$fecha["mday"]."-".$fecha["mon"]."-".$fecha["year"]."_".$fecha["hours"]."-".$fecha["minutes"]."-".$fecha["seconds"].".csv";		
	
			$destino=$ruta.$nombre_v;
			$explo=explode(".",$nombre);
	
	
			if($explo[1] != "csv"){
				$alert=1;
			}else{
	
				if(move_uploaded_file($ruta_temporal, $destino)){
					$alert=2;
				}
	
			}
	
		}

	$x=0;
	$data=array();
	$fichero=fopen($destino, "r");

	while(($datos= fgetcsv($fichero,1000)) != FALSE){
		if($x>1)
		{
			$data[]='('.$datos[0].',"'.$datos[1].'","'.$datos[2].'","'.$datos[3].'","'.$datos[4].'",'.$datos[5].','.$datos[6].',"'.$datos[7].'",'.$datos[8].')';
		}
		$x++;

	}
	$Elimina="delete from asistencia";
	$result2= mysql_query($Elimina);
	$inserta="insert into asistencia values ".implode(",", $data);
	$result= mysql_query($inserta);
    if($result2)
    {
		if($result)
		{
			echo '<script>alert("Datos importados Correctamente")</script>';
			fclose($fichero);
		}
		echo '<script>alert("Importando Datos!")</script>';
    }
    else
    {
        echo '<script>alert("ERROR")</script>';
    }
?>
<meta http-equiv="Refresh" content="0;url=http://localhost:8080/Elapas/asistencia/?mod=rrhh&pag=insertar_archivo_csv">
<!-- Definir la ruta de retorno  segun el servidor -->
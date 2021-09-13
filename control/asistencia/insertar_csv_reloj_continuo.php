<?php
	require_once("conexion2.php");
	ini_set('memory_limit','1024M');
	require_once('../../modelo/conexion.php'); 
	require_once('../../modelo/asistencia_zktECO_continuo.php');
	$slash = "/";
	$guion = "-";
	$bd = new Conexion();

	$antecedentes = $bd -> Consulta("SELECT * FROM bruto_zktECO_continuo");
	if($bd->numFila($antecedentes) == 0)
	{
		$ruta = 'archivos/';	
		if(!file_exists($ruta))
        mkdir($ruta);
		foreach ($_FILES as $key) 
		{

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

		while(($datos= fgetcsv($fichero,1000)) != FALSE)
		{
			$x++;
			if($x>1)
			{
				$data[]='('.$datos[0].',"'.$datos[1].'","'.$datos[2].'","'.$datos[3].'","'.$datos[4].'","'.$datos[5].'")';
			}

		}
		$refinado          = array();
		$informacion_bruto = array();
		$array_bruto       = array();
		$comparativa       = array();
		$array_asistencia  = array();
		$inhasistencia     = array();
		$inserta="INSERT INTO bruto_zkteco_continuo values ".implode(",", $data);
		$result= mysql_query($inserta);

		if($result)
		{
			$consultados = $bd -> Consulta("SELECT * FROM bruto_zktECO_continuo");
			while($consult = $bd -> getFila($consultados))
			{
				$fecha_en_bruto = str_replace($slash, $guion, (substr($consult[2],0,strpos($consult[2],' '))));
				$fecha_bruto = date_create($fecha_en_bruto);
				// $formato_fecha = ;

				array_push($refinado, '('.($consult[0]).',"'.($consult[1]).'","'.date_format($fecha_bruto, 'Y-m-d').'","'.(substr($consult[2],(strpos($consult[2],' ')+1))).'","'.$consult[3].'","'.$consult[4].'","'.$consult[5].'")');
				$con++;
			}
			$insertados="INSERT INTO zkteco_continuo values ".implode(",", $refinado);
			$result2 = mysql_query($insertados);
			if($result2)
			{
				$lll = 0;
				$historico_consultas = $bd -> Consulta("SELECT * FROM zkteco_continuo");
				while($a = $bd -> getFila($historico_consultas))
				//while($lll < sizeof($refinado))
				{
					// DICCIONARIO
					$informacion_bruto = array(
						"numero"         => $a[numero_continuo],
						"nombre"         => $a[nombre_continuo],
						"fecha"          => $a[fecha_continuo],
						"hora"           => $a[hora_continuo],
						"estado"         => $a[estado_continuo],
						"dispositivo"    => $a[dispositivo_continuo],
						"registro"       => $a[tipo_registro_continuo]);
						array_push($array_bruto, $informacion_bruto);
					// ARRAY NORMAL
					// $numero         = $a[numero_continuo];
					// $nombre         = $a[nombre_continuo];
					// $fecha_personal = $a[fecha_continuo];
					// $hora_personal  = $a[hora_continuo];
					// $estado         = $a[estado_continuo];
					// $dispositivo    = $a[dispositivo_continuo];
					// $registro       = $a[tipo_registro_continuo];
					// array_push($historico, ('('.'""'.',"'.$numero.'","'.$nombre.'","'.$fecha_personal.'","'.$hora_personal.'","'.$estado.'","'.$dispositivo.'","'.$registro.'")'));
					// array_push($historico, (''.$refinado[$lll]));
					// $lll;
				}
				$array_fechas = array();
				$agrupacion_fechas = $bd -> Consulta("SELECT fecha_continuo FROM `zkteco_continuo` group by fecha_continuo");
				while($agrup_fechas = $bd -> getFila($agrupacion_fechas))
				{
					array_push($array_fechas, $agrup_fechas[0]);
				}
				// array de almacenamiento de trabajadores que asistienron 
				$k = 0;
				while($k < sizeof($array_bruto)) // 13-7-2021
				{
					$fecha_verificacion = $array_fechas[$k];
					$verificacion_asistenci = $bd -> Consulta("SELECT *
					FROM zkteco_continuo
					WHERE fecha_continuo = '$fecha_verificacion'
					AND numero_continuo
					IN (SELECT ci FROM trabajador t INNER JOIN zkteco_continuo b ON b.numero_continuo = t.ci)");
					while($verifi_asistencia = $bd -> getFila($verificacion_asistenci))
					{
						array_push($array_asistencia, '('.'""'.',"'.$verifi_asistencia[numero_continuo].'","'.$verifi_asistencia[nombre_continuo].'","'.$verifi_asistencia[fecha_continuo].'","'.$verifi_asistencia[hora_continuo].'","'.$verifi_asistencia[estado_continuo].'","'.$verifi_asistencia[dispositivo_continuo].'","'.$verifi_asistencia[tipo_registro_continuo].'")');
					}
					$k++;
				}
				// Array de almacenamiento de trabajadores que no Asistieron
				$m = 0;
				while($m < sizeof($array_fechas))
				{
					$fecha_verificacion = $array_fechas[$m];
					$verificacion_ci = $bd -> Consulta("SELECT ci, nombres
					from trabajador where  ci NOT IN(SELECT numero_continuo FROM zkteco_continuo where fecha_continuo = '$fecha_verificacion')");
					while($verifi_ci = $bd -> getFila($verificacion_ci))
					{
						$numero_identidad    = $verifi_ci[ci];
						$nombre_identidad    = $verifi_ci[nombres];
						array_push($inhasistencia, '('.'""'.',"'.$numero_identidad.'","'.$nombre_identidad.'","'.$fecha_verificacion.'","'.'00:00:00'.'","'.'Falta'.'","'.'Ninguno'.'","'.'---------'.'")');
					}
					$m++;
				}
				$trab_asistencia="INSERT INTO marcaciones_zakteco_continuo values ".implode(",", $array_asistencia);
				$asistencia = mysql_query($trab_asistencia);
				if($asistencia)
				{
					$trab_inhasistencia = "INSERT INTO marcaciones_zakteco_continuo values ".implode(",", $inhasistencia);
					$inhasistencia = mysql_query($trab_inhasistencia);
					if($inhasistencia)
					{
						echo '<script>alert("Datos importados Correctamente")</script>';
						fclose($fichero);
					}
					else
					{
						echo '<script>alert("La generacion de asistencia a fallado")</script>';	
					}
				}
				else
				{
					echo '<script>alert("Registro de datos fallido")</script>';
				}
			}
			else
			{
				echo '<script>alert("Refinacion fallida")</script>';
			}
		}
		else
		{
			echo '<script>alert("ERROR")</script>';
		}
	}
	elseif($bd->numFila($antecedentes) == 1 || $bd->numFila($antecedentes) > 0)
	{
		// START BackUp
		$ruta = 'archivos/';	
		if(!file_exists($ruta))
			mkdir($ruta);
		foreach ($_FILES as $key) {

			$nombre=$key["name"];
			$ruta_temporal=$key["tmp_name"];		
			
			$fecha=getdate();
			$nombre_v="CSV ".$fecha["mday"]."-".$fecha["mon"]."-".$fecha["year"]."_".$fecha["hours"]."-".$fecha["minutes"]."-".$fecha["seconds"].".csv";		
	
			$destino=$ruta.$nombre_v;
			$explo=explode(".",$nombre);
			if($explo[1] != "csv")
			{
				$alert=1;
			}
			else
			{
				if(move_uploaded_file($ruta_temporal, $destino))
				{
					$alert=2;
				}
			}
		}
		// END BackUp
		$x=0;
		$data                   =array();
		$fichero                = fopen($destino, "r");
		$antiguo_continuo       = array();
		$antiguo_a              = array();
		$refinado_bruto         = array();
		$datos_brutos_refinados = array();
		$array_bruto            = array();
		$refinado_continuo      = array();
		$contador = 0;
		$z = 0;
		$data_a = array();
		
		while(($datos= fgetcsv($fichero,1000)) != FALSE){
			$x++;
			if($x>1)
			{
				$data[]='('.$datos[0].',"'.$datos[1].'","'.$datos[2].'","'.$datos[3].'","'.$datos[4].'","'.$datos[5].'"'.')';
			}
		}
		// Borramos lo ya registrado en la tabla bruto para leer de neuvo el CSV
		$borrado_bruto = $bd -> Consulta("DELETE FROM bruto_zktECO_continuo");
		if($b = $bd -> numFila_afectada($borrado_bruto) > 0 && $l = $bd -> numFila_afectada($borrado_continuo))
		{
			// Insercion de los nuevos datos del CSV
			$insertar_csv = "INSERT INTO bruto_zkteco_continuo VALUES ".implode(",", $data);
			$insert_csv = mysql_query($insertar_csv);
			if($insert_csv)
			{
				
				// Sacamos un diccionario con los datos ya registrados de la primera refinacion   
				$comparativa = $bd -> Consulta("SELECT * FROM zkteco_continuo");
				while($c = $bd -> getFila($comparativa))
				{
					$antiguo_continuo = array(
						"numero"      => $c[0],
						"nombre"      => $c[1],
						"fecha"       => $c[2],
						"hora"        => $c[3],
						"estado"      => $c[4],
						"dispositivo" => $c[5],
						"registro"    => $c[6]);
						array_push($refinado_continuo, $antiguo_continuo);
				}
				// Capturamos la fecha mas reciente
				$j = 0;
				$fecha_maxima = "0000-00-00";
				while($j < sizeof($refinado_continuo))
				{
					if($refinado_continuo[$j]["fecha"] > $fecha_maxima)
					{
						$fecha_maxima = $refinado_continuo[$j]["fecha"];
					}
					$j++;
				}
				// Convertir el Arreglo en Fecha tipo MySql
				// $date = date_create($fecha_maxima);
				// $formato_fecha_old = date_format($date, 'Y-m-d');
				// Armamos el diccionario con datos del CSV
				$registro_bruto_csv = $bd -> Consulta("SELECT * FROM bruto_zktECO_continuo");	
				while($v = $bd -> getFila($registro_bruto_csv))
				{
					$fecha_en_bruto_2 = str_replace($slash,$guion,substr($v[2],0,strpos($v[2],' ')));
					$fecha_bruto_2 = date_create($fecha_en_bruto_2);
					$antiguo_a = array(
						"numero"      => $v[0],
						"nombre"      => $v[1],
						"fecha"       => date_format($fecha_bruto_2, 'Y-m-d'),
						"hora"        => substr($v[2],(strpos($v[2],' ')+1)),
						"estado"      => $v[3],
						"dispositivo" => $v[4],
						"registro"    => $v[5]);
						array_push($refinado_bruto,$antiguo_a);
				}
				$consultados = $bd -> Consulta("SELECT * FROM bruto_zktECO_continuo");
				while($consult = $bd -> getFila($consultados))
				{
					$fecha_en_bruto_2 = str_replace($slash,$guion,substr($consult[2],0,strpos($consult[2],' ')));
					$fecha_bruto_2 = date_create($fecha_en_bruto_2);
					array_push($datos_brutos_refinados, '('.($consult[0]).',"'.($consult[1]).'","'.date_format($fecha_bruto_2, "Y-m-d").'","'.(substr($consult[2],(strpos($consult[2],' ')+1))).'","'.$consult[3].'","'.$consult[4].'","'.$consult[5].'")');
					$con++;
				}
				$insertar_datos_brutos = "INSERT INTO zkteco_continuo VALUES ".implode(",", $datos_brutos_refinados);
				$insert_refinado = mysql_query($insertar_datos_brutos);
				if($insert_refinado)
				{
					$array_fechas = array();
					$agrupacion_fechas = $bd -> Consulta("SELECT fecha_continuo FROM `zkteco_continuo` WHERE fecha_continuo > '$fecha_maxima' group by fecha_continuo");
					while($agrup_fechas = $bd -> getFila($agrupacion_fechas))
					{
						array_push($array_fechas, $agrup_fechas[0]);
					}
					// Nuevos datos mayores a la fecha mas reciente
					$nuevos_datos = array();
					// $i = 0;
					// while($i < sizeof($refinado_bruto))
					// {
						
					// 	if(strtotime($refinado_bruto[$i]["fecha"]) > strtotime($fecha_maxima))
					// 	{
					// 		array_push($nuevos_datos, $refinado_bruto[$i]);
					// 	}
					// 	$i++;
					// }
					// $tamanio_refinado = 0;
					// $array_refinado_bruto = array();
					// while($tamanio_refinado < sizeof($nuevos_datos))
					// {
					// 	array_push($array_refinado_bruto, '("'.$nuevos_datos[$tamanio_refinado]["numero"].'","'.$nuevos_datos[$tamanio_refinado]["nombre"].'","'.$nuevos_datos[$tamanio_refinado]["fecha"].'","'.$nuevos_datos[$tamanio_refinado]["hora"].'","'.$nuevos_datos[$tamanio_refinado]["estado"].'","'.$nuevos_datos[$tamanio_refinado]["dispositivo"].'","'.$nuevos_datos[$tamanio_refinado]["registro"].'")');
					// 	$tamanio_refinado++;
					// }
					$array_asistencia_2 = array();
					$k = 0;
					while($k < sizeof($datos_brutos_refinados)) // 13-7-2021
					{
						$fecha_verificacion = $array_fechas[$k];
						$verificacion_asistenci = $bd -> Consulta("SELECT *
						FROM zkteco_continuo
						WHERE fecha_continuo = '$fecha_verificacion'
						AND numero_continuo
						IN (SELECT ci FROM trabajador t INNER JOIN zkteco_continuo b ON b.numero_continuo = t.ci)");
						while($verifi_asistencia = $bd -> getFila($verificacion_asistenci))
						{
							array_push($array_asistencia_2, '('.'""'.',"'.$verifi_asistencia[numero_continuo].'","'.$verifi_asistencia[nombre_continuo].'","'.$verifi_asistencia[fecha_continuo].'","'.$verifi_asistencia[hora_continuo].'","'.$verifi_asistencia[estado_continuo].'","'.$verifi_asistencia[dispositivo_continuo].'","'.$verifi_asistencia[tipo_registro_continuo].'")');
						}
						$k++;
					}
					// Array de almacenamiento de trabajadores que no Asistieron
					$inhasistencia_2 = array();
					$m = 0;
					while($m < sizeof($array_fechas))
					{
						$fecha_verificacion = $array_fechas[$m];
						$verificacion_ci = $bd -> Consulta("SELECT ci, nombres
						from trabajador where  ci NOT IN(SELECT numero_continuo FROM zkteco_continuo where fecha_continuo = '$fecha_verificacion')");
						while($verifi_ci = $bd -> getFila($verificacion_ci))
						{
							$numero_identidad    = $verifi_ci[ci];
							$nombre_identidad    = $verifi_ci[nombres];
							array_push($inhasistencia_2, '('.'""'.',"'.$numero_identidad.'","'.$nombre_identidad.'","'.$fecha_verificacion.'","'.'00:00:00'.'","'.'Falta'.'","'.'Ninguno'.'","'.'---------'.'")');
						}
						$m++;
					}
					$insercion_inhasistencia = "INSERT INTO marcaciones_zakteco_continuo values ".implode(",", $inhasistencia_2);
					$c_inhasistencia = mysql_query($insercion_inhasistencia);
					if($c_inhasistencia)
					{
						$insercion_asistencia = "INSERT INTO marcaciones_zakteco_continuo values ".implode(",", $array_asistencia_2);
						$c_asistencia = mysql_query($insercion_asistencia);
						if($c_asistencia)
						{
							echo '<script>alert("Procesamiento exitoso!")</script>'; 
						}
						else
						{
							echo '<script>alert("Procesamiento de asistencia fallida!")</script>';
						}
					}
					else
					{
						echo '<script>alert("Procesamiento de faltas fallida!")</script>';
					}
				}
				else
				{
					echo '<script>alert("Procesamiento de datos fallida!")</script>';
				}
			}
			else
			{
				echo '<script>alert("Error al leer de archivo......")</script>';
			}
		}
		else
		{
			echo "Error...";
		}
}
?>
<meta http-equiv="Refresh" content="0;url=http://localhost:8080/Elapas/asistencia/?mod=rrhh&pag=insertar_archivo_reloj_csv_continuo">
<!-- Definir la ruta de retorno  segun el servidor -->
<?php
    require("../../modelo/conexion.php");
    require("../../modelo/funciones.php");
    require("../../modelo/marcaciones_zktECO_continuo.php");
    $bd = new conexion();
    $asistencia_reloj = new asistencia_reloj();
    $cuestionamiento = $bd -> Consulta("SELECT COUNT(*) total FROM marcaciones_zakteco_continuo");
    $cuestion = $bd -> getFila($cuestionamiento);
    $c = $cuestion[0];
    // Consulta sobre la existencia de datos en la base de datos
    if($c == 0)
    {
        // si no hay datos
        $datos = $bd -> Consulta("SELECT * FROM bruto_zktECO_continuo");
        $asistencia = array();
        while($dato = $bd -> getFila($datos))
        {
            $numero = $dato[0];
            $nombre = $dato[1];
            $fecha_personal = substr($dato[2],0,strpos($dato[2],' '));
            $hora_personal  = substr($dato[2],11);
            $estado = $dato[3];
            $result = $asistencia_reloj -> registrar_asistencia_reloj($numero, $nombre, $fecha_personal, $hora_personal, $estado);
        }
        if($result)
        {
            echo "Datos Registrados";
        }
        else
        {
            echo "Ocurrio un Error!.";
        }    
    }
    else
    {
        // si hay datos existentes
        $historico = array(); // datos existentes dentro la tabla refinada
        $antiguo   = array(); // datos existentes dentro la tabla bruta 
        $nuevo     = array(); // datos nuevos
        $asistencia_r = $bd -> Consulta("SELECT * FROM marcaciones_zakteco_continuo");
        $datos = $bd -> Consulta("SELECT * FROM bruto_zktECO_continuo");
        while($a = $bd -> getFila($asistencia_r))
        {
            $numero        = $a[numero];
            $nombre        = $a[nombre];
            $fecha_personal= $a[fecha_personal];
            $hora_personal = $a[hora_personal];
            $estado        = $a[estado];
            array_push($historico, ('('.''.','.$numero.',"'.$nombre.'","'.$fecha_personal.'","'.$hora_personal.'","'.$estado.'")'));
        }
        // print_r($historico);
        // echo "<br>";
        $asistencia_zxkECO = $bd -> Consulta("SELECT * FROM bruto_zktECO_continuo");
        while($info = $bd->getFila($asistencia_zxkECO))
        {
            array_push($antiguo,('('.''.','.($info[numero]).',"'.($info[nombre]).'","'.(substr($info[tiempo],0,strpos($info[tiempo],' '))).'","'.(substr($info[tiempo],11)).'","'.($info[estado]).'")'));
        }
        // print_r($antiguo);
        // echo "<br>";
        // refinacion de datos duplicados
        $k = 0;
        while($k < sizeof($antiguo))
        {
            $ll = 0;
            while($ll < sizeof($historico))
            {
                if($antiguo[$k] == $historico[$ll])
                {
                    
                    unset($antiguo[$k]);
                    $k++;
                }
                $ll++;
            }
            $k++;
        }
        $abc = 0;
        while($abc < sizeof($antiguo))
        {
            array_push($nuevo, $antiguo[$abc]);
            $abc++;
        }
        // echo "Nuevos datos de introduccion al sistema <br>";
        $n = 0;
        $numero = '';
        $nombre = '';
        $fecha_personal = '';
        $hora_personal = '';
        $estado = '';
        while($n < sizeof($nuevo))
        {
            // echo $nuevo[$n];
            $numero         = $nuevo[1];
            $nombre         = $nuevo[2];
            $fecha_personal = $nuevo[3];
            $hora_personal  = $nuevo[4];
            $estado         = $nuevo[5];
            // echo "<br> =>".$id."-".$numero."-".$nombre."-".$fecha_personal."-".$hora_personal."<br>";
            $result = $asistencia_reloj -> registrar_asistencia_reloj($numero, $nombre, $fecha_personal, $hora_personal, $estado);
            $n++;
        }
        // subir datos ala base de datos;
        if($result)
        {
            echo "Datos Registrados";
        }
        else
        {
            echo "No hay datos nuevos!.";
        }    
    }
?>
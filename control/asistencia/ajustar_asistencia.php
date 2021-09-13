<?php 
    require("../../modelo/conexion.php");
    require("../../modelo/asistencia_zktECO_continuo.php");
    require("../../modelo/funciones.php");
    $bd = new conexion();
    $fecha = "22/07/2021";
    $tiempo_hora = 8;
    $tiempo_minutos = 10;
    $res_hora = 0;
    $res_minutos = 0;
    $datos = $bd -> Consulta("SELECT * FROM bruto_zktECO_continuo");
    $empleados = $bd -> Consulta("SELECT * FROM marcaciones_zakteco_continuo WHERE fecha_personal = '$fecha' AND estado = 'Entrada' or 'ENTRADA'");
    while($empleado = $bd -> getFila($empleados))
    {
        $nombre = $empleado[nombre];
        $hora = date('H',strtotime($empleado[hora_personal]));
        $minuto = date('i', strtotime($empleado[hora_personal]));
        echo "Nombre ".$nombre."H: ".$hora." m: ".$minuto."<br>";
        if($hora >= $tiempo_hora)
        {
            if($minuto >= $tiempo_minutos)
            {
                $h = 0;
                while($h <= $hora)
                {
                    $res_hora = $h;
                    $h++;
                }
                $m = 0;
                while($m <= $minuto)
                {
                    $res_minutos = $m;
                    $m++;
                }
            }
        }
        echo "Nombre: ".$nombre." Retrasado por: Horas = ".$res_hora." y Minutos =".$res_minutos."<br>";
    }
?>
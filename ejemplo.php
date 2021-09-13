<?php 
	$origin   = '00:00:00';
    $fromTime = '10:30:00'; // $fromTime = date('H:i:s',strtotime($from_time))
    $toTime = '11:00:00';  //// $toTime= date('H:i:s',strtotime($to_time))
    $totalasignado='02:00:00';
    $diff = (strtotime($toTime) - strtotime($fromTime)) + strtotime($origin);
    $diferencia=date('H:i:s', $diff );
    $asig = (strtotime($totalasignado) - strtotime($diferencia)) + strtotime($origin);
    $a=date('H:i:s', $asig );
    if ($diferencia <= '02:00:00') {
    	echo "tiempo disponible : ".$a;
    }
    else{
    	echo 'sobrepaso el limite de tiempo disponible: '. $diferencia;
    }
    echo '<br>';
    $fecha= '2021-03-26';
    $num_dias=date('t', strtotime($fecha));
    echo "Numero de dias :". $num_dias;
    if ($X) {
    	# code...
    }
 ?>
<?php 
    include("modelo/asistencia_zktECO_continuo.php");
    
    $mes_1 = date("m");
    $cero = "0";
    $espacio = "";
    if($mes_1 < 10)
    {
        $mes = str_replace($cero, $espacio, $mes_1);
    }
    else
    {
        $mes = $mes_1;
    }
    $dia = date("d");
    $anio = date("Y");
    $fecha = $dia."-".$mes."-".$anio;
    $asistencia_zktECO = new asistencia_zktECO();
    $fecha_i = strtotime($fecha);
    $registros = $bd->Consulta("SELECT * from marcaciones_zakteco_continuo WHERE fecha_marcaciones = '$fecha'");    
?>
<h2>ACTIVOS ELAPAS <?php echo $fecha; ?>
   
    <a href="control/asistencia/ajustar_asistencia.php?fecha=<?php echo $fecha;?>" class="btn btn-danger btn-icon" style="float: right; margin-right: 5px;">
        Ajustar Asistencia<i class="entypo-print"></i>
    </a>

    <a href="control/asistencia/subir_base_de_datos.php" class='accion btn btn-orange btn-icon' style="float: right; margin-right: 5px;">
        Generar asistencia<i class="entypo-plus"></i>
    </a>
</h2>
<br />
<div class="table-responsive">
<table class="table table-bordered datatable" id="table-1">
    <thead>
    <tr>	
        <th>No</th>
        <th>Estado</th>
        <th>Carnet de <br>Identidad</th>
        <th>Nombre</th>
    	<th>Fecha</th>
        <th>Hora</th>
        <th width="90">Acciones</th>
	</tr>
   </thead>
   <tbody>    
   <?php
        $n = 0;
        while($registro = $bd->getFila($registros)) 
        {
            $n++;
            echo "<tr>";
            echo utf8_encode("<td>$n</td>
                <td>$registro[estado_marcaciones]</td>
                <td>$registro[numero_marcaciones]</td>
                <td>$registro[nombre_marcaciones]</td>
                <td>$registro[fecha_marcaciones]</td>
                <td>$registro[hora_marcaciones]</td>");
            echo "<td>";
            echo "<a href='?mod=rrhh&pag=editar_archivo_reloj_csv_continuo?id_marcaciones=$registro[id_marcaciones]' class='btn btn-green btn-icon'>Editar<i class='entypo-pencil'></i></a>";
            echo "</td>";
            echo "</tr>";
        }	
    ?>
    </tbody>
	<tfoot>  
        <tr>
            <th>No</th>
            <th>Estado</th>
            <th>Carnet de <br>Identidad</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th width="90">Acciones</th>

        </tr>                          		
	</tfoot>
</table>
</div>
                    
                    
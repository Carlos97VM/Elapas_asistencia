<?php 
    include("modelo/activos.php");
    $trabajador = security($_GET['trabajador']);
    $mod        = security($_GET['mod']);
    $pag        = security($_GET['pag']);
    $activo = new activo();
    $registros = $bd->Consulta("select * from qr_code where custodio = $trabajador");    
?>
<h2>ACTIVOS ELAPAS <?php echo date("Y") ?>
    <a href="?mod=activos&pag=form_activo" class="btn btn-green btn-icon" style="float: right; margin-right: 5px;">
    	INSERTAR ACTIVO <i class="entypo-plus"></i>
    </a>

    <a target="_blank" href="vista/reportes/visor_reporte.php?f=vista/activos/activos_pdf.php&custodio=<?php echo $trabajador; ?>" class="btn btn-danger btn-icon" style="float: right; margin-right: 5px;">
        GENERAR ETIQUETAS PDF<i class="entypo-print"></i>
    </a>

    <a target="_blank" href="vista/reportes/visor_reporte.php?f=vista/activos/PDF_lista_activos.php&custodio=<?php echo $trabajador; ?>" class="btn btn-danger btn-icon" style="float: right; margin-right: 5px;">
        GENERAR LISTA PDF<i class="entypo-print"></i>
    </a>
</h2>
<br />
<div class="table-responsive">
<table class="table table-bordered datatable" id="table-1">
    <thead>
    <tr>	
        <th>No</th>
        <th>Departamento</th>
    	<th>Nombre</th>
        <th>CI</th>
    	<th>Fecha y Hora</th>
    	<th>Locacion ID</th>
        <th>ID Numero</th>
        <th>Metodo de Verificacion</th>
        <th>Nro de Tarjeta</th>
        <th width="160">Acciones</th>
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
                            <td>$registro[departamento_asistencia]</td>
                            <td>$registro[nombre_asistencia]</td>
                            <td>$registro[carnet_asistencia]</td>
                            <td>$registro[fecha_hora_asistencia]</td>
                            <td>$registro[locacion_id_asistencia]</td>
                            <td>$registro[id_numero_asistencia]</td>
                            <td>$registro[verificaCod_asistencia]</td>
                            <td>$registro[nro_tarjeta_asistencia]</td>
                            <td>$registro[custodion]</td>");
            echo "<td>
            	    <a href='?mod=activos&pag=editar_activo&id=$registro[id_qr]' class='btn btn-info btn-icon btn-xs'>EDITAR ACTIVO<i class='entypo-pencil'></i></a>
                    <a href='control/activo/eliminar.php?id=$registro[id_qr]' class='accion btn btn-red btn-icon btn-xs'>ELIMINAR <i class='entypo-cancel'></i></a>
          		  </td>";
            echo "</tr>";
        }	
    ?>
    </tbody>
	<tfoot>  
        <tr>
            <th>No</th>
            <th>Departamento</th>
            <th>Nombre</th>
            <th>CI</th>
            <th>Fecha y Hora</th>
            <th>Locacion ID</th>
            <th>ID Numero</th>
            <th>Metodo de Verificacion</th>
            <th>Nro de Tarjeta</th>
            <th width="160">Acciones</th>
        </tr>                          		
	</tfoot>
</table>
</div>
                    
                    
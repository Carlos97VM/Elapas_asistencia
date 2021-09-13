<?php
	$anio = date("Y");
	include("modelo/activos.php");    
    $activo = new activo();
    $registros = $bd->Consulta("select * from qr_code group by custodion");    
?>
<h2>ACTIVOS <?php echo $anio; ?></h2>
  <br />
  <div class="panel panel-default panel-shadow" data-collapsed="0">
  	<div class="panel-heading">
  		<div class="panel-title">
			Consultar
  		</div>
  	</div>

	<div class="panel-body">

		<form name="frm_activos" id="frm_activos" action="?mod=activos&lista" method="GET" role="form" class="form-horizontal form-groups-bordered">
			<input type="hidden" name="mod" value="activos"/>
            <input type="hidden" name="pag" value="lista"/>
			<div class="form-group">
				<label for="trabajador" class="col-sm-3 control-label">TRABAJADOR</label>
                <div class="col-sm-3">
					<select name="trabajador" id="trabajador" class="form-control required select2">
					<option value="">----SELECCIONE--</option>
						<?php 
						while($registro = $bd->getFila($registros)) 
						{ 
							echo utf8_encode("<option value='$registro[custodio]'>$registro[custodion]</option>");
						}
						
						?>
					</select>
				</div>
				
				<div class="col-sm-2">
					<button type="submit" class="btn btn-info">Mostrar</button>
				</div>
			</div>
		</form>

	</div>

</div>






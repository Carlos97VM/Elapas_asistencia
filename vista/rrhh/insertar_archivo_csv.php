<?php 
$anio = date("Y");
$dir = 'archivos/';

    if(!file_exists($dir))
        mkdir($dir);?>
<h2>ACTIVOS <?php echo $anio; ?></h2>
  <br />
  <div class="panel panel-default panel-shadow" data-collapsed="0">
  	<div class="panel-heading">
  		<div class="panel-title">
          IMPORTAR REGISTROS DESDE ARCHIVO .CSV
  		</div>
  	</div>

	<div class="panel-body">

		<form name="frm_asistencia" id="frm_asistencia" action="control/asistencia/insertar_csv.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-groups-bordered">
			<input type="hidden" name="mod" value="activos"/>
            <input type="hidden" name="pag" value="lista"/>
			<div class="form-group">
				<label for="trabajador" class="col-sm-4 control-label">SELECCIONAR ARCHIVO</label>
                <div class="col-sm-4">
                    <input class="form-control" type="file" name="foto" id="foto">
				</div>
				
				<div class="col-sm-2">
					<button type="submit" class="btn btn-info">SUBIR</button>
				</div>
			</div>
		</form>

	</div>

</div>






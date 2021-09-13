
<?php

	include("modelo/activos.php");
    
    $id = security($_GET['id']);

    $activo = new activo();

    $activo->get_activo($id);

?>
<h2>EDITAR ACTIVO</h2>
<br/>
<div class="panel panel-default panel-shadow" data-collapsed="0">
	<div class="panel-heading">
		<div class="panel-title">
		ACTIVO
		</div>
	</div>
	<div class="panel-body">
		<form name="frm_activo" id="frm_activo" action="control/activo/editar.php" method="post" role="form" class="validate form-horizontal form-groups-bordered">
			<div class="form-group">
				<label for="iactivo" class="col-sm-2 control-label">Codigo del activo</label>
				<div class="col-sm-2">
					<input type="text" name="iactivo" id="iactivo" value='<?php echo $activo->iactivo; ?>' class="form-control required"/ readonly>
					<input type="hidden" name="id" id="id" value="<?php echo $id ?>"> 
				</div>
				<label for="nombre" class="col-sm-1 control-label">Nombre</label>
				<div class="col-sm-4">
					<input type="text" name="nombre" id="nombre" class="form-control required" value='<?php echo utf8_encode($activo->nombre); ?>'/>
				</div>
			</div>
			<div class="form-group">
				<label for="detalle" class="col-sm-2 control-label">Detalle del activo</label>
				<div class="col-sm-7">
					<input type="text" name="detalle" id="detalle" class="form-control required" value='<?php echo utf8_encode($activo->detalle); ?>'/>
				</div>
			</div>
			<div class="form-group">
				<label for="coston" class="col-sm-2 control-label">Unidad perteneciente</label>
				<div class="col-sm-7">
					<input type="text" name="coston" id="coston" class="form-control required text" value='<?php echo utf8_encode($activo->coston); ?>'/>
				</div>
			</div>
			<div class="form-group">
				<label for="ubicacionn" class="col-sm-2 control-label">Ubicacion del Activo</label>
				<div class="col-sm-7">
					<input type="text" name="ubicacionn" id="ubicacionn" class="form-control required" value='<?php echo utf8_encode($activo->ubicacionn); ?>'/>
				</div>
			</div>
			<div class="form-group">
				<label for="custodio" class="col-sm-2 control-label">Cedula del trabajor</label>
				<div class="col-sm-2">
					<input type="text" name="custodio" id="custodio" class="form-control required" value='<?php echo $activo->custodio; ?>' readonly/>
				</div>
				<label for="custodion" class="col-sm-1 control-label">Trabajador-Cargo</label>
				<div class="col-sm-4">
					<input type="text" name="custodion" id="custodion" class="form-control required" value='<?php echo utf8_encode($activo->custodion); ?>' readonly/>
				</div>
			</div>
			<div class="form-group">
				<label for="tipobienn" class="col-sm-2 control-label">Tipo de Bien</label>
				<div class="col-sm-7">
					<input type="text" name="tipobienn" id="tipobienn" class="form-control required" value='<?php echo utf8_encode($activo->tipobienn); ?>'/>
				</div>
			</div>
			<div class="form-group">
				<label for="fechaalta" class="col-sm-2 control-label">Fecha de Alta</label>
				<div class="col-sm-3">
					<input type="text" name="fechaalta" id="fechaalta" class="form-control required" value='<?php echo $activo->fechaalta; ?>'/>
				</div>
				<label for="fechabaja" class="col-sm-1 control-label">Fecha de Baja</label>
				<div class="col-sm-3">
					<input type="text" name="fechabaja" id="fechabaja" class="form-control required" value='<?php echo $activo->fechabaja; ?>'/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-3">
					<button type="submit" class="btn btn-info">GUARDAR</button> <button type="reset" class="btn btn-default cancelar">Cancelar</button>
				</div>
			</div>
		</form>
	</div>
</div>

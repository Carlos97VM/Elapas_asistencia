<?php
	include('conexion.php');
	require 'phpqrcode/qrlib.php';
	
	$dir = 'temp/';
	
	if(!file_exists($dir))
		mkdir($dir);
	$sql = "select * from qr_code where id_qr between 1 and 10";
	$result=$con->query($sql);
	$filename = $dir.'test.png';
	$filename2 = $dir.'test.png';


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ACTIVOS</title>
</head>
<style>
	.tamanio{
		font-size: 28px;
	}
	.imagen{
		width: 230px; height: 100px;
	}

	.button {
    background-color: red; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;

	/* otro form */
	
}
</style>
<body>
	<form action="REPORTE_PDF.php" method="POST">
	<label>PARTE DERECHA</label><br>
	<label>DEL: </label>
	<input type="number" name="rango1_derecha"><br><br>
	<label>AL: </label>
	<input type="number" name="rango2_derecha" ><br><br>
	<label>PARTE IZQUIERDA</label><br>
	<label>DEL: </label>
	<input type="number" name="rango1_izq"><br><br>
	<label>AL: </label>
	<input type="number" name="rango2_izq" ><br><br>
	<input type="submit"  name="crear" id="crear" value="GENERAR PDF">

	</form>
<br><br>
	
<div id="registration-form">
	<div class='fieldset'>
    <legend>Wanna be Cool?!</legend>
		<form action="#" method="post" data-validate="parsley">
			<div class='row'>
				<label for='firstname'>First Name</label>
				<input type="text" placeholder="First Name" name='firstname' id='firstname' data-required="true" data-error-message="Your First Name is required">
			</div>
			<div class='row'>
				<label for="email">E-mail</label>
				<input type="text" placeholder="E-mail"  name='email' data-required="true" data-type="email" data-error-message="Your E-mail is required">
			</div>
			<div class='row'>
				<label for="cemail">Confirm your E-mail</label>
				<input type="text" placeholder="Confirm your E-mail" name='cemail' data-required="true" data-error-message="Your E-mail must correspond">
			</div>
			<input type="submit" value="Register">
		</form>
	</div>
</div>
	
</body>
</html>

<?php
    include('conexion.php');
    require 'phpqrcode/qrlib.php';
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    $dir = 'temp/';
    // $_SESSION[rango_1]=$_GET[rango_1];
    // $_SESSION[rango_2]=$_GET[rango_2];
    if(!file_exists($dir))
        mkdir($dir);
    $sql = "SELECT * FROM `qr_code` WHERE id_qr between 1 and 10 ";
    $result=$con->query($sql);
    $sql1 = "SELECT * FROM `qr_code` WHERE id_qr between 11 and 20";
    $result1=$con->query($sql1);


    // 1/06/21
    // $sql = "SELECT * FROM `qr_code` WHERE id_qr between 2006 and 2097 ";
    // $sql1 = "SELECT * FROM `qr_code` WHERE id_qr between 2098 and 2187";


    $result=$con->query($sql);
    // $name = uniqid();
    // $filename = $dir.$name.'.png';
    $tamanio = 2;
    $level = 'H';
    $frameSize = 1;

?>

<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">


<style>
    .tamanio{
        font-size: 22px;
    }
    .tamanio2{
        font-size: 22px;
    }
    .letra_activo{
        font-size: 8px;
        margin: 0;
        padding: 0;
    }
    .imagen{
        margin: 2;
        width: 170px; height: 60px;
    }
    .imagen_qr{
        width: 100px; height: 100px;
    }
    table{
        border-collapse: collapse;
    }
</style>
<?php echo var_dump($_POST); ?>
<!-- <table border="1">
<?php

while($d=$result->fetch_assoc() and $d1=$result1->fetch_assoc() )
    {
        $name = $d['iactivo'];
        $filename = $dir.$name.'.png';
        
        // $contenido=$d['iactivo']." || ".$d['detalle']." || ".utf8_encode($d['ubicacionn'])." || ".$d['custodio']." || ".$d['custodion']." || ".$d['tipobienn'];
        // QRcode::png($contenido, $filename, $level, $tamanio, $frameSize);

        $name1 = $d1['iactivo'];
        $filename1 = $dir.$name1.'.png';
        
        // $contenido1=$d1['iactivo']." || ".$d1['detalle']." || ".utf8_encode($d1['ubicacionn'])." || ".$d1['custodio']." || ".$d1['custodion']." || ".$d1['tipobienn'];
        // QRcode::png($contenido1, $filename1, $level, $tamanio, $frameSize);
        ?>
        
        
            
                <tr>
                    <td>
                        <img class="imagen_qr" src="<?php echo $filename ?>">
                    </td>
                    <th style="text-align: center;" >
                        <span class="tamanio"><?php echo $d['iactivo']; ?></span><br>
                        <span class="letra_activo"><?php echo $d['nombre']; ?></span><br>
                        <img class="imagen" src="logo.png"><br><span>&nbsp;&nbsp;Recodificacion de activos: 2021&nbsp;</span>
                    </th>

                    <td>
                        <img class="imagen_qr" src="<?php echo $filename1 ?>">
                    </td>
                    <th style="text-align: center;">
                        <span class="tamanio"><?php echo $d1['iactivo']; ?></span><br>
                        <span class="letra_activo"><?php echo $d1['nombre']; ?></span><br>
                        <img class="imagen" src="logo.png"><br><span>&nbsp;&nbsp;Recodificacion de activos: 2021&nbsp;</span>
                    </th>
                </tr>
<?php }
?>  

</table>     -->

    
</page>
<!-- <page pageset="old">
    Nouvelle page !!!!
</page> -->
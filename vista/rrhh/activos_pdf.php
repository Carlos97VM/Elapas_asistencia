<?php
    session_start();
    require_once('../../lib/phpqrcode/qrlib.php');
    require_once('../../lib/html2pdf/html2pdf.class.php');
    ob_start();
    
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');

    $dir = 'temp/';

    if(!file_exists($dir))
        mkdir($dir);
    require_once('../reportes/cabeza.php');
    setlocale(LC_TIME,"es_ES");
    ini_set('date.timezone','America/La_Paz');
    $CI_trabajador = $_SESSION['CI_trabajador'];
    include("../../modelo/activos.php");
    $activo_trabajador = new activo();
    $activo_trabajador->get_activo_ci($CI_trabajador);
    $activos_de_trabajador=$bd->Consulta("SELECT * from qr_code where custodio=$CI_trabajador");
    $activos_de_trabajador1=$bd->Consulta("SELECT * from qr_code where custodio=$CI_trabajador");

    $tamanio = 2;
    $level = 'H';
    $frameSize = 1;
    $info = $bd -> Consulta("SELECT * FROM qr_code WHERE custodio = $CI_trabajador");
    $i = $bd -> getFila($info);
    $nombre = $i[custodion];
?>
<h1 align="center"><br><?php echo "<b class='title'>".$i[custodion]."</b>";?></h1>
<table class="cont" align="center"cellspacing="0" border="1">
    <?php
    $n = 0;
    $numeradas = $bd->numFila($activos_de_trabajador);
    $columnas=2;
    $filas = ceil($numeradas / $columnas);
    $contador = 0;
    // echo var_dump($activo_trabajador);
    $activo_nombre=array();
    $activo_iactivo=array();
    $activo_detalle=array();
    $activo_ubicacionn=array();
    $activo_custodio=array();
    $activo_custodion=array();
    $activo_tipobienn=array();
    while($activo_array = $bd->getFila($activos_de_trabajador1)){
        array_push($activo_nombre,$activo_array['nombre']);
        array_push($activo_iactivo,$activo_array['iactivo']);
        array_push($activo_detalle,$activo_array['detalle']);
        array_push($activo_ubicacionn,$activo_array['ubicacionn']);
        array_push($activo_custodio,$activo_array['custodio']);
        array_push($activo_custodion,$activo_array['custodion']);
        array_push($activo_tipobienn,$activo_array['tipobienn']);
    }
            
    for ($i = 1; $i <= $filas; $i++) {
        echo "<tr>\n";
        for ($j = 1; $j <= $columnas; $j++) {

            $name = $activo_iactivo[$n];
            $filename = $dir.$name.'.png';
                echo "<td>";
        ?>
            <?php if($contador<$numeradas){ ?>
                <img class="imagen_qr" src="<?php echo $filename ?>">           
            <?php
            }
            else{
                
                echo "";
            }
                echo "</td>";
            
                echo "<th style='text-align: center;'>";
            ?>
            <?php if($contador<$numeradas){ ?>
                <span class="tamanio"><?php echo $activo_iactivo[$contador]; ?></span><br>
                <span class="letra_activo"><?php echo $activo_nombre[$contador]; ?></span><br>
                <img class="imagen" src="logo.png"><br><span>&nbsp;&nbsp;RECODIFICACION DE ACTIVOS: 2021&nbsp;</span>
            <?php
            }
            else{
                
                echo "";
            }
                echo "</th>";
                $contador++;    
        }
        echo "</tr>";
        echo "\n";
        $n++;
    }
        ?>
</table>
    
<?php
    echo "</page>";
    $content = ob_get_clean();

    try
    {
        $html2pdf = new HTML2PDF('P', array(200,350), 'es', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        $html2pdf->Output("ACTIVOS_ELAPAS_".$nombre.".pdf");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    unset($_SESSION['CI_trabajador']);
?>
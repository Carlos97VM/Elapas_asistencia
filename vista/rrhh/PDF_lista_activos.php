<?php
    session_start();

    require_once('../../lib/html2pdf/html2pdf.class.php');
    ob_start();

    require_once('../reportes/cabezah.php');
    setlocale(LC_TIME,"es_ES");
    $CI_trabajador = $_SESSION['CI_trabajador'];
    ini_set('date.timezone','America/La_Paz');
    $info = $bd -> Consulta("SELECT * FROM qr_code WHERE custodio = $CI_trabajador");
    $i = $bd -> getFila($info);
?>
<h1 align="center"> DETALLES DEL USUARIO: <br><?php echo "<b class='title'>".$i[custodion]."</b>";?><br> GESTION: <?php echo date("Y");?></h1>
<table class="cont" align="center"cellspacing="0" border="1">
    <tr class="titulo">	
        <th class="ids" >No</th>
        <th class="detalle">CODIGO</th>
        <th class="detalle">NOMBRE</th>
        <th class="detalle">DETALLE</th>
        <th class="detalle"> UNIDAD</th>
        <th class="detalle"> CI</th>
    </tr>
    <?php
    $registros=$bd->Consulta("SELECT * FROM qr_code WHERE custodio=$CI_trabajador");
        $n = 0;
        while($registro = $bd->getFila($registros)) 
        {
            echo "<tr>";
            $n++;
            echo utf8_encode("<td class='ids'>    $n</td>
                              <td class='detalle'>$registro[iactivo]  </td>
                              <td class='detalle'>$registro[nombre]   </td>
                              <td class='detalle'>$registro[detalle]  </td>
                              <td class='detalle'>$registro[coston]   </td>
                              <td class='detalle'>$registro[custodio] </td>
                              ");
            echo "</tr>";
        }
        ?>
</table>

<?php
    echo "</page>";
    $content = ob_get_clean();

    try
    {
        $html2pdf = new HTML2PDF('P', array(216,356), 'es', true, 'UTF-8', 1);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        $html2pdf->Output("LISTA_ACTIVOS_ELAPAS_".$i[custodion].".pdf");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    unset($_SESSION['CI_trabajador']);
?>
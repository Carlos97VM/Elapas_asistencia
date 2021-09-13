<?php
    session_start();
    include("../../modelo/funciones.php");
	$file = urldecode(security($_GET['f']));
    $_SESSION[CI_trabajador] = $_GET[custodio]; 
?>
<script src="../../assets/js/jquery.js"></script>
<style type="text/css">
<!--
	*{
	   margin: 0;
       padding: 0;
	}
-->
</style>
<iframe id="pdfFrame" name="pdfFrame" style="border: none; width: 100%; height: 100%; margin: 0; padding: 0; overflow: hidden;" src="../../assets/js/pdfjs/web/viewer.html?file=../../../../<?php echo $file; ?>"></iframe>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#pdfFrame').on('load', function() {
            //window.frames.pdfFrame.print(); 
        });
    });
</script>
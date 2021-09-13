<?php    
    include("../../modelo/activos.php");  
    include("../../modelo/funciones.php");
    
        $activo = new activo();
        if($activo->eliminar(security($_GET[id])))
        {
            echo "Acci&oacute;n completada con &eacute;xito";
        }
        else
        {
            echo "Ocurri&oacute; un error.";
        }
    
?>
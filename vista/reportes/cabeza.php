<style type="text/css">

<!--

*
    {
        font-size: 12px;
    }
table.papeleta{
    width:100%;
    
}
table.page_header
    {

        width: 100%; 

        border: none;

        padding: 10px 10px 0px 10px;

        color: #223B50; 

        font-size: 10px;       

    }

    table.page_footer 

    {

        width: 100%; 

        height: 93px;

        border: none; 

        /*background-image: url(../../images/pie.png);*/

        padding: 25px 10px;

        color: #223B50;     

        font-size: 10px;

    }

h3

{

    display: block;

    text-align: center;

    color:#444;

    font-size: 14px;

    font-weight: normal;

}

h1

{

    display: block;

    text-align: center;

    color:#223B50;

    font-size: 14px;

} 
h2

{

    display: block;

    text-align: center;

    color:#223B50;

    font-size: 12px;

} 

p{

    padding: 0px 40px;

    text-align: justify;

}   
 
table.cont {
    text-align: center;
    width: 100%;

    border-left: solid 1px #223B50;

    border-top: solid 1px #223B50;
    border: 1px solid black;

    background: #fff;

    font-size: 12px;
}
table.cont td
{    

    border-bottom: solid 1px #223B50;

    border-right: solid 1px #223B50;

    padding: 5px;

    font-size: 9px;

}

table.cont thead td

{    

    border-bottom: solid 1px #828587;

    border-right: solid 1px #828587;

    padding: 5px;

    font-size: 7px;

}
tr,th.titulo {
    margin: 2em;
    padding:5px;
    text-align:center; 
    
}
th.ids{
    text-align:center;
    background:#21618C;
}
td.ids{
    width: 30px;
}
th.detalle{
    text-align:center;
    background:#21618C;
}
td.detalle{
    width: 90px;
}
.img{
    width:150px;
    height:50px;
    position:center solid;
    padding-right:150px;
    margin-right:150px;
}
b.title{
    text-transform: uppercase;
}
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

.letra_numero{
    font-size: 14;
    margin: 0;
    padding: 0;
}

-->

</style>
<?php
    include("../../modelo/conexion.php");
    include("../../modelo/funciones.php");

    $bd = new Conexion();
?>
<page backtop="18mm" backbottom="14mm" backleft="0mm" backright="0mm" backimg="" style="font-size: 14pt">

    <page_header>        

        <table class="page_header">            

            <tr>

            <td style="width: 30%; text-align: left;">
                <img class="img" src="../reportes/images/logo.png"/>
            </td>
            <td style="width: 30%; text-align: right;">
                <h1> ACTIVOS DE ELAPAS <br>GESTION: <?php echo date("Y");?></h1>
            </td>

            </tr>

        </table>

    </page_header>    

    <page_footer>        

<table class="page_footer">

    <tr>

        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

    </tr>

    <tr>

        <td style="width: 33%; text-align: left;">                    
            
        </td>

        <td style="width: 34%; text-align: center">

            p&aacute;gina [[page_cu]]/[[page_nb]]

        </td>

        <td style="width: 33%; text-align: right">
            <?php echo date('d/m/Y'); ?>
        </td>

    </tr>

</table>

</page_footer>
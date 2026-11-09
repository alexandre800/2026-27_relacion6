<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador
$barra = [
    ["TEXTO" => "inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "página principal", "ENLACE" => "/aplicacion/principal/index.php"]
];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION INDEX", $barra);
cuerpo(); //llamo a la vista
finCuerpo();

// **********************************************************
//vista
function cabecera() {}

//vista
function cuerpo()
{
?>
    
<?php

//pruebas del funcionamiento de las clases
$mueble1 = new MuebleBase("MESA");
echo $mueble1;

}
<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador
$barra = [
    ["TEXTO" => "inicio", "ENLACE" => "../../index.php"],
    ["TEXTO" => "página principal", "ENLACE" => "index.php"]
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
    <a href="pruebas.php">Pruebas de las clases</a>
<?php

}
<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

//controlador
$barra = [
    ["TEXTO" => "inicio", "ENLACE" => "../../index.php"],
    ["TEXTO" => "página principal", "ENLACE" => "index.php"],
    ["TEXTO" => "pruebas", "ENLACE" => "pruebas.php"]
];

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION INDEX", $barra);
cuerpo($muebles); //llamo a la vista
finCuerpo();

// **********************************************************
//vista
function cabecera() {}

//vista
function cuerpo($muebles)
{
?>
    
<?php

//pruebas del funcionamiento de las clases
// $mueble1 = new MuebleBase("MESA");
// echo $mueble1;

$mueble1 = new MuebleReciclado("MESA");
$mueble2 = new MuebleTradicional("SILLA");

$mueble2->anadirCaracteristicas("dureza", "alta", "densidad", 1.34, "mal parámetro");
echo $mueble1;
echo "<br>".$mueble2."<br>";

foreach($muebles as $mueble){
    echo "<br>".$mueble;
}

}
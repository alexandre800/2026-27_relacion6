<?php 
define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO","desarrollo"); //en "produccion o en desarrollo

if (MODO_TRABAJO=="produccion")
    error_reporting(0);
    else 
        error_reporting(E_ALL);  

spl_autoload_register(function ($clase){
    $ruta=RUTABASE."/aplicacion/clases/curso2026/";
    $fichero=$ruta."$clase.php";
    
    if (file_exists($fichero))
        {
            require_once($fichero);
        }
      else
        {
            throw new Exception("La clase $clase no se ha encontrado.");
        }
});

include(RUTABASE."/aplicacion/plantilla/plantilla.php");

//creo todos los objetos que necesita mi aplicación

$muebles = [
    1 => new MuebleReciclado(
        "MESA",
        "EcoWood",
        "ESPAÑA",
        2022,
        "01/03/2022",
        "31/12/2035",
        120,
        75
    ),

    2 => new MuebleTradicional(
        "SILLA",
        "FaMu:Sillas",
        "PORTUGAL",
        2021,
        "15/02/2021",
        "31/12/2030",
        45,
        8,
        "S02"
    ),

    3 => new MuebleReciclado(
        "ARMARIO",
        "GreenHome",
        "FRANCIA",
        2023,
        "01/06/2023",
        "31/12/2040",
        350,
        90
    ),

    4 => new MuebleTradicional(
        "ESTANTERIA",
        "MueblesSur",
        "ITALIA",
        2020,
        "01/01/2020",
        "31/12/2032",
        180,
        20,
        "E15"
    ),

    5 => new MuebleReciclado(
        "ESCRITORIO",
        "ReciDesk",
        "ALEMANIAwewewewewewet",
        2024,
        "01/04/2032",
        "31/12/2030",
        20,
        120
    )
];

foreach($muebles as $mueble){
    $mueble->anadirCaracteristicas("dureza", "alta", "densidad", 1.34);
}

//esto es una modificacion de alexandre
<?php
include_once(dirname(__FILE__) . "/cabecera.php");

//controlador
$barra = [
    ["TEXTO" => "inicio", "ENLACE" => "/index.php"]
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
    <!-- <br><br>
    <div id="barraMenu">
        <ul>
            <li><a href="/aplicacion/pruebas/index.php">Pruebas</a></li>
            <li><a href="/aplicacion/relacion1/index.php">Relación 1</a></li>
            <li><a href="/aplicacion/relacion2/index.php">Relación 2</a></li>
        </ul>

    </div> -->
<?php
}

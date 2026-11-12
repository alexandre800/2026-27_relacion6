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
cuerpo($muebles); //llamo a la vista
finCuerpo();

// **********************************************************
//vista
function cabecera() {}

//vista
function cuerpo($muebles)
{
?>
    <a href="pruebas.php">Pruebas de las clases</a>

    <table>
        <thead>
            <td>Índice</td>
            <td>Tipo</td>
            <td>Nombre</td>
            <td>Inicio venta</td>
            <td>Precio</td>
        </thead>
        <?php
        echo muestraTabla($muebles);
        ?>
    </table>

    <form action="" method="post">

        <select name="muebleSelect" id="ordenar">
            <?php
            echo muestraSelect($muebles);
            ?>
        </select>

        <input type="submit" class="boton" value="Mostrar mueble" name="mostrar">

    </form>

    <form action="modificar.php" method="post" target="_blank">
        <input type="hidden" name="id" value="<?= $_POST["muebleSelect"] ?>">
        <button type="submit">Modificar mueble</button>
    </form>

    <div id="muebleInformacion">
        <?php
        if (isset($_POST["mostrar"])) {
            $mueble = $muebles[$_POST["muebleSelect"]];

            echo "<h3>Datos del mueble</h3>";
            echo "Clase: " . get_class($mueble) . "<br>";
            echo "Nombre: " . $mueble->getNombre() . "<br>";
            echo "Fabricante: " . $mueble->getFabricante() . "<br>";
            echo "País: " . $mueble->getPais() . "<br>";
            echo "Año: " . $mueble->getAnio() . "<br>";
            echo "Fecha inicio venta: " . $mueble->getFechaIniVenta() . "<br>";
            echo "Fecha fin venta: " . $mueble->getFechaFinVenta() . "<br>";
            echo "Precio: " . $mueble->getPrecio() . " €<br>";

            echo "<h4>Propiedades adicionales</h4>";
            foreach ($mueble->damePropiedadesAdicionales() as $propiedad) {
                $metodo = "get" . ucfirst($propiedad);
                echo $propiedad . ": " . $mueble->$metodo() . "<br>";
            }

            echo "<h4>Características</h4>";
            foreach ($mueble->getCaracteristicas() as $nombre => $valor) {
                echo $nombre . ": " . $valor . "<br>";
            }
        }
        ?>
    </div>

    

<?php

}

function muestraTabla($muebles)
{
    $cadena = "";

    for ($i = 1; $i <= count($muebles); $i++) {
        $cadena .= "<tr>"
            . "<td>{$i}<td>"
            . "<td>" . get_class($muebles[$i]) . "<td>"
            . "<td>{$muebles[$i]->getNombre()}<td>"
            . "<td>{$muebles[$i]->getFechaIniVenta()}<td>"
            . "<td>{$muebles[$i]->getPrecio()} €<td>"
            . "</tr>";
    }

    return $cadena;
}

function muestraSelect($muebles)
{
    $cadena = "";

    for ($i = 1; $i <= count($muebles); $i++) {
        $cadena .= "<option value={$i}>mueble {$muebles[$i]->getNombre()} ({$i})</option>";
    }

    return $cadena;
}

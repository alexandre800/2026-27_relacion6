<?php

final class MuebleTradicional extends MuebleBase
{

    //propiedades
    private float $_peso=15;
    private string $_serie="S01";

    /**
     * Constructor (llama al constructor de la clase padre e inicializa
     * las dos nuevas propiedades)
     *
     * @param [type] $nombre
     * @param string $fabricante
     * @param string $pais
     * @param integer $anio
     * @param string $fechaIniVenta
     * @param string $fechaFinVenta
     * @param integer $precio
     * @param float $peso
     * @param string $serie
     */
    public function __construct($nombre, $fabricante = "FaMu:", $pais = "ESPAÑA", $anio = 2020, 
        $fechaIniVenta = "01/01/2020", $fechaFinVenta = "31/12/2040", $precio = 30,
        $peso=15, $serie="S01")
    {
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);
        $this->setPeso($peso);
        $this->setSerie($serie);
    }

    //Get y set de las nuevas propiedades
    public function getSerie(): string
    {
        return $this->_serie;
    }

    public function setSerie(string $serie): bool
    {
        $this->_serie=$serie;
        return true;
    }

    public function getPeso(): float
    {
        return $this->_peso;
    }

    public function setPeso(float $peso): bool
    {
        if (validaReal($peso, 15, 300, 15)) {
            $this->_peso = $peso;
            return true;
        }

        return false;
    }


    /**
     * Redefinición del método de clase padre, devuelve
     * un array con los nombres de las nuevas propiedades
     *
     * @return array
     */
    function damePropiedadesAdicionales():array {
        return ["peso", "serie"];
    }

    /**
     * Método que al convertir la instancia en cadena nos devuelve
     * la información completa
     *
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString().", peso: {$this->getPeso()} kg, 
            serie: {$this->getSerie()}";
    }

}
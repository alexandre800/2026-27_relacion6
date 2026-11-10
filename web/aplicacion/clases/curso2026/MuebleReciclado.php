<?php

final class MuebleReciclado extends MuebleBase
{

    //propiedades
    private int $_porcentajeReciclado = 10;

    /**
     * Constructor (llama al constructor de la clase padre e inicializa
     * porcentajeReciclado)
     *
     * @param [type] $nombre
     * @param string $fabricante
     * @param string $pais
     * @param integer $anio
     * @param string $fechaIniVenta
     * @param string $fechaFinVenta
     * @param integer $precio
     * @param integer $porcentajeReciclado
     */
    public function __construct($nombre, $fabricante = "FaMu:", $pais = "ESPAÑA", $anio = 2020, 
        $fechaIniVenta = "01/01/2020", $fechaFinVenta = "31/12/2040", $precio = 30,
        $porcentajeReciclado=10)
    {
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);
        $this->setPorcentajeReciclado($porcentajeReciclado);
    }

    /**
     * devuelve el valor de la propiedad porcentajeReciclado
     *
     * @return integer
     */
    public function getPorcentajeReciclado(): int
    {
        return $this->_porcentajeReciclado;
    }

    /**
     * Asigna a porcentajeReciclado un valor pasado como parámetro,
     * devuelve true si es un valor válido, y false si no lo es
     *
     * @param integer $porcentaje
     * @return boolean
     */
    public function setPorcentajeReciclado(int $porcentaje): bool
    {
        if (validaEntero($porcentaje, 0, 100, 10)) {
            $this->_porcentajeReciclado = $porcentaje;
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
        return ["porcentajeReciclado"];
    }

    /**
     * Método que al convertir la instancia en cadena nos devuelve
     * la información completa
     *
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString().", porcentaje de reciclado: {$this->getPorcentajeReciclado()} %";
    }
}

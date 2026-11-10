<?php
class Caracteristicas implements Iterator
{

    //Array privado donde se almacenan las propiedades dinámicas
    private array $_caracteristicas = [];

    private array $_iteracion = [];
    private int $_posicion = 0;
    private static bool $_puedeCrear = true;

    //----------------------------------
    //Métodos mágicos para control de la sobrecarga


    public function __set(string $nombre, mixed $valor): void
    {

        if (!self::$_puedeCrear)
            throw new Exception("No se pueden crear más características");

        if ($nombre === "ULTIMA") {
            self::$_puedeCrear = false;
        }

        $this->_caracteristicas[$nombre] = $valor;
    }


    public function __get(string $nombre): mixed
    {
        // if (array_key_exists($nombre, $this->_caracteristicas))
        return $this->_caracteristicas[$nombre];

        // throw new Exception("La característica ".$nombre." no existe");
    }

    //---------------------------------
    //Métodos de Iterator



    public function rewind(): void
    {
        $this->_iteracion = array_reverse(
            $this->_caracteristicas,
            true
        );

        $this->_posicion = 0;
    }

    public function current(): mixed
    {
        return array_values($this->_iteracion)[$this->_posicion];
    }


    public function key(): mixed
    {
        return array_keys($this->_iteracion)[$this->_posicion];
    }

    public function next(): void
    {
        $this->_posicion++;
    }


    public function valid(): bool
    {
        return $this->_posicion < count($this->_iteracion);
    }

    /**
     * Método que al convertir la instancia en cadena nos devuelve
     * la información completa
     *
     * @return string
     */
    public function __toString()
    {
        $cadena = "";
        foreach ($this->_caracteristicas as $clave => $valor) {
            $cadena .= "$clave:$valor;";
        }

        return $cadena;
    }
}

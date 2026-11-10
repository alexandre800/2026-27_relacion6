<?php

include_once(dirname(__FILE__) . "/../../../scripts/librerias/validacion.php");

abstract class MuebleBase
{

    //constante con el máximo de muebles
    public const MAXIMO_MUEBLES = 9;

    //Número de muebles (instancias) creados hasta el momento
    private static int $_mueblesCreados = 0;

    //Propiedades
    private string $_nombre;
    private string $_fabricante = "FaMu:";
    private string $_pais = "ESPAÑA";
    private int $_anio = 2020;
    private string $_fechaIniVenta = "01/01/2020";
    private string $_fechaFinVenta = "31/12/2040";
    private float $_precio = 30;

    //propiedad privada caracteristicas
    private Caracteristicas $_caracteristicas;

    /**
     * Inicializa las variables usando sus métodos set
     *
     * @param [type] $nombre -> el único que no tiene valor por defecto,
     * si el set da false, lanza un error
     * @param string $fabricante
     * @param string $pais
     * @param integer $anio
     * @param string $fechaIniVenta
     * @param string $fechaFinVenta
     * @param integer $precio
     */
    public function __construct(
        $nombre,
        $fabricante = "FaMu:",
        $pais = "ESPAÑA",
        $anio = 2020,
        $fechaIniVenta = "01/01/2020",
        $fechaFinVenta = "31/12/2040",
        $precio = 30
    ) {
        $numero = 0;
        if (!self::puedeCrear($numero))
            throw new Exception("No se pueden crear más muebles (" .
                self::$_mueblesCreados . "/" . self::MAXIMO_MUEBLES . ")");

        if (!$this->setNombre($nombre))
            throw new Error("Error en el nombre");

        $this->setFabricante($fabricante);
        $this->setPais($pais);
        $this->setAnio($anio);
        $this->setFechaIniVenta($fechaIniVenta);
        $this->setFechaFinVenta($fechaFinVenta);
        $this->setPrecio($precio);

        $this->_caracteristicas=new Caracteristicas();
    }

    //------------------------------------
    //Métodos get y set de propiedades
    //en los métodos set se verifican primero las restricciones de cada campo

    public function getNombre(): string
    {
        return $this->_nombre;
    }

    public function setNombre(string $nombre): bool
    {
        if (validaExpresion($nombre, "/^[A-Z]{1,40}$/", "nombre")) {
            $this->_nombre = $nombre;
            return true;
        }

        return false;
    }

    public function getFabricante(): string
    {
        return $this->_fabricante;
    }

    public function setFabricante(string $fabricante): bool
    {
        if (validaCadena($fabricante, 30, "FaMu:")) {

            //se le añade "FaMu:" si no lo tiene
            validaExpresion($fabricante, "/^[A-Z]*$/", "FaMu:" . $fabricante);
            $this->_fabricante = $fabricante;
            return true;
        }

        return false;
    }

    public function getPais(): string
    {
        return $this->_pais;
    }

    public function setPais(string $pais): bool
    {
        if (validaCadena($pais, 20, "ESPAÑA")) {
            $this->_pais = $pais;
            return true;
        }

        return false;
    }

    public function getAnio(): int
    {
        return $this->_anio;
    }

    public function setAnio(int $anio): bool
    {
        if (validaEntero($anio, 2020, intval(date("Y")), 2020)) {
            $this->_anio = $anio;
            return true;
        }

        return false;
    }

    public function getFechaIniVenta(): string
    {
        return $this->_fechaIniVenta;
    }

    public function setFechaIniVenta(string $fechaIniVenta): bool
    {
        if (validaFecha($fechaIniVenta, "01/01/2020")) {

            $fechaFab = "01/01/" . $this->getAnio();
            if (
                DateTime::createFromFormat('d/m/Y', $fechaIniVenta) <
                DateTime::createFromFormat('d/m/Y', $fechaFab)
            )
                $fechaIniVenta = $fechaFab;

            $this->_fechaIniVenta = $fechaIniVenta;
            return true;
        }

        return false;
    }

    public function getFechaFinVenta(): string
    {
        return $this->_fechaFinVenta;
    }

    public function setFechaFinVenta(string $fechaFinVenta): bool
    {
        if (validaFecha($fechaFinVenta, "31/12/2040")) {

            if (
                DateTime::createFromFormat('d/m/Y', $fechaFinVenta) <
                DateTime::createFromFormat('d/m/Y', $this->getFechaIniVenta())
            )
                $fechaFinVenta = "31/12/2040";

            $this->_fechaFinVenta = $fechaFinVenta;
            return true;
        }

        return false;
    }

    public function getPrecio(): float
    {
        return $this->_precio;
    }

    public function setPrecio(float $precio): bool
    {
        if (validaReal($precio, 30, PHP_FLOAT_MAX, 30)) {
            $this->_precio = $precio;
            return true;
        }

        return false;
    }

    public function getCaracteristicas(): Caracteristicas
    {
        return $this->_caracteristicas;
    }

    //Métodos para deshabilitar la sobrecarga dinámica
    public function __get(string $name)
    {
        throw new \Exception("La propiedad " . $name . " no existe");
    }
    public function __set(string $name, mixed $value): void
    {
        throw new \Exception("La propiedad " . $name . " no existe");
    }
    public function __isset(string $nombre): bool
    {
        return false;
    }

    /**
     * Será redefinido en las clases hijas y devolverá 
     * un array con el nombre de las propiedades adicionales a la clase base
     *
     * @return array
     */
    abstract function damePropiedadesAdicionales(): array;


    /**
     * devuelve true si se pueden crear más instancias de la 
     * clase y false en caso contrario
     *
     * @param integer $numero-> se devuelve  el número de muebles que aún se pueden crear de la clase
     * @return boolean
     */
    public static function puedeCrear(int &$numero): bool
    {
        $numero = self::MAXIMO_MUEBLES - self::$_mueblesCreados;
        return self::$_mueblesCreados < self::MAXIMO_MUEBLES;
    }

    /**
     * Método que al convertir la instancia en cadena nos devuelve
     * la información completa
     *
     * @return string
     */
    public function __toString(): string
    {
        return "MUEBLE de clase " . get_class($this) .
            " con nombre " . $this->getNombre() .
            ", fabricante " . $this->getFabricante() .
            ", fabricado en " . $this->getPais() .
            " a partir del año " . $this->getAnio() .
            ", vendido desde " . $this->getFechaIniVenta() .
            " hasta " . $this->getFechaFinVenta() .
            ", precio " . $this->getPrecio() . " €" .
            ", características: " . $this->_caracteristicas;
    }

    public function anadirCaracteristicas(string $carac, mixed ...$valor)
    {

        if (count($valor) % 2 == 0)
            array_pop($valor);

        $this->_caracteristicas->$carac = $valor[0];

        for ($i = 1; $i < count($valor); $i += 2){
            $prop=$valor[$i];
            $this->_caracteristicas->$prop = $valor[$i+1];
        }
    }
}

<?php

/**
 * Biblioteca de funciones de validación de varios
 * tipos de datos usando FILTER_VALIDATE siempre que se pueda
 */

/**
 * Valida que un número entero se encuentre dentro de un rango.
 *
 * @param int $var Variable a validar. Se modifica por referencia.
 * @param int $min Valor mínimo permitido.
 * @param int $max Valor máximo permitido.
 * @param int $defecto Valor asignado a la variable si la validación falla.
 * @return bool True si el valor es válido; false en caso contrario.
 */
function validaEntero(int &$var, int $min, int $max, int $defecto): bool
{

    $o = [
        "options" => [
            "min_range" => $min,
            "max_range" => $max
        ]
    ];

    if (filter_var($var, FILTER_VALIDATE_INT, $o)===false) {
        $var = $defecto;
        return false;
    }

    return true;
}

/**
 * Valida que un número real se encuentre dentro de un rango.
 *
 * @param float $var Variable a validar. Se modifica por referencia.
 * @param float $min Valor mínimo permitido.
 * @param float $max Valor máximo permitido.
 * @param float $defecto Valor asignado a la variable si la validación falla.
 * @return bool True si el valor es válido; false en caso contrario.
 */
function validaReal(float &$var, float $min, float $max, float $defecto): bool
{

    $o = [
        "options" => [
            "min_range" => $min,
            "max_range" => $max
        ]
    ];

    if (filter_var($var, FILTER_VALIDATE_FLOAT, $o)===false) {
        $var = $defecto;
        return false;
    }

    return true;
}

/**
 * Valida una fecha en formato dd/mm/aaaa.
 *
 * Si la fecha es válida, la sanea utilizando el formato
 * d/m/Y y la devuelve en la variable recibida.
 *
 * @param string $var Fecha a validar.
 * @param string $defecto Fecha por defecto en caso de error.
 * @return bool True si la fecha es válida; false en caso contrario.
 */
function validaFecha(string &$var, string $defecto): bool
{

    $var = trim($var);
    if ($fecha = \DateTime::createFromFormat('d/m/Y', $var)) {
        $var = $fecha->format("d/m/Y");
        return true;
    }

    $var = $defecto;
    return false;
}

/**
 * Valida una hora en formato hh:mm:ss.
 *
 * Permite introducir horas sin ceros a la izquierda
 * (por ejemplo 0:5:1) y las transforma al formato
 * correcto (00:05:01).
 *
 * @param string $var Hora a validar.
 * @param string $defecto Hora por defecto en caso de error.
 * @return bool True si la hora es válida; false en caso contrario.
 */
function validaHora(string &$var, string $defecto): bool
{

    $var = trim($var);
    $partes = explode(":", $var);
    if (count($partes) === 3) {
        $var = str_pad($partes[0], 2, '0', STR_PAD_LEFT) . ':' .
            str_pad($partes[1], 2, '0', STR_PAD_LEFT) . ':' .
            str_pad($partes[2], 2, '0', STR_PAD_LEFT);
    }

    if ($hora = \DateTime::createFromFormat('H:i:s', $var)) {
        $var = $hora->format("H:i:s");
        return true;
    }

    $var = $defecto;
    return false;
}

/**
 * Valida una dirección de correo electrónico mediante
 * una expresión regular.
 *
 * @param string $var Email a validar.
 * @param string $defecto Valor por defecto en caso de error.
 * @return bool True si el email es válido; false en caso contrario.
 */
function validaEmail(string &$var, string $defecto): bool
{

    $var = trim($var);
    if (!filter_var($var, FILTER_VALIDATE_EMAIL)) {
        $var = $defecto;
        return false;
    }

    return true;
}

/**
 * Valida que una cadena no supere una longitud máxima.
 *
 * @param string $var Cadena a validar.
 * @param int $longitud Longitud máxima permitida.
 * @param string $defecto Valor por defecto en caso de error.
 * @return bool True si la longitud es válida; false en caso contrario.
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool
{

    //$var = trim($var);
    $o = [
        "options" => [
            "regexp" => "/^[\S]{0,".$longitud."}$/"
        ]
    ];

    if (!filter_var($var, FILTER_VALIDATE_REGEXP, $o)) {
        $var=$defecto;
        return false;
    }

    return true;
}

/**
 * Valida una cadena utilizando una expresión regular.
 *
 * @param string $var Cadena a validar.
 * @param string $expresion Expresión regular utilizada para la validación.
 * @param string $defecto Valor por defecto en caso de error.
 * @return bool True si la cadena cumple la expresión; false en caso contrario.
 */
function validaExpresion(string &$var, string $expresion, string $defecto): bool
{
    $var = trim($var);
    $o = [
        "options" => [
            "regexp" => $expresion
        ]
    ];

    if (!filter_var($var, FILTER_VALIDATE_REGEXP, $o)) {
        $var=$defecto;
        return false;
    }

    return true;
}

/**
 * Comprueba si un valor pertenece a un conjunto
 * de valores permitidos.
 *
 * Puede realizar la comprobación sobre los valores
 * de un array o sobre sus claves.
 *
 * @param mixed $var Valor a buscar.
 * @param array $posibles Array de valores permitidos.
 * @param int $tipo
 *      1 -> buscar en los valores del array.
 *      2 -> buscar en las claves del array.
 * @return bool True si se encuentra el valor; false en caso contrario.
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool {

    if($tipo===2)
        $array=array_keys($posibles);
    else
        $array=$posibles;

    foreach ($array as $elem) {
        if ($elem === $var)
            return true;
    }

    return false;
}

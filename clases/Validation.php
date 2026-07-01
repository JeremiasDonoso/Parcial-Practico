<?php

class Validation
{

    public static function requerido($valor)
    {
        return !empty(trim($valor));
    }

    public static function correo($correo)
    {
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }

    public static function edad($edad)
    {
        return is_numeric($edad) && $edad >= 1 && $edad <= 120;
    }

    public static function documento($documento)
    {
        return preg_match('/^\d{1,2}-\d{2,3}-\d{3,4}$/', $documento);
    }

    public static function temas($temas)
    {
        return isset($temas) && count($temas) > 0;
    }

    public static function celular($celular)
    {
        return preg_match('/^[0-9]{8}$/', $celular);
    }

}
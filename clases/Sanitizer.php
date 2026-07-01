<?php

class Sanitizer
{
    public static function texto($texto)
    {
        $texto = trim($texto);
        $texto = strip_tags($texto);
        $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');

        return mb_convert_case($texto, MB_CASE_TITLE, "UTF-8");
    }

    public static function correo($correo)
    {
        $correo = trim($correo);
        return strtolower(filter_var($correo, FILTER_SANITIZE_EMAIL));
    }

    public static function celular($celular)
    {
        return preg_replace('/[^0-9]/', '', $celular);
    }

    public static function documento($documento)
    {
        return trim(strip_tags($documento));
    }

    public static function observaciones($texto)
    {
        return trim(strip_tags($texto));
    }
}
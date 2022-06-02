<?php

class Loader
{
    public static function autoload($classname)
    {
        $path = $classname . ".php";
        try {
            require_once $path;
        } catch (Exception $erreur) {
            exit($erreur->getMessage());
        }
    }
}
// Enregistre une fonction en tant qu'implémentation de __autoload()
spl_autoload_register("Loader::autoload");

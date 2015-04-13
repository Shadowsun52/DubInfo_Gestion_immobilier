<?php
namespace DubInfo_gestion_immobilier;

use DubInfo_gestion_immobilier\Exception\ClassNotFoundException;
/**
 * Classe static pour charger les classes utilisées dans l'app
 * 
 * @author Jenicot Alexandre
 */
class Autoloader {
    
    public static function register() {
        spl_autoload_register(array(__CLASS__, '_autoload'));
    }

    private static function _autoload($class){
        if(strpos($class, __NAMESPACE__ . "\\") === 0)
        {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            
            if(file_exists($class . '.php'))
            {
                require_once $class . '.php';
            }
            elseif(file_exists('../' . $class . '.php'))
            {
                require_once '../' . $class . '.php';
            }
            else
            {
                throw new ClassNotFoundException($class);
            }
        }
    }
}

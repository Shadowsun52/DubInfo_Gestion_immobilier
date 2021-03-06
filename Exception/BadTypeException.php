<?php
namespace DubInfo_gestion_immobilier\Exception;

use \Exception;
/**
 * Description of BadTypeException
 *
 * @author Jenicot Alexandre
 */
class BadTypeException extends Exception{
    const NAMESPACE_MODEL = "DubInfo_gestion_immobilier\model\\";
    
    public function __construct($attribute_name, $class_name) {
        parent::__construct("Mauvais type entré pour l'attribut '" . 
                $attribute_name . "' pour un object de la classe '" . 
                str_replace(self::NAMESPACE_MODEL, '', $class_name) . "'", 0, NULL);
    }
}

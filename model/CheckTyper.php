<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DateTime;
/**
 * Description of CheckTyper
 *
 * @author Jenicot Alexandre
 */
final class CheckTyper {
    
    /**
     * Verifie que le valeur d'un attribut d'une classe est bien du type integer
     * si $value vaut null la fonction retourne null
     * @param mixed $value
     * @param string $attribute_name
     * @param string $class_name
     * @return int
     * @throws BadTypeException
     */
    public static function isInteger($value, $attribute_name, $class_name) {
        if($value === NULL) {
            return NULL;
        }
        
        if(is_numeric($value)) {
            settype($value, 'integer');
            return $value;
        }
        
        throw new BadTypeException($attribute_name, $class_name);
    }
    
    /**
     * Verifie que le valeur d'un attribut d'une classe est bien du type double
     * si $value vaut null la fonction retourne null
     * @param mixed $value
     * @param string $attribute_name
     * @param string $class_name
     * @return double
     * @throws BadTypeException
     */
    public static function isDouble($value, $attribute_name, $class_name) {
        if($value === NULL) {
            return NULL;
        }
        
        if(is_numeric($value)) {
            settype($value, 'double');
            return $value;
        }
        
        throw new BadTypeException($attribute_name, $class_name);
    }
    
    /**
     * Verifie que le valeur d'un attribut d'une classe est bien du type string
     * si $value vaut null la fonction retourne null
     * @param mixed $value
     * @param string $attribute_name
     * @param string $class_name
     * @return string
     * @throws BadTypeException
     */
    public static function isString($value, $attribute_name, $class_name) {
        if($value === NULL) {
            return NULL;
        }
        
        if(is_string($value)) {
            return $value;
        }
        
        throw new BadTypeException($attribute_name, $class_name);
    }
    
    /**
     * Verifie que le valeur d'un attribut d'une classe est bien du type boolean
     * Si la valeur est un integer et vaut 1 ou 0, il est convertie en boolean
     * si $value vaut null la fonction retourne null
     * @param mixed $value
     * @param string $attribute_name
     * @param string $class_name
     * @return boolean
     * @throws BadTypeException
     */
    public static function isBoolean($value, $attribute_name, $class_name) {
        if($value === NULL) {
            return NULL;
        }
        
        if(is_bool($value)) {
            return $value;
        }
        
        if(is_numeric($value))
        {
            settype($value, 'integer');
            if($value == 0 || $value == 1) {
                settype($value, 'boolean');
                return $value;
            }
        }
        
        throw new BadTypeException($attribute_name, $class_name);
    }
    
    /**
     * Verifie que le valeur d'un attribut d'une classe est bien un object DateTime
     * si $value vaut null la fonction retourne null
     * @param mixed $value
     * @param string $attribute_name
     * @param string $class_name
     * @return DateTime
     * @throws BadTypeException
     */
    public static function isDateTime($value, $attribute_name, $class_name) {
        if($value === NULL) {
            return new DateTime();
        }
        
        if($value instanceof DateTime) {
            return $value;
        }
        
        throw new BadTypeException($attribute_name, $class_name);
    }
    
    /**
     * Verifie que le valeur d'un attribut d'une classe est bien un model de la bonne classe
     * si $value vaut null la fonction retourne null
     * @param mixed $value
     * @param string $model_name Classe voulu pour la value à tester
     * @param string $attribute_name
     * @param string $class_name
     * @return DateTime
     * @throws BadTypeException
     */
    public static function isModel($value, $model_name, $attribute_name, $class_name) {
        
        if($value === NULL) {
            return new $model_name();
        }
        
        if($value instanceof $model_name) {
            return $value;
        }
        
        throw new BadTypeException($attribute_name, $class_name);
    }
}

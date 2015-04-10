<?php
namespace DubInfo_gestion_immobilier;

/**
 * Description of Config
 *
 * @author Jenicot Alexandre
 */
class Config {
    const DB_HOST = 'db.host';
    const DB_BASENAME = "db.basename";
    const DB_USER = 'db.user';
    const DB_PASSWORD = 'db.password';
    const ROOT = 'root_path';
    
    /**
     * Tableau contenant les données de configuration générale de l'app
     * @var array[mixed] 
     */
    static private $_confArray;

    /**
     * Fonction retournant la valeur de configuration lié à la clé $name
     * @param string $name
     * @return mixed
     */
    public static function read($name)
    {
        return self::$_confArray[$name];
    }

    /**
     * Fonction qui encode une valeur de configuration lié à la clé $name
     * @param string $name
     * @param mixed $value
     */
    public static function write($name, $value)
    {
        self::$_confArray[$name] = $value;
    }
}

//Initialisation des informations de la DB
Config::write(Config::DB_HOST, 'localhost');
Config::write(Config::DB_BASENAME, 'bestinvewabi');
Config::write(Config::DB_USER, 'root');
Config::write(Config::DB_PASSWORD, '');

//Initialisation de chemin Root
Config::write(Config::ROOT, $_SERVER['DOCUMENT_ROOT'] . 'dubInfo_gestion_immobilier/');

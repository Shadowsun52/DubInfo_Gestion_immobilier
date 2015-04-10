<?php
namespace DubInfo_gestion_immobilier\data;

use PDO;
use DubInfo_gestion_immobilier\Config;
/**
 * Description of PDO2
 *
 * @author Alexandre
 */
class PDO2
{
    public $db; // handle of the db connexion
    private static $instance;

    private function __construct()
    {
        // building data source name from config
        $dsn = 'mysql:host=' . Config::read(Config::DB_HOST) .
               ';dbname='    . Config::read(Config::DB_BASENAME).
               ';connect_timeout=15';
        // getting DB user from config                
        $user = Config::read(Config::DB_USER);
        // getting DB password from config                
        $password = Config::read(Config::DB_PASSWORD);

        $this->db = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }

    public static function getInstance()
    {
            if (!isset(self::$instance))
            {
                    $object = __CLASS__;
                    self::$instance = new $object;
            }
            return self::$instance;
    }
}
?>

<?php
namespace DubInfo_gestion_immobilier\data;

use DateTime;
/**
 * Classe abstrait utilisé par la couche data pour l'interaction avec la DB
 *
 * @author Jenicot Alexandre
 */
abstract class AbstractDAO {
    private $_connection;
    
    public function __construct() {
        $this->setConnection();
    }
    
    public abstract function readList($id = NULL);

    public abstract function read($id);
    
    public abstract function add($object);
    
    public abstract function update($object);
    
    public abstract function delete($id);
    
    public abstract function readAll();

    /**
     * Méthode pour créer un DateTime à partir de données provenant d'une DB
     * @param string $date la date lut dans la DB
     * @return DateTime
     */
    protected function readDate($date) {
        if($date == '') {
            return null;
        }
        else {
            return new DateTime($date);
        }
    }
    
    /**
     * Méthode retournant une date sous format string écrivable dans une DB
     * @param DateTime $date la date à encoder dans la DB
     * @return string
     */
    protected function writeDate($date) {
        if($date === NULL) {
            return null;
        }
        else {
            return $date->format('Y-m-d H:i:s');
        }
    }
    
    /**
     * Retourne la connexion à la DB
     * @return PDO2
     */
    protected function getConnection() {
        return $this->_connection;
    }

    /**
     * récuperer la connexion à la DB
     */
    protected function setConnection() {
        $this->_connection = PDO2::getInstance()->db;
    }
}

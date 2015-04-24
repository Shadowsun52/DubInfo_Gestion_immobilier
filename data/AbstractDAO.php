<?php
namespace DubInfo_gestion_immobilier\data;

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

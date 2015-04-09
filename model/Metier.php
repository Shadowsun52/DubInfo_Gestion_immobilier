<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of Metier
 *
 * @author Jenicot Alexandre
 */
class Metier {
    const MAX_SIZE_LIBELLE = 70;
    
    /**
     *
     * @var int
     */
    private $_id;
    
    /**
     *
     * @var string 
     */
    private$_libelle;
    
    /**
     * 
     * @param int $id
     * @param string $libelle
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $libelle = NULL) {
        $this->setId($id);
        $this->setlibelle($libelle);
    }
    
    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->_id;
    }
    
    /**
     * 
     * @param int $id
     * @throws BadTypeException
     */
    public function setId($id) {
        $this->_id = CheckTyper::isInteger($id, 'id', __CLASS__);
    }
    
    /**
     * @return string
     */
    public function getLibelle() {
        return $this->_libelle;
    }
    
    /**
     * 
     * @param string $libelle
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setlibelle($libelle) {
        $_libelle = CheckTyper::isString($libelle, 'libelle', __CLASS__);
        
        if(strlen($_libelle) > self::MAX_SIZE_LIBELLE)
        {
            throw new StringAttributeTooLong('libelle', __CLASS__);
        }
        $this->_libelle = $_libelle;
    }
}

<?php
namespace DubInfo_gestion_immobilier\model;

/**
 * Description of Commune
 *
 * @author Jenicot Alexandre
 */
class Commune {
    const MAX_SIZE_LIBELLE = 255;
    
    /**
     * @var int 
     */
    private $_id;
    
    /**
     * @var string 
     */
    private $_libelle;
    
    public function __construct() {
        ;
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
     * throws BadTypeException
     */
    public function setId($id) {
        $this->_id = CheckTyper::isInteger($id, 'id', __CLASS__);
    }
    
    /**
     * 
     * @return string
     */
    public function getLibelle() {
        return $this->_libelle;
    }
    
    /**
     * 
     * @param string $libelle
     * throws BadTypeException, StringAttributeTooLong
     */
    public function setLibelle($libelle) {
        $_libelle = CheckTyper::isString($libelle, 'libelle', __CLASS__);
        
        if(strlen($_libelle) > self::MAX_SIZE_LIBELLE) {
            throw new StringAttributeTooLong('libelle', __CLASS__);
        }
        
        $this->_libelle = $libelle;
    }
}

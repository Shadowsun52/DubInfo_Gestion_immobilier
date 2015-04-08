<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of Commune
 *
 * @author Jenicot Alexandre
 */
class Commune {
    const MAX_SIZE_LIBELLE = 255;
    const MAX_SIZE_CODE_POSTAL = 10;
    
    /**
     * @var int 
     */
    private $_id;
    
    /**
     * @var string 
     */
    private $_libelle;
    
    /**
     *
     * @var string 
     */
    private $_code_postal;
    /**
     * 
     * @param int $id
     * @param string $libelle
     * @param string $code_postal
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $libelle = NULL, $code_postal = NULL) {
        $this->setId($id);
        $this->setLibelle($libelle);
        $this->setCodePostal($code_postal);
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
     * 
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
    public function setLibelle($libelle) {
        $_libelle = CheckTyper::isString($libelle, 'libelle', __CLASS__);
        
        if(strlen($_libelle) > self::MAX_SIZE_LIBELLE) {
            throw new StringAttributeTooLong('libelle', __CLASS__);
        }
        
        $this->_libelle = $_libelle;
    }
    
    /**
     * 
     * @return string
     */
    public function getCodePostal() {
        return $this->_code_postal;
    }
    
    /**
     * 
     * @param string $code_postal
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setCodePostal($code_postal) {
        $_code_postal = CheckTyper::isString($code_postal, 'code postal', __CLASS__);
        
        if(strlen($_code_postal) > self::MAX_SIZE_CODE_POSTAL) {
            throw new StringAttributeTooLong('code postal', __CLASS__);
        }
        
        $this->_code_postal = $_code_postal;
    }
}

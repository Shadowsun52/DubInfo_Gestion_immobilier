<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of Ville
 *
 * @author Jenicot Alexandre
 */
class Ville {
    const MAX_SIZE_CODE_POSTAL = 10;
    const MAX_SIZE_NOM = 70;
    const MAX_SIZE_PAYS = 70;
    
    /**
     *
     * @var int
     */
    private $_id;
    
    /**
     *
     * @var string
     */
    private $_code_postal;
    
    /**
     *
     * @var string
     */
    private $_nom;
    
    /**
     *
     * @var string
     */
    private $_pays;
    
    /**
     * 
     * @param int $id
     * @param string $code_postal
     * @param string $nom
     * @param string $pays
     */
    public function __construct($id = NULL, $code_postal = NULL, $nom = NULL, 
            $pays = NULL) {
        $this->setId($id);
        $this->setCodePostal($code_postal);
        $this->setNom($nom);
        $this->setPays($pays);
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
    
    /**
     * 
     * @return string
     */
    public function getNom() {
        return $this->_nom;
    }
    
    /**
     * 
     * @param string $nom
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setNom($nom) {
        $_nom = CheckTyper::isString($nom, 'nom', __CLASS__);
        
        if(strlen($_nom) > self::MAX_SIZE_NOM) {
            throw new StringAttributeTooLong('nom', __CLASS__);
        }
        
        $this->_nom = $_nom;
    }
    
    /**
     * 
     * @return string
     */
    public function getPays() {
        return $this->_pays;
    }
    
    /**
     * 
     * @param string $pays
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setPays($pays) {
        $_pays = CheckTyper::isString($pays, 'pays', __CLASS__);
        
        if(strlen($_pays) > self::MAX_SIZE_PAYS) {
            throw new StringAttributeTooLong('pays', __CLASS__);
        }
        
        $this->_pays = $_pays;
    }
}

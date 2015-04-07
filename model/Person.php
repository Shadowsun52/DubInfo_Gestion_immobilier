<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;

/**
 * Description of Person
 *
 * @author Jenicot Alexandre
 */
abstract class Person {
    const MAX_SIZE_NOM = 45;
    const MAX_SIZE_PRENOM = 45;
    
    /**
     * @var int 
     */
    private $_id;
    
    /**
     * @var string 
     */
    private $_nom;
    
    /**
     * @var string 
     */
    private $_prenom;
    
    /**
     * 
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL) {
        $this->setId($id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
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
        
        $this->_nom = $nom;
    }
    
    /**
     * 
     * @return string
     */
    public function getPrenom() {
        return $this->_prenom;
    }
    
    /**
     * 
     * @param string $prenom
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setPrenom($prenom) {
        $_prenom = CheckTyper::isString($prenom, 'prenom', __CLASS__);
        
        if(strlen($_prenom) > self::MAX_SIZE_PRENOM) {
            throw new StringAttributeTooLong('prenom', __CLASS__);
        }
        
        $this->_prenom = $prenom;
    }
}

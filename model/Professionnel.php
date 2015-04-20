<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of Professionnel
 *
 * @author Jenicot Alexandre
 */
class Professionnel extends Contact implements \JsonSerializable{
    const MAX_SIZE_TVA = 45;
    const MAX_NOM_ENTREPRISE = 70;
    const MAX_NUM_COMPTE = 40;
    const MAX_SWIFT = 20;
    /**
     *
     * @var string 
     */
    private $_num_tva;
    
    /**
     *
     * @var string 
     */
    private $_nom_entreprise;
    
    /**
     *
     * @var Metier 
     */
    private $_metier;
    
    /**
     *
     * @var string
     */
    private $_num_compte;
    
    /**
     *
     * @var string
     */
    private $_swift;
    
    /**
     * 
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param string $num_telephone
     * @param string $num_gsm
     * @param string $mail
     * @param string $commentaire
     * @param string $num_tva
     * @param Etat $etat
     * @param Adresse $adresse
     * @param Metier $metier
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, 
            $num_telephone = NULL, $num_gsm = NULL, $mail = NULL, 
            $commentaire = NULL, $num_tva = NULL, $nom_entreprise = NULL, 
            $num_compte = NULL, $swift = NULL, $etat = NULL, $adresse = NULL, 
            $metier = NULL) {
        parent::__construct($id, $nom, $prenom, $num_telephone, $num_gsm, $mail, 
                $commentaire, $etat, $adresse);
        $this->setNumTva($num_tva);
        $this->setNomEntreprise($nom_entreprise);
        $this->setNumCompte($num_compte);
        $this->setSwift($swift);
        $this->setMetier($metier);
    }
    
    /**
     * 
     * @return string
     */
    public function getNumTva() {
        return $this->_num_tva;
    }
    
    /**
     * 
     * @param string $num_tva
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setNumTva($num_tva) {
        $_num_tva = CheckTyper::isString($num_tva, 'num_tva', __CLASS__);
        
        if(strlen($_num_tva) > self::MAX_SIZE_TVA) {
            throw new StringAttributeTooLong('num_tva', __CLASS__);
        }
        
        $this->_num_tva = $_num_tva;
    }
    
    /**
     * 
     * @return string
     */
    public function getNomEntreprise() {
        return $this->_nom_entreprise;
    }
    
    /**
     * 
     * @param string $nom_entreprise
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setNomEntreprise($nom_entreprise) {
        $_nom_entreprise = CheckTyper::isString($nom_entreprise, 'nom entreprise', __CLASS__);
        
        if(strlen($_nom_entreprise) > self::MAX_NOM_ENTREPRISE) {
            throw new StringAttributeTooLong('nom entreprise', __CLASS__);
        }
        
        $this->_nom_entreprise = $_nom_entreprise;
    }
    
    /**
     * 
     * @return Metier
     */
    public function getMetier() {
        return $this->_metier;
    }
    
    /**
     * 
     * @param Metier $metier
     * @throws BadTypeException
     */
    public function setMetier($metier) {
        $this->_metier = CheckTyper::isModel($metier, Metier::class, 'metier', __CLASS__);
    }
    
    /**
     * 
     * @return string
     */
    public function getNumCompte() {
        return $this->_num_compte;
    }
    
    /**
     * 
     * @param string $num_compte
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setNumCompte($num_compte) {
        $_num_compte = CheckTyper::isString($num_compte, 'num compte', __CLASS__);
        
        if(strlen($_num_compte) > self::MAX_NUM_COMPTE) {
            throw new StringAttributeTooLong('num compte', __CLASS__);
        }
        
        $this->_num_compte = $_num_compte;
    }
    
    /**
     * 
     * @return string
     */
    public function getSwift() {
        return $this->_swift;
    }
    
    /**
     * 
     * @param string $swift
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setSwift($swift) {
        $_swift = CheckTyper::isString($swift, 'swift', __CLASS__);
        
        if(strlen($_swift) > self::MAX_SWIFT) {
            throw new StringAttributeTooLong('swift', __CLASS__);
        }
        
        $this->_swift = $_swift;
    }
    
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(),
                array(
                    'num_tva' => $this->getNumTva(),
                    'nom_entreprise' => $this->getNomEntreprise(),
                    'num_compte' => $this->getNumCompte(),
                    'swift' => $this->getSwift(),
                    'metier' => $this->getMetier()
                ));
    }
}

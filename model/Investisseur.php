<?php

namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DubInfo_gestion_immobilier\Exception\ReadOusideArrayException;

/**
 * Description of Investisseur
 *
 * @author Jenicot Alexandre
 */
class Investisseur extends Contact{
    const MAX_SIZE_ADRESSE = 70;
    const MAX_SIZE_TVA = 45;
    
    /**
     * @var string 
     */
    private $_adresse;
    
    /**
     * @var string 
     */
    private $_num_tva;
    
    /**
     * 
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param string $num_telephone
     * @param string $num_gsm
     * @param string $num_fax
     * @param string $mail
     * @param string $adresse
     * @param Etat $etat
     * @param string $num_tva
     * @param string $commentaire
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL,
            $num_telephone = NULL, $num_gsm = NULL, $num_fax = NULL, $mail = NULL, 
            $adresse = NULL, $etat = NULL, $num_tva = NULL, $commentaire = NULL) {
        parent::__construct($id, $nom, $prenom, $num_telephone, $num_gsm, $num_fax,
                $mail,$commentaire, $etat);
        $this->setAdresse($adresse);
        $this->setNumTva($num_tva);
    }
    
    /**
     * 
     * @return string
     */
    public function getAdresse() {
        return $this->_adresse;
    }
    
    /**
     * 
     * @param string $adresse
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setAdresse($adresse) {
        $_adresse = CheckTyper::isString($adresse, 'adresse', __CLASS__);
        
        if(strlen($_adresse) > self::MAX_SIZE_ADRESSE) {
            throw new StringAttributeTooLong('adresse', __CLASS__);
        }
        
        $this->_adresse = $adresse;
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
        
        $this->_num_tva = $num_tva;
    }
}
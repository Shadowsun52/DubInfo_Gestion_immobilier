<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;

/**
 * Description of Contact
 *
 * @author Jenicot Alexandre
 */
class Contact extends Person implements \JsonSerializable{
    const MAX_SIZE_NUM = 20;
    const MAX_SIZE_MAIL = 70;
    const MAX_SIZE_COMMENTAIRE = 500;
    
    /**
     * @var string 
     */
    private $_num_telephone;
    
    /**
     * @var string 
     */
    private $_num_gsm;
    
    /**
     * @var string 
     */
    private $_mail;
    
    /**
     *
     * @var string 
     */
    private $_commentaire;
    
    /**
     * @var Etat 
     */
    private $_etat;
    
    /**
     *
     * @var Adresse 
     */
    private $_adresse;
    
    /**
     * 
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param string $num_telephone
     * @param string $num_gsm
     * @param string $num_fax
     * @param string $mail
     * @param string $commentaire
     * @param Etat   $etat
     * @param Adresse $adresse 
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, 
            $num_telephone = NULL, $num_gsm = NULL, $mail = NULL, 
            $commentaire = NULL, $etat = NULL, $adresse = NULL) {
        parent::__construct($id, $nom, $prenom);
        $this->setNumTelephone($num_telephone);
        $this->setNumGsm($num_gsm);
        $this->setMail($mail);
        $this->setCommentaire($commentaire);
        $this->setEtat($etat);
        $this->setAdresse($adresse);
    }
    
    /**
     * 
     * @return string
     */
    public function getNumTelephone() {
        return $this->_num_telephone;
    }
    
    /**
     * 
     * @param string $num_telephone
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setNumTelephone($num_telephone) {
        $_num_telephone = CheckTyper::isString($num_telephone, 'num_telephone', __CLASS__);
        
        if(strlen($_num_telephone) > self::MAX_SIZE_NUM) {
            throw new StringAttributeTooLong('num_telephone', __CLASS__);
        }
        
        $this->_num_telephone = $_num_telephone;
    }
    
    /**
     * 
     * @return string
     */
    public function getNumGsm() {
        return $this->_num_gsm;
    }
    
    /**
     * 
     * @param string $num_gsm
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setNumGsm($num_gsm) {
        $_num_gsm = CheckTyper::isString($num_gsm, 'num_gsm', __CLASS__);
        
        if(strlen($_num_gsm) > self::MAX_SIZE_NUM) {
            throw new StringAttributeTooLong('num_gsm', __CLASS__);
        }
        
        $this->_num_gsm = $_num_gsm;
    }
    
    /**
     * 
     * @return string
     */
    public function getMail() {
        return $this->_mail;
    }
    
    /**
     * 
     * @param string $mail
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setMail($mail) {
        $_mail = CheckTyper::isString($mail, 'mail', __CLASS__);
        
        if(strlen($_mail) > self::MAX_SIZE_MAIL) {
            throw new StringAttributeTooLong('mail', __CLASS__);
        }
        
        $this->_mail = $_mail;
    }
    
    /**
     * 
     * @return string
     */
    public function getCommentaire() {
        return $this->_commentaire;
    }
    
    /**
     * 
     * @param string $commentaire
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setCommentaire($commentaire) {
        $_commentaire = CheckTyper::isString($commentaire, 'commentaire', __CLASS__);
        
        if(strlen($_commentaire) > self::MAX_SIZE_COMMENTAIRE) {
            throw new StringAttributeTooLong('commentaire', __CLASS__);
        }
        
        $this->_commentaire = $_commentaire;
    }
    
    /**
     * 
     * @return Etat
     */
    public function getEtat() {
        return $this->_etat;
    }
    
    /**
     * 
     * @param Etat $etat
     * @throws BadTypeException
     */
    public function setEtat($etat) {
        $this->_etat = CheckTyper::isModel($etat, Etat::class, 'etat', __CLASS__);
    }
    
    /**
     * 
     * @return Adresse
     */
    public function getAdresse() {
        return $this->_adresse;
    }
    
    /**
     * 
     * @param Adresse $adresse
     * @throws BadTypeException
     */
    public function setAdresse($adresse) {
        $this->_adresse = CheckTyper::isModel($adresse, Adresse::class, 
                'adresse', __CLASS__);
    }
    
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), 
                array(
                    'num_tel' =>  $this->getNumTelephone(),
                    'num_gsm' => $this->getNumGsm(),
                    'mail' => $this->getMail(),
                    'commentaire' => $this->getCommentaire(),
                    'etat' => $this->getEtat(),
                    'adresse' => $this->getAdresse()
                ));
    }
}

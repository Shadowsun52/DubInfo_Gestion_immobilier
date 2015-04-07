<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;

/**
 * Description of Contact
 *
 * @author Jenicot Alexandre
 */
class Contact extends Person{
    const MAX_SIZE_NUM = 20;
    const MAX_SIZE_MAIL = 70;
    
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
    private $_num_fax;
    
    /**
     * @var string 
     */
    private $_mail;
    
    /**
     * @var Etat 
     */
    private $_etat;
    
    /**
     * 
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param string $num_telephone
     * @param string $num_gsm
     * @param string $num_fax
     * @param string $mail
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, 
            $num_telephone = NULL, $num_gsm = NULL, $num_fax = NULL, 
            $mail = NULL, $etat = NULL) {
        parent::__construct($id, $nom, $prenom);
        $this->setNumTelephone($num_telephone);
        $this->setNumGsm($num_gsm);
        $this->setNumFax($num_fax);
        $this->setMail($mail);
        $this->setEtat($etat);
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
        
        $this->_num_telephone = $num_telephone;
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
        
        $this->_num_gsm = $num_gsm;
    }
    
    /**
     * 
     * @return string
     */
    public function getNumFax() {
        return $this->_num_fax;
    }
    
    /**
     * 
     * @param string $num_fax
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setNumFax($num_fax) {
        $_num_fax = CheckTyper::isString($num_fax, 'num_fax', __CLASS__);
        
        if(strlen($_num_fax) > self::MAX_SIZE_NUM) {
            throw new StringAttributeTooLong('num_fax', __CLASS__);
        }
        
        $this->_num_fax = $num_fax;
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
        
        $this->_mail = $mail;
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
}

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
    
    /**
     *
     * @var string 
     */
    private $_num_tva;
    
    /**
     *
     * @var Metier 
     */
    private $_metier;
    
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
     * @param string $num_tva
     * @param Etat $etat
     * @param Adresse $adresse
     * @param Metier $metier
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, 
            $num_telephone = NULL, $num_gsm = NULL, $mail = NULL, 
            $commentaire = NULL, $num_tva = NULL, $etat = NULL, $adresse = NULL, 
            $metier = NULL) {
        parent::__construct($id, $nom, $prenom, $num_telephone, $num_gsm, $mail, 
                $commentaire, $etat, $adresse);
        $this->setNumTva($num_tva);
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
    
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(),
                array(
                    'num_tva' => $this->getNumTva(),
                    'metier' => $this->getMetier()
                ));
    }
}

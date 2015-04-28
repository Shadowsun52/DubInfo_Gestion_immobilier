<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of VisiteLocataire
 *
 * @author Jenicot Alexandre
 */
class VisiteLocataire extends VisiteMaison{
    /**
     * Détermine si le locataire de la visite est candidat ou non pour la maison
     * @var boolean 
     */
    private $_candidat;
    
    /**
     *
     * @var Locataire 
     */
    private $_locataire;
    
    /**
     * 
     * @param int $id
     * @param DateTime $date
     * @param string $rapport
     * @param boolean $candidat
     * @param Maison $maison
     * @param Locataire $locataire
     * @param array[User] $participants
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $date = NULL, $rapport = NULL, 
            $candidat = NULL, $maison = NULL, $locataire = NULL, $participants = NULL) {
        parent::__construct($id, $date, $rapport, $maison, $participants);
        $this->setCandidat($candidat);
        $this->setLocataire($locataire);
    }
    
    /**
     * 
     * @return boolean
     */
    public function getCandidat() {
        return $this->_candidat;
    }
    
    /**
     * 
     * @param boolean $candidat
     */
    public function setCandidat($candidat) {
        $this->_candidat = CheckTyper::isBoolean($candidat, 'candidat', __CLASS__);
    }
    
    /**
     * 
     * @return Locataire
     */
    public function getLocataire() {
        return $this->_locataire;
    }
    
    /**
     * 
     * @param Locataire $locataire
     */
    public function setLocataire($locataire) {
        $this->_locataire = CheckTyper::isModel($locataire, Locataire::class, 
                'locataire', __CLASS__);
    }
    
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), 
                array(
                    'locataire' =>  $this->getLocataire(),
                    'candidat' => $this->getCandidat()
                ));
    }
    
    public function toString() {
        return $this->getMaison()->getTitre(Maison::LANGUAGE_FR) . ' ' 
                . parent::toString();
    }
}

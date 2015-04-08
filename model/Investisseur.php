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
     * Liste des visites de maison par l'investisseur
     * @var array[VisiteMaisonInvestisseur] 
     */
    private $_visites;
    
    /**
     *
     * @var array[LettreMission] 
     */
    private $_lettres_mission;
    
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
     * @param VisiteMaisonLocataire $visites Liste des maisons visitées par l'investisseur
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL,
            $num_telephone = NULL, $num_gsm = NULL, $num_fax = NULL, $mail = NULL, 
            $adresse = NULL, $etat = NULL, $num_tva = NULL, $commentaire = NULL,
            $visites = NULL, $lettres_mission = NULL) {
        parent::__construct($id, $nom, $prenom, $num_telephone, $num_gsm, $num_fax,
                $mail,$commentaire, $etat);
        $this->setAdresse($adresse);
        $this->setNumTva($num_tva);
        $this->setVisites($visites);
        $this->setLettresMission($lettres_mission);
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
        
        $this->_adresse = $_adresse;
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

//<editor-fold defaultstate="collapsed" desc="Visites">
    /**
     * 
     * @return array[VisiteMaisonInvestisseur]
     */
    public function getVisites() {
        return $this->_visites;
    }
    
    /**
     * 
     * @param array[VisiteMaisonInvestisseur] $visites
     * @throws BadTypeException
     */
    public function setVisites($visites) {
        $this->_visites = CheckTyper::isArrayOfModel($visites,
                VisiteMaisonInvestisseur::class, 'visites', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return VisiteMaisonInvestisseur
     * @throws ReadOusideArrayException
     */
    public function getVisite($id) {
        if($id < count($this->_visites)) {
            return $this->_visites[$id];
        }
        
        throw new ReadOusideArrayException('visites', __CLASS__);
    }
    
    /**
     * 
     * @param VisiteMaisonInvestisseur $visite
     * @throws BadTypeException
     */
    public function addVisite($visite) {
        $this->_visites[] = CheckTyper::isModel($visite, 
                VisiteMaisonInvestisseur::class, 'visites', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Lettres mission">
    /**
     * 
     * @return array[LettreMission]
     */
    public function getLettresMission() {
        return $this->_lettres_mission;
    }
    
    /**
     * 
     * @param array[LettreMission] $lettres_mission
     * @throws BadTypeException
     */
    public function setLettresMission($lettres_mission) {
        $this->_lettres_mission = CheckTyper::isArrayOfModel($lettres_mission,
                LettreMission::class, 'lettres mission', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return LettreMission
     * @throws ReadOusideArrayException
     */
    public function getLettreMission($id) {
        if($id < count($this->_visites)) {
            return $this->_visites[$id];
        }
        
        throw new ReadOusideArrayException('lettres mission', __CLASS__);
    }
    
    /**
     * 
     * @param LettreMission $lettre_mission
     * @throws BadTypeException
     */
    public function addLettreMission($lettre_mission) {
        $this->_lettres_mission[] = CheckTyper::isModel($lettre_mission, 
                LettreMission::class, 'lettres mission', __CLASS__);
    }
//</editor-fold>
}
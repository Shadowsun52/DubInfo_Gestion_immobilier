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
class Investisseur extends Contact implements \JsonSerializable{
    const MAX_SIZE_ADRESSE = 70;
    const MAX_SIZE_TVA = 45;
    
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
     * @var boolean 
     */
    private $_lettre_mission;
    
    /**
     *
     * @var double 
     */
    private $_budget;
    
    /**
     *
     * @var array[Offre]
     */
    private $_offres;
    
    /**
     *
     * @var array[Projet]
     */
    private $_projets;
    
    /**
     * 
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param string $num_telephone
     * @param string $num_gsm
     * @param string $mail
     * @param Adresse $adresse
     * @param Etat $etat
     * @param string $num_tva
     * @param string $commentaire
     * @param boolean $lettre_mission
     * @param double $budget
     * @param array[VisiteMaisonLocataire] $visites Liste des maisons visitées par l'investisseur
     * @param boolean $lettre_mission 
     * @param array[Offre] $offres 
     * @param array[Projet] $projets
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL,
            $num_telephone = NULL, $num_gsm = NULL, $mail = NULL, $adresse = NULL, 
            $etat = NULL, $num_tva = NULL, $commentaire = NULL, $lettre_mission = NULL ,
            $budget = NULL, $visites = NULL, $offres = NULL, $projets = NULL) {
        parent::__construct($id, $nom, $prenom, $num_telephone, $num_gsm, $mail,
                $commentaire, $etat, $adresse);
        $this->setNumTva($num_tva);
        $this->setVisites($visites);
        $this->setLettreMission($lettre_mission);
        $this->setBudget($budget);
        $this->setOffres($offres);
        $this->setProjets($projets);
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
     * @return double
     */
    public function getBudget() {
        return $this->_budget;
    }
    
    /**
     * 
     * @param double $budget
     * @throws BadTypeException
     */
    public function setBudget($budget) {
        $this->_budget = CheckTyper::isDouble($budget, 'budget', __CLASS__);
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
     * @return boolean
     */
    public function getLettreMission() {
        return $this->_lettre_mission;
    }
    
    /**
     * 
     * @param boolean $lettre_mission
     * @throws BadTypeException
     */
    public function setLettreMission($lettre_mission) {
        $this->_lettre_mission = CheckTyper::isBoolean($lettre_mission, 
                'lettre mission', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Offres">
    /**
     * 
     * @return array[Offre]
     */
    public function getOffres() {
        return $this->_offres;
    }
    
    /**
     * 
     * @param array[Offre] $offres
     * @throws BadTypeException
     */
    public function setOffres($offres) {
        $this->_offres = CheckTyper::isArrayOfModel($offres, Offre::class,
                'offres', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return Offre
     * @throws ReadOusideArrayException
     */
    public function getOffre($id) {
        if($id < count($this->_offres)) {
            return $this->_offres[$id];
        }
        
        throw new ReadOusideArrayException('offres', __CLASS__);
    }
    
    /**
     * 
     * @param Offre $offre
     * @throws BadTypeException
     */
    public function addOffre($offre) {
        $this->_offres[] = CheckTyper::isModel($offre, Offre::class, 
                'offres', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Projets">
    /**
     * 
     * @return array[Projet]
     */
    public function getProjets() {
        return $this->_projets;
    }
    
    /**
     * 
     * @param array[Projet] $projets
     * @throws BadTypeException
     */
    public function setProjets($projets) {
        $this->_projets = CheckTyper::isArrayOfModel($projets, Projet::class,
                'projets', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return Projet
     * @throws ReadOusideArrayException
     */
    public function getProjet($id) {
        if($id < count($this->_projets)) {
            return $this->_projets[$id];
        }
        
        throw new ReadOusideArrayException('projets', __CLASS__);
    }
    
    /**
     * 
     * @param Projet $projet
     * @throws BadTypeException
     */
    public function addProjet($projet) {
        $this->_projets[] = CheckTyper::isModel($projet, Projet::class, 
                'projets', __CLASS__);
    }
//</editor-fold>
    
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(),
                array(
                    'num_tva' => $this->getNumTva(),
                    'lettre_mission' => $this->getLettreMission(),
                    'budget' => $this->getBudget()
                ));
    }
    
    public function toString() {
        return parent::toString() . ' (' . $this->getEtat()->getLibelle() .')';
    }
}
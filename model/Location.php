<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DubInfo_gestion_immobilier\Exception\ReadOusideArrayException;
/**
 * Description of Location
 *
 * @author Jenicot Alexandre
 */
class Location {
    /**
     *
     * @var int 
     */
    private $_id;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_debut;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_fin;
    
    /**
     *
     * @var double 
     */
    private $_loyer;
    
    /**
     *
     * @var double 
     */
    private $_charges;
    
    /**
     *
     * @var Locataire 
     */
    private $_locataire;
    
    /**
     *
     * @var array[Paiement] 
     */
    private $_Paiements;
    
    /**
     * 
     * @param int $id
     * @param DateTime $date_debut
     * @param DateTime $date_fin
     * @param double $loyer
     * @param double $charges
     * @param Locataire $locataire
     * @param array[Paiement] $paiement
     */
    public function __construct($id = NULL, $date_debut = NULL, $date_fin = NULL,
            $loyer = NULL, $charges = NULL, $locataire = NULL, $paiement = NULL) {
        $this->setId($id);
        $this->setDateDebut($date_debut);
        $this->setDateFin($date_fin);
        $this->setLoyer($loyer);
        $this->setCharges($charges);
        $this->setLocataire($locataire);
        $this->setPaiement($paiement);
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
    public function getDateDebut() {
        return $this->_date_debut;
    }
    
    /**
     * 
     * @param DateTime $date_debut
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setDateDebut($date_debut) {
        $this->_date_debut = CheckTyper::isDateTime($date_debut, 'date début', __CLASS__);
    }
    
    /**
     * 
     * @return DateTime
     */
    public function getDateFin() {
        return $this->_date_fin;
    }
    
    /**
     * 
     * @param DateTime $date_fin
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setDateFin($date_fin) {
        $this->_date_fin = CheckTyper::isDateTime($date_fin, 'date fin', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getLoyer() {
        return $this->_loyer;
    }
    
    /**
     * 
     * @param double $loyer
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setLoyer($loyer) {
        $this->_loyer = CheckTyper::isDouble($loyer, 'loyer', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getCharges() {
        return $this->_charges;
    }
    
    /**
     * 
     * @param double $charges
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setCharges($charges) {
        $this->_charges = CheckTyper::isDouble($charges, 'charges', __CLASS__);
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
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setLocataire($locataire) {
        $this->_locataire = CheckTyper::isModel($locataire, Locataire::class,
                'locataire', __CLASS__);
    }
    
    /**
     * 
     * @return array[Paiement]
     */
    public function getPaiement() {
        return $this->_Paiements;
    }
    
    /**
     * 
     * @param array[Paiement] $paiement
     * @throws BadTypeException
     */
    public function setPaiement($paiement) {
        $this->_Paiements = CheckTyper::isArrayOfModel($paiement, Paiement::class,
                'paiements', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return Paiement
     * @throws ReadOusideArrayException
     */
    public function getPaiement($id) {
        if($id < count($this->_Paiements)) {
            return $this->_Paiements[$id];
        }
        
        throw new ReadOusideArrayException('Paiement', __CLASS__);
    }
    
    /**
     * 
     * @param Paiement $paiement
     * @throws BadTypeException
     */
    public function addPaiement($paiement) {
        $this->_sources[] = CheckTyper::isModel($paiement, Paiement::class, 
                'Paiement', __CLASS__);
    }
}

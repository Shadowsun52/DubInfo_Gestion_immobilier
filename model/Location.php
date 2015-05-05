<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DubInfo_gestion_immobilier\Exception\ReadOusideArrayException;
use DateTime;
/**
 * Description of Location
 *
 * @author Jenicot Alexandre
 */
class Location implements \JsonSerializable{
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
     * @var boolean 
     */
    private $_bail_signe;
    
    /**
     *
     * @var boolean 
     */
    private $_etat_lieux_signe;
    
    /**
     *
     * @var boolean 
     */
    private $_charte_signee;
    
    /**
     *
     * @var double 
     */
    private $_garantie_locative_totale;
    
    /**
     *
     * @var double 
     */
    private $_garantie_locative_payee;
    
    /**
     *
     * @var Locataire 
     */
    private $_locataire;
    
    /**
     *
     * @var Chambre 
     */
    private $_chambre;

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
     * @param boolean $bail_signe
     * @param boolean $charte_signee
     * @param boolean $etat_lieux_signe
     * @param double $garantie_locative_totale
     * @param double $garantie_locative_payee
     * @param Locataire $locataire
     * @param Chambre $chambre
     * @param array[Paiement] $paiements
     * @throws BadTypeException
     */
    public function __construct($id = NULL, $date_debut = NULL, $date_fin = NULL,
            $loyer = NULL, $charges = NULL, $bail_signe = NULL, $charte_signee = NULL, 
            $etat_lieux_signe = NULL, $garantie_locative_totale = NULL,
            $garantie_locative_payee = NULL, $locataire = NULL, $chambre = NULL, 
            $paiements = NULL) {
        $this->setId($id);
        $this->setDateDebut($date_debut);
        $this->setDateFin($date_fin);
        $this->setLoyer($loyer);
        $this->setCharges($charges);
        $this->setBailSigne($bail_signe);
        $this->setCharteSignee($charte_signee);
        $this->setEtatLieuSigne($etat_lieux_signe);
        $this->setGarantieLocativeTotal($garantie_locative_totale);
        $this->setGarantieLocativePayee($garantie_locative_payee);
        $this->setLocataire($locataire);
        $this->setPaiements($paiements);
        $this->setChambre($chambre);
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
     */
    public function setCharges($charges) {
        $this->_charges = CheckTyper::isDouble($charges, 'charges', __CLASS__);
    }
    
    /**
     * 
     * @return boolean
     */
    public function getBailSigne() {
        return $this->_bail_signe;
    }
    
    /**
     * 
     * @param boolean $bail_signe
     * @throws BadTypeException
     */
    public function setBailSigne($bail_signe) {
        $this->_bail_signe = CheckTyper::isBoolean($bail_signe, 'bail signé', __CLASS__);
    }
    
    /**
     * 
     * @return boolean
     */
    public function getEtatLieuSigne() {
        return $this->_etat_lieux_signe;
    }
    
    /**
     * 
     * @param boolean $etat_lieux_signe
     * @throws BadTypeException
     */
    public function setEtatLieuSigne($etat_lieux_signe) {
        $this->_etat_lieux_signe = CheckTyper::isBoolean($etat_lieux_signe, 
                'état lieux signé', __CLASS__);
    }
    
    /**
     * 
     * @return boolean
     */
    public function getCharteSignee() {
        return $this->_charte_signee;
    }
    
    /**
     * 
     * @param boolean $charte_signee
     * @throws BadTypeException
     */
    public function setCharteSignee($charte_signee) {
        $this->_charte_signee = CheckTyper::isBoolean($charte_signee, 
                'charte signée', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getGarantieLocativeTotal() {
        return $this->_garantie_locative_totale;
    }
    
    /**
     * 
     * @param double $garantie_locative_total
     * @throws BadTypeException
     */
    public function setGarantieLocativeTotal($garantie_locative_total) {
        $this->_garantie_locative_totale = CheckTyper::isDouble(
                $garantie_locative_total, 'garantie locative totale', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getGarantieLocativePayee() {
        return $this->_garantie_locative_payee;
    }
    
    /**
     * 
     * @param double $garantie_locative_payee
     * @throws BadTypeException
     */
    public function setGarantieLocativePayee($garantie_locative_payee) {
        $this->_garantie_locative_payee = CheckTyper::isDouble(
                $garantie_locative_payee, 'garantie locative payee', __CLASS__);
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
     */
    public function setLocataire($locataire) {
        $this->_locataire = CheckTyper::isModel($locataire, Locataire::class,
                'locataire', __CLASS__);
    }
    
    /**
     * 
     * @return Chambre
     */
    public function getChambre() {
        return $this->_chambre;
    }
    
    /**
     * 
     * @param Chambre $chambre
     * @throws BadTypeException
     */
    public function setChambre($chambre) {
        $this->_chambre = CheckTyper::isModel($chambre, Chambre::class,
                'chambre', __CLASS__);
    }
    
    /**
     * 
     * @return array[Paiement]
     */
    public function getPaiements() {
        return $this->_Paiements;
    }
    
    /**
     * 
     * @param array[Paiement] $paiements
     * @throws BadTypeException
     */
    public function setPaiements($paiements) {
        $this->_Paiements = CheckTyper::isArrayOfModel($paiements, Paiement::class,
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

    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'date_debut' => ($this->getDateDebut() == NULL)? NULL 
                : $this->getDateDebut()->format('d-m-Y'),
            'date_fin' => ($this->getDateFin() == NULL)? NULL 
                : $this->getDateFin()->format('d-m-Y'),
            'loyer' => $this->getLoyer(),
            'charges' => $this->getCharges(),
            'bail_signe' => $this->getBailSigne(),
            'charte_signee' => $this->getCharteSignee(),
            'etat_lieux_signe' => $this->getEtatLieuSigne(),
            'garantie_locative_totale' => $this->getGarantieLocativeTotal(),
            'garantie_locative_payee' => $this->getGarantieLocativePayee(),
            'locataire' => $this->getLocataire(),
            'chambre' => $this->getChambre(),
            'paiement' => $this->getPaiements(),
            'toString' => $this->toString()
        ];
    }
    
    /**
     *
     * @return string
     */
    public function toString() {
        if($this->getDateDebut() === NULL && $this->getDateFin() === NULL) {
            return "Location (id=" . $this->getId() . ')';
        }
        return 'Du ' . (($this->getDateDebut() === NULL)? '...' : $this->getDateDebut()->format('d-m-Y'))
               . ' au ' . (($this->getDateFin() === NULL)? '...' : $this->getDateFin()->format('d-m-Y'));
    }
}

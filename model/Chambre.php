<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DubInfo_gestion_immobilier\Exception\ReadOusideArrayException;
/**
 * Description of Chambre
 *
 * @author Jenicot Alexandre
 */
class Chambre {
    /**
     *
     * @var int 
     */
    private $_id;
    
    /**
     *
     * @var int 
     */
    private $_numero;
    
    /**
     *
     * @var int 
     */
    private $_etage;
    
    /**
     *
     * @var double 
     */
    private $_prix;
    
    /**
     *
     * @var double 
     */
    private $_charges;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_disponible;
    
    /**
     *
     * @var boolean 
     */
    private $_disponible;
    
    /**
     *
     * @var array[Location] 
     */
    private $_locations;
    
    /**
     * 
     * @param int $id
     * @param int $numero
     * @param int $etage
     * @param double $prix
     * @param double $charges
     * @param DateTime $date_disponible
     * @param boolean $disponible
     * @param array[Location] $locations
     * @throws BadTypeException
     */
    public function __construct($id = NULL, $numero = NULL, $etage = NULL, $prix = NULL, 
            $charges = NULL, $date_disponible = NULL, $disponible = NULL, $locations = NULL) {
        $this->setId($id);
        $this->setNumero($numero);
        $this->setEtage($etage);
        $this->setPrix($prix);
        $this->setCharges($charges);
        $this->setDateDisponible($date_disponible);
        $this->setDisponible($disponible);
        $this->setLocations($locations);
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
     * @return int
     */
    public function getNumero() {
        return $this->_numero;
    }
    
    /**
     * 
     * @param int $numero
     * @throws BadTypeException
     */
    public function setNumero($numero) {
        $this->_numero = CheckTyper::isInteger($numero, 'numero', __CLASS__);
    }
    
    /**
     * 
     * @return int
     */
    public function getEtage() {
        return $this->_etage;
    }
    
    /**
     * 
     * @param int $etage
     * @throws BadTypeException
     */
    public function setEtage($etage) {
        $this->_etage = CheckTyper::isInteger($etage, 'etage', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getPrix() {
        return $this->_prix;
    }
    
    /**
     * 
     * @param double $prix
     * @throws BadTypeException
     */
    public function setPrix($prix) {
        $this->_prix = CheckTyper::isDouble($prix, 'prix', __CLASS__);
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
     * @return DateTime
     */
    public function getDateDisponible() {
        return $this->_date_disponible;
    }
    
    /**
     * 
     * @param DateTime $date_disponible
     * @throws BadTypeException
     */
    public function setDateDisponible($date_disponible) {
        $this->_date_disponible = CheckTyper::isDateTime($date_disponible, 
                'date disponible', __CLASS__);
    }
    
    /**
     * 
     * @return boolean
     */
    public function getDisponible() {
        return $this->_disponible;
    }
    
    /**
     * 
     * @param boolean $disponible
     * @throws BadTypeException
     */
    public function setDisponible($disponible) {
        $this->_disponible = CheckTyper::isBoolean($disponible, 'disponible', __CLASS__);
    }
    
    /**
     * 
     * @return array[Location]
     */
    public function getLocations() {
        return $this->_locations;
    }
    
    /**
     * 
     * @param array[Location] $location
     * @throws BadTypeException
     */
    public function setLocations($location) {
        $this->_locations = CheckTyper::isArrayOfModel($location, Location::class,
                'locations', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return Location
     * @throws ReadOusideArrayException
     */
    public function getLocation($id) {
        if($id < count($this->_locations)) {
            return $this->_locations[$id];
        }
        
        throw new ReadOusideArrayException('locations', __CLASS__);
    }
    
    /**
     * 
     * @param SourceLocataire $location
     * @throws BadTypeException
     */
    public function addLocation($location) {
        $this->_locations[] = CheckTyper::isModel($location, Location::class, 
                'location', __CLASS__);
    }
}

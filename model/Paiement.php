<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\model\Location;
use DubInfo_gestion_immobilier\Exception\BadTypeException;

/**
 * Description of Paiement
 *
 * @author Jenicot Alexandre
 */
class Paiement implements \JsonSerializable{
    
    /**
     * @var int 
     */
    private $_id;
    
    /**
     * @var int 
     */
    private $_mois;
    
    /**
     * @var int 
     */
    private $_annee;
    
    /**
     *
     * @var double
     */
    private $_loyer_paye;
    
    /**
     *
     * @var Location
     */
    private $_location;
    
    /**
     *
     * @var array[string] 
     */
    static private $_noms_mois = ['janvier', 'février', 'mars', 'avril', 'mai', 
        'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

    /**
     * 
     * @param int $id
     * @param int $mois
     * @param int $annee
     * @param double $loyer_paye
     * @param Location $location 
     * @throws BadTypeException
     */
    public function __construct($id = NULL, $mois = NULL, $annee = NULL, 
            $loyer_paye = NULL, $location = NULL) {
        $this->setId($id);
        $this->setMois($mois);
        $this->setAnnee($annee);
        $this->setLoyerPayer($loyer_paye);
        $this->setLocation($location);
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
    public function getMois() {
        return $this->_mois;
    }
    
    /**
     * 
     * @param int $mois
     * @throws BadTypeException
     */
    public function setMois($mois) {
        $this->_mois = CheckTyper::isInteger($mois, 'mois', __CLASS__);
    }
    
    /**
     * 
     * @return int
     */
    public function getAnnee() {
        return $this->_annee;
    }
    
    /**
     * 
     * @param int $annee
     * @throws BadTypeException
     */
    public function setAnnee($annee) {
        $this->_annee = CheckTyper::isInteger($annee, 'annee', __CLASS__);
    }

    /**
     * 
     * @return double
     */
    public function getLoyerPaye() {
        return $this->_loyer_paye;
    }
    
    /**
     * 
     * @param double $loyer_paye
     * @throws BadTypeException
     */
    public function setLoyerPayer($loyer_paye) {
        $this->_loyer_paye = CheckTyper::isDouble($loyer_paye, 'loyer payé', __CLASS__);
    }
    
    /**
     * 
     * @return Location
     */
    public function getLocation() {
        return $this->_location;
    }
    
    /**
     * 
     * @param Location $location
     * @throws BadTypeException
     */
    public function setLocation($location) {
        $this->_location = CheckTyper::isModel($location, Location::class, 
                'location', __CLASS__);
    }
    
    /**
     * 
     * @return array[string]
     */
    static public function getNomsMois() {
        return self::$_noms_mois;
    }
    
    /**
     * 
     * @param int $nb Numéro du mois (0 = janvier, etc)
     */
    static public function getNomMois($nb) {
        return self::$_noms_mois[$nb];
    }
        
    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'mois' => $this->getMois(),
            'annee' => $this->getAnnee(),
            'loyer_paye' => $this->getLoyerPaye(),
            'toString' => $this->toString()
        ];
    }
    
    /**
     *
     * @return string
     */
    public function toString() {
        return self::getNomMois($this->getMois()) . ' ' . $this->getAnnee();
    }

}

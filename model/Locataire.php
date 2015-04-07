<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DubInfo_gestion_immobilier\Exception\ReadOusideArrayException;
/**
 * Description of Locataire
 *
 * @author Jenicot Alexandre
 */
class Locataire extends Contact{
    const MAX_SIZE_COMMENTAIRE = 500;
    
    /**
     *
     * @var double 
     */
    private $_budget;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_emmenagement;
    
    /**
     *
     * @var string 
     */
    private $_commentaire;
    
    /**
     *
     * @var array[SourceLocataire] 
     */
    private $_sources;
    
    /**
     *
     * @var array[Commune] 
     */
    private $_communes_preferees;
    
    /**
     *
     * @var array[Location] 
     */
    private $_locations;
    
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, 
            $num_telephone = NULL, $num_gsm = NULL, $num_fax = NULL, $mail = NULL, 
            $budget = NULL, $date_emmenagement = NULL, $etat = NULL, $commentaire = NULL, 
            $sources = NULL, $communes_preferees = NULL, $locations = NULL) {
        parent::__construct($id, $nom, $prenom, $num_telephone, $num_gsm, $num_fax, $mail, $etat);
        $this->setBudget($budget);
        $this->setDateEmmenagement($date_emmenagement);
        $this->setCommentaire($commentaire);
        $this->setSources($sources);
        $this->setCommunesPreferees($communes_preferees);
        $this->setLocations($locations);
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
    
    /**
     * 
     * @return DateTime
     */
    public function getDateTime() {
        return $this->_date_emmenagement;
    }
    
    /**
     * 
     * @param DateTime $date_emmenagement
     * @throws BadTypeException
     */
    public function setDateEmmenagement($date_emmenagement) {
        $this->_date_emmenagement = CheckTyper::isDateTime($date_emmenagement, 
                'date_emmenagement', __CLASS__);
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
        
        $this->_commentaire = $commentaire;
    }
    
    /**
     * 
     * @return array[SourceLocataire]
     */
    public function getSources() {
        return $this->_sources;
    }
    
    /**
     * 
     * @param array[SourceLocataire] $sources
     * @throws BadTypeException
     */
    public function setSources($sources) {
        $this->_sources = CheckTyper::isArrayOfModel($sources, SourceLocataire::class,
                'sources', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return SourceLocataire
     * @throws ReadOusideArrayException
     */
    public function getSource($id) {
        if($id < count($this->_sources)) {
            return $this->_sources[$id];
        }
        
        throw new ReadOusideArrayException('Sources', __CLASS__);
    }
    
    /**
     * 
     * @param SourceLocataire $source
     * @throws BadTypeException
     */
    public function addSource($source) {
        $this->_sources[] = CheckTyper::isModel($source, SourceLocataire::class, 
                'Source', __CLASS__);
    }
    
    /**
     * 
     * @return array[Commune]
     */
    public function getCommunesPreferees() {
        return $this->_communes_preferees;
    }
    
    /**
     * 
     * @param array[Commune] $communes_preferees
     * @throws BadTypeException
     */
    public function setCommunesPreferees($communes_preferees) {
        $this->_communes_preferees = CheckTyper::isArrayOfModel($communes_preferees, Commune::class,
                'Communes preferees', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return Commune
     * @throws ReadOusideArrayException
     */
    public function getCommunePreferee($id) {
        if($id < count($this->_communes_preferees)) {
            return $this->_communes_preferees[$id];
        }
        
        throw new ReadOusideArrayException('Communes preferees', __CLASS__);
    }
    
    /**
     * 
     * @param Commune $commune_preferee
     * @throws BadTypeException
     */
    public function addCommunePreferee($commune_preferee) {
        $this->_communes_preferees[] = CheckTyper::isModel($commune_preferee, Commune::class, 
                'Commune prefere', __CLASS__);
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
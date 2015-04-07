<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\BadTypeException;

/**
 * Description of Paiement
 *
 * @author Jenicot Alexandre
 */
class Paiement {
    
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
     * @param int $id
     * @param int $mois
     * @param int $annee
     * @throws BadTypeException
     */
    public function __construct($id = NULL, $mois = NULL, $annee = NULL) {
        $this->setId($id);
        $this->setMois($mois);
        $this->setAnnee($annee);
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
        return $this->_id;
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
}

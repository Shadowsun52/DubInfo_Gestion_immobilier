<?php
namespace DubInfo_gestion_immobilier\model;

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
     */
    public function __construct($id, $mois, $annee) {
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
     */
    public function setId($id) {
        $this->_id = $id;
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
     */
    public function setMois($mois) {
        $this->_mois = $mois;
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
     */
    public function setAnnee($annee) {
        $this->_annee = $annee;
    }
}

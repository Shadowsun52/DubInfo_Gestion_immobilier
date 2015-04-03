<?php
namespace DubInfo_gestion_immobilier\model;

/**
 * Description of Etat
 *
 * @author Jenicot Alexandre
 */
class Etat {
    
    /**
     * @var int 
     */
    private $_id;
    
    /**
     * @var string 
     */
    private $_libelle;
    
    /**
     * 
     * @param int $id
     * @param libelle $libelle
     */
    public function __construct($id, $libelle) {
        $this->setId($id);
        $this->setlibelle($libelle);
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
     * @return string
     */
    public function getLibelle() {
        return $this->_libelle;
    }
    
    /**
     * 
     * @param string $libelle
     */
    public function setlibelle($libelle) {
        $this->_libelle = $libelle;
    }
}

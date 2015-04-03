<?php
namespace DubInfo_gestion_immobilier\model;

/**
 * Description of Source
 *
 * @author Alexandre
 */
abstract class Source {
    /**
     * @var int 
     */
    private $_id;
    
    /**
     * @var string 
     */
    private $_libelle;
    
    /**
     * @param int $id identifiant dans la base de données de la source
     * @param string $libelle
     */
    public function __construct($id, $libelle) {
        $this->setId($id);
        $this->setlibelle($libelle);
    }
    
    /**
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

<?php
namespace DubInfo_gestion_immobilier\model;

/**
 * Description of SourceMaison
 *
 * @author Jenicot Alexandre
 */
class SourceMaison extends Source{
    
    /**
     * @var string référence de la maison chez la source 
     */
    private $_reference;
    
    /**
     * 
     * @param int $id
     * @param string $libelle
     * @param string $reference référence de la maison chez la source
     */
    public function __construct($id, $libelle, $reference = NULL) {
        parent::__construct($id, $libelle);
        $this->setReference($reference);
    }
    
    /**
     *
     * @return string
     */
    public function getReference() {
        return $this->_reference;
    }
    
    /**
     * 
     * @param string $reference
     */
    public function setReference($reference) {
        $this->_reference = $reference;
    }
}

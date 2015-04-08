<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;

/**
 * Description of SourceMaison
 *
 * @author Jenicot Alexandre
 */
class SourceMaison extends Source{
    const MAX_SIZE_REFERENCE = 70;
    /**
     * @var string référence de la maison chez la source 
     */
    private $_reference;
    
    /**
     * 
     * @param int $id
     * @param string $libelle
     * @param string $reference référence de la maison chez la source
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $libelle = NULL, $reference = NULL) {
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
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setReference($reference) {
        $_reference = CheckTyper::isString($reference, 'reference', __CLASS__);
        
        if(strlen($_reference) > self::MAX_SIZE_REFERENCE) {
            throw new StringAttributeTooLong('reference', __CLASS__);
        }
        
        $this->_reference = $_reference;
    }
}

<?php
namespace DubInfo_gestion_immobilier\model;

/**
 * Description of SourceLocataire
 *
 * @author Jenicot Alexandre
 */
class SourceLocataire extends Source{
    
    /**
     * @param int $id
     * @param string $libelle
     * throws BadTypeException, StringAttributeTooLong
     */
    public function __construct($id = NULL, $libelle = NULL) {
        parent::__construct($id, $libelle);
    }
}

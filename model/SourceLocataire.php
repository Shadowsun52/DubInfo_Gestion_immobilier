<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;

/**
 * Description of SourceLocataire
 *
 * @author Jenicot Alexandre
 */
class SourceLocataire extends Source{
    
    /**
     * @param int $id
     * @param string $libelle
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $libelle = NULL) {
        parent::__construct($id, $libelle);
    }
}

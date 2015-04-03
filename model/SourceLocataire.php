<?php
namespace DubInfo_gestion_immobilier\model;

/**
 * Description of SourceLocataire
 *
 * @author Alexandre
 */
class SourceLocataire extends Source{
    
    /**
     * @param int $id
     * @param string $libelle
     */
    public function __construct($id, $libelle) {
        parent::__construct($id, $libelle);
    }
}

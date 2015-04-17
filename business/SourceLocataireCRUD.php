<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOSourceLocataire;
use DubInfo_gestion_immobilier\model\SourceLocataire;
/**
 * Description of SourceLocataireCRUD
 *
 * @author Jenicot Alexandre
 */
class SourceLocataireCRUD extends AbstractBusiness{
    public function __construct() {
        parent::__construct(new DAOSourceLocataire(), "source locataire", 
                self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet SourceLocataire à l'aide de données provenant
     * d'un formulaire
     * @param array[mixed] $data
     * @return SourceLocataire
     */
    public function createObject($data) {
        $source = new SourceLocataire($data['select_id'], $data['libelle']);
        return $source; 
    }

}

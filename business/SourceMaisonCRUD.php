<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOSourceMaison;
use DubInfo_gestion_immobilier\model\SourceMaison;
/**
 * Description of SourceMaisonCRUD
 *
 * @author Jenicot Alexandre
 */
class SourceMaisonCRUD extends AbstractBusiness{
    
    public function __construct() {
        parent::__construct(new DAOSourceMaison(), 'source maison', 
                self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet source maison à l'aide de données provenant d'un
     * formulaire
     * @param array[mixed] $data
     * @return Locataire
     */
    public function createObject($data) {
        return new SourceMaison($data['select_id'], $data['libelle']);
    }

}

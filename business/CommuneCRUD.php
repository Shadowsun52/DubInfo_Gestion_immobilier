<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOCommune;
use DubInfo_gestion_immobilier\model\Commune;
/**
 * Description of CommuneCRUD
 *
 * @author Jenicot Alexandre
 */
class CommuneCRUD extends AbstractBusiness{
    
    public function __construct() {
        parent::__construct(new DAOCommune(), 'commune', self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet commune à l'aide de données provenant d'un
     * formulaire
     * @param array[mixed] $data
     * @return Commune
     */
    public function createObject($data) {
        return new Commune($data['select_id'], $data['libelle']);
    }
}

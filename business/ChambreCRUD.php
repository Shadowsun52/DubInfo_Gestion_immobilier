<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOChambre;
use DubInfo_gestion_immobilier\model\Chambre;

/**
 * Description of ChambreCRUD
 *
 * @author Jenicot Alexandre
 */
class ChambreCRUD extends FilterBusiness{
    
    public function __construct() {
        parent::__construct(new DAOChambre(), 'chambre', self::GENRE_FEMININ);
    }
    
    public function createObject($data) {
        return NULL;
    }

}

<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOMaisonLocation;
/**
 * Description of MaisonLocationCRUD
 *
 * @author Jenicot Alexandre
 */
class MaisonLocationCRUD extends AbstractBusiness{
    public function __construct() {
        parent::__construct(new DAOMaisonLocation(), 'maison', self::GENRE_FEMININ);
    }
    
    public function createObject($data) {
        return null;
    }

}

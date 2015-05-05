<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOChambre;
use DubInfo_gestion_immobilier\model\Chambre;

/**
 * Description of ChambreCRUD
 *
 * @author Jenicot Alexandre
 */
class ChambreCRUD extends AbstractBusiness{
    
    public function __construct() {
        parent::__construct(new DAOChambre(), 'chambre', self::GENRE_FEMININ);
    }
    
    /**
     * Fonction qui retourne la liste des objets pour un certain choix
     * @param int $data donnée envoyer avec la requête ajax
     * @return array[mixed]
     * @throws PDOException
     */
    public function readList($data = NULL) {
        return $this->getDao()->readList($data['id']);
    }
    
    public function createObject($data) {
        return NULL;
    }

}

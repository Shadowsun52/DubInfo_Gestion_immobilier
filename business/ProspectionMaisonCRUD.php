<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOVisiteMaison;
use DubInfo_gestion_immobilier\model\VisiteMaison;
use DubInfo_gestion_immobilier\model\Maison;
/**
 * Description of ProspectionMaisonCRUD
 *
 * @author Jenicot Alexandre
 */
class ProspectionMaisonCRUD extends VisiteBusiness{
    
    public function __construct() {
        parent::__construct(new DAOVisiteMaison(), 'visite de prospection', 
                self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet visiteMaison à l'aide de données provenant 
     * d'un formulaire
     * @param array[mixed] $data
     * @return VisiteMaison
     */
    public function createObject($data) {
        $maison = new Maison($data['select_maison']);
        $date = $this->createDateVisite($data);
        $participants = $this->createParticipants($data);
        
        $visite = new VisiteMaison($data['select_id'], $date, $data['rapport'], 
                $maison, $participants);
        return $visite;
    }

}

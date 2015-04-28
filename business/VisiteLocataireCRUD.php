<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOVisiteLocataire;
use DubInfo_gestion_immobilier\model\VisiteLocataire;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Locataire;
/**
 * Description of VisiteLocataire
 *
 * @author Jenicot Alexandre
 */
class VisiteLocataireCRUD extends VisiteBusiness{
    
    public function __construct() {
        parent::__construct(new DAOVisiteLocataire(), 
                'visite d\'une maison par un locataire', self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet VisiteLocataire à l'aide de données provenant
     * d'un formulaire
     * @param array[mixed] $data
     * @return VisiteLocataire
     */
    public function createObject($data) {
        $maison = new Maison($data['select_maison']);
        $locataire = new Locataire($data['select_locataire']);
        $date = $this->createDate($data);
        $participants = $this->createParticipants($data);

        if(isset($data['candidat'])) {
            $candidat = true;
        }
        else {
            $candidat = false;
        }
        
        $visite = new VisiteLocataire($data['id'], $date, $data['rapport'], 
                $candidat, $maison, $locataire, $participants);
        return $visite;
    }

}

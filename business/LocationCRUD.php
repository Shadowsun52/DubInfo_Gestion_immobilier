<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOLocation;
use DubInfo_gestion_immobilier\model\Location;
use DubInfo_gestion_immobilier\model\Locataire;
use DubInfo_gestion_immobilier\model\Chambre;

/**
 * Description of LocationCRUD
 *
 * @author Jenicot Alexandre
 */
class LocationCRUD extends FilterBusiness{
    
    public function __construct() {
        parent::__construct(new DAOLocation(), 'location', self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet location à l'aide de données provenant 
     * d'un formulaire
     * @param array[mixed] $data
     * @return Location
     */
    public function createObject($data) {
        $chambre = new Chambre($data['select_chambres']);
        $locataire = new Locataire($data['select_locataire']);
        
        //création des dates
        $date_debut = $this->createDate($data['date_debut']);
        $date_fin = $this->createDate($data['date_fin']);
        
        $location = new Location($data['select_id'], $date_debut, $date_fin, 
                $data['loyer'], $data['charges'], $data['bail_signe'], 
                $data['charte_signee'], $data['etat_lieux_signe'], 
                $data['garantie_total'], $data['garantie_payee'], 
                $locataire, $chambre);
        return $location;
    }
}

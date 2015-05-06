<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOPaiement;
use DubInfo_gestion_immobilier\model\Paiement;
use DubInfo_gestion_immobilier\model\Location;
/**
 * Description of PaiementLoyerCRUD
 *
 * @author Jenicot Alexandre
 */
class PaiementLoyerCRUD extends FilterBusiness{
    
    public function __construct() {
        parent::__construct(new DAOPaiement(), 'paiement loyer');
    }
    
    /**
     * Méthode créant un objet paiement à l'aide de données provenant 
     * d'un formulaire
     * @param array[mixed] $data
     * @return Paiement
     */
    public function createObject($data) {
        $location = new Location($data['select_location']);
        
        $paiement = new Paiement($data['select_id'], $data['select_mois'], 
                $data['select_annee'], $data['loyer'], $location);
        
        return $paiement;
    }

}

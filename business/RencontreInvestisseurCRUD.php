<?php
namespace DubInfo_gestion_immobilier\business;
use DubInfo_gestion_immobilier\data\DAOVisiteInvestisseur;
use DubInfo_gestion_immobilier\model\VisiteInvestisseur;
use DubInfo_gestion_immobilier\model\Investisseur;

/**
 * Description of rencontreInvestisseurCRUD
 *
 * @author Jenicot Alexandre
 */
class RencontreInvestisseurCRUD extends VisiteBusiness{
    public function __construct() {
        parent::__construct(new DAOVisiteInvestisseur(), 
                'rencontre avec un investisseur', self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet visiteInvestisseur à l'aide de données provenant 
     * d'un formulaire
     * @param array[mixed] $data
     * @return VisiteInvestisseur
     */
    public function createObject($data) {
        $investisseur = new Investisseur($data['select_investisseur']);
        $date = $this->createDateVisite($data);
        $participants = $this->createParticipants($data);
        
        $visite = new VisiteInvestisseur($data['select_id'], $date, 
                $data['endroit'], $data['rapport'], $investisseur, $participants);
        return $visite;
    }
}
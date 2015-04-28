<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOVisiteMaisonInvest;
use DubInfo_gestion_immobilier\model\VisiteMaisonInvestisseur;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Investisseur;
/**
 * Description of VisiteMaisonInvestisseurCRUD
 *
 * @author Jenicot Alexandre
 */
class VisiteMaisonInvestisseurCRUD extends VisiteBusiness{
    
    public function __construct() {
        parent::__construct(new DAOVisiteMaisonInvest(), 
                'visite d\'une maison par un investisseur', self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet visiteMaisonInvestisseur à l'aide de données 
     * provenant d'un formulaire
     * @param array[mixed] $data
     * @return VisiteMaisonInvestisseur
     */
    public function createObject($data) {
        $maison = new Maison($data['select_maison']);
        $investisseur = new Investisseur($data['select_investisseur']);
        $date = $this->createDate($data);
        $participants = $this->createParticipants($data);
        
        $visite = new VisiteMaisonInvestisseur($data['select_id'], $date, 
                $data['rapport'], $maison, $investisseur, $participants);
        return $visite;
    }

}

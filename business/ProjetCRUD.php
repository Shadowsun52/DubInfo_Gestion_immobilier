<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOProjet;
use DubInfo_gestion_immobilier\model\Projet;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Etat;
/**
 * Description of ProjetCRUD
 *
 * @author Jenicot Alexandre
 */
class ProjetCRUD extends FilterBusiness{
    
    public function __construct() {
        parent::__construct(new DAOProjet(), 'projet');
    }
    
    /**
     * Méthode créant un objet Projet à l'aide de données provenant 
     * d'un formulaire
     * @param array[mixed] $data
     * @return Projet
     */
    public function createObject($data) {
        $maison = new Maison($data['select_maison']);
        $investisseur = new Investisseur($data['select_investisseur']);
        $etat = new Etat($data['select_etat']);
        
        //création des dates
        $date_compromis = $this->createDate($data['date_signature_compromis']);
        $date_acte = $this->createDate($data['date_signature_acte']);
        $date_chantier = $this->createDate($data['date_reception_chantier']);
        $date_mobilier = $this->createDate($data['date_livraison_mobilier']);
        
        $projet = new Projet($data['select_id'], null, $etat, $date_compromis, 
                $date_acte, $data['plan_metre_fait'], $data['devis_entrepreneur_confirme'], 
                $data['selection_materiaux_fait'], $date_chantier, 
                $data['commande_mobilier_fait'], $date_mobilier, 
                $data['remarque'], $maison, $investisseur);
        return $projet;
    }
}

<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOInvestisseur;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Etat;
/**
 * Description of InvestisseurCRUD
 *
 * @author Jenicot Alexandre
 */
class InvestisseurCRUD extends AbstractBusiness{
    public function __construct() {
        parent::__construct(new DAOInvestisseur(), 'investisseur');
    }
    
    /**
     * Méthode créant un objet Investisseur à l'aide de données provenant d'un
     * formulaire
     * @param array[mixed] $data
     * @return Investisseur
     */
    public function createObject($data) {
        $ville = new Ville(null, $data['select_cp'], $data['select_villes'], $data['select_pays']);
        $adresse = new Adresse($data['rue'], $data['numero'], $data['boite'], $ville);
        $etat = new Etat($_POST['select_etat']);    
        $investisseur = new Investisseur($data['select_id'], $data['nom'],
                $data['prenom'], $data['num_tel'], $data['num_gsm'],
                $data['mail'], $adresse, $etat, $data['num_tva'], $data['remarque'], 
                $data['lettre_mission'], $data['budget']);
        return $investisseur; 
    }
}

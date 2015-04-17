<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\business\AbstractBusiness;
use DubInfo_gestion_immobilier\data\DAOProfessionnel;
use DubInfo_gestion_immobilier\model\Professionnel;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Metier;
/**
 * Description of ProfessionnelCRUD
 *
 * @author Jenicot Alexandre
 */
class ProfessionnelCRUD extends AbstractBusiness{
    public function __construct() {
        parent::__construct(new DAOProfessionnel(), 'professionnel');
    }
    
    /**
     * Méthode permettant de créer un object professionnel à l'aide d'un tableau de donnée
     * @param array[mixed] $data 
     * @return Metier 
     */
    public function createObject($data) {
        $ville = new Ville(null, $data['select_cp'], $data['select_villes'], $data['select_pays']);
        $adresse = new Adresse($data['rue'], $data['numero'], $data['boite'], $ville);
        $metier = new Metier($data['select_metier']);
        $professionnel = new Professionnel($data['select_id'], $data['nom'], 
                $data['prenom'], $data['num_tel'], $data['num_gsm'], $data['mail'], 
                $data['remarque'], $data['num_tva'], null, $adresse, $metier);
        return $professionnel;
    }

}

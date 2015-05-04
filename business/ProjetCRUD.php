<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOProjet;
use DubInfo_gestion_immobilier\model\Projet;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Etat;
use DateTime;
/**
 * Description of ProjetCRUD
 *
 * @author Jenicot Alexandre
 */
class ProjetCRUD extends AbstractBusiness{
    
    public function __construct() {
        parent::__construct(new DAOProjet(), 'projet');
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
    
    /**
     * Méthode qui permet de créer une date provenant de donnée du formulaire
     * @param string $input_date
     * @return DateTime
     */
    protected function createDate($input_date) {
       if($input_date === '') {
           return null;
       }
       return new DateTime($input_date);
   }
}

<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOInvestisseur;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Etat;
/**
 * Description of BusinessCRUD
 *
 * @author Jenicot Alexandre
 */
class BusinessCRUD {
    /**
     * 
     * @var DAOInvestisseur  
     */
    private $_dao_investisseur;

    public function __construct() {
        $this->_setDaoInvestisseur();
    }
    
    /**
     * Méthode qui recois les données d'un formulaire et le convertir en objet 
     * Investisseur et qui l'envoie à la couche data
     * dans la DB
     * @param array[mixed] $data
     * @return string Message a retouner à l'utilisateur
     */
    public function addInvestisseur($data) {
        $ville = new Ville(null, $data['select_cp'], $data['select_villes'], $data['select_pays']);
        $adresse = new Adresse($data['rue'], $data['numero'], $data['boite'], $ville);
        $etat = new Etat(1); //temporaire pour tester
//        $etat = new Etat($_POST['select_etat'])// la vrai ligne à mettre quand la DB et le reste sera opérationnel     
        $investisseur = new Investisseur(null, $data['nom'], $data['prenom'], 
            $data['num_tel'], $data['num_gsm'], $data['mail'], 
            $adresse, $etat, $data['num_tva'], $data['remarque']);
        $this->_getDaoInvestisseur()->addInvestisseur($investisseur);
        return "L'investisseur a été ajouté avec succès";
    }
    
    /**
     * 
     * @return DAOInvestisseur
     */
    private function _getDaoInvestisseur() {
        return $this->_dao_investisseur;
    }

    private function _setDaoInvestisseur() {
        $this->_dao_investisseur = new DAOInvestisseur();
    }


}

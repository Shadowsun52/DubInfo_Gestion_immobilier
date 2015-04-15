<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOInvestisseur;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Etat;
use DubInfo_gestion_immobilier\Exception\PDOException;
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
     * Fonction qui retourne la liste des investisseurs ne comprenant que l'id
     * le nom et le prénom
     * @return array[Investisseur]
     * @throws PDOException
     */
    public function readListInvestisseur() {
        return $this->_getDaoInvestisseur()->readListInvestisseur();
    }
    
    /**
     * Méthode qui interroge la couche data pour récuperer un Investisseur 
     * via son id
     * @param array[mixed] $data
     * @return mixed
     */
    public function readInvestisseur($data) {
        if(isset($data['id'])) {
            return $this->_getDaoInvestisseur()->readInvestisseur($data['id']);    
        }
        
        return array('success' => false, 'error' => "Aucun identifiant n'a été reçu."); 
    }
    
    /**
     * Méthode qui reçois les données d'un formulaire et le convertir en objet 
     * Investisseur pour l'envoyer à la couche data pour une insert
     * dans la DB
     * @param array[mixed] $data
     * @return array[mixed] données a retouner à l'utilisateur
     * @throws PDOException
     */
    public function addInvestisseur($data) {
        $investisseur = $this->_createInvestisseur($data);
        
//        if($this->_getDaoInvestisseur()->checkDuplicateInvestisseur($investisseur))
//        {
//            return array('success' => false, 
//                         'cause' => 'duplicate', 
//                         'message' => "Un investisseur avec le même nom et prénom "
//                . "existe déjà, Voulez-vous quand même rajouter celui-ci ?");
//        }
        
        $this->_getDaoInvestisseur()->addInvestisseur($investisseur);
        return array('success' => true, 'message' => "L'investisseur a été ajouté avec succès.");
    }
    
    /**
     * Méthode qui reçois les données d'un formulaire et le convertir en objet 
     * Investisseur pour l'envoyer à la couche data pour une update
     * @param array[mixed] $data
     * @return array[mixed] données a retouner à l'utilisateur
     * @throws PDOException
     */
    public function editInvestisseur($data) {
        $investisseur = $this->_createInvestisseur($data);
        
        $this->_getDaoInvestisseur()->updateInvestisseur($investisseur);
        
        return array('success' => true, 'message' => "L'investisseur a été modifié avec succès.");
    }
    
    /**
     * Méthode créant un objet Investisseur à l'aide de données provenant d'un
     * formulaire
     * @param array[mixed] $data
     * @return Investisseur
     */
    private function _createInvestisseur($data) {
       $ville = new Ville(null, $data['select_cp'], $data['select_villes'], $data['select_pays']);
        $adresse = new Adresse($data['rue'], $data['numero'], $data['boite'], $ville);
        $etat = new Etat(1); //temporaire pour tester
//        $etat = new Etat($_POST['select_etat'])// la vrai ligne à mettre quand la DB et le reste sera opérationnel     
        $investisseur = new Investisseur($data['select_id'], $data['nom'],
                $data['prenom'], $data['num_tel'], $data['num_gsm'],
                $data['mail'], $adresse, $etat, $data['num_tva'], $data['remarque']);
        return $investisseur; 
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

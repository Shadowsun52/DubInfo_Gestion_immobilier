<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOAdresse;
/**
 * Description of AdresseCRUD
 *
 * @author Jenicot Alexandre
 */
class AdresseCRUD {
    
    /**
     *
     * @var DAOAdresse 
     */
    private $_daoAdresse;
    
    public function __construct() {
        $this->_setDaoAdresse();
    }
    /**
     * Méthode qui reçois l'id d'un pays et qui l'envoie à la couche data pour 
     * récupérer la liste des codes postaux de ce pays
     * @param array[mixed] $data
     * @return array[string] Liste des codes postaux pour un pays
     * @throws PDOException
     */
    public function readCodesPostaux($data) {
        if(isset($data['pays_id'])) {
            return $this->_getDaoAdresse()->getCodesPostaux($data['pays_id']);    
        }
        
        return array('success' => false, 'error' => "Aucun identifiant de pays n'a été reçu."); 
    }
    
    /**
     * Méthode qui reçois un code postal et un pays
     * Qui les envoient à la couche data pour récupérer la liste des villes liées
     * @param array[mixed] $data
     * @return array[string] Liste des codes postaux pour un pays
     * @throws PDOException
     */
    public function readVilles($data) {
        if(isset($data['cp_id']) && isset($data['pays'])) {
            return $this->_getDaoAdresse()->getVilles($data['cp_id'], $data['pays']);    
        }
        
        return array('success' => false, 'error' => "Aucun code postal n'a été reçu.");
    }
    
    /**
     * Méthode qui récuperer dans la couche data la liste des communes de Bruxelles
     * et les retournes
     * @return array[string]
     */
    public function readCommunesBruxelles() {
        return $this->_getDaoAdresse()->getCommunesBruxelles();
    }
    
    private function _getDaoAdresse() {
        return $this->_daoAdresse;
    }

    private function _setDaoAdresse() {
        $this->_daoAdresse = new DAOAdresse;
    }


}

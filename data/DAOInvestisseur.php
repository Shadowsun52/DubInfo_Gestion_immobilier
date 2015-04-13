<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Classe permettant des interactions avec la base de données pour les objets
 * du type Investisseur
 *
 * @author Jenicot Alexandre
 */
class DAOInvestisseur {
    private $_connection;
    
    public function __construct() {
        $this->_setConnection();
    }
    
    /**
     * Méthode permettant d'ajouter un investisseur dans la DB
     * @param Investisseur $investisseur
     */
    public function addInvestisseur($investisseur) {
        try {
            $sql = "INSERT INTO Investisseur (nom, prenom, num_telephone, 
                    num_gsm, mail, num_tva, commentaire, adresse_rue, adresse_numero, 
                    adresse_ville, adresse_code_postal, adresse_pays, etat_id) 
                    VALUES (:nom, :prenom, :num_telephone, :num_gsm, :mail, :num_tva,
                    :commentaire, :adresse_rue, :adresse_numero, :adresse_ville, 
                    :adresse_code_postal, :adresse_pays, :etat)";
            $request = $this->_getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => $investisseur->getNom(),
                ':prenom' => $investisseur->getPrenom(),
                ':num_telephone' => $investisseur->getNumTelephone(),
                ':num_gsm' => $investisseur->getNumGsm(),
                ':mail' => $investisseur->getMail(),
                ':num_tva' => $investisseur->getNumTva(),
                ':commentaire' => $investisseur->getCommentaire(),
                ':adresse_rue' => $investisseur->getAdresse()->getRue(),
                ':adresse_numero' => $investisseur->getAdresse()->getNumero(),
                ':adresse_ville' => $investisseur->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $investisseur->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $investisseur->getAdresse()->getVille()->getPays(),
                ':etat' => $investisseur->getEtat()->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Retourne la connexion à la DB
     * @return PDO2
     */
    private function _getConnection() {
        return $this->_connection;
    }

    /**
     * récuperer la connexion à la DB
     */
    private function _setConnection() {
        $this->_connection = PDO2::getInstance()->db;
    }


}

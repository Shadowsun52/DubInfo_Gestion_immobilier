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
     * @throws PDOException
     */
    public function addInvestisseur($investisseur) {
        try {
            $sql = "INSERT INTO Investisseur (nom, prenom, num_telephone, 
                    num_gsm, mail, num_tva, commentaire, adresse_rue, adresse_numero, 
                    adresse_boite, adresse_ville, adresse_code_postal, 
                    adresse_pays, etat_id) 
                    VALUES (:nom, :prenom, :num_telephone, :num_gsm, :mail, :num_tva,
                    :commentaire, :adresse_rue, :adresse_numero, :adresse_boite, 
                    :adresse_ville, :adresse_code_postal, :adresse_pays, :etat)";
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
                ':adresse_boite' => $investisseur->getAdresse()->getBoite(),
                ':adresse_ville' => $investisseur->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $investisseur->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $investisseur->getAdresse()->getVille()->getPays(),
                ':etat' => $investisseur->getEtat()->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Permet de savoir si un investisseur est déjà dans la DB,
     * retour true s'il trouve un doublon
     * @param Investisseur $investisseur
     * @return boolean
     * @throws PDOException
     */
    public function checkDuplicateInvestisseur($investisseur) {
        try {
            $sql = "SELECT id FROM investisseur WHERE UPPER(nom) = :nom AND
                    UPPER(prenom) = :prenom";
            $request = $this->_getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => strtoupper($investisseur->getNom()),
                ':prenom' => strtoupper($investisseur->getPrenom())
                ));
            $results = $request->fetchAll(\PDO::FETCH_ASSOC);
            
            foreach($results as $result) {
                return TRUE;
            }
            
            return FALSE;
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

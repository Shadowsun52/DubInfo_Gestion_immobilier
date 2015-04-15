<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Classe permettant des interactions avec la base de données pour les données
 * lié aux adresses
 *
 * @author Jenicot Alexandre
 */
class DAOAdresse {
    private $_connection;
    
    public function __construct() {
        $this->_setConnection();
    }
    
    /**
     * Retourne tout les codes postaux pour un pays
     * @param int $id_pays l'identifiant du pays
     * @return array[string] liste des codes postaux
     * @throws PDOException
     */
    public function getCodesPostaux($id_pays) {
        try{
            $sql = "SELECT distinct(code_postal) FROM ville WHERE Pays_id = :pays ORDER BY code_postal";
            $request = $this->_getConnection()->prepare($sql);
            $request->execute(array(':pays' => $id_pays));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $codes_postaux[] =$result['code_postal'];;
            }
            return isset( $codes_postaux) ?  $codes_postaux : NULL;
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Retourne toute les villes lié à un code postal
     * @param int $code_postal
     * @return array[string]
     * @throws PDOException
     */
    public function getVilles($code_postal) {
        try{
            $sql = "SELECT nom FROM ville WHERE code_postal = :cp ORDER BY nom";
            $request = $this->_getConnection()->prepare($sql);
            $request->execute(array(':cp' => $code_postal));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $villes[] =$result['nom'];;
            }
            return isset( $villes) ?  $villes : NULL;
            
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

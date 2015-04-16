<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Metier;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOMetier
 *
 * @author Jenicot Alexandre
 */
class DAOMetier extends AbstractDAO{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Fonction qui lit tous les metiers pour les mettres dans une listes
     * @return array[Metier]
     * @throws PDOException
     */
    public function readList() {
        try{
            $sql = "SELECT * FROM metier ORDER BY libelle";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $metiers[] = new Metier($result['id'], $result['libelle']);
            }
            return isset( $metiers) ?  $metiers : NULL;
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Méthode qui permet de lire un métier de la DB en fonction de son 
     * identifiant
     * @param int $id
     * @return Metier
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT libelle FROM metier WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet metier
            $metier = new Metier($id, $result['libelle']);
            
            return $metier;
        } catch (Exception $exc) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Methode qui permet l'insertion d'un nouveau métier
     * @param Metier $metier
     * @throws PDOException
     */
    public function add($metier) {
        try {
            $sql = "INSERT INTO metier (libelle) VALUES (:libelle)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':libelle' => $metier->getLibelle()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Méthode qui permet de supprimer un métier en fonction de son id
     * @param type $id
     * @throws PDOException
     */
    public function delete($id) {
        try {
            $sql = "DELETE FROM metier WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Méthode qui met à jour un métier dans la base de donnée
     * @param Metier $metier
     * @throws PDOException
     */
    public function update($metier) {
        try {
            $sql = "UPDATE metier SET libelle = :libelle WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':libelle' => $metier->getLibelle(),
                ':id' => $metier->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

}

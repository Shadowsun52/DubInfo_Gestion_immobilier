<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Metier;
use DubInfo_gestion_immobilier\Exception\PDOException;
use DubInfo_gestion_immobilier\Exception\ForeignKeyConstraintException;
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
            return isset( $metiers) ?  $metiers : [];
            
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
     * @param int $id
     * @throws PDOException
     * @throws ForeignKeyConstraintException
     */
    public function delete($id) {
        if($this->checkForeignKeyContraint($id)) {
            try {
                $sql = "DELETE FROM metier WHERE id = :id";
                $request = $this->getConnection()->prepare($sql);
                $request->execute(array(':id' => $id));
            } catch (Exception $ex) {
                throw new PDOException($ex->getMessage());
            }
        }
        else {
            throw new ForeignKeyConstraintException("Le métier a des liens avec des professionnels.");
        }
        
    }
    
    /**
     * Méthode qui met à jour un métier dans la base de données
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

    /**
     * Permet de vérifier si un metier n'est pas lié par une Foreign key avant 
     * sa suppression. 
     * Retourn True si aucune clé étrangère ne pose problème sinon retour False
     * @param int $id
     * @return boolean
     */
    protected function checkForeignKeyContraint($id) {
        try {
            $sql = "SELECT id FROM professionnel WHERE Metier_id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                return FALSE;
            }
            return TRUE;
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
}

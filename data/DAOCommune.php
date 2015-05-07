<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Commune;
use \DubInfo_gestion_immobilier\Exception\ForeignKeyConstraintException;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOCommune
 *
 * @author Jenicot Alexandre
 */
class DAOCommune extends AbstractDAO{
    /**
     * Méthode permettant d'ajouter une commune dans la DB
     * @param Commune $commune
     * @throws PDOException
     */
    public function add($commune) {
        try {
            $sql = "INSERT INTO communes_bruxelles_table (name) VALUES (:name)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':name' => $commune->getLibelle()));
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'une commune grâce à sont identifiant
     * @param int $id Identifiant de la commune à supprimer
     * @throws PDOException
     * @throws ForeignKeyConstraintException
     */
    public function delete($id) {
        if($this->checkForeignKeyContraint($id)) {
            try {
                $sql = "DELETE FROM communes_bruxelles_table WHERE id = :id";
                $request = $this->getConnection()->prepare($sql);
                $request->execute(array(':id' => $id));
            } catch (Exception $ex) {
                throw new PDOException($ex->getMessage());
            }
        }
        else {
            throw new ForeignKeyConstraintException(
                    "La commune a des liens soit avec des maisons, soit avec des locataires.");
        }
    }

    /**
     * Fonction qui retourne une commune par rapport à un id donné
     * @param int $id
     * @return Commune La commune lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM communes_bruxelles_table WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet Contact
            $commune = new Commune($id, $result['name']);

            return $commune;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les communes pour les mettres dans une listes
     * @param int $id NO USE
     * @return array[Commune]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT * FROM communes_bruxelles_table ORDER BY name";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $communes[] = new Commune($result['id'], $result['name']);
            }
            return isset( $communes) ?  $communes : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode permettant d'update une commune dans la DB
     * @param Commune $commune
     * @throws PDOException
     */
    public function update($commune) {
        try {
            $sql = "UPDATE communes_bruxelles_table SET name = :name WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);       
            $result = $request->execute(array(
                ':name' => $commune->getLibelle(),
                ':id' => $commune->getId()));
            
            if(!$result) {
                throw new PDOException('Erreur durant l\'update');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Permet de vérifier si une commune  n'est pas lié par une Foreign key  
     * avant sa suppression. 
     * Retourn True si aucune clé étrangère ne pose problème sinon retour False
     * @param int $id
     * @return boolean
     */
    protected function checkForeignKeyContraint($id) {
        try {
            //on regarde s'il n'y a pas de lien avec une maison
            $sql = "SELECT * FROM propositions_table WHERE commune_id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                return FALSE;
            }
            
            //ou alors avec un locataire
            $sql = "SELECT * FROM commune_preferee WHERE communes_bruxelles_table_id = :id";
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

    public function readAll() {
        return ['erreur' => 'readAll pas implémentée'];
    }
}

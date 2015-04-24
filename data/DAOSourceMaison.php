<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\SourceMaison;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOSourceMaison
 *
 * @author Jenicot Alexandre
 */
class DAOSourceMaison extends AbstractDAO{
    /**
     * Methode qui permet l'insertion d'une nouvelle source maison
     * @param SourceMaison $source
     * @throws PDOException
     */
    public function add($source) {
        try {
            $sql = "INSERT INTO source_maison (libelle) VALUES (:libelle)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':libelle' => $source->getLibelle()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode qui permet de supprimer une source maison en fonction de son id
     * @param int $id NO USE
     * @throws PDOException
     * @throws ForeignKeyConstraintException
     */
    public function delete($id) {
        if($this->checkForeignKeyContraint($id)) {
            try {
                $sql = "DELETE FROM source_maison WHERE id = :id";
                $request = $this->getConnection()->prepare($sql);
                $request->execute(array(':id' => $id));
            } catch (Exception $ex) {
                throw new PDOException($ex->getMessage());
            }
        }
        else {
            throw new ForeignKeyConstraintException("La source a des liens avec des maisons.");
        } 
    }

    /**
     * Fonction qui retourne une source maison par rapport à un id donné
     * @param int $id
     * @return SourceMaison la source maison lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT libelle FROM source_maison WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            $source = new SourceMaison($id, $result['libelle']);
            
            return $source;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les sources maisons pour les mettres dans 
     * une listes
     * @param int $id
     * @return array[SourceMaison]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT * FROM source_maison ORDER BY libelle";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $sources[] = new SourceMaison($result['id'], $result['libelle']);
            }
            return isset( $sources) ?  $sources : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode qui met à jour une source maison dans la base de données
     * @param SourceMaison $source
     * @throws PDOException
     */
    public function update($source) {
        try {
            $sql = "UPDATE source_maison SET libelle = :libelle WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':libelle' => $source->getLibelle(),
                ':id' => $source->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Permet de vérifier si une source maison n'est pas lié par 
     * une Foreign key avant sa suppression. 
     * Retourn True si aucune clé étrangère ne pose problème sinon retour False
     * @param int $id
     * @return boolean
     */
    protected function checkForeignKeyContraint($id) {
        try {
            $sql = "SELECT id FROM provenance_maison WHERE source_maison_id = :id";
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

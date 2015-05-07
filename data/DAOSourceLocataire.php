<?php
namespace DubInfo_gestion_immobilier\data;
use DubInfo_gestion_immobilier\model\SourceLocataire;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOSourceLocataire
 *
 * @author Jenicot Alexandre
 */
class DAOSourceLocataire extends AbstractDAO{
    /**
     * Methode qui permet l'insertion d'une nouvelle source locataire
     * @param SourceLocataire $source
     * @throws PDOException
     */
    public function add($source) {
        try {
            $sql = "INSERT INTO source_locataire (libelle) VALUES (:libelle)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':libelle' => $source->getLibelle()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode qui permet de supprimer une source locataire en fonction de son id
     * @param int $id
     * @throws PDOException
     * @throws ForeignKeyConstraintException
     */
    public function delete($id) {
        if($this->checkForeignKeyContraint($id)) {
            try {
                $sql = "DELETE FROM source_locataire WHERE id = :id";
                $request = $this->getConnection()->prepare($sql);
                $request->execute(array(':id' => $id));
            } catch (Exception $ex) {
                throw new PDOException($ex->getMessage());
            }
        }
        else {
            throw new ForeignKeyConstraintException("La source a des liens avec des locataires.");
        }
        
    }

    /**
     * Fonction qui retourne une source locataire par rapport à un id donné
     * @param int $id
     * @return SourceLocataire la source locataire lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT libelle FROM source_locataire WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet investisseur
            $source = new SourceLocataire($id, $result['libelle']);
            
            return $source;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les sources locataires pour les mettres dans 
     * une listes
     * @param int $id NO USE
     * @return array[SourceLocataire]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT * FROM source_locataire ORDER BY libelle";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $sources[] = new SourceLocataire($result['id'], $result['libelle']);
            }
            return isset( $sources) ?  $sources : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode qui met à jour une source locataire dans la base de données
     * @param SourceLocataire $source
     * @throws PDOException
     */
    public function update($source) {
        try {
            $sql = "UPDATE source_locataire SET libelle = :libelle WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':libelle' => $source->getLibelle(),
                ':id' => $source->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function readAll() {
        return ['erreur' => 'readAll pas implémentée'];
    }
    
    /**
     * Permet de vérifier si une source locataire n'est pas lié par 
     * une Foreign key avant sa suppression. 
     * Retourn True si aucune clé étrangère ne pose problème sinon retour False
     * @param int $id
     * @return boolean
     */
    protected function checkForeignKeyContraint($id) {
        try {
            $sql = "SELECT id FROM locataire WHERE source_locataire_id = :id";
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

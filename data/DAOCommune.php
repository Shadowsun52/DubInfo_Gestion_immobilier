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
    public function add($object) {
        
    }

    public function delete($id) {
        
    }

    public function read($id) {
        
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

    public function update($object) {
        
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
}

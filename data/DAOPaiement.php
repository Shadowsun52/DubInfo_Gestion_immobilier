<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Paiement;
/**
 * Description of DAOPaiement
 *
 * @author Jenicot Alexandre
 */
class DAOPaiement extends AbstractDAO{
    /**
     * Méthode permettant d'ajouter un paiement dans la DB
     * @param Paiement $paiement
     * @throws PDOException
     */
    public function add($paiement) {
        try {
            $sql = "INSERT INTO paiement_loyer (mois, annee, loyer_paye, 
                    location_id) VALUES (:mois, :annee, :loyer_paye, :location)";
            $request = $this->getConnection()->prepare($sql);

            $request->execute(array(
                ':mois' => $paiement->getMois(),
                ':annee' => $paiement->getAnnee(),
                ':loyer_paye' => $paiement->getLoyerPaye(),
                ':location' => $paiement->getLocation()->getId()));  
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'un paiement
     * @param int $id Identifiant du paiement à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {  
            $sql = "DELETE FROM paiement_loyer WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne un paiement par rapport à un id donné
     * @param int $id
     * @return Paiement
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM paiement_loyer WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de la location
            $paiement = new Paiement($id, $result['mois'], $result['annee'], 
                    $result['loyer_paye']);
            
            return $paiement;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit toute les paiements d'une location donné pour les
     * mettres dans une listes
     * on récupere uniquement l'id, le mois et l'année
     * @param int $id l'identifiant de la location
     * @return array[Paiement]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT id, mois, annee FROM paiement_loyer 
                    WHERE location_id = :id ORDER BY annee, mois";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $paiements[] = new Paiement($result['id'], $result['mois'], 
                        $result['annee']);
            }
            return isset( $paiements) ?  $paiements : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }

}

<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Paiement;
/**
 * Description of DAOPaiement
 *
 * @author Jenicot Alexandre
 */
class DAOPaiement extends AbstractDAO{
    public function add($object) {
        
    }

    public function delete($id) {
        
    }

    public function read($id) {
        
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

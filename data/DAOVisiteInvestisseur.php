<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\VisiteInvestisseur;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOVisiteInvestisseur
 *
 * @author Jenicot Alexandre
 */
class DAOVisiteInvestisseur extends AbstractDAO{

    public function add($object) {
        
    }

    public function delete($id) {
        
    }

    public function read($id) {
        
    }

    /**
     * Fonction qui lit tous les rencontres avec un investisseur donné pour les mettres dans une listes
     * mettres dans une listes
     * on récupere uniquement la date et l'endroit
     * @param int $id l'identifiant de l'investisseur
     * @return array[VisiteInvetisseur]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT id, date, endroit FROM rencontre_investisseur
                    WHERE investisseur_id = :id ORDER BY date";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $rencontres[] = new VisiteInvestisseur($result['id'], 
                        $result['date'], $result['endroit']);
            }
            return isset( $rencontres) ?  $rencontres : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }

}

<?php
namespace DubInfo_gestion_immobilier\data;

/**
 * Description of DAOVisiteLocataire
 *
 * @author Jenicot Alexandre
 */
class DAOVisiteLocataire extends DAOVisite{
    public function add($object) {
        
    }

    public function delete($id) {
        
    }

    public function read($id) {
        
    }

    /**
     * Fonction qui lit tous les visites d'une maison par un locataire donné 
     * pour les mettres dans une listes
     * on récupere uniquement l'id la maison et la date
     * @param int $id l'identifiant de l'investisseur
     * @return array[VisiteMaisonInvestisseur]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT vl.id, vl.date , pt.titre_fr FROM visite_locataire vl
                    JOIN propositions_table pt ON pt.id = vl.maisons_table_id
                    WHERE vl.locataire_id = :id ORDER BY pt.titre_fr, vl.date";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                 if($result['date'] == '') {
                    $date = null;
                }
                else {
                    $date = new DateTime($result['date']);
                }
                
                $maison = new Maison();
                $maison->addTitre(Maison::LANGUAGE_FR, $result['titre_fr']);
                
                $visite = new VisiteMaisonInvestisseur($result['id'], $date);
                $visite->setMaison($maison);
                $visites[] = $visite;
            }
            return isset( $visites) ?  $visites : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }

}

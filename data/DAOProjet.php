<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Projet;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Etat;
use DateTime;
/**
 * Description of DAOProjet
 *
 * @author Jenicot Alexandre
 */
class DAOProjet extends AbstractDAO{
    public function add($object) {
        
    }

    public function delete($id) {
        
    }

    public function read($id) {
        
    }

    /**
     * Fonction qui lit tous les projets d'un investisseur donné pour les
     * mettres dans une listes
     * on récupere uniquement l'id et le titre de la maison et l'état
     * @param int $id l'identifiant de l'investisseur
     * @return array[Projet]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT o.id, pt.titre_fr, e.libelle FROM offre o
                    JOIN propositions_table pt ON o.propositions_table_id = pt.id
                    JOIN etat e ON o.etat_id = e.id WHERE o.investisseur_id = :id
                    ORDER BY pt.titre_fr";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $projet = new Projet($result['id']);
                $maison = new Maison();
                $maison->addTitre(Maison::LANGUAGE_FR, $result['titre_fr']);
                $projet->setMaison($maison);
                $projet->setEtat(new Etat(null, $result['libelle']));
                $projets[] = $projet;
            }
            return isset( $projets) ?  $projets : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }

}

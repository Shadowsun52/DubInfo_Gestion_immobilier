<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Commune;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOMaisonLocation
 *
 * @author Jenicot Alexandre
 */
class DAOMaisonLocation extends AbstractDAO{
    
    /**
     * Méthode permettant d'ajouter une maison prête à la location et ses liens 
     * dans la DB
     * @param Maison $maison
     * @throws PDOException
     */
    public function add($maison) {
        try {
            $sql = "INSERT INTO maisons_table (titre_fr, date_creation, 
                    commentaire, commune_id, propositions_table_id) 
                    VALUES (:titre, :date_creation, :commentaire, 
                    :commune, :proposition_id)";
            $request = $this->getConnection()->prepare($sql);
            $date = new \DateTime();
            $result = $request->execute(array(
                ':titre' => $maison->getTitre(Maison::LANGUAGE_FR),
                ':date_creation' => $date->getTimestamp(),
                ':commentaire' => $maison->getCommentaire(),
                ':commune' => $maison->getCommune()->getId(),
                ':proposition_id' => $maison->getIdProposition()));
            if($result) {
                $maison->setIdMaison($this->getConnection()->lastInsertId());
                $this->attachToChambres($maison);
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'une maison prête à la location
     *  grâce à son identifiant
     * @param int $id Identifiant de la maison à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {            
            $sql = "DELETE FROM maisons_table WHERE propositions_table_id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode qui lit une maison prête à louer selon un identifiant donné pour 
     * voir si elle existe
     * @param int $id Identifiant de la maison dans la table propositions
     * @return boolean 
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT id FROM maisons_table WHERE propositions_table_id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            if($result) {
                return true;
            }
            else {
                return false;
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les maisons prête à la location pour les mettres 
     * dans une listes
     * on récupere uniquement l'id, le titre et la commune
     * @param int $id NO USE
     * @return array[Maison]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT mt.id, mt.titre_fr, cbt.name FROM maisons_table mt
                    LEFT JOIN communes_bruxelles_table cbt ON mt.commune_id = cbt.id 
                    ORDER BY mt.titre_fr, cbt.name ";
            
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $maison = new Maison(null, $result['id']);
                $maison->addTitre(Maison::LANGUAGE_FR, $result['titre_fr']);
                $maison->setCommune(new Commune(null, $result['name']));
                $maisons[] = $maison;
            }
            return isset( $maisons) ?  $maisons : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode permettant d'update une maison prête à la location dans la DB
     * @param Maison $maison
     * @throws PDOException
     */
    public function update($maison) {
        try {
            $sql = "UPDATE maisons_table SET titre_fr = :titre, 
                    commentaire = :commentaire, commune_id = :commune 
                    WHERE propositions_table_id = :id";
            $request = $this->getConnection()->prepare($sql);            
            $result = $request->execute(array(
                ':titre' => $maison->getTitre(Maison::LANGUAGE_FR),
                ':commentaire' => $maison->getCommentaire(),
                ':commune' => $maison->getCommune()->getId(),
                ':id' => $maison->getIdProposition()));
            if($result) {
                $this->attachToChambres($maison);
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function readAll() {
        return ['erreur' => 'readAll pas implémentée'];
    }
    
    /**
     * Méthode qui permet de lié les chambres à la table maison 
     * (utile pour le site déjà existant)
     * @param Maison $maison
     */
    protected function attachToChambres($maison) {
        $sql = "UPDATE chambres_table SET maison_id = :id_maison
                WHERE propositions_table_id = :id";
        $request = $this->getConnection()->prepare($sql);            
            $request->execute(array(
                ':id_maison' => $maison->getIdMaison(),
                ':id' => $maison->getIdProposition()));
    }
}

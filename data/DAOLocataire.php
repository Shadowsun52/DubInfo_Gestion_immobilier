<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Locataire;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOLocataire
 *
 * @author Jenicot Alexandre
 */
class DAOLocataire extends AbstractDAO{
    /**
     * Méthode permettant d'ajouter un locataire dans la DB
     * @param Locataire $locataire
     * @throws PDOException
     */
    public function add($locataire) {
        try {
            //TODO gérer le cas d'une nouvelle source
            $sql = "INSERT INTO locataire (nom, prenom, num_telephone, 
                    num_gsm, mail, budget, commentaire, adresse_rue, adresse_numero, 
                    adresse_boite, adresse_ville, adresse_code_postal, 
                    adresse_pays, date_emmenagement, etat_id, source_locataire_id) 
                    VALUES (:nom, :prenom, :num_telephone, :num_gsm, :mail, :budget,
                    :commentaire, :adresse_rue, :adresse_numero, :adresse_boite, 
                    :adresse_ville, :adresse_code_postal, :adresse_pays, :etat, 
                    :source)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => $locataire->getNom(),
                ':prenom' => $locataire->getPrenom(),
                ':num_telephone' => $locataire->getNumTelephone(),
                ':num_gsm' => $locataire->getNumGsm(),
                ':mail' => $locataire->getMail(),
                ':budget' => $locataire->getBudget(),
                ':commentaire' => $locataire->getCommentaire(),
                ':adresse_rue' => $locataire->getAdresse()->getRue(),
                ':adresse_numero' => $locataire->getAdresse()->getNumero(),
                ':adresse_boite' => $locataire->getAdresse()->getBoite(),
                ':adresse_ville' => $locataire->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $locataire->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $locataire->getAdresse()->getVille()->getPays(),
                ':etat' => $locataire->getEtat()->getId(),
                ':source' => $locataire->getSource(0)));
            
            //ajout des communes préférées
            $id_locataire = $this->getConnection()->lastInsertId();
            foreach ($locataire->getCommunesPreferees() as $commune) {
                $sql = "INSERT INTO commune_preferee (locataire_id, 
                        communes_bruxelles_table_id) VALUE(:locataire, :commune)";
                $request = $this->getConnection()->prepare($sql);
                $request->execute(array(
                    ':locataire' => $id_locataire,
                    ':commune' => $commune->getId()));
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'un locataire grâce à sont identifiant
     * @param int $id Identifiant de l'investisseur à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {
            //suppression des communes préférées
            $sql = "DELETE FROM commune_preferee WHERE locataire_id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            $sql = "DELETE FROM locataire WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function read($id) {
        
    }

    /**
     * Fonction qui lit tous les locataire pour les mettres dans une listes
     * Donc pas toute les informations sont lu pour, uniquement l'id, le nom 
     * et le prénom
     * @return array[Locataire]
     * @throws PDOException
     */
    public function readList() {
        try{
            $sql = "SELECT id, nom, prenom FROM locataire ORDER BY nom, prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $locataires[] = new Locataire($result['id'], 
                        $result['nom'], $result['prenom']);
            }
            return isset( $locataires) ?  $locataires : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }
}

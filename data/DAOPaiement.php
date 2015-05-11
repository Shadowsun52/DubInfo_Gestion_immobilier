<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Paiement;
use DubInfo_gestion_immobilier\model\Locataire;
use DubInfo_gestion_immobilier\model\Location;
use DubInfo_gestion_immobilier\model\Chambre;
use DubInfo_gestion_immobilier\model\Maison;
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
            
            //création du paiment
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

    /**
     * Méthode permettant d'update un paiement dans la DB
     * @param Paiement $paiement
     * @throws PDOException
     */
    public function update($paiement) {
        try {
            $sql = "UPDATE paiement_loyer SET mois = :mois, annee = :annee,
                    loyer_paye = :loyer_paye WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
           
            $request->execute(array(
                ':mois' => $paiement->getMois(),
                ':annee' => $paiement->getAnnee(),
                ':loyer_paye' => $paiement->getLoyerPaye(),
                ':id' => $paiement->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode qui retourne tous les paiements de loyer de la DB
     * @return array[Paiement]
     */
    public function readAll() {
        try {
            $sql = "SELECT pl.*, l.loyer, l.locataire_id, laire.nom, 
                    laire.prenom, l.chambres_table_id,  ct.numero, ct.etage, 
                    ct.propositions_table_id, pt.titre_fr FROM paiement_loyer pl
                    JOIN location l ON pl.location_id = l.id
                    JOIN locataire laire ON l.locataire_id = laire.id
                    JOIN chambres_table ct ON l.chambres_table_id = ct.id
                    JOIN propositions_table pt ON ct.propositions_table_id = pt.id
                    ORDER BY pt.titre_fr, ct.numero, laire.nom, laire.prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $locataire = new Locataire($result['locataire_id'], 
                        $result['nom'], $result['prenom']);
                
                $maison = new Maison($result['propositions_table_id']);
                $maison->addTitre(Maison::LANGUAGE_FR, $result['titre_fr']);
                $chambre = new Chambre($result['chambres_table_id'], 
                        $result['numero'], $result['etage']);
                $chambre->setMaison($maison);
                $location = new Location($result['location_id']);
                $location->setLoyer($result['loyer']);
                $location->setLocataire($locataire);
                $location->setChambre($chambre);

                //création de l'objet paiement
                $paiements[] = new Paiement($result['id'], $result['mois'], 
                        $result['annee'], $result['loyer_paye'], $location);
            }

            return isset( $paiements) ?  $paiements : [];
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
}

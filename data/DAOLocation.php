<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Location;
use DubInfo_gestion_immobilier\model\Locataire;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Chambre;

/**
 * Description of DAOLocation
 *
 * @author Jenicot Alexandre
 */
class DAOLocation extends AbstractDAO{
    /**
     * Méthode permettant d'ajouter une location dans la DB
     * @param Location $location
     * @throws PDOException
     */
    public function add($location) {
        try {
            $sql = "INSERT INTO location (date_debut, date_fin, loyer, charges,
                    bail_signe, etat_lieux_signe, charte_signee, garantie_locative_totale,
                    garantie_locative_payee, locataire_id, chambres_table_id) 
                    VALUES (:date_debut, :date_fin, :loyer, :charges, :bail, :etat_lieux, 
                    :charte, :garantie_totale, :garantie_payee, :locataire, :chambre)";
            $request = $this->getConnection()->prepare($sql);
            
            //préparation des dates
            $date_debut = $this->writeDate($location->getDateDebut());
            $date_fin = $this->writeDate($location->getDateFin());

            $request->execute(array(
                ':date_debut' => $date_debut,
                ':date_fin' => $date_fin,
                ':loyer' => $location->getLoyer(),
                ':charges' => $location->getCharges(),
                ':bail' => $location->getBailSigne(),
                ':etat_lieux' => $location->getEtatLieuSigne(),
                ':charte' => $location->getCharteSignee(),
                ':garantie_totale' => $location->getGarantieLocativeTotal(),
                ':garantie_payee' => $location->getGarantieLocativePayee(),
                ':locataire' => $location->getLocataire()->getId(),
                ':chambre' => $location->getChambre()->getId()));      
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'une location
     * @param int $id Identifiant de la location à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {  
            $sql = "DELETE FROM location WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne une location  par rapport à un id donné
     * @param int $id
     * @return Projet
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT l.*, ct.propositions_table_id FROM location l 
                    JOIN chambres_table ct ON ct.id = l.chambres_table_id
                    WHERE l.id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            $chambre = new Chambre($result['chambres_table_id']);
            $chambre->setMaison(new Maison($result['propositions_table_id']));
            $locataire = new Locataire($result['locataire_id']);
            
            //création des dates
            $date_debut = $this->readDate($result['date_debut']);
            $date_fin = $this->readDate($result['date_fin']);
            
            //création de la location
            $location = new Location($id, $date_debut, $date_fin, $result['loyer'], 
                    $result['charges'], $result['bail_signe'], $result['charte_signee'], 
                    $result['etat_lieux_signe'], $result['garantie_locative_totale'], 
                    $result['garantie_locative_payee'], $locataire, $chambre);
            
            return $location;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit toute les locations d'un locataire donné pour les
     * mettres dans une listes
     * on récupere uniquement l'id, la date de debut et la date de fin
     * @param int $id l'identifiant du locataire
     * @return array[Projet]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT id, date_debut, date_fin FROM location 
                    WHERE locataire_id = :id ORDER BY date_debut, date_fin";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $date_debut = $this->readDate($result['date_debut']);
                $date_fin = $this->readDate($result['date_fin']);
                $locations[] = new Location($result['id'], $date_debut, $date_fin);
            }
            return isset( $locations) ?  $locations : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }

}

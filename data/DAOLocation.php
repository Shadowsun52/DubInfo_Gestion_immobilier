<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Location;
use DubInfo_gestion_immobilier\model\Locataire;
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

    public function delete($id) {
        
    }

    public function read($id) {
        
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

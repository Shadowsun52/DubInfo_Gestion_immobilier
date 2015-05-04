<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\VisiteLocataire;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Locataire;
use DubInfo_gestion_immobilier\Exception\PDOException;
use \DateTime;
/**
 * Description of DAOVisiteLocataire
 *
 * @author Jenicot Alexandre
 */
class DAOVisiteLocataire extends DAOVisite{
    /**
     * Méthode permettant d'ajouter une viste d'une maison par un locataire dans la DB
     * @param VisiteLocataire $visite
     * @throws PDOException
     */
    public function add($visite) {
        try {
            $sql = "INSERT INTO visite_locataire (date, candidat, rapport, 
                    locataire_id, propositions_table_id) 
                    VALUES (:date, :candidat, :rapport, :locataire, :maison)";
            $request = $this->getConnection()->prepare($sql);
            
            if($visite->getDate() === NULL) {
                $date = null;
            }
            else {
                $date = $visite->getDate()->format('Y-m-d H:i:s');
            }
            
            $request->execute(array(
                ':date' => $date,
                ':candidat' => $visite->getCandidat(),
                ':rapport' => $visite->getRapport(),
                ':locataire' => $visite->getLocataire()->getId(),
                ':maison' => $visite->getMaison()->getIdProposition()));
            
            //ajout des participants
            $visite->setId($this->getConnection()->lastInsertId());
            $this->addParticipants($visite, 'visite_locataire');
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function delete($id) {
        
    }

    /**
     * Fonction qui retourne une visite d'une maison par un locataire
     * par rapport à un id donné
     * @param int $id
     * @return VisiteLocataire La visite lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM visite_locataire WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet maison
            $maison = new Maison($result['propositions_table_id']);
            
            //création de l'objet locataire
            $locataire = new Locataire($result['locataire_id']);
            
            //création de la date
            if($result['date'] == '') {
                $date = null;
            }
            else {
                $date = new DateTime($result['date']);
            }
            
            //création de l'objet visite
            $visite = new VisiteLocataire($id, $date, $result['rapport'], 
                    $result['candidat'], $maison, $locataire);
            $visite->setParticipants($this->readParticipants($id, 'visite_locataire'));
            
            return $visite;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les visites d'une maison par un locataire donné 
     * pour les mettres dans une listes
     * on récupere uniquement l'id la maison et la date
     * @param int $id l'identifiant de l'investisseur
     * @return array[VisiteLocataire]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT vl.id, vl.date , pt.titre_fr FROM visite_locataire vl
                    JOIN propositions_table pt ON pt.id = vl.propositions_table_id
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
                $visite = new VisiteLocataire($result['id'], $date);
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

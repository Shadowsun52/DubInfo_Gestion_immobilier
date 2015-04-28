<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\VisiteMaison;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\Exception\PDOException;
use \DateTime;
/**
 * Description of DAOVisiteMaison
 *
 * @author Jenicot Alexandre
 */
class DAOVisiteMaison extends DAOVisite{
    /**
     * Méthode permettant d'ajouter une viste de prospection dans la DB
     * @param VisiteMaison $visite
     * @throws PDOException
     */
    public function add($visite) {
        try {
            $sql = "INSERT INTO visite_prospection (date, rapport, 
                    propositions_table_id) VALUES (:date, :rapport, :maison)";
            $request = $this->getConnection()->prepare($sql);
            
            if($visite->getDate() === NULL) {
                $date = null;
            }
            else {
                $date = $visite->getDate()->format('Y-m-d H:i:s');
            }
            
            $request->execute(array(
                ':date' => $date,
                ':rapport' => $visite->getRapport(),
                ':maison' => $visite->getMaison()->getIdProposition()));
            
            //ajout des participants
            $visite->setId($this->getConnection()->lastInsertId());
            $this->addParticipants($visite, 'visite_prospection');
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'une visite de prospectionr
     * @param int $id Identifiant de la visite à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {
            //suppression des participants
            $this->deleteParticipants($id,'visite_prospection');
            
            $sql = "DELETE FROM visite_prospection WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne une visite de prospection par rapport à un id donné
     * @param int $id
     * @return VisiteMaison La visite de la maison lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM visite_prospection WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet maison
            $maison = new Maison($result['propositions_table_id']);
            
            //création de la date
            if($result['date'] == '') {
                $date = null;
            }
            else {
                $date = new DateTime($result['date']);
            }
            
            //création de l'objet visite
            $visite = new VisiteMaison($id, $date, $result['rapport'], $maison);
            $visite->setParticipants($this->readParticipants($id, 
                    'visite_prospection'));
            return $visite;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les prospections d'une maison donné pour les
     * mettres dans une listes
     * on récupere uniquement l'id et la date
     * @param int $id l'identifiant de l'investisseur
     * @return array[VisiteMaison]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT id, date FROM visite_prospection
                    WHERE propositions_table_id = :id ORDER BY date";
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
                
                $prospections[] = new VisiteMaison($result['id'], $date);
            }
            return isset( $prospections) ?  $prospections : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode permettant d'update une visite de prospection dans la DB
     * @param VisiteMaison $visite
     * @throws PDOException
     */
    public function update($visite) {
        try {
            $sql = "UPDATE visite_prospection SET date = :date,
                    rapport = :rapport WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            
            if($visite->getDate() === NULL) {
                $date = null;
            }
            else {
                $date = $visite->getDate()->format('Y-m-d H:i:s');
            }
            
            $result = $request->execute(array(
                ':date' => $date,
                ':rapport' => $visite->getRapport(),
                ':id' => $visite->getId()));
            
            if($result) {
                //suppression des participants
                $this->deleteParticipants($visite->getId(),'visite_prospection');
                
                //ajout des nouveaux participants
                $this->addParticipants($visite, 'visite_prospection');
            }
            else {
                throw new PDOException('Erreur durant l\'update');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

}

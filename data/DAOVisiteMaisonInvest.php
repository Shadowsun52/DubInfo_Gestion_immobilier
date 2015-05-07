<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\VisiteMaisonInvestisseur;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\Exception\PDOException;
use \DateTime;
/**
 * Description of DAOVisiteMaisonInvest
 *
 * @author Jenicot Alexandre
 */
class DAOVisiteMaisonInvest extends DAOVisite{
    /**
     * Méthode permettant d'ajouter une viste de maison par un investisseur
     * dans la DB
     * @param VisiteMaisonInvestisseur $visite
     * @throws PDOException
     */
    public function add($visite) {
        try {
            $sql = "INSERT INTO visite_invest_maison (date, rapport, 
                    investisseur_id, propositions_table_id) 
                    VALUES (:date, :rapport, :investisseur, :maison)";
            $request = $this->getConnection()->prepare($sql);
            
            $date = $this->writeDate($visite->getDate());
            
            $request->execute(array(
                ':date' => $date,
                ':rapport' => $visite->getRapport(),
                ':investisseur' => $visite->getInvestisseur()->getId(),
                ':maison' => $visite->getMaison()->getIdProposition()));
            
            //ajout des participants
            $visite->setId($this->getConnection()->lastInsertId());
            $this->addParticipants($visite, 'visite_invest', 
                    'visite_invest_maison');
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode qui permet la suppression d'une visite d'une maison par un 
     * investisseur
     * @param int $id Identifiant de la visite à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {
            //suppression des participants
            $this->deleteParticipants($id,'visite_invest', 'visite_invest_maison');
            
            $sql = "DELETE FROM visite_invest_maison WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne une visite de maison pour un investisseur
     * par rapport à un id donné
     * @param int $id
     * @return VisiteInvestisseur La visite de la maison par un investisseur lut 
     * dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM visite_invest_maison WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet maison
            $maison = new Maison($result['propositions_table_id']);
            
            //création de l'object investisseur
            $investisseur = new Investisseur($result['investisseur_id']);
            
            //création de la date
            $date = $this->readDate($result['date']);
            
            //création de l'objet visite
            $visite = new VisiteMaisonInvestisseur($id, $date, 
                    $result['rapport'], $maison, $investisseur);
            $visite->setParticipants($this->readParticipants($id,'visite_invest', 
                    'visite_invest_maison'));
            return $visite;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les visites d'une maison par un investisseur donné 
     * pour les mettres dans une listes
     * on récupere uniquement l'id la maison et la date
     * @param int $id l'identifiant de l'investisseur
     * @return array[VisiteMaisonInvestisseur]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT vim.id, vim.date , pt.titre_fr FROM visite_invest_maison vim
                    JOIN propositions_table pt ON pt.id = vim.propositions_table_id
                    WHERE vim.investisseur_id = :id ORDER BY pt.titre_fr, vim.date ";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $date = $this->readDate($result['date']);
                
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

    /**
     * Méthode permettant d'update une visite d'une maison par un investisseur
     *  dans la DB
     * @param VisiteMaisonInvestisseur $visite
     * @throws PDOException
     */
    public function update($visite) {
        try {
            $sql = "UPDATE visite_invest_maison SET date = :date,
                    rapport = :rapport, propositions_table_id = :maison WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            
            $date = $this->writeDate($visite->getDate());
            
            $result = $request->execute(array(
                ':date' => $date,
                ':rapport' => $visite->getRapport(),
                ':maison' => $visite->getMaison()->getIdProposition(),
                ':id' => $visite->getId()));
            
            if($result) {
                //suppression des participants
                $this->deleteParticipants($visite->getId(), 'visite_invest', 'visite_invest_maison');
                
                //ajout des nouveaux participants
                $this->addParticipants($visite, 'visite_invest', 'visite_invest_maison');
            }
            else {
                throw new PDOException('Erreur durant l\'update');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    public function readAll() {
        return ['erreur' => 'readAll pas implémentée'];
    }
}

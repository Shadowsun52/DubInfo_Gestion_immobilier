<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\VisiteInvestisseur;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\Exception\PDOException;
use DubInfo_gestion_immobilier\model\Etat;
use DateTime;
/**
 * Description of DAOVisiteInvestisseur
 *
 * @author Jenicot Alexandre
 */
class DAOVisiteInvestisseur extends DAOVisite{

    /**
     * Méthode permettant d'ajouter une rencontre avec un investisseur dans la DB
     * @param VisiteInvestisseur $visite
     * @throws PDOException
     */
    public function add($visite) {
        try {
            $sql = "INSERT INTO rencontre_investisseur (endroit, date, rapport,
                    investisseur_id) VALUES (:endroit, :date, :rapport, :investisseur)";
            $request = $this->getConnection()->prepare($sql);
            
            $date = $this->writeDate($visite->getDate());
            
            $request->execute(array(
                ':endroit' => $visite->getEndroit(),
                ':date' => $date,
                ':rapport' => $visite->getRapport(),
                ':investisseur' => $visite->getInvestisseur()->getId()));
            
            //ajout des participants
            $visite->setId($this->getConnection()->lastInsertId());
            $this->addParticipants($visite, 'rencontre_invest',
                    'rencontre_investisseur');
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'une rencontre avec un investisseur
     * @param int $id Identifiant de la rencontre à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {
            //suppression des participants
            $this->deleteParticipants($id,'rencontre_invest',
                    'rencontre_investisseur');
            
            $sql = "DELETE FROM rencontre_investisseur WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne une rencontre investisseur  par rapport à un id donné
     * @param int $id
     * @return VisiteInvestisseur La rencontre avec l'investisseur lut dans 
     * la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM rencontre_investisseur WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet investisseur
            $investisseur = new Investisseur($result['investisseur_id']);
            
            //création de la date
            $date = $this->readDate($result['date']);
            
            //création de l'objet visite
            $visite = new VisiteInvestisseur($result['id'], $date, 
                    $result['endroit'], $result['rapport'], $investisseur);
            $visite->setParticipants($this->readParticipants($id, 
                    'rencontre_invest', 'rencontre_investisseur'));
            return $visite;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les rencontres avec un investisseur donné pour les
     * mettres dans une listes
     * on récupere uniquement la date et l'endroit
     * @param int $id l'identifiant de l'investisseur
     * @return array[VisiteInvetisseur]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT id, date, endroit FROM rencontre_investisseur
                    WHERE investisseur_id = :id ORDER BY date";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $date = $this->readDate($result['date']);
                
                $rencontres[] = new VisiteInvestisseur($result['id'], $date, 
                        $result['endroit']);
            }
            return isset( $rencontres) ?  $rencontres : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode permettant d'update une rencontre avec un investisseur dans la DB
     * @param VisiteInvestisseur $visite
     * @throws PDOException
     */
    public function update($visite) {
        try {
            $sql = "UPDATE rencontre_investisseur SET endroit = :endroit,
                    date = :date, rapport = :rapport WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            
            $date = $this->writeDate($visite->getDate());
            
            $result = $request->execute(array(
                ':endroit' => $visite->getEndroit(),
                ':date' => $date,
                ':rapport' => $visite->getRapport(),
                ':id' => $visite->getId()));
            
            if($result) {
                //suppression des participants
                $this->deleteParticipants($visite->getId(),'rencontre_invest',
                        'rencontre_investisseur');
                
                //ajout des nouveaux participants
                $this->addParticipants($visite, 'rencontre_invest', 
                        'rencontre_investisseur');
            }
            else {
                throw new PDOException('Erreur durant l\'update');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Méthode qui retourne tous les rencontres investisseurs de la DB
     * @return array[VisiteInvestisseur]
     */
    public function readAll() {
        try {
            $sql = "SELECT ri.*, i.nom, i.prenom, i.budget, i.etat_id, e.libelle
                    FROM rencontre_investisseur ri
                    JOIN investisseur i ON ri.investisseur_id = i.id
                    JOIN etat e ON i.etat_id = e.id ORDER BY i.nom, i.prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                //création de l'objet investisseur
                $investisseur = new Investisseur($result['investisseur_id'], 
                        $result['nom'], $result['prenom']);
                $investisseur->setBudget($result['budget']);
                $investisseur->setEtat(new Etat($result['etat_id'], 
                        $result['libelle']));

                //création de la date
                $date = $this->readDate($result['date']);

                //création de l'objet visite
                $visites[] = new VisiteInvestisseur($result['id'], $date, 
                        $result['endroit'], $result['rapport'], $investisseur);
            }

            return isset( $visites) ?  $visites : [];
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
}

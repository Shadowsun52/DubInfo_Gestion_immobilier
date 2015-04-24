<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\VisiteInvestisseur;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\Exception\PDOException;
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
            
            if($visite->getDate() === NULL) {
                $date = null;
            }
            else {
                $date = $visite->getDate()->format('Y-m-d H:i:s');
            }
            
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
            //suppression des communes préférées
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
            if($result['date'] == '') {
                $date = null;
            }
            else {
                $date = new DateTime($result['date']);
            }
            
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
                 if($result['date'] == '') {
                    $date = null;
                }
                else {
                    $date = new DateTime($result['date']);
                }
                
                $rencontres[] = new VisiteInvestisseur($result['id'], $date, 
                        $result['endroit']);
            }
            return isset( $rencontres) ?  $rencontres : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }

}

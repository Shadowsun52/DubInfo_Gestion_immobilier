<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Etat;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Classe permettant des interactions avec la base de données pour les objets
 * du type Investisseur
 *
 * @author Jenicot Alexandre
 */
class DAOInvestisseur extends AbstractDAO{
    
    /**
     * Fonction qui lit tous les investisseurs pour les mettres dans une listes
     * Donc pas toute les informations sont lu pour l'investisseur, uniquement
     * l'id, le nom et le prénom
     * @param int $id 
     * @return array[Investisseur]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT i.id, i.nom, i.prenom, e.libelle FROM investisseur i
                    JOIN etat e ON i.etat_id = e.id ORDER BY nom, prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
             
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $investisseur = new Investisseur($result['id'], 
                        $result['nom'], $result['prenom']);
                $investisseur->setEtat(new Etat(null, $result['libelle']));
                $investisseurs[] = $investisseur;
            }
            return isset( $investisseurs) ?  $investisseurs : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Fonction qui retourne un investisseur par rapport à un id donné
     * @param int $id
     * @return Investisseur L'investisseur lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT i.*, e.libelle FROM investisseur i 
                    JOIN etat e ON i.etat_id = e.id WHERE i.id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet adresse
            $ville = new Ville(null, $result['adresse_code_postal'], 
                    $result['adresse_ville'], $result['adresse_pays']);
            $adresse = new Adresse($result['adresse_rue'], 
                    $result['adresse_numero'], $result['adresse_boite'], $ville);
            
            //création de l'objet etat
            $etat = new Etat($result['etat_id'], $result['libelle']);
            
            //création de l'objet investisseur
            $investisseur = new Investisseur($id, $result['nom'], 
                    $result['prenom'], $result['num_telephone'], 
                    $result['num_gsm'], $result['mail'], $adresse, $etat, 
                    $result['num_tva'], $result['commentaire'], 
                    $result['lettre_de_mission'], $result['budget']);
            
            return $investisseur;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Méthode permettant d'ajouter un investisseur dans la DB
     * @param Investisseur $investisseur
     * @throws PDOException
     */
    public function add($investisseur) {
        try {
            $sql = "INSERT INTO investisseur (nom, prenom, num_telephone, 
                    num_gsm, mail, num_tva, commentaire, lettre_de_mission, 
                    budget, adresse_rue, adresse_numero, adresse_boite, 
                    adresse_ville, adresse_code_postal, adresse_pays, etat_id) 
                    VALUES (:nom, :prenom, :num_telephone, :num_gsm, :mail, :num_tva,
                    :commentaire, :lettre_mission, :budget, :adresse_rue, 
                    :adresse_numero, :adresse_boite, :adresse_ville, 
                    :adresse_code_postal, :adresse_pays, :etat)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => $investisseur->getNom(),
                ':prenom' => $investisseur->getPrenom(),
                ':num_telephone' => $investisseur->getNumTelephone(),
                ':num_gsm' => $investisseur->getNumGsm(),
                ':mail' => $investisseur->getMail(),
                ':num_tva' => $investisseur->getNumTva(),
                ':commentaire' => $investisseur->getCommentaire(),
                ':lettre_mission' => $investisseur->getLettreMission(),
                ':budget' => $investisseur->getBudget(),
                ':adresse_rue' => $investisseur->getAdresse()->getRue(),
                ':adresse_numero' => $investisseur->getAdresse()->getNumero(),
                ':adresse_boite' => $investisseur->getAdresse()->getBoite(),
                ':adresse_ville' => $investisseur->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $investisseur->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $investisseur->getAdresse()->getVille()->getPays(),
                ':etat' => $investisseur->getEtat()->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Méthode permettant d'update un investisseur dans la DB
     * @param Investisseur $investisseur
     * @throws PDOException
     */
    public function update($investisseur) {
        try {
            $sql = "UPDATE investisseur SET nom = :nom, prenom = :prenom, 
                    num_telephone = :num_telephone, num_gsm = :num_gsm,
                    mail = :mail, num_tva = :num_tva, commentaire = :commentaire,
                    lettre_de_mission = :lettre_mission, budget = :budget,
                    adresse_rue = :adresse_rue, adresse_numero = :adresse_numero,
                    adresse_boite = :adresse_boite, adresse_ville = :adresse_ville,
                    adresse_code_postal = :adresse_code_postal, 
                    adresse_pays = :adresse_pays, etat_id = :etat WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => $investisseur->getNom(),
                ':prenom' => $investisseur->getPrenom(),
                ':num_telephone' => $investisseur->getNumTelephone(),
                ':num_gsm' => $investisseur->getNumGsm(),
                ':mail' => $investisseur->getMail(),
                ':num_tva' => $investisseur->getNumTva(),
                ':commentaire' => $investisseur->getCommentaire(),
                'lettre_mission' => $investisseur->getLettreMission(),
                'budget' => $investisseur->getBudget(),
                ':adresse_rue' => $investisseur->getAdresse()->getRue(),
                ':adresse_numero' => $investisseur->getAdresse()->getNumero(),
                ':adresse_boite' => $investisseur->getAdresse()->getBoite(),
                ':adresse_ville' => $investisseur->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $investisseur->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $investisseur->getAdresse()->getVille()->getPays(),
                ':etat' => $investisseur->getEtat()->getId(),
                ':id' => $investisseur->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     *  Méthode qui permet la suppression d'un investisseur grâce à sont identifiant
     * @param int $id Identifiant de l'investisseur à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {
            $sql = "DELETE FROM investisseur WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Permet de savoir si un investisseur est déjà dans la DB,
     * retour true s'il trouve un doublon
     * @param Investisseur $investisseur
     * @return boolean
     * @throws PDOException
     */
    public function checkDuplicateInvestisseur($investisseur) {
        try {
            $sql = "SELECT id FROM investisseur WHERE UPPER(nom) = :nom AND
                    UPPER(prenom) = :prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => strtoupper($investisseur->getNom()),
                ':prenom' => strtoupper($investisseur->getPrenom())
                ));
            $results = $request->fetchAll(\PDO::FETCH_ASSOC);
            
            foreach($results as $result) {
                return TRUE;
            }
            
            return FALSE;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Méthode qui retourne tous les investisseurs  de la DB
     * @return array[Investisseur]
     */
    public function readAll() {
        try {
            $sql = "SELECT i.*, e.libelle FROM investisseur i 
                    JOIN etat e ON i.etat_id = e.id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                //création de l'objet adresse
            $ville = new Ville(null, $result['adresse_code_postal'], 
                    $result['adresse_ville'], $result['adresse_pays']);
            $adresse = new Adresse($result['adresse_rue'], 
                    $result['adresse_numero'], $result['adresse_boite'], $ville);
            
            //création de l'objet etat
            $etat = new Etat($result['etat_id'], $result['libelle']);
            
            //création de l'objet investisseur
            $investisseurs[] = new Investisseur($result['id'], $result['nom'], 
                    $result['prenom'], $result['num_telephone'], 
                    $result['num_gsm'], $result['mail'], $adresse, $etat, 
                    $result['num_tva'], $result['commentaire'], 
                    $result['lettre_de_mission'], $result['budget']);
            }

            return isset( $investisseurs) ?  $investisseurs : [];
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
}

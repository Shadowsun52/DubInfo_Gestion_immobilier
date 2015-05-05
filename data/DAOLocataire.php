<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Locataire;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Etat;
use DubInfo_gestion_immobilier\model\Commune;
use DubInfo_gestion_immobilier\model\SourceLocataire;
use DubInfo_gestion_immobilier\Exception\PDOException;
use DateTime;
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
            $sql = "INSERT INTO locataire (nom, prenom, num_telephone, 
                    num_gsm, mail, commentaire, adresse_rue, adresse_numero, 
                    adresse_boite, adresse_ville, adresse_code_postal, 
                    adresse_pays, budget, date_emmenagement, source_locataire_id, etat_id)
                    VALUES (:nom, :prenom, :num_telephone, :num_gsm, :mail,
                    :commentaire, :adresse_rue, :adresse_numero, :adresse_boite, 
                    :adresse_ville, :adresse_code_postal, :adresse_pays, :budget, 
                    :date, :source, :etat)";
            $request = $this->getConnection()->prepare($sql);
            
            $date = $this->writeDate($locataire->getDateEmmenagement());
            
            $request->execute(array(
                ':nom' => $locataire->getNom(),
                ':prenom' => $locataire->getPrenom(),
                ':num_telephone' => $locataire->getNumTelephone(),
                ':num_gsm' => $locataire->getNumGsm(),
                ':mail' => $locataire->getMail(),
                ':commentaire' => $locataire->getCommentaire(),
                ':adresse_rue' => $locataire->getAdresse()->getRue(),
                ':adresse_numero' => $locataire->getAdresse()->getNumero(),
                ':adresse_boite' => $locataire->getAdresse()->getBoite(),
                ':adresse_ville' => $locataire->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $locataire->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $locataire->getAdresse()->getVille()->getPays(),
                ':budget' => $locataire->getBudget(),
                ':date' => $date,
                ':source' => $locataire->getSource(0)->getId(),
                ':etat' => $locataire->getEtat()->getId()));
            //ajout des communes préférées
            $locataire->setId($this->getConnection()->lastInsertId());
            $this->addCommunesPreferees($locataire);
            
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
            $this->deleteCommunesPreferees($id);
            
            $sql = "DELETE FROM locataire WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne un locataire par rapport à un id donné
     * @param int $id
     * @return Locataire Le locataire lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT l.*, sl.libelle as 'source', e.libelle as 'etat' FROM locataire l 
                LEFT JOIN source_locataire sl ON l.source_locataire_id = sl.id 
                LEFT JOIN etat e ON l.etat_id = e.id WHERE l.id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet adresse
            $ville = new Ville(null, $result['adresse_code_postal'], 
                    $result['adresse_ville'], $result['adresse_pays']);
            $adresse = new Adresse($result['adresse_rue'], 
                    $result['adresse_numero'], $result['adresse_boite'], $ville);
            
            //création de la source
            $etat = new Etat($result['etat_id'], $result['etat']);
            
            //création de l'objet source_locataire
            $source = new SourceLocataire(
                    $result['source_locataire_id'], $result['source']);
            
            //creation date emmenagement
            $date = $this->readDate($result['date_emmenagement']);
            
            //création de l'objet Locataire
            $locataire = new Locataire($result['id'], $result['nom'], 
                    $result['prenom'], $result['num_telephone'], $result['num_gsm'], 
                    $result['mail'], $result['budget'], $date, 
                    $result['commentaire'], $etat, $adresse);
            $locataire->addSource($source);
            $locataire->setCommunesPreferees($this->readCommunesPreferees($id));

            return $locataire;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Fonction qui lit tous les locataire pour les mettres dans une listes
     * Donc pas toute les informations sont lu pour, uniquement l'id, le nom 
     * et le prénom
     * @param int $id NO USE
     * @return array[Locataire]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT l.id, l.nom, l.prenom, e.libelle FROM locataire l
                    JOIN etat e ON l.etat_id = e.id ORDER BY nom, prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $locataire = new Locataire($result['id'], 
                        $result['nom'], $result['prenom']);
                $locataire->setEtat(new Etat(null, $result['libelle']));
                $locataires[] = $locataire;
            }
            return isset( $locataires) ?  $locataires : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode permettant d'update un locataire dans la DB
     * @param Locataire $locataire
     * @throws PDOException
     */
    public function update($locataire) {
        try {
            $sql = "UPDATE locataire SET nom = :nom, prenom = :prenom, 
                    num_telephone = :num_tel, num_gsm = :num_gsm,  mail = :mail,
                    budget = :budget, commentaire = :commentaire,
                    date_emmenagement = :date, adresse_rue = :adresse_rue, 
                    adresse_numero = :adresse_numero, 
                    adresse_boite = :adresse_boite, adresse_ville = :adresse_ville, 
                    adresse_code_postal = :adresse_code_postal, 
                    adresse_pays = :adresse_pays, source_locataire_id = :source, 
                    etat_id = :etat WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            
            $date = $this->writeDate($locataire->getDateEmmenagement());
            
            $result = $request->execute(array(
                ':nom' => $locataire->getNom(),
                ':prenom' => $locataire->getPrenom(),
                ':num_tel' => $locataire->getNumTelephone(),
                ':num_gsm' => $locataire->getNumGsm(),
                ':mail' => $locataire->getMail(),
                ':budget' => $locataire->getBudget(),
                ':date' => $date,
                ':commentaire' => $locataire->getCommentaire(),
                ':adresse_rue' => $locataire->getAdresse()->getRue(),
                ':adresse_numero' => $locataire->getAdresse()->getNumero(),
                ':adresse_boite' => $locataire->getAdresse()->getBoite(),
                ':adresse_ville' => $locataire->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $locataire->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $locataire->getAdresse()->getVille()->getPays(),
                ':source' => $locataire->getSource(0)->getId(),
                ':etat' => $locataire->getEtat()->getId(),
                ':id' => $locataire->getId()));
            
            if($result) {
                //suppression des anciennes communes préférées
                $this->deleteCommunesPreferees($locataire->getId());
            
                //ajout des nouvelles communes préférées
                $this->addCommunesPreferees($locataire);
            }
            else {
                throw new PDOException('Erreur durant l\'update');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Méthode qui retourne la liste des communes préférées d'un locataire
     * @param int $id l'identifiant du locataire
     * @return array[Commune] Liste des communes préférées
     */
    protected function readCommunesPreferees($id) {
        $sql = "SELECT cbt.* FROM commune_preferee cp 
                LEFT JOIN communes_bruxelles_table cbt 
                ON cp.communes_bruxelles_table_id = cbt.id 
                WHERE cp.locataire_id = :id";
        $request = $this->getConnection()->prepare($sql);
        $request->execute(array(':id' => $id));
        foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
        {
            $sources[] = new Commune($result['id'], $result['name']);
        }
        return isset( $sources) ?  $sources : [];
    }
    
    /**
     * Méthode qui permet d'ajouter les communes préférées d'un locataire
     * @param Locataire $locataire le locataire à qui l'ont doit ajouter des 
     * communes préférées
     */
    protected function addCommunesPreferees($locataire) {
        foreach ($locataire->getCommunesPreferees() as $commune) {
            $sql = "INSERT INTO commune_preferee (locataire_id, 
                    communes_bruxelles_table_id) VALUE(:locataire, :commune)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':locataire' => $locataire->getId(),
                ':commune' => $commune->getId()));
        }
    }
    
    /**
     * Méthode qui supprime les communes préférées d'un locataire
     * @param int $id l'identifiant du locataire
     */
    protected function deleteCommunesPreferees($id) {
        $sql = "DELETE FROM commune_preferee WHERE locataire_id = :id";
        $request = $this->getConnection()->prepare($sql);
        $request->execute(array(':id' => $id));
    }
}

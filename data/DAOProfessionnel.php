<?php
namespace DubInfo_gestion_immobilier\data;
use DubInfo_gestion_immobilier\model\Professionnel;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Metier;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOProfessionnel
 *
 * @author Jenicot Alexandre
 */
class DAOProfessionnel extends AbstractDAO{
    /**
     * Méthode permettant d'ajouter un professionnel dans la DB
     * @param Professionnel $professionnel
     * @throws PDOException
     */
    public function add($professionnel) {
        try {
            $sql = "INSERT INTO professionnel (nom, prenom, num_telephone, 
                    num_gsm, mail, num_tva, nom_entreprise, num_compte, swift,
                    commentaire, adresse_rue, adresse_numero, adresse_boite, 
                    adresse_ville, adresse_code_postal, adresse_pays, metier_id) 
                    VALUES (:nom, :prenom, :num_telephone, :num_gsm, :mail, 
                    :num_tva, :nom_entreprise, :num_compte, :swift,:commentaire, 
                    :adresse_rue, :adresse_numero, :adresse_boite, :adresse_ville,
                    :adresse_code_postal, :adresse_pays, :metier)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => $professionnel->getNom(),
                ':prenom' => $professionnel->getPrenom(),
                ':num_telephone' => $professionnel->getNumTelephone(),
                ':num_gsm' => $professionnel->getNumGsm(),
                ':mail' => $professionnel->getMail(),
                ':num_tva' => $professionnel->getNumTva(),
                ':nom_entreprise' => $professionnel->getNomEntreprise(),
                ':num_compte' => $professionnel->getNumCompte(),
                ':swift' => $professionnel->getSwift(),
                ':commentaire' => $professionnel->getCommentaire(),
                ':adresse_rue' => $professionnel->getAdresse()->getRue(),
                ':adresse_numero' => $professionnel->getAdresse()->getNumero(),
                ':adresse_boite' => $professionnel->getAdresse()->getBoite(),
                ':adresse_ville' => $professionnel->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $professionnel->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $professionnel->getAdresse()->getVille()->getPays(),
                ':metier' => $professionnel->getMetier()->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'un professionnel grâce à sont identifiant
     * @param int $id Identifiant du professionnel à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {
            $sql = "DELETE FROM professionnel WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne un professionnel par rapport à un id donné
     * @param int $id
     * @return Professionnel Le professionnel lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT p.*, m.libelle FROM professionnel p 
                    LEFT JOIN metier m ON p.metier_id = m.id WHERE p.id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet adresse
            $ville = new Ville(null, $result['adresse_code_postal'], 
                    $result['adresse_ville'], $result['adresse_pays']);
            $adresse = new Adresse($result['adresse_rue'], 
                    $result['adresse_numero'], $result['adresse_boite'], $ville);
            
            //création de l'objet Metier
            $metier = new Metier($result['Metier_id'], $result['libelle']);
            
            //création de l'objet Professionnel
            $professionnel = new Professionnel($result['id'], $result['nom'], 
                    $result['prenom'], $result['num_telephone'], 
                    $result['num_gsm'], $result['mail'], $result['commentaire'], 
                    $result['num_tva'], $result['nom_entreprise'],
                    $result['num_compte'], $result['swift'], null, $adresse, $metier);
            return $professionnel;
        } catch (Exception $exc) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les professionnels pour les mettres dans une listes
     * Donc pas toute les informations, uniquement l'id, le nom et le prénom
     * @param int $id NO USE
     * @return array[Investisseur]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            $sql = "SELECT id, nom, prenom FROM professionnel ORDER BY nom, prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $professionnel[] = new Professionnel($result['id'], 
                        $result['nom'], $result['prenom']);
            }
            return isset( $professionnel) ?  $professionnel : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode permettant d'update un professionnel dans la DB
     * @param Professionnel $professionnel
     * @throws PDOException
     */
    public function update($professionnel) {
        try {
            $sql = "UPDATE professionnel SET nom = :nom, prenom = :prenom, 
                    num_telephone = :num_telephone, num_gsm = :num_gsm, 
                    mail = :mail, num_tva = :num_tva, num_compte = :num_compte, 
                    nom_entreprise = :nom_entreprise,  swift = :swift, 
                    commentaire = :commentaire, adresse_rue = :adresse_rue, 
                    adresse_numero = :adresse_numero, adresse_boite = :adresse_boite, 
                    adresse_ville = :adresse_ville, adresse_code_postal = :adresse_code_postal, 
                    adresse_pays = :adresse_pays, Metier_id = :metier WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => $professionnel->getNom(),
                ':prenom' => $professionnel->getPrenom(),
                ':num_telephone' => $professionnel->getNumTelephone(),
                ':num_gsm' => $professionnel->getNumGsm(),
                ':mail' => $professionnel->getMail(),
                ':num_tva' => $professionnel->getNumTva(),
                ':nom_entreprise' => $professionnel->getNomEntreprise(),
                ':num_compte' => $professionnel->getNumCompte(),
                ':swift' => $professionnel->getSwift(),
                ':commentaire' => $professionnel->getCommentaire(),
                ':adresse_rue' => $professionnel->getAdresse()->getRue(),
                ':adresse_numero' => $professionnel->getAdresse()->getNumero(),
                ':adresse_boite' => $professionnel->getAdresse()->getBoite(),
                ':adresse_ville' => $professionnel->getAdresse()->getVille()->getNom(),
                ':adresse_code_postal' => $professionnel->getAdresse()->getVille()->getCodePostal(),
                ':adresse_pays' => $professionnel->getAdresse()->getVille()->getPays(),
                ':metier' => $professionnel->getMetier()->getId(),
                ':id' => $professionnel->getId()));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function readAll() {
        return ['erreur' => 'readAll pas implémentée'];
    }
}

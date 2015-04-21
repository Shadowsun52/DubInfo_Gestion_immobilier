<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Contact;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOContact
 *
 * @author Jenicot Alexandre
 */
class DAOContact extends AbstractDAO{
    /**
     * Méthode permettant d'ajouter un contact dans la DB
     * @param Contact $contact
     * @throws PDOException
     */
    public function add($contact) {
        try {
            $sql = "INSERT INTO contact (nom, prenom, num_telephone, num_gsm, 
                    mail, commentaire) VALUES (:nom, :prenom, :num_telephone, 
                    :num_gsm, :mail, :commentaire)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':nom' => $contact->getNom(),
                ':prenom' => $contact->getPrenom(),
                ':num_telephone' => $contact->getNumTelephone(),
                ':num_gsm' => $contact->getNumGsm(),
                ':mail' => $contact->getMail(),
                ':commentaire' => $contact->getCommentaire()));
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'un contact grâce à sont identifiant
     * @param int $id Identifiant de l'investisseur à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        if($this->checkForeignKeyContraint($id)) {
            try {
                $sql = "DELETE FROM contact WHERE id = :id";
                $request = $this->getConnection()->prepare($sql);
                $request->execute(array(':id' => $id));
            } catch (Exception $ex) {
                throw new PDOException($ex->getMessage());
            }
        }
        else {
            throw new ForeignKeyConstraintException("Le contact a des liens avec des maisons.");
        }
    }

    /**
     * Fonction qui retourne un contact par rapport à un id donné
     * @param int $id
     * @return Contact Le contact lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM contact WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet Contact
            $contact = new Contact($result['id'], $result['nom'], 
                    $result['prenom'], $result['num_telephone'], $result['num_gsm'], 
                    $result['mail'], $result['commentaire']);

            return $contact;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Fonction qui lit tous les contacts pour les mettres dans une listes
     * Donc pas toute les informations sont lu pour, uniquement l'id, le nom 
     * et le prénom
     * @return array[Contact]
     * @throws PDOException
     */
    public function readList() {
        try{
            $sql = "SELECT id, nom, prenom FROM contact ORDER BY nom, prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $contacts[] = new Contact($result['id'], 
                        $result['nom'], $result['prenom']);
            }
            return isset( $contacts) ?  $contacts : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode permettant d'update un contact dans la DB
     * @param Contact $contact
     * @throws PDOException
     */
    public function update($contact) {
        try {
            $sql = "UPDATE contact SET nom = :nom, prenom = :prenom, 
                    num_telephone = :num_tel, num_gsm = :num_gsm,  mail = :mail,
                    commentaire = :commentaire WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);       
            $result = $request->execute(array(
                ':nom' => $contact->getNom(),
                ':prenom' => $contact->getPrenom(),
                ':num_tel' => $contact->getNumTelephone(),
                ':num_gsm' => $contact->getNumGsm(),
                ':mail' => $contact->getMail(),
                ':commentaire' => $contact->getCommentaire(),
                ':id' => $contact->getId()));
            
            if(!$result) {
                throw new PDOException('Erreur durant l\'update');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Permet de vérifier si un  contact n'est pas lié par une Foreign key avant 
     * sa suppression. 
     * Retourn True si aucune clé étrangère ne pose problème sinon retour False
     * @param int $id
     * @return boolean
     */
    protected function checkForeignKeyContraint($id) {
        try {
            $sql = "SELECT id FROM contact_maison WHERE contact_id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                return FALSE;
            }
            return TRUE;
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
}

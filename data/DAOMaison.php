<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Commune;
use DubInfo_gestion_immobilier\model\Etat;
use DubInfo_gestion_immobilier\model\SourceMaison;
use DubInfo_gestion_immobilier\model\Contact;
use DubInfo_gestion_immobilier\data\DAOContact;
use DubInfo_gestion_immobilier\data\DAOMaisonLocation;
use DubInfo_gestion_immobilier\Exception\PDOException;

/**
 * Description of DAOMaison
 *
 * @author Jenicot Alexandre
 */
class DAOMaison extends AbstractDAO{
    const ETAT_LOCATION = 7;
    /**
     *
     * @var DAOContact 
     */
    private $_dao_contact;
    
    /**
     *
     * @var DAOMaisonLocation 
     */
    private $_dao_maison_location;
    
    public function __construct() {
        parent::__construct();
        $this->setDaoContact();
        $this->setDaoMaisonLocation();
    }
    
    /**
     * Méthode permettant d'ajouter une maison et ses liens dans la DB
     * @param Maison $maison
     * @throws PDOException
     */
    public function add($maison) {
        try {
            $sql = "INSERT INTO propositions_table (titre_fr, date_creation, 
                    commentaire, adresse_rue, adresse_numero, commune_id, prix,
                    superficie_habitable, nb_salle_de_bain, cout_travaux, etat_id,
                    raison_abandon) VALUES (:titre, :date_creation, :commentaire, 
                    :adresse_rue, :adresse_numero, :commune, :prix, :superficie,
                    :nb_sdb, :cout_travaux, :etat, :raison_abandon)";
            $request = $this->getConnection()->prepare($sql);
            $date = new \DateTime();
            $result = $request->execute(array(
                ':titre' => $maison->getTitre(Maison::LANGUAGE_FR),
                ':date_creation' => $date->getTimestamp(),
                ':commentaire' => $maison->getCommentaire(),
                ':adresse_rue' => $maison->getAdresse()->getRue(),
                ':adresse_numero' => $maison->getAdresse()->getNumero(),
                ':commune' => $maison->getCommune()->getId(),
                ':prix' => $maison->getPrix(),
                ':superficie' => $maison->getSuperficeHabitable(),
                ':nb_sdb' => $maison->getNbSalleDeBain(),
                'cout_travaux' => $maison->getCoutTravaux(),
                'raison_abandon' => $maison->getRaisonAbandon(),
                ':etat' => $maison->getEtat()->getId()));
            
            if($result) {
                $id = $this->getConnection()->lastInsertId();
                $this->addSource($id, $maison->getSource(0));
                $this->addContacts($id, $maison->getContacts());
                $this->addMaisonLocation($maison);
            }
            else {
                throw new PDOException('Erreur lors de l\'ajout!');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'une maison grâce à son identifiant
     * @param int $id Identifiant de la maison à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {
            //suppression des contacts
            $this->deleteContacts($id);
            
            //suppression de la source
            $this->deleteSources($id);
            
            //suppression de la maison dans la table maison_table
            $this->deleteMaisonLocation($id);
            
            $sql = "DELETE FROM propositions_table WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne une maison par rapport à un id donné
     * @param int $id
     * @return Maison La maison lut dans la base de données
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT pt.*, e.libelle as 'etat', cbt.name as 'commune', 
                    sm.id as 'id_source', sm.libelle as 'source', pm.reference_maison
                    FROM propositions_table pt LEFT JOIN etat e ON pt.etat_id = e.id
                    LEFT JOIN communes_bruxelles_table cbt ON pt.commune_id = cbt.id
                    LEFT JOIN provenance_maison pm ON pm.propositions_table_id = pt.id
                    LEFT JOIN source_maison sm ON pm.source_maison_id = sm.id WHERE pt.id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            //création de l'objet adresse
            $adresse = new Adresse($result['adresse_rue'], $result['adresse_numero']);
            $commune = new Commune($result['commune_id'], $result['commune']);
            
            //création de la source
            $etat = new Etat($result['etat_id'], $result['etat']);
            
            //création de l'objet source_locataire
            $source = new SourceMaison($result['id_source'], $result['source'],
                    $result['reference_maison']);
            
            //creation date creation
            $date = new \DateTime();
            $date->setTimestamp(intval($result['date_creation']));
            
            //création de l'objet maison
            $maison = new Maison($result['id'], null, $result['prix'],
                    $result['superficie_habitable'], $result['nb_salle_de_bain'], 
                    $result['cout_travaux'], $result['commentaire'], 
                    $result['raison_abandon'], $etat, $commune, $adresse, $date);
            $maison->addTitre(Maison::LANGUAGE_FR, $result['titre_fr']);
            $maison->addSource($source);
            $maison->setContacts($this->readContactsMaison($id));
            
            return $maison;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les maisons pour les mettres dans une listes
     * Donc pas toute les informations sont lu pour, uniquement l'id, le titre 
     * et la commune
     * @param int $filter
     * @return array[Maison]
     * @throws PDOException
     */
    public function readList($filter = NULL) {
        try{
            $sql = "SELECT pt.id, pt.titre_fr, cbt.name FROM propositions_table pt
                    LEFT JOIN communes_bruxelles_table cbt ON pt.commune_id = cbt.id";
            
            if($filter !== NULL) {
                $sql .= " WHERE pt.etat_id = " . $filter;
            }
            
            $sql .= " ORDER BY pt.titre_fr, cbt.name "; 
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $maison = new Maison($result['id']);
                $maison->addTitre(Maison::LANGUAGE_FR, $result['titre_fr']);
                $maison->setCommune(new Commune(null, $result['name']));
                $maisons[] = $maison;
            }
            return isset( $maisons) ?  $maisons : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Méthode permettant d'update une maison dans la DB
     * @param Maison $maison
     * @throws PDOException
     */
    public function update($maison) {
        try {
            $sql = "UPDATE propositions_table SET titre_fr = :titre, 
                    commentaire = :commentaire, adresse_rue = :rue, 
                    adresse_numero = :numero, commune_id = :commune, prix = :prix, 
                    superficie_habitable = :superficie, nb_salle_de_bain = :nb_sdb, 
                    cout_travaux = :cout_travaux, raison_abandon = :raison_abandon, 
                    etat_id = :etat WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);            
            $result = $request->execute(array(
                ':titre' => $maison->getTitre(Maison::LANGUAGE_FR),
                ':commentaire' => $maison->getCommentaire(),
                ':rue' => $maison->getAdresse()->getRue(),
                ':numero' => $maison->getAdresse()->getNumero(),
                ':commune' => $maison->getCommune()->getId(),
                ':prix' => $maison->getPrix(),
                ':superficie' => $maison->getSuperficeHabitable(),
                ':nb_sdb' => $maison->getNbSalleDeBain(),
                ':cout_travaux' => $maison->getCoutTravaux(),
                ':raison_abandon' => $maison->getRaisonAbandon(),
                ':etat' => $maison->getEtat()->getId(),
                ':id' => $maison->getIdProposition()));
            
            if($result) {
                //suppression de l'anciennes source
                $this->deleteSources($maison->getIdProposition());
            
                //ajout de la nouvelle source
                $this->addSource($maison->getIdProposition(), $maison->getSource(0));
                
                //suppression des anciens contacts
                $this->deleteContacts($maison->getIdProposition());
            
                //ajout des nouveaux contacts
                $this->addContacts($maison->getIdProposition(), $maison->getContacts());
                
                //suppression de la version actuelle de la maison dans maison_table
                $this->deleteMaisonLocation($maison->getIdProposition());
                
                /*
                 * ajout de la nouvelle version, si dans le bon état, de la 
                 * maison dans maisons_table
                 */
                $this->addMaisonLocation($maison);
            }
            else {
                throw new PDOException('Erreur durant l\'update');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

//<editor-fold defaultstate="collapsed" desc="Gestion source & contacts">
    /**
     * Méthode qui ajoute un lien entre une source et une maison dans la DB
     * @param int $id   Identifiant de la maison
     * @param SourceMaison $source la source a liée à la maison
     */
    protected function addSource($id, $source) {
        $sql = "INSERT INTO provenance_maison (propositions_table_id, source_maison_id, 
                reference_maison) VALUES (:propositision_id, :source_id, :reference)";
        $request = $this->getConnection()->prepare($sql);
        $request->execute(array(
            ':propositision_id' => $id,
            ':source_id' => $source->getId(),
            ':reference' => $source->getReference()));
    }
    
    /**
     * Méthode qui supprime les liens entre une maison et des sources
     * @param int $id l'identifiant de la maison
     */
    protected function deleteSources($id) {
        $sql = "DELETE FROM provenance_maison WHERE propositions_table_id = :id";
        $request = $this->getConnection()->prepare($sql);
        $request->execute(array(':id' => $id));
    }
    
    /**
     * Méthode qui retourne la liste des contacts d'une maison
     * @param int $id l'identifiant de la maison
     * @return array[Contact] Liste des contacts
     */
    public function readContactsMaison($id) {
        $sql = "SELECT * FROM contact JOIN contact_maison ON contact_id = id
                WHERE propositions_table_id = :id";
        $request = $this->getConnection()->prepare($sql);
        $request->execute(array(':id' => $id));
        foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
        {
            $contacts[] = new Contact($result['id'], $result['nom'], 
                    $result['prenom'], $result['num_telephone'], 
                    $result['num_gsm'], $result['mail'], $result['commentaire']);
        }
        return isset( $contacts) ?  $contacts : [];
    }
    
    /**
     * Méthode qui ajoute un lien entre un contact et une maison dans la DB
     * @param int $id   Identifiant de la maison
     * @param array[Contact] $contacts les sources a liées à la maison
     */
    protected function addContacts($id, $contacts) {
        foreach ($contacts as $contact) {
            if($contact->getId() === NULL) {
                $this->getDaoContact()->add($contact);
                $contact->setId($this->getConnection()->lastInsertId());
            }
            else {
                $this->getDaoContact()->update($contact);
            }
            
            $sql = "INSERT INTO contact_maison (propositions_table_id, contact_id)
                    VALUES (:propositision_id, :contact_id)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':propositision_id' => $id,
                ':contact_id' => $contact->getId()));
        }
    }
    
    /**
     * Méthode qui supprime les liens entre une maison et des contacts
     * @param int $id l'identifiant de la maison
     */
    protected function deleteContacts($id) {
        $sql = "DELETE FROM contact_maison WHERE propositions_table_id = :id";
        $request = $this->getConnection()->prepare($sql);
        $request->execute(array(':id' => $id));
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Gestion Maison location">
    /**
     * Méthode qui permet d'ajouter une maison dans la table maisons_table si
     * sont état est location
     * @param Maison $maison
     */
    protected  function addMaisonLocation($maison) {
        if($maison->getEtat()->getId() == self::ETAT_LOCATION) {
            $this->getDaoMaisonLocation()->add($maison);
        }
    }
    
    /**
     * Méthode qui permet de supprimmer une maison de la table maison_table en 
     * fonction de l'id dans la table proposition
     * @param int $id
     */
    protected function deleteMaisonLocation($id) {
        $this->getDaoMaisonLocation()->delete($id);
    }
//</editor-fold>
    
    /**
     * 
     * @return DAOContact
     */
    protected function getDaoContact() {
        return $this->_dao_contact;
    }

    protected function setDaoContact() {
        $this->_dao_contact = new DAOContact();
    }
    
    /**
     * 
     * @return DAOMaisonLocation
     */
    protected function getDaoMaisonLocation() {
        return $this->_dao_maison_location;
    }

    protected function setDaoMaisonLocation() {
        $this->_dao_maison_location = new DAOMaisonLocation();
    }
}

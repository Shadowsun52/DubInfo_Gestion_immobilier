<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Commune;
use DubInfo_gestion_immobilier\model\Etat;
use DubInfo_gestion_immobilier\model\SourceMaison;
use DubInfo_gestion_immobilier\model\Contact;
use DubInfo_gestion_immobilier\Exception\PDOException;

/**
 * Description of DAOMaison
 *
 * @author Jenicot Alexandre
 */
class DAOMaison extends AbstractDAO{
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
                    raison_abandon) VALUES (:titre, NOW(), :commentaire, 
                    :adresse_rue, :adresse_numero, :commune, :prix, :superficie,
                    :nb_sdb, :cout_travaux, :etat, :raison_abandon)";
            $request = $this->getConnection()->prepare($sql);
            $result = $request->execute(array(
                ':titre' => $maison->getTitre(Maison::LANGUAGE_FR),
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
                $this->addContact($id, $maison->getContact(0));
            }
            else {
                throw new PDOException('Erreur lors de l\'ajout!');
            }
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function delete($id) {
        
    }

    public function read($id) {
        
    }

    /**
     * Fonction qui lit tous les maisons pour les mettres dans une listes
     * Donc pas toute les informations sont lu pour, uniquement l'id, le titre 
     * et la commune
     * @return array[Maison]
     * @throws PDOException
     */
    public function readList() {
        try{
            $sql = "SELECT pt.id, pt.titre_fr, cbt.name FROM propositions_table pt
                    LEFT JOIN communes_bruxelles_table cbt ON pt.commune_id = cbt.id 
                    ORDER BY pt.titre_fr, cbt.name ";
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

    public function update($object) {
        
    }

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
     * Méthode qui ajoute un lien entre un contact et une maison dans la DB
     * @param int $id   Identifiant de la maison
     * @param Contact $contact la source a liée à la maison
     */
    protected function addContact($id, $contact) {
        $sql = "INSERT INTO contact_maison (propositions_table_id, contact_id, 
                reference_maison) VALUES (:propositision_id, :contact_id)";
        $request = $this->getConnection()->prepare($sql);
        $request->execute(array(
            ':propositision_id' => $id,
            ':contact_id' => $contact->getId()));
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
}

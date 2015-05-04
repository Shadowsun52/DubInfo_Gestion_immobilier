<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Projet;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Etat;
use DateTime;
/**
 * Description of DAOProjet
 *
 * @author Jenicot Alexandre
 */
class DAOProjet extends AbstractDAO{
    /**
     * Méthode permettant d'ajouter un projet dans la DB
     * @param Projet $projet
     * @throws PDOException
     */
    public function add($projet) {
        try {
            $sql = "INSERT INTO projet (date_signature_compromis, date_signature_acte,
                    plan_metre_fait, devis_entrepreneur_confirme, 
                    selection_materiaux_fait, date_reception_chantier, 
                    commande_mobilier_fait, date_livraison_mobilier, 
                    propositions_table_id, investisseur_id, etat_id, commentaire) 
                    VALUES (:compromis, :acte, :plan_metre, :devis_entrepreneur, 
                    :selection_materiaux, :date_chantier, :commande_mobilier, 
                    :date_mobilier, :maison, :investisseur, :etat, :commentaire)";
            $request = $this->getConnection()->prepare($sql);
            
            //préparation des dates
            $compromis = $this->writeDate($projet->getDateSignatureCompromis());
            $acte = $this->writeDate($projet->getDateSignatureActe());
            $mobilier = $this->writeDate($projet->getDateLivraisonMobilier());
            $chantier = $this->writeDate($projet->getDateReceptionChantier());

            $request->execute(array(
                ':compromis' => $compromis,
                ':acte' => $acte,
                ':plan_metre' => $projet->getPlanMetreFait(),
                ':devis_entrepreneur' => $projet->getDevisEntrepreneurConfirmer(),
                ':selection_materiaux' => $projet->getSelectionMateriauxFait(),
                ':date_chantier' => $chantier,
                ':commande_mobilier' => $projet->getCommandeMobilierFait(),
                ':date_mobilier' => $mobilier,
                ':maison' => $projet->getMaison()->getIdProposition(),
                ':investisseur' => $projet->getInvestisseur()->getId(),
                ':etat' => $projet->getEtat()->getId(),
                ':commentaire' => $projet->getCommentaire()));      
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     *  Méthode qui permet la suppression d'un projet
     * @param int $id Identifiant du projet à supprimer
     * @throws PDOException
     */
    public function delete($id) {
        try {  
            $sql = "DELETE FROM projet WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui retourne un projet  par rapport à un id donné
     * @param int $id
     * @return Projet
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM projet WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            $maison = new Maison($result['propositions_table_id']);
            $investisseur = new Investisseur($result['investisseur_id']);
            $etat = new Etat($result['etat_id']);
            //création des dates
            $compromis = $this->readDate($result['date_signature_compromis']);
            $acte = $this->readDate($result['date_signature_acte']);
            $date_mobilier = $this->readDate($result['date_livraison_mobilier']);
            $date_chantier = $this->readDate($result['date_reception_chantier']);
            
            //création de projet
            $projet = new Projet($id, null, $etat, $compromis, $acte, 
                    $result['plan_metre_fait'], $result['devis_entrepreneur_confirme'], 
                    $result['selection_materiaux_fait'], $date_chantier, 
                    $result['commande_mobilier_fait'], $date_mobilier, 
                    $result['commentaire'], $maison, $investisseur);
            
            return $projet;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les projets d'un investisseur donné pour les
     * mettres dans une listes
     * on récupere uniquement l'id et le titre de la maison et l'état
     * @param int $id l'identifiant de l'investisseur
     * @return array[Projet]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT p.id, pt.titre_fr, e.libelle FROM projet p
                    JOIN propositions_table pt ON p.propositions_table_id = pt.id
                    JOIN etat e ON p.etat_id = e.id WHERE p.investisseur_id = :id
                    ORDER BY pt.titre_fr";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $projet = new Projet($result['id']);
                $maison = new Maison();
                $maison->addTitre(Maison::LANGUAGE_FR, $result['titre_fr']);
                $projet->setMaison($maison);
                $projet->setEtat(new Etat(null, $result['libelle']));
                $projets[] = $projet;
            }
            return isset( $projets) ?  $projets : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }

    /**
     * Méthode pour créer un DateTime à partir de données provenant d'une DB
     * @param string $date
     * @return DateTime
     */
    protected function readDate($date) {
        if($date == '') {
            return null;
        }
        else {
            return new DateTime($date);
        }
    }
    
    /**
     * Méthode retournant une date sous format string écrivable dans une DB
     * @param DateTime $date
     * @return string
     */
    protected function writeDate($date) {
        if($date === NULL) {
            return null;
        }
        else {
            return $date->format('Y-m-d H:i:s');
        }
    }
}

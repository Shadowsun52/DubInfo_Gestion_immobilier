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
            if($projet->getDateSignatureCompromis()=== NULL) {
                $compromis = null;
            }
            else {
                $compromis = $projet->getDateSignatureCompromis()->format('Y-m-d H:i:s');
            }
            
            if($projet->getDateSignatureActe()=== NULL) {
                $acte = null;
            }
            else {
                $acte = $projet->getDateSignatureActe()->format('Y-m-d H:i:s');
            }
            
            if($projet->getDateLivraisonMobilier()=== NULL) {
                $mobilier = null;
            }
            else {
                $mobilier = $projet->getDateLivraisonMobilier()->format('Y-m-d H:i:s');
            }
            
            if($projet->getDateReceptionChantier()=== NULL) {
                $chantier = null;
            }
            else {
                $chantier = $projet->getDateReceptionChantier()->format('Y-m-d H:i:s');
            }
            
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

    public function delete($id) {
        
    }

    public function read($id) {
        
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

}

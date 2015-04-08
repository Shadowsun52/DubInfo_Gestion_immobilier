<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;

/**
 * Description of Projet
 *
 * @author Jenicot Alexandre
 */
class Projet extends Proposition{
    const MAX_SIZE_COMMENTAIRE = 500;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_signature_compromis;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_signature_acte;
    
    /**
     *
     * @var boolean 
     */
    private $_plan_metre_fait;
    
    /**
     *
     * @var boolean 
     */
    private $_devis_entrepreneur_confirmer;
    
    /**
     *
     * @var boolean 
     */
    private $_selection_materiaux_fait;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_reception_chantier;
    
    /**
     *
     * @var boolean 
     */
    private $_commande_mobilier_fait;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_livraison_mobilier;
    
    /**
     *
     * @var string 
     */
    private $_commentaire;
    
    /**
     * 
     * @param int $id
     * @param double $prix_achat
     * @param Etat $etat
     * @param DateTime $date_signature_compromis
     * @param DateTime $date_signature_acte
     * @param boolean $plan_metre_fait
     * @param boolean $devis_entrepreneur_confirmer
     * @param boolean $selection_materiaux_fait
     * @param DateTime $date_reception_chantier
     * @param boolean $commande_mobilier_fait
     * @param DateTime $date_livraison_mobilier
     * @param string $commentaire
     * @param Maison $maison
     * @param Investisseur $investisseur
     */
    public function __construct($id = NULL, $prix_achat = NULL, $etat = NULL, 
            $date_signature_compromis = NULL, $date_signature_acte = NULL, 
            $plan_metre_fait = NULL, $devis_entrepreneur_confirmer = NULL,
            $selection_materiaux_fait = NULL, $date_reception_chantier = NULL,
            $commande_mobilier_fait = NULL, $date_livraison_mobilier = NULL, 
            $commentaire = NULL, $maison = NULL, $investisseur = NULL) {
        parent::__construct($id, $prix_achat, $etat, $maison, $investisseur);
        $this->setDateSignatureCompromis($date_signature_compromis);
        $this->setDateSignatureActe($date_signature_acte);
        $this->setPlanMetreFait($plan_metre_fait);
        $this->setDevisEntrepreneurConfirmer($devis_entrepreneur_confirmer);
        $this->setSelectionMateriauxFait($selection_materiaux_fait);
        $this->setDateReceptionChantier($date_reception_chantier);
        $this->setCommandeMobilierFait($commande_mobilier_fait);
        $this->setDateLivraisonMobilier($date_livraison_mobilier);
        $this->setCommentaire($commentaire);
        
    }
    
//<editor-fold defaultstate="collapsed" desc="Signature">
    /**
     * 
     * @return DateTime
     */
    public function getDateSignatureCompromis() {
        return $this->_date_signature_compromis;
    }
    
    /**
     * 
     * @return boolean
     */
    public function SignatureCompromisFait() {
        if($this->_date_signature_compromis == NULL) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * 
     * @param DateTime $date_signature_compromis
     * @throws BadTypeException
     */
    public function setDateSignatureCompromis($date_signature_compromis) {
        $this->_date_signature_compromis = CheckTyper::isDateTime(
                $date_signature_compromis, 'date signature compromis', __CLASS__);
    }
    
    /**
     * 
     * @return DateTime
     */
    public function getDateSignatureActe() {
        return $this->_date_signature_acte;
    }
    
    /**
     * 
     * @return boolean
     */
    public function SignatureActeFait() {
        if($this->_date_signature_acte == NULL) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * 
     * @param DateTime $date_signature_acte
     * @throws BadTypeException
     */
    public function setDateSignatureActe($date_signature_acte) {
        $this->_date_signature_acte = CheckTyper::isDateTime(
                $date_signature_acte, 'date signature acte', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Chantier">
    /**
     * 
     * @return boolean
     */
    public function getPlanMetreFait() {
        return $this->_plan_metre_fait;
    }
    
    /**
     * 
     * @param boolean $plan_metre_fait
     * @throws BadTypeException
     */
    public function setPlanMetreFait($plan_metre_fait) {
        $this->_plan_metre_fait = CheckTyper::isBoolean($plan_metre_fait, 
                'plan metre fait', __CLASS__);
    }
    
    /**
     * 
     * @return boolean
     */
    public function getDevisEntrepreneurConfirmer() {
        return $this->_devis_entrepreneur_confirmer;
    }
    
    /**
     * 
     * @param boolean $devis_entrepreneur_confirmer
     * @throws BadTypeException
     */
    public function setDevisEntrepreneurConfirmer($devis_entrepreneur_confirmer) {
        $this->_devis_entrepreneur_confirmer = CheckTyper::isBoolean(
                $devis_entrepreneur_confirmer, 'devis entrepreneur confirmer', __CLASS__);
    }
    
    /**
     * 
     * @return boolean
     */
    public function getSelectionMateriauxFait() {
        return $this->_selection_materiaux_fait;
    }
    
    /**
     * 
     * @param boolean $selection_materiaux_fait
     * @throws BadTypeException
     */
    public function setSelectionMateriauxFait($selection_materiaux_fait) {
        $this->_selection_materiaux_fait = CheckTyper::isBoolean(
                $selection_materiaux_fait, 'selection materiaux fait', __CLASS__);
    }
    
    /**
     * 
     * @return DateTime
     */
    public function getDateReceptionChantier() {
        return $this->_date_reception_chantier;
    }
    
    /**
     * 
     * @return boolean
     */
    public function DateReceptionChantierFixer() {
        if($this->_date_reception_chantier == NULL) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * 
     * @param DateTime $date_reception_chantier
     * @throws BadTypeException
     */
    public function setDateReceptionChantier($date_reception_chantier) {
        $this->_date_reception_chantier = CheckTyper::isDateTime(
                $date_reception_chantier, 'date reception chantier', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Mobiliers">
    /**
     * 
     * @return boolean
     */
    public function getCommandeMobilierFait() {
        return $this->_commande_mobilier_fait;
    }
    
    /**
     * 
     * @param boolean $commande_mobilier_fait
     * @throws BadTypeException
     */
    public function setCommandeMobilierFait($commande_mobilier_fait) {
        $this->_commande_mobilier_fait = CheckTyper::isBoolean(
                $commande_mobilier_fait, 'commande mobilier fait', __CLASS__);
    }
    
    /**
     * 
     * @return DateTime
     */
    public function getDateLivraisonMobilier() {
        return $this->_date_livraison_mobilier;
    }
    
    /**
     * 
     * @return boolean
     */
    public function DateLivraisonMobilierFixer() {
        if($this->_date_livraison_mobilier == NULL) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * 
     * @param DateTime $date_livraison_mobilier
     * @throws BadTypeException
     */
    public function setDateLivraisonMobilier($date_livraison_mobilier) {
        $this->_date_livraison_mobilier = CheckTyper::isDateTime(
                $date_livraison_mobilier, 'date livraison mobilier', __CLASS__);
    }
//</editor-fold>
    
    /**
     * 
     * @return string
     */
    public function getCommentaire() {
        return $this->_commentaire;
    }
    
    /**
     * 
     * @param string $commentaire
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setCommentaire($commentaire) {
        $_commentaire = CheckTyper::isString($commentaire, 'commentaire', __CLASS__);
        
        if(strlen($_commentaire) > self::MAX_SIZE_COMMENTAIRE) {
            throw new StringAttributeTooLong('commentaire', __CLASS__);
        }
        
        $this->_commentaire = $_commentaire;
    }
}

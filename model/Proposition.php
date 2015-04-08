<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of Proposition
 *
 * @author Jenicot Alexandre
 */
abstract class Proposition {
    /**
     *
     * @var int 
     */
    private $_id;
    
    /**
     *
     * @var double 
     */
    private $_prix_achat;
    
    /**
     *
     * @var Etat 
     */
    private $_etat;
    
    /**
     *
     * @var Maison 
     */
    private $_maison;
    
    /**
     *
     * @var Investisseur 
     */
    private $_investisseur;
    
    /**
     * 
     * @param int $id
     * @param double $prix_achat
     * @param Etat $etat
     * @param Maison $maison
     * @param Investisseur $investisseur
     * @throws BadTypeException
     */
    public function __construct($id = NULL, $prix_achat = NULL, $etat = NULL, 
            $maison = NULL, $investisseur = NULL) {
        $this->setId($id);
        $this->setPrixAchat($prix_achat);
        $this->setEtat($etat);
        $this->setMaison($maison);
        $this->setInvestisseur($investisseur);
    }
    
    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->_id;
    }
    
    /**
     * 
     * @param int $id
     * @throws BadTypeException
     */
    public function setId($id) {
        $this->_id = CheckTyper::isInteger($id, 'id', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getPrixAchat() {
        return $this->_prix_achat;
    }
    
    /**
     * 
     * @param double $prix_achat
     * @throws BadTypeException
     */
    public function setPrixAchat($prix_achat) {
        $this->_prix_achat = CheckTyper::isDouble($prix_achat, 'prix achat', __CLASS__);
    }
    
    /**
     * 
     * @return Etat
     */
    public function getEtat() {
        return $this->_etat;
    }
    
    /**
     * 
     * @param Etat $etat
     * @throws BadTypeException
     */
    public function setEtat($etat) {
        $this->_etat = CheckTyper::isModel($etat, Etat::class, 'etat', __CLASS__);
    }
    
    /**
     * 
     * @return Maison
     */
    public function getMaison() {
        return $this->_maison;
    }
    
    /**
     * 
     * @param Maison $maison
     * @throws BadTypeException
     */
    public function setMaison($maison) {
        $this->_maison = CheckTyper::isModel($maison, Maison::class, 'maison', __CLASS__);
    }
    
    /**
     * 
     * @return Investisseur
     */
    public function getInvestisseur() {
        return $this->_investisseur;
    }
    
    /**
     * 
     * @param Investisseur $investisseur
     * @throws BadTypeException
     */
    public function setInvestisseur($investisseur) {
        $this->_investisseur = CheckTyper::isModel($investisseur, 
                Investisseur::class, 'investisseur', __CLASS__);
    }
}

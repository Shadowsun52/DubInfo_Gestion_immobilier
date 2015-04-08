<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DubInfo_gestion_immobilier\Exception\ReadOusideArrayException;
/**
 * Description of LettreMission
 *
 * @author Jenicot Alexandre
 */
class LettreMission {
    const MAX_SIZE_COMMENTAIRE = 500;
    
    /**
     *
     * @var int 
     */
    private $_id;
    
    /**
     *
     * @var double 
     */
    private $_budget;
    
    /**
     *
     * @var DateTime 
     */
    private $_delai;
    
    /**
     *
     * @var string 
     */
    private $_commentaire;
    
    /**
     *
     * @var Investisseur 
     */
    private $_investisseur;
    
    /**
     *
     * @var array[Commune] 
     */
    private $_communes;
    
    /**
     * 
     * @param int $id
     * @param double $budget
     * @param DateTime $delai
     * @param string $commmentaire
     * @param Investisseur $investisseur
     * @param array[Commune] $communes
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $budget = NULL, $delai = NULL, 
            $commmentaire = NULL, $investisseur = NULL, $communes = NULL) {
        $this->setId($id);
        $this->setBudget($budget);
        $this->setDelai($delai);
        $this->setCommentaire($commmentaire);
        $this->setInvestisseur($investisseur);
        $this->setCommunes($communes);
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
    public function getBudget() {
        return $this->_budget;
    }
    
    /**
     * 
     * @param double $budget
     * @throws BadTypeException
     */
    public function setBudget($budget) {
        $this->_budget = CheckTyper::isDouble($budget, 'budget', __CLASS__);
    }
    
    /**
     * 
     * @return DateTime
     */
    public function getDelai() {
        return $this->_delai;
    }
    
    /**
     * 
     * @param DateTime $delai
     * @throws BadTypeException
     */
    public function setDelai($delai) {
        $this->_delai = CheckTyper::isDateTime($delai, 'delai', __CLASS__);
    }
    
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
     */
    public function setCommentaire($commentaire) {
        $_commentaire = CheckTyper::isString($commentaire, 'commentaire', __CLASS__);
        
        if(strlen($_commentaire) > self::MAX_SIZE_COMMENTAIRE) {
            throw new StringAttributeTooLong('commentaire', __CLASS__);
        }
        
        $this->_nom = $_commentaire;
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
    
//<editor-fold defaultstate="collapsed" desc="Communes">
    /**
     * 
     * @return array[Commune]
     */
    public function getCommunes() {
        return $this->_communes;
    }
    
    /**
     * 
     * @param array[Commune] $communes
     * @throws BadTypeException
     */
    public function setCommunes($communes) {
        $this->_communes = CheckTyper::isArrayOfModel($communes, Commune::class,
                'communes', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return Commune
     * @throws ReadOusideArrayException
     */
    public function getCommune($id) {
        if($id < count($this->_communes)) {
            return $this->_communes[$id];
        }
        
        throw new ReadOusideArrayException('communes', __CLASS__);
    }
    
    /**
     * 
     * @param Commune $commune
     * @throws BadTypeException
     */
    public function addCommune($commune) {
        $this->_communes[] = CheckTyper::isModel($commune, Commune::class, 
                'commune', __CLASS__);
    }
//</editor-fold>
}

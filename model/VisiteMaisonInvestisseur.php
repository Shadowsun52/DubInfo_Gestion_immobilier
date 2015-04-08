<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of VisiteMaisonInvestisseur
 *
 * @author Jenicot Alexandre
 */
class VisiteMaisonInvestisseur extends VisiteMaison {
    /**
     *
     * @var Investisseur 
     */
    private $_investisseur;
    
    /**
     * 
     * @param int $id
     * @param DateTime $date
     * @param string $rapport
     * @param Maison $maison
     * @param Investisseur $investisseur
     * @param array[User] $participants
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $date = NULL, $rapport = NULL, 
            $maison = NULL, $investisseur = NULL, $participants = NULL) {
        parent::__construct($id, $date, $rapport, $maison, $participants);
        $this->setInvestisseur($investisseur);
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

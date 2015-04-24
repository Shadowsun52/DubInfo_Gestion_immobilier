<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Visite de rencontre entre certains membre du personnel et un investisseur
 * potentiel
 *
 * @author Jenicot Alexandre
 */
class VisiteInvestisseur extends Visite{
    const MAX_SIZE_ENDROIT = 70;
    
    /**
     * Lieu de la visite
     * @var string 
     */
    private $_endroit;
    
    /**
     * L'investisseur rencontré pour cette visite
     * @var Investisseur 
     */
    private $_investisseur;
    
    /**
     * 
     * @param int $id
     * @param DateTime $date
     * @param string $endroit lieu de la visite
     * @param string $rapport 
     * @param Investisseur $investisseur l'investisseur rencontré pour cette visite
     * @param array[User] $participants Employé participant à cette visite
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $date = NULL, $endroit = NULL, 
            $rapport = NULL, $investisseur = NULL, $participants = NULL) {
        parent::__construct($id, $date, $rapport, $participants);
        $this->setEndroit($endroit);
        $this->setInvestisseur($investisseur);
    }
    
    /**
     * 
     * @return string
     */
    public function getEndroit() {
        return $this->_endroit;
    }
    
    /**
     * 
     * @param string $endroit
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setEndroit($endroit) {
        $_endroit = CheckTyper::isString($endroit, 'endroit', __CLASS__);
        
        if(strlen($_endroit) > self::MAX_SIZE_ENDROIT) {
            throw new StringAttributeTooLong('endroit', __CLASS__);
        }
        
        $this->_endroit = $_endroit;
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
     * @param type $investisseur
     * @throws BadTypeException
     */
    public function setInvestisseur($investisseur) {
        $this->_investisseur = CheckTyper::isModel($investisseur, Investisseur::class,
                'investisseur', __CLASS__);
    }
    
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(),
                array(
                    'endroit' => $this->getEndroit(),
                    'investisseur' => $this->getInvestisseur()
                ));
    }
    
    /**
     *
     * @return string
     */
    public function toString() {
        return $this->getInvestisseur()->toString() . ' ' . parent::toString();
    }
}

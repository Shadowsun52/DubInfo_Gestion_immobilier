<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of VisiteMaison
 *
 * @author Jenicot Alexandre
 */
abstract class VisiteMaison extends Visite{
    /**
     *
     * @var Maison 
     */
    private $_maison;
    
    /**
     * 
     * @param int $id
     * @param DateTime $date
     * @param string $rapport
     * @param Maison $maison
     * @param array[User] $participants
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($id = NULL, $date = NULL, $rapport = NULL, 
            $maison = NULL, $participants = NULL) {
        parent::__construct($id, $date, $rapport, $participants);
        $this->setMaison($maison);
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
     */
    public function setMaison($maison) {
        $this->_maison = CheckTyper::isModel($maison, Maison::class, 'maison', __CLASS__);
    }
}

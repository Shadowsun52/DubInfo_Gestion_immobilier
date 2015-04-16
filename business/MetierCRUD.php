<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOMetier;
use DubInfo_gestion_immobilier\model\Metier;
/**
 * Description of MetierCRUD
 *
 * @author Jenicot Alexandre
 */
class MetierCRUD extends AbstractBusiness{
    
    public function __construct() {
        parent::__construct(new DAOMetier(), 'metier');
    }
    
    /**
     * Méthode permettant de créer un object métier à l'aide d'un tableau de donnée
     * @param array[mixed] $data 
     * @return Metier 
     */
    public function createObject($data) {
        return new Metier($data['select_id'], $data['libelle']);
    }
}

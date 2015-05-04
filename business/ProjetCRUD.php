<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOProjet;
use DubInfo_gestion_immobilier\model\Projet;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\Maison;
use DateTime;
/**
 * Description of ProjetCRUD
 *
 * @author Jenicot Alexandre
 */
class ProjetCRUD extends VisiteBusiness{
    
    public function __construct() {
        parent::__construct(new DAOProjet(), 'projet');
    }
    
    public function createObject($data) {
        
    }
}

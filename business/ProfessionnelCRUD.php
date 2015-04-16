<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\business\AbstractBusiness;
use DubInfo_gestion_immobilier\data\DAOProfessionnel;
use DubInfo_gestion_immobilier\model\Professionnel;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
/**
 * Description of ProfessionnelCRUD
 *
 * @author Jenicot Alexandre
 */
class ProfessionnelCRUD extends AbstractBusiness{
    public function __construct() {
        parent::__construct(new DAOProfessionnel(), 'professionnel');
    }
    
    /**
     * Méthode permettant de créer un object professionnel à l'aide d'un tableau de donnée
     * @param array[mixed] $data 
     * @return Metier 
     */
    public function createObject($data) {
        //TODO faire la methode create
    }

}

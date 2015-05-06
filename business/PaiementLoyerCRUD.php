<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOPaiement;
/**
 * Description of PaiementLoyerCRUD
 *
 * @author Jenicot Alexandre
 */
class PaiementLoyerCRUD extends FilterBusiness{
    
    public function __construct() {
        parent::__construct(new DAOPaiement(), 'paiement loyer');
    }
    
    public function createObject($data) {
        
    }

}

<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOUser;
/**
 * Description of UserCRUD
 *
 * @author Jenicot Alexandre
 */
class UserCRUD extends AbstractBusiness{
    public function __construct() {
        parent::__construct(new DAOUser(), 'utilisateur');
    }
    
    public function createObject($data) {
        return null;
    }

}

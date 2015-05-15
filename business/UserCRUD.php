<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOUser;
use DubInfo_gestion_immobilier\model\User;
/**
 * Description of UserCRUD
 *
 * @author Jenicot Alexandre
 */
class UserCRUD extends AbstractBusiness{
    public function __construct() {
        parent::__construct(new DAOUser(), 'utilisateur');
    }
    
    /**
     * Méthode qui regarde si les informations de connexion sont correcte
     * @param User $user l'utilisateur encodé dans le formulaire de connexion
     */
    public function checkConnexion($user) {
        $user_read = $this->getDao()->read($user->getLogin());
        
        if($user_read && $this->samePassword($user, $user_read)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Méthode qui vérifie que les deux users ont le même mot de passe
     * @param User $user_encode utilisateur encodé dans le formulaire de connexion
     * @param User $user_read uitlisateur lut dans la DB
     * @return boolean
     */
    protected function samePassword($user_encode, $user_read) {
        return sha1($user_encode->getPassword()) === $user_read->getPassword();
    }


    public function createObject($data) {
        return null;
    }

}

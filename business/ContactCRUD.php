<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOContact;
use DubInfo_gestion_immobilier\model\Contact;
/**
 * Description of ContactCRUD
 *
 * @author Jenicot Alexandre
 */
class ContactCRUD extends AbstractBusiness{
    
    public function __construct() {
        parent::__construct(new DAOContact(), 'contact');
    }
    
    /**
     * Méthode créant un objet contact à l'aide de données provenant d'un
     * formulaire
     * @param array[mixed] $data
     * @return Locataire
     */
    public function createObject($data) {
        //création du contact
        $contact = new Contact($data['select_id'], $data['nom'], 
                $data['prenom'], $data['num_tel'], $data['num_gsm'], 
                $data['mail'], $data['remarque']);
        
        return $contact;
    }

}

<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\model\User;
use DateTime;
/**
 * Description of VisiteBusiness
 *
 * @author Jenicot Alexandre
 */
abstract class VisiteBusiness extends FilterBusiness{  
    
    /**
     * Méthode qui permet de créer la date de la visite
     * @param array[mixed] $data
     * @return DateTime
     */
    protected function createDateVisite($data) {
       if($data['date_visite'] === '') {
           return null;
       }
       return new DateTime($data['date_visite']);
   }
    
    /**
    * Méthode qui créer la liste des participants à une rencontre en fonction
    * des données du formulaire
    * @param array[mixed] $data
    * @return User
    */
   protected function createParticipants($data){
       if(isset($data['select_participants'])) {
            foreach ($data['select_participants'] as $id_participant) {
                $participants[] = new User($id_participant);
            }
            return $participants;
        }
        
        return null;
   }
}

<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\model\User;
use DateTime;
/**
 * Description of VisiteBusiness
 *
 * @author Jenicot Alexandre
 */
abstract class VisiteBusiness extends AbstractBusiness{
    /**
     * Fonction qui retourne la liste des objets pour un certain choix
     * @param int $data donnée envoyer avec la requête ajax
     * @return array[mixed]
     * @throws PDOException
     */
    public function readList($data) {
        return $this->getDao()->readList($data['id']);
    }
    
    protected function createDate($data) {
        
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

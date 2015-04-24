<?php
namespace DubInfo_gestion_immobilier\business;
use DubInfo_gestion_immobilier\data\DAOVisiteInvestisseur;
use DubInfo_gestion_immobilier\model\VisiteInvestisseur;
use DubInfo_gestion_immobilier\model\Investisseur;
use DubInfo_gestion_immobilier\model\User;
use DateTime;

/**
 * Description of rencontreInvestisseurCRUD
 *
 * @author Jenicot Alexandre
 */
class rencontreInvestisseurCRUD extends VisiteBusiness{
    public function __construct() {
        parent::__construct(new DAOVisiteInvestisseur(), 
                'rencontre avec un investisseur', self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet visiteInvestisseur à l'aide de données provenant 
     * d'un formulaire
     * @param array[mixed] $data
     * @return VisiteInvestisseur
     */
    public function createObject($data) {
        $investisseur = new Investisseur($data['select_investisseur']);
        $date = $this->createDate($data);
        $participants = $this->createParticipants($data);
        
        $visite = new VisiteInvestisseur($data['select_id'], $date, 
                $data['endroit'], $data['rapport'], $investisseur, $participants);
        return $visite;
    }

    protected function createDate($data) {
       if($data['date_rencontre'] === '') {
           return null;
       }
       
       return new DateTime($data['date_rencontre']);
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

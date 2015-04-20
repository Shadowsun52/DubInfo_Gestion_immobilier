<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOLocataire;
use DubInfo_gestion_immobilier\model\Locataire;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Etat;
use DubInfo_gestion_immobilier\model\SourceLocataire;
use DubInfo_gestion_immobilier\model\Commune;
use DateTime;

/**
 * Description of LocataireCRUD
 *
 * @author Jenicot Alexandre
 */
class LocataireCRUD extends AbstractBusiness{
    
    public function __construct() {
        parent::__construct(new DAOLocataire(), 'locataire');
    }
    
    /**
     * Méthode créant un objet locataire à l'aide de données provenant d'un
     * formulaire
     * @param array[mixed] $data
     * @return Locataire
     */
    public function createObject($data) {
        //Etat
        $etat = new Etat($data['select_etat']);
        
        //adresse
        $adresse = $this->createAdresse($data);
        
        //source
        $source = $this->createSource($data);
        
        //commune préféree
        $communes = $this->createCommunesPreferees($data);
        
        //date d'emmenagement
        $date_emmenagement = $this->createDateEmmenagement($data);
        //création du locataire
        $locataire = new Locataire($data['select_id'], $data['nom'], 
                $data['prenom'], $data['num_tel'], $data['num_gsm'], 
                $data['mail'], $data['budget'], $date_emmenagement, 
                $data['remarque'], $etat, $adresse, null, $communes);
        $locataire->addSource($source);
        
        return $locataire;
    }
    
    /**
     * Méthode qui retourne l'adresse noté dans le formulaire
     * @param array[mixed] $data
     * @return Adresse
     */
    protected function createAdresse($data) {
        $ville = new Ville(null, $data['select_cp'], $data['select_villes'], 
                $data['select_pays']);
        return new Adresse($data['rue'], $data['numero'], $data['boite'], 
                $ville);
    }
    
    /**
     * Méthode qui retourne la source choisi dans le formulaire pour le locataire
     * @param array[mixed] $data
     * @return SourceLocataire
     */
    protected function createSource($data) {
        if($data['select_source'] === '@Autre') {
            return new SourceLocataire(null, $data['new_source']);
        }
        else {
            return new SourceLocataire($data['select_source']);
        }
    }
    
    /**
     * Méthode qui retourne un tableau des communes préférées choisi pour le 
     * locataire.
     * Si rien n'est choisi retourne NULL
     * @param array[mixed] $data
     */
    protected function createCommunesPreferees($data) {
        if(isset($data['select_communes'])) {
            foreach ($data['select_communes'] as $id_commune) {
                $communes[] = new Commune($id_commune);
            }
            return $communes;
        }
        
        return null;
    }
    
   protected function createDateEmmenagement($data) {
       if($data['date_rentree'] === '') {
           return null;
       }
       
       return new DateTime($data['date_rentree']);
   }
}

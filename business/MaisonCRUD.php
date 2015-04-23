<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOMaison;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Commune;
use DubInfo_gestion_immobilier\model\Etat;
use DubInfo_gestion_immobilier\model\SourceMaison;
use DubInfo_gestion_immobilier\model\Contact;
use DubInfo_gestion_immobilier\Exception\NomContactException;

/**
 * Description of MaisonCRUD
 *
 * @author Jenicot Alexandre
 */
class MaisonCRUD extends AbstractBusiness{
    
    public function __construct() {
        parent::__construct(new DAOMaison(), 'maison', self::GENRE_FEMININ);
    }
    
    /**
     * Méthode créant un objet maison à l'aide de données provenant d'un
     * formulaire
     * @param array[mixed] $data
     * @return Maison
     * @throws NomContactException
     */
    public function createObject($data) {
        $adresse = new Adresse($data['rue'], $data['numero']);
        $commune = new Commune($data['select_commune']);
        $etat = new Etat($data['select_etat']);
        $source = new SourceMaison($data['select_source'], null, $data['reference']);
        $contacts = $this->createContacts($data);
        
        /*La seconde valeur NULL correspond à raison_abandon qui n'est pas encore
         * gérer dans cette version du programme
         */
        $maison = new Maison($data['select_id'], null, $data['prix'],
                $data['superficie_habitable'], $data['select_sdb'], 
                $data['cout_travaux'], $data['remarque'], null, $etat, $commune, 
                $adresse);
        $maison->addTitre(Maison::LANGUAGE_FR, $data['titre']);
        $maison->addSource($source);
        $maison->setContacts($contacts);
        return $maison;
    }  
    
    /**
     * Méthode créer la liste des contacts d'une maison
     * @param type $data
     * @return Contact
     * @throws NomContactException
     */
    protected function createContacts($data) {
        $contacts = [];
        $id_contact = []; //permet d'éviter les doublons
        
        for($i = 1; isset($data['select_contact' . $i]) 
                && $data['select_contact' . $i] != ''; $i++) {
            if(!in_array($data['select_contact' . $i], $id_contact)) {
                if($data['select_contact' . $i] == '@Autre@') {
                    $id = null;
                }
                else {
                    $id = $data['select_contact' . $i];
                    $id_contact[] = $id;
                }
                
                if($data['contact_nom' . $i] === '') {
                    throw new NomContactException($i);
                }
                $contacts[] = new Contact($id, $data['contact_nom' . $i], 
                        $data['contact_prenom' . $i], $data['contact_num_tel' . $i], 
                        $data['contact_num_gsm' . $i], $data['contact_mail' . $i], 
                        $data['contact_remarque' .$i]);
            }
        }
        
        return $contacts;
    }
}

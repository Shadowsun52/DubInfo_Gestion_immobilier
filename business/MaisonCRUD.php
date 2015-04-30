<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\DAOMaison;
use DubInfo_gestion_immobilier\model\Maison;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Commune;
use DubInfo_gestion_immobilier\model\Etat;
use DubInfo_gestion_immobilier\model\SourceMaison;
use DubInfo_gestion_immobilier\model\Contact;
use DubInfo_gestion_immobilier\model\Chambre;
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
        $source = new SourceMaison($data['select_source'], null, 
                $data['reference_source']);
        $contacts = $this->createContacts($data);
        $maison = new Maison($data['select_id'], null, $data['reference'], $data['prix'], 
                $data['prix_conseille'], $data['rendement'], $data['superficie_habitable'], 
                $data['select_sdb'], $data['cout_travaux'], $data['dossier'], 
                $data['localisation'], $data['select_localisation_indice'], 
                $data['qualite'], $data['select_qualite_indice'], $data['remarque'], 
                $data['raison_abandon'], $data['show'], $etat, $commune, $adresse);
        $maison->addTitre(Maison::LANGUAGE_FR, $data['titre']);
        $maison->addSource($source);
        $maison->setContacts($contacts);
        $maison->setChambres($this->createChambres($data));
        return $maison;
    }  
    
    /**
     * Méthode qui permet de retourner les contacts d'une maison
     * @param array[mixed] $data
     * @return array[Contact]
     */
    public function readContact($data) {
        return $this->getDao()->readContactsMaison($data['id']);
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
    
    /**
     * Méthode qui créer le nombre de chambres choisi dans le formulaire
     * @param array[mixed] $data
     * @return array[Chambre]
     */
    protected function createChambres($data) {
        for ($i = 0; $i < $data['select_chambres']; $i++) {
            $chambres[] = new Chambre();
        }
        
        return isset($chambres) ? $chambres : [];
    }
}

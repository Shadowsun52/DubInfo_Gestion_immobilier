<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
use DubInfo_gestion_immobilier\Exception\ReadOusideArrayException;
use DubInfo_gestion_immobilier\Exception\KeyDontExistException;
/**
 * Description of Maison
 *
 * @author Jenicot Alexandre
 */
class Maison {
    const MAX_SIZE_TITRE = 100;
    const MAX_SIZE_DESCR = 500;
    const MAX_SIZE_ADRESSE = 70;
    const MAX_SIZE_COMMENTAIRE = 500;
    const MAX_SIZE_RAISON_ABANDON = 500;
    const LANGUAGE_FR = "french";
    const LANGUAGE_NE = "dutch";
    const LANGUAGE_EN = "english";
    
    /**
     *
     * @var int 
     */
    private $_id_maison;
    
    /**
     *
     * @var int 
     */
    private $_id_proposition;
    
    /**
     *
     * @var array[string] 
     */
    private $_titres;
    
    /**
     *
     * @var array[string] 
     */
    private $_descriptions;
    
    /**
     *
     * @var array[string] 
     */
    private $_descriptions_chambres;
    
    /**
     *
     * @var array[string] 
     */
    private $_description_charges;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_creation;
    
    /**
     *
     * @var DateTime 
     */
    private $_date_modification;
    
    /**
     *
     * @var string 
     */
    private $_adresse;
    
    /**
     *
     * @var Commune 
     */
    private $_commune;
    
    /**
     *
     * @var double 
     */
    private $_prix;
    
    /**
     *
     * @var int 
     */
    private $_superficie_habitable;
    
    /**
     *
     * @var int 
     */
    private $_nb_salle_de_bain;
    
    /**
     *
     * @var double 
     */
    private $_cout_travaux;
    
    /**
     *
     * @var string 
     */
    private $_commentaire;
    
    /**
     *
     * @var string 
     */
    private $_raison_abandon;
    
    /**
     *
     * @var Etat 
     */
    private $_etat;
    
    /**
     *
     * @var array[Chambre] 
     */
    private $_chambres;
    
    /**
     *
     * @var array[Contact] 
     */
    private $_contacts;
    
    /**
     *
     * @var array[SourceMaison] 
     */
    private $_sources;
    
    
    public function __construct($id_proposition = NULL, $id_maison = NULL, $date_creation = NULL, 
            $date_modification = NULL, $adresse = NULL, $prix = NULL, $superficie_habitable = NULL,
            $nb_salle_de_bain = NULL, $cout_travaux = NULL, $titres = NULL, $descriptions = NULL,
            $descriptions_chambres = NULL, $descriptions_charges = NULL, $commentaire = NULL,
            $raison_abandon = NULL, $etat = NULL, $chambres = NULL, $contacts = NULL, $sources = NULL) {
        $this->setIdProposition($id_proposition);
        $this->setIdMaison($id_maison);
        $this->setDateCreation($date_creation);
        $this->setDateModification($date_modification);
        $this->setAdresse($adresse);
        $this->setPrix($prix);
        $this->setSuperficieHabitable($superficie_habitable);
        $this->setNbSalleDeBain($nb_salle_de_bain);
        $this->setCoutTravaux($cout_travaux);
        $this->setTitres($titres);
        $this->setDescriptions($descriptions);
        $this->setDescriptionsChambres($descriptions_chambres);
        $this->setDescriptionsCharges($descriptions_charges);
        $this->setCommentaire($commentaire);
        $this->setRaisonAbandon($raison_abandon);
        $this->setEtat($etat);
        $this->setChambres($chambres);
        $this->setContacts($contacts);
        $this->setSources($sources);
    }
    
//<editor-fold defaultstate="collapsed" desc="Id">
    /**
     * 
     * @return int
     */
    public function getIdMaison() {
        return $this->_id_maison;
    }
    
    /**
     * 
     * @param int $id_maison
     * @throws BadTypeException
     */
    public function setIdMaison($id_maison) {
        $this->_id_maison = CheckTyper::isInteger($id_maison, 'id maison', __CLASS__);
    }
    
    /**
     * 
     * @return int
     */
    public function getIdProposition() {
        return $this->_id_proposition;
    }
    
    /**
     * 
     * @param int $id_proposition
     * @throws BadTypeException
     */
    public function setIdProposition($id_proposition) {
        $this->_id_proposition = CheckTyper::isInteger($id_proposition, 
                'id proposition', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Titre & description">
    /**
     * 
     * @return array[string]
     */
    public function getTitres() {
        return $this->_titres;
    }
    
    /**
     * 
     * @param array[string] $titres
     * @throws BadTypeException
     * @throws KeyDontExistException
     * @throws StringAttributeTooLong
     */
    public function setTitres($titres) {
        foreach ($titres as $language => $titre) {
            if($this->languageExist($language) 
                    && strlen($titre) > self::MAX_SIZE_TITRE) {
                throw new StringAttributeTooLong('titres', __CLASS__);
            }
        }
        $this->_titres = CheckTyper::isArrayOfString($titres, 'titres', __CLASS__);    
    }
    
    /**
     * Retourne le titre de la maison dans la langue donnée 
     * @param string $language  Langue voulu
     * @return string
     * @throws KeyDontExistException
     */
    public function getTitre($language) {
        if($this->languageExist($language)) {
            return $this->_titres[$language];
        }
    }
    
    /**
     * 
     * @param string $language
     * @param string $titre
     * @throws KeyDontExistException
     * @throws BadTypeException
     */
    public function addTitre($language, $titre) {
        if($this->languageExist($language) && strlen($titre) > self::MAX_SIZE_TITRE) {
            throw new StringAttributeTooLong('titre', __CLASS__);
        }
        $this->_titres[] = CheckTyper::isString($titre, 'titre', __CLASS__);
    }
    
    /**
     * 
     * @return array[string]
     */
    public function getDescriptions() {
        return $this->_descriptions;
    }
    
    /**
     * 
     * @param array[string] $descriptions
     * @throws BadTypeException
     * @throws KeyDontExistException
     * @throws StringAttributeTooLong
     */
    public function setDescriptions($descriptions) {
        foreach ($descriptions as $language => $description) {
            if($this->languageExist($language) 
                    && strlen($description) > self::MAX_SIZE_DESCR) {
                throw new StringAttributeTooLong('descriptions', __CLASS__);
            }
        }
        $this->_descriptions = CheckTyper::isArrayOfString($descriptions, 
                'descriptions', __CLASS__);    
    }
    
    /**
     * Retourne le titre de la maison dans la langue donnée 
     * @param string $language  Langue voulu
     * @return string
     * @throws KeyDontExistException
     */
    public function getDescription($language) {
        if($this->languageExist($language)) {
            return $this->_descriptions[$language];
        }
    }
    
    /**
     * 
     * @param string $language
     * @param string $description
     * @throws KeyDontExistException
     * @throws BadTypeException
     */
    public function addDescription($language, $description) {
        if($this->languageExist($language) && strlen($description) > self::MAX_SIZE_DESCR) {
            throw new StringAttributeTooLong('description', __CLASS__);
        }
        $this->_descriptions[] = CheckTyper::isString($description, 'description', __CLASS__);
    }
    
    /**
     * 
     * @return array[string]
     */
    public function getDescriptionsChambres() {
        return $this->_descriptions_chambres;
    }
    
    /**
     * 
     * @param array[string] $descriptions_chambres
     * @throws BadTypeException
     * @throws KeyDontExistException
     * @throws StringAttributeTooLong
     */
    public function setDescriptionsChambres($descriptions_chambres) {
        foreach ($descriptions_chambres as $language => $titre) {
            if($this->languageExist($language) 
                    && strlen($titre) > self::MAX_SIZE_DESCR) {
                throw new StringAttributeTooLong('descriptions chambres', __CLASS__);
            }
        }
        $this->_descriptions_chambres = CheckTyper::isArrayOfString($descriptions_chambres,
                'descriptions chambres', __CLASS__);    
    }
    
    /**
     * Retourne le titre de la maison dans la langue donnée 
     * @param string $language  Langue voulu
     * @return string
     * @throws KeyDontExistException
     */
    public function getDescriptionChambres($language) {
        if($this->languageExist($language)) {
            return $this->_descriptions_chambres[$language];
        }
    }
    
    /**
     * 
     * @param string $language
     * @param string $description_chambres
     * @throws KeyDontExistException
     * @throws BadTypeException
     */
    public function addDescriptionChambres($language, $description_chambres) {
        if($this->languageExist($language) && strlen($description_chambres) > self::MAX_SIZE_DESCR) {
            throw new StringAttributeTooLong('description chambres', __CLASS__);
        }
        $this->_descriptions_chambres[] = CheckTyper::isString($description_chambres, 
                'description chambres', __CLASS__);
    }
    
    /**
     * 
     * @return array[string]
     */
    public function getDescriptionsCharges() {
        return $this->_description_charges;
    }
    
    /**
     * 
     * @param array[string] $descriptions_charges
     * @throws BadTypeException
     * @throws KeyDontExistException
     * @throws StringAttributeTooLong
     */
    public function setDescriptionsCharges($descriptions_charges) {
        foreach ($descriptions_charges as $language => $titre) {
            if($this->languageExist($language) 
                    && strlen($titre) > self::MAX_SIZE_DESCR) {
                throw new StringAttributeTooLong('descriptions charges', __CLASS__);
            }
        }
        $this->_description_charges = CheckTyper::isArrayOfString($descriptions_charges,
                'descriptions charges', __CLASS__);    
    }
    
    /**
     * Retourne le titre de la maison dans la langue donnée 
     * @param string $language  Langue voulu
     * @return string
     * @throws KeyDontExistException
     */
    public function getDescriptionCharges($language) {
        if($this->languageExist($language)) {
            return $this->_description_charges[$language];
        }
    }
    
    /**
     * 
     * @param string $language
     * @param string $description_charges
     * @throws KeyDontExistException
     * @throws BadTypeException
     */
    public function addDescriptionCharges($language, $description_charges) {
        if($this->languageExist($language) && strlen($description_charges) > self::MAX_SIZE_DESCR) {
            throw new StringAttributeTooLong('description charges', __CLASS__);
        }
        $this->_description_charges[] = CheckTyper::isString($description_charges, 
                'description charges', __CLASS__);
    }
    
    /**
     * Verifie que la clé existe si oui retourne true. Sinon retour une erreur
     * du type KeyDontExistException
     * @param string $language
     * @return boolean
     * @throws KeyDontExistException
     */
    protected function languageExist($language) {
        if($language == self::LANGUAGE_EN || $language == self::LANGUAGE_FR 
                || $language == self::LANGUAGE_NE) { 
            return true;
        }
        throw new KeyDontExistException($language);
    }
//</editor-fold>
   
//<editor-fold defaultstate="collapsed" desc="Date">
    /**
     * 
     * @return DateTime
     */
    public function getDateCreation() {
        return $this->_date_creation;
    }
    
    /**
     * 
     * @param DateTime $date_creation
     * @throws BadTypeException
     */
    public function setDateCreation($date_creation) {
        $this->_date_creation = CheckTyper::isDateTime($date_creation, 
                'date creation', __CLASS__);
    }
    
    /**
     * 
     * @return DateTime
     */
    public function getDateModification() {
        return $this->_date_modification;
    }
    
    /**
     * 
     * @param DateTime $date_modification
     * @throws BadTypeException
     */
    public function setDateModification($date_modification) {
        $this->_date_modification = CheckTyper::isDateTime($date_modification,
                'date modification', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Coordonnees">
    /**
     * 
     * @return string
     */
    public function getAdresse() {
        return $this->_adresse;
    }
    
    /**
     * 
     * @param string $adresse
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setAdresse($adresse) {
        $_adresse = CheckTyper::isString($adresse, 'adresse', __CLASS__);
        
        if(strlen($_adresse) > self::MAX_SIZE_ADRESSE) {
            throw new StringAttributeTooLong('adresse', __CLASS__);
        }
        
        $this->_adresse = $adresse;
    }
    
    /**
     * 
     * @return Commune
     */
    public function getCommune() {
        return $this->_commune;
    }
    
    /**
     * 
     * @param Commune $commune
     * @throws BadTypeException
     */
    public function setCommune($commune) {
        $this->_commune = CheckTyper::isModel($commune, Commune::class, 
                'commune', __CLASS__);
    }
//</editor-fold>

//<editor-fold defaultstate="collapsed" desc="Autre informations">
    /**
     * 
     * @return Etat
     */
    public function getEtat() {
        return $this->_etat;
    }
    
    /**
     * 
     * @param Etat $etat
     * @throws BadTypeException
     */
    public function setEtat($etat) {
        $this->_etat = CheckTyper::isModel($etat, Etat::class, 'prix', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getPrix() {
        return $this->_prix;
    }
    
    /**
     * 
     * @param double $prix
     * @throws BadTypeException
     */
    public function setPrix($prix) {
        $this->_prix = CheckTyper::isDouble($prix, 'prix', __CLASS__);
    }
    
    /**
     * 
     * @return int
     */
    public function getSuperficeHabitable() {
        return $this->_superficie_habitable;
    }
    
    /**
     * 
     * @param int $superficie_habitable
     * @throws BadTypeException
     */
    public function setSuperficieHabitable($superficie_habitable) {
        $this->_superficie_habitable = CheckTyper::isInteger($superficie_habitable, 
                'superficie habitable', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getPrixMetreCarre() {
        if($this->getPrix() == NULL || $this->getSuperficeHabitable() == NULL 
                || $this->getSuperficeHabitable() == 0) {
            return 0;
        }
        
        return $this->getPrix() / $this->getSuperficeHabitable(); 
    }
    
    /**
     * 
     * @return int
     */
    public function getNbSalleDeBain() {
        return $this->_nb_salle_de_bain;
    }
    
    /**
     * 
     * @param int $nb_salle_de_bain
     * @throws BadTypeException
     */
    public function setNbSalleDeBain($nb_salle_de_bain) {
        $this->_nb_salle_de_bain = CheckTyper::isInteger($nb_salle_de_bain, 
                'nb salle de bain', __CLASS__);
    }
    
    /**
     * 
     * @return double
     */
    public function getCoutTravaux() {
        return $this->_cout_travaux;
    }
    
    /**
     * 
     * @param double $cout_travaux
     * @throws BadTypeException
     */
    public function setCoutTravaux($cout_travaux) {
        $this->_cout_travaux = CheckTyper::isInteger($cout_travaux, 
                'cout travaux', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Commentaires">
    /**
     * 
     * @return string
     */
    public function getCommentaire() {
        return $this->_commentaire;
    }
    
    /**
     * 
     * @param string $commentaire
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setCommentaire($commentaire) {
        $_commentaire = CheckTyper::isString($commentaire, 'commentaire', __CLASS__);
        
        if(strlen($_commentaire) > self::MAX_SIZE_COMMENTAIRE) {
            throw new StringAttributeTooLong('commentaire', __CLASS__);
        }
        
        $this->_commentaire = $commentaire;
    }
    
    /**
     * 
     * @return string
     */
    public function getRaisonAbandon() {
        return $this->_raison_abandon;
    }
    
    /**
     * 
     * @param string $raison_abandon
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setRaisonAbandon($raison_abandon) {
        $_raison_abandon = CheckTyper::isString($raison_abandon, 'raison abandon', __CLASS__);
        
        if(strlen($_raison_abandon) > self::MAX_SIZE_RAISON_ABANDON) {
            throw new StringAttributeTooLong('raison abandon', __CLASS__);
        }
        
        $this->_raison_abandon = $raison_abandon;
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Chambres">
    /**
     * 
     * @return array[Chambre]
     */
    public function getChambres() {
        return $this->_chambres;
    }
    
    /**
     * 
     * @param array[Chambre] $chambres
     * @throws BadTypeException
     */
    public function setChambres($chambres) {
        $this->_chambres = CheckTyper::isArrayOfModel($chambres, Chambre::class,
                'chambres', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return Chambre
     * @throws ReadOusideArrayException
     */
    public function getChambre($id) {
        if($id < count($this->_chambres)) {
            return $this->_chambres[$id];
        }
        
        throw new ReadOusideArrayException('chambre', __CLASS__);
    }
    
    /**
     * 
     * @param Chambre $chambre
     * @throws BadTypeException
     */
    public function addChambre($chambre) {
        $this->_chambres[] = CheckTyper::isModel($chambre, Chambre::class, 
                'chambre', __CLASS__);
    }
    
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="contacts">
    /**
     * 
     * @return array[Contact]
     */
    public function getContacts() {
        return $this->_contacts;
    }
    
    /**
     * 
     * @param array[Contact] $contacts
     * @throws BadTypeException
     */
    public function setContacts($contacts) {
        $this->_contacts = CheckTyper::isArrayOfModel($contacts, Contact::class,
                'contacts', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return Contact
     * @throws ReadOusideArrayException
     */
    public function getContact($id) {
        if($id < count($this->_contacts)) {
            return $this->_contacts[$id];
        }
        
        throw new ReadOusideArrayException('contact', __CLASS__);
    }
    
    /**
     * 
     * @param Contact $contact
     * @throws BadTypeException
     */
    public function addContact($contact) {
        $this->_contacts[] = CheckTyper::isModel($contact, Contact::class, 
                'contact', __CLASS__);
    }
//</editor-fold>
    
//<editor-fold defaultstate="collapsed" desc="Sources">
    /**
     * 
     * @return array[SourceMaison]
     */
    public function getSources() {
        return $this->_sources;
    }
    
    /**
     * 
     * @param array[SourceMaison] $sources
     * @throws BadTypeException
     */
    public function setSources($sources) {
        $this->_sources = CheckTyper::isArrayOfModel($sources, SourceMaison::class,
                'sources', __CLASS__);
    }
    
    /**
     * 
     * @param int $id index de la valeur dans le tableau
     * @return SourceMaison
     * @throws ReadOusideArrayException
     */
    public function getSource($id) {
        if($id < count($this->_sources)) {
            return $this->_sources[$id];
        }
        
        throw new ReadOusideArrayException('Sources', __CLASS__);
    }
    
    /**
     * 
     * @param SourceMaison $source
     * @throws BadTypeException
     */
    public function addSource($source) {
        $this->_sources[] = CheckTyper::isModel($source, SourceMaison::class, 
                'Source', __CLASS__);
    }
//</editor-fold>
}

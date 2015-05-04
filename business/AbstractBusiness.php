<?php
namespace DubInfo_gestion_immobilier\business;

use DubInfo_gestion_immobilier\data\AbstractDAO;
/**
 * Description of AbstractBusiness
 *
 * @author Jenicot Alexandre
 */
abstract class AbstractBusiness {
    const GENRE_MASCULIN = 'm';
    const GENRE_FEMININ = 'f';
    
    /**
     * La classe de la couche data pour les opérations dans la DB
     * @var AbstractDAO 
     */
    private $_Dao;
    
    /**
     * Le nom de l'objet à traiter
     * @var string 
     */
    private $_name_item;
    
    /**
     * Le genre de l'objet
     * @var string 
     */
    private $_Genre;
    
    /**
     * 
     * @param AbstractDAO $Dao
     * @param string $name_item
     * @param string $Genre
     */
    function __construct(AbstractDAO $Dao, $name_item = "objet", 
            $Genre = self::GENRE_MASCULIN) {
        $this->setDao($Dao);
        $this->setNameItem($name_item);
        $this->setGenre($Genre);
    }
    
    /**
     * Fonction qui retourne la liste des objets
     * @param int $data donnée envoyer avec la requête ajax. 
     * Peut ne pas être utilisé !
     * @return array[mixed]
     * @throws PDOException
     */
    public function readList($data = NULL) {
        return $this->getDao()->readList();
        }
        
    /**
     * Méthode qui interroge la couche data pour récuperer un objet grâce à son id
     * @param array[mixed] $data
     * @return mixed
     */
    public function read($data) {
        if(isset($data['id'])) {
            try {
                return $this->getDao()->read($data['id']);  
            } catch (Exception $ex) {
                $error = "Une erreur a été rencontrée lors de la lecture dans la base de données" ;
                return array('success' => false, 'error' => $error);
            }
              
        }
        
        if($this->getGenre() == self::GENRE_MASCULIN) {
            $error = "Aucun " . $this->getNameItem() . " n'a été reçu";
        } 
        else {
            $error = "Aucune " . $this->getNameItem() . " n'a été reçue";
        }
        return array('success' => false, 'error' => $error); 
    }
    
    /**
     * Méthode qui reçois les données d'un formulaire et le convertir en objet 
     * l'envoyer à la couche data pour une insert dans la DB
     * @param array[mixed] $data
     * @return array[mixed] données a retouner à l'utilisateur
     * @throws PDOException
     */
    public function add($data) {
        try {
            $object = $this->createObject($data);
       
            $this->getDao()->add($object);

            return array('success' => true, 
                'message' => $this->getMessage('ajouté'));
        } catch (Exception $ex) {
            $error = "Une erreur a été rencontrée lors de l'ajout dans la base de données" ;
            return array('success' => false, 'error' => $error); 
        }
    }
    
    /**
     * Méthode qui reçois les données d'un formulaire et le convertir en objet 
     * pour l'envoyer à la couche data pour une update
     * @param array[mixed] $data
     * @return array[mixed] données a retouner à l'utilisateur
     * @throws PDOException
     */
    public function edit($data) {
        try {
            $object = $this->createObject($data);
       
            $this->getDao()->update($object);
            
            return array('success' => true, 
                'message' => $this->getMessage('modifié'));
        } catch (Exception $ex) {
            $error = "Une erreur a été rencontrée lors de la modification dans la base de données" ;
            return array('success' => false, 'error' => $error); 
        }
    }
    
    /**
     * Méthode qui reçois les données d'un formulaire pour en extraire l'id et 
     * appeler la méthode de suppression d'un object dans la DB
     * @param array[mixed] $data
     * @return array[mixed]
     * @throws PDOException
     */
    public function delete($data) {
        if(isset($data['id'])) {
            try {
                $this->getDao()->delete($data['id']);  
                return array('success' => true, 
                    'message' => $this->getMessage('supprimé'));
            } catch (Exception $ex) {
                $error = "Une erreur a été rencontrée lors de la suppression dans la base de données" ;
                return array('success' => false, 'error' => $error);
            }
              
        }
        
        $error = "Aucun identifiant n'a été reçu.";
        return array('success' => false, 'error' => $error);
    }
    
    /**
     * Méthode permettant de créer l'object à l'aide d'un tableau de donnée
     * @param array[mixed] $data 
     */
    public abstract function createObject($data);

    /**
     * Retourne le message à envoyer au view pour l'utilisateur
     * @param string $verbe le verbe de la phrase
     * @return string
     */
    protected function getMessage($verbe) {
        if($this->getGenre() === self::GENRE_MASCULIN) {
            return "Le/l' " . $this->getNameItem() . " a été ". $verbe .
                    " avec succès.";
        } 
        else {
            return "La " . $this->getNameItem() . " a été ". $verbe . 
                    "e avec succès.";
        }
    }
    
    /**
     * 
     * @return AbstractDAO
     */
    protected function getDao() {
        return $this->_Dao;
    }

    /**
     * 
     * @return string
     */
    protected function getNameItem() {
        return $this->_name_item;
    }

    /**
     * 
     * @return string
     */
    protected function getGenre() {
        return $this->_Genre;
    }

    /**
     * 
     * @param AbstractDAO $Dao
     */
    protected function setDao(AbstractDAO $Dao) {
        $this->_Dao = $Dao;
    }

    /**
     * 
     * @param string $name_item
     */
    protected function setNameItem($name_item) {
        $this->_name_item = $name_item;
    }

    /**
     * 
     * @param string $Genre
     */
    protected function setGenre($Genre) {
        $this->_Genre = $Genre;
    }


}

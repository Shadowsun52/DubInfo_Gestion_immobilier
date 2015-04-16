<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Metier;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOMetier
 *
 * @author Jenicot Alexandre
 */
class DAOMetier extends AbstractDAO{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Fonction qui lit tous les metiers pour les mettres dans une listes
     * @return array[Metier]
     * @throws PDOException
     */
    public function readList() {
        try{
            $sql = "SELECT * FROM metier ORDER BY libelle";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $metiers[] = new Metier($result['id'], $result['libelle']);
            }
            return isset( $metiers) ?  $metiers : NULL;
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
    
    /**
     * Methode qui permet l'insertion d'un nouveau métier
     * @param string $libelle le libelle du métier
     * @throws PDOException
     */
    public function addMetier($libelle) {
        try {
            $sql = "INSERT INTO metier (libelle) VALUES (:libelle)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':libelle' => $libelle));
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }
}

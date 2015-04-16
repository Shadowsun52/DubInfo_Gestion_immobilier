<?php
namespace DubInfo_gestion_immobilier\data;
use DubInfo_gestion_immobilier\model\Professionnel;
use DubInfo_gestion_immobilier\model\Adresse;
use DubInfo_gestion_immobilier\model\Ville;
use DubInfo_gestion_immobilier\model\Metier;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOProfessionnel
 *
 * @author Jenicot Alexandre
 */
class DAOProfessionnel extends AbstractDAO{
    public function add($object) {
        
    }

    public function delete($id) {
        
    }

    public function read($id) {
        
    }

    /**
     * Fonction qui lit tous les professionnels pour les mettres dans une listes
     * Donc pas toute les informations, uniquement l'id, le nom et le prénom
     * @return array[Investisseur]
     * @throws PDOException
     */
    public function readList() {
        try{
            $sql = "SELECT id, nom, prenom FROM professionnel ORDER BY nom, prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $professionnel[] = new Investisseur($result['id'], 
                        $result['nom'], $result['prenom']);
            }
            return isset( $professionnel) ?  $professionnel : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        
    }

}

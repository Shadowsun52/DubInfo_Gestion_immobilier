<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\Chambre;
use DubInfo_gestion_immobilier\model\Maison;
use DateTime;
/**
 * Description of DAOChambre
 *
 * @author Jenicot Alexandre
 */
class DAOChambre extends AbstractDAO{
    public function add($object) {
        return ['erreur' => 'Ajout pas implémenté'];
    }

    public function delete($id) {
        return ['erreur' => 'Suppression pas implémentée'];
    }

    /**
     * Fonction qui retourne une chambre  par rapport à un id donné
     * @param int $id
     * @return Chambre
     * @throws PDOException
     */
    public function read($id) {
        try {
            $sql = "SELECT * FROM chambres_table WHERE id = :id";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            $result = $request->fetch();
            
            $maison = new Maison($result['propositions_table_id'], 
                    $result['maison_id']);

            //création de la date disponible
            $date = $this->readDate($result['date_disponibilite']);

            //création de la chambres
            $chambre = new Chambre($id, $result['numero'], $result['etage'], 
                    $result['prix'], $result['charges'], $date, 
                    $result['disponible'], $maison);

            return $chambre;
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    /**
     * Fonction qui lit tous les chambres d'une maison donné pour les mettres 
     * dans une listes
     * on récupere uniquement l'id et le numero, l'état et la disponibilité
     * @param int $id l'identifiant de la maison
     * @return array[Chambre]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            
            $sql = "SELECT id, numero, etage, disponible FROM chambres_table ct
                    WHERE propositions_table_id = :id ORDER BY numero";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(':id' => $id));
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $chambre = new Chambre($result['id'], $result['numero'], 
                        $result['etage']);
                $chambre->setDisponible($result['disponible']);
                $chambres[] = $chambre;
            }
            return isset( $chambres) ?  $chambres : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        return ['erreur' => 'Mise à jour pas implémentée'];
    }

    public function readAll() {
        return ['erreur' => 'readAll pas implémentée']; 
    }
}

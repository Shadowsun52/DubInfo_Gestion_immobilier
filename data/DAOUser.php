<?php
namespace DubInfo_gestion_immobilier\data;

use DubInfo_gestion_immobilier\model\User;
use DubInfo_gestion_immobilier\Exception\PDOException;
/**
 * Description of DAOUser
 *
 * @author Jenicot Alexandre
 */
class DAOUser extends AbstractDAO{
    public function add($object) {
        throw new Exception("Action pas implémentée");
    }

    public function delete($id) {
        throw new Exception("Action pas implémentée");
    }

    public function read($id) {
        throw new Exception("Action pas implémentée");
    }

    /**
     * Fonction qui lit tous les users pour les mettres dans une listes
     * on récupere uniquement l'id, le nom et le prénom
     * @param int $id NO USE
     * @return array[User]
     * @throws PDOException
     */
    public function readList($id = NULL) {
        try{
            //l'id 5 correspond à l'utilisateur admin
            $sql = "SELECT id, nom, prenom FROM users_table WHERE NOT id = 5
                    ORDER BY nom, prenom";
            $request = $this->getConnection()->prepare($sql);
            $request->execute();
            
            foreach ($request->fetchAll(\PDO::FETCH_ASSOC) as $result)
            {
                $users[] = new User($result['id'], $result['nom'], 
                        $result['prenom']);
            }
            return isset( $users) ?  $users : [];
            
        } catch (Exception $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    public function update($object) {
        throw new Exception("Action pas implémentée");
    }

    public function readAll() {
        return ['erreur' => 'readAll pas implémentée'];
    }
}

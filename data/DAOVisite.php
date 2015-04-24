<?php
namespace DubInfo_gestion_immobilier\data;
use DubInfo_gestion_immobilier\model\Visite;
/**
 * Description of DAOVisite
 *
 * @author Jenicot Alexandre
 */
abstract class DAOVisite extends AbstractDAO{
    /**
     * Méthode qui permet d'ajouter les participants à une visite
     * @param Visite $visite la visite à qui l'on doit ajouter les participants
     * @param string $table_name Le nom de la tableau ou est stocker la visite
     * @param string $field_name Le nom du champs contenant l'id de la visite
     * Par défault, il est le même que $table_name
     */
    protected function addParticipants($visite, $table_name, $field_name = NULL) {
        if($field_name == NULL) {
            $field_name = $table_name;
        }
        
        foreach ($visite->getParticipants() as $participant) {
            $sql = "INSERT INTO participation_" . $table_name ." (". $field_name .
                    "_id, users_table_id) VALUE(:visite, :participant)";
            $request = $this->getConnection()->prepare($sql);
            $request->execute(array(
                ':visite' => $visite->getId(),
                ':participant' => $participant->getId()));
        }
    }
    
    /**
     * Méthode qui supprime les participants d'une visite
     * @param int $id l'identifiant de la visite
     * @param string $table_name Le nom de la tableau ou est stocker la visite
     * @param string $field_name Le nom du champs contenant l'id de la visite
     */
    protected function deleteParticipants($id, $table_name, $field_name) {
        if($field_name == NULL) {
            $field_name = $table_name;
        }
        
        $sql = "DELETE FROM participation_" . $table_name . " WHERE " .
                $field_name . "_id = :id";
        $request = $this->getConnection()->prepare($sql);
        $request->execute(array(':id' => $id));
    }
}

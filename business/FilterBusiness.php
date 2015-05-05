<?php
namespace DubInfo_gestion_immobilier\business;

/**
 * Description of FilterBusiness
 *
 * @author Jenicot Alexandre
 */
abstract class FilterBusiness extends AbstractBusiness{
    /**
     * Fonction qui retourne la liste des objets pour un certain choix
     * @param int $data donnée envoyer avec la requête ajax
     * @return array[mixed]
     * @throws PDOException
     */
    public function readList($data = NULL) {
        return $this->getDao()->readList($data['id']);
    }
}

<?php
namespace DubInfo_gestion_immobilier\Exception;

use \Exception;
/**
 * Description of KeyDontExistException
 *
 * @author Jenicot Alexandre
 */
class KeyDontExistException extends Exception {
    public function __construct($key) {
        parent::__construct("La clé '" . $key . "' n'existe pas pour les tableaux de string", 0, NULL);
    }
}

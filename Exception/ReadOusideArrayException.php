<?php
namespace DubInfo_gestion_immobilier\Exception;

use \Exception;
/**
 * Description of ReadOusideArrayException
 *
 * @author Jenicot Alexandre
 */
class ReadOusideArrayException extends Exception{
    /**
     * @param string $table_name Nom du tableau que l'on a assez de lire
     * @param string $class_name Nom de la classe où se trouve le tableau
     */
    public function __construct($table_name, $class_name) {
        parent::__construct("Lecture en dehors du tableau : '" . $table_name .
                "' de la classe '" . $class_name . "'.", 0, NULL);
    }
}

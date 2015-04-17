<?php
namespace DubInfo_gestion_immobilier\Exception;

use \Exception;
/**
 * Description of ForeignKeyConstraintException
 *
 * @author Jenicot Alexandre
 */
class ForeignKeyConstraintException extends Exception{
    public function __construct($message) {
        parent::__construct("Suppression impossible: ".$message, 0, null);
    }
}

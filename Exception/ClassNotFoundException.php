<?php
namespace DubInfo_gestion_immobilier\Exception;

use \Exception;
/**
 * Description of ClassNotFoundException
 *
 * @author Alexandre
 */
class ClassNotFoundException extends Exception{
    public function __construct($class, $code = 0) {
        parent::__construct('la classe ' . $class . ' n\'existe pas', $code, NULL);
    }
}

<?php
namespace DubInfo_gestion_immobilier\Exception;

/**
 * Description of NomContactException
 *
 * @author Jenicot Alexandre
 */
class NomContactException extends \Exception{
    public function __construct($numero) {
        parent::__construct("Un nom est requis pour le contact " . $numero, 0, NULL);
    }
}

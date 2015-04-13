<?php
namespace DubInfo_gestion_immobilier\Exception;

use \Exception;
/**
 * Description of PDOException
 *
 * @author Jenicot Alexandre
 */
class PDOException extends Exception{
    private $_error_message;
    
    public function __construct($message) {
        parent::__construct("Erreur rencontrée lors de l'accès à la base de données", 0, NULL);
        $this->_setErrorMessage($message);
    }
    
    /**
     * Retourne le message d'erreur original 
     * @return string
     */
    public function getErrorMessage() {
        return $this->_error_message;
    }
    
    /**
     * 
     * @param string $error_message
     */
    private function _setErrorMessage($error_message) {
        $this->_error_message = $error_message;
    }


}

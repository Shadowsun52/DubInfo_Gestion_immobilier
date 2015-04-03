<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
/**
 * Description of User
 *
 * @author Jenicot Alexandre
 */
class User extends Person{
    const MAX_SIZE_LOGIN = 255;
    const MAX_SIZE_PASSWORD = 255;
    
    /**
     * @var string 
     */
    private $_login;
    
    /**
     * @var string 
     */
    private $_password;
    
    /**
     * @param type $id
     * @param type $nom
     * @param type $prenom
     * @param type $login
     * @param type $password
     * throws BadTypeException, StringAttributeTooLong
     */
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, 
            $login = NULL, $password = NULL) {
        parent::__construct($id, $nom, $prenom);
        $this->setLogin($login);
        $this->setPassword($password);
    }
    
    /**
     * 
     * @return string
     */
    public function getLogin() {
        return $this->_login;
    }
    
    /**
     * 
     * @param string $login
     * throws BadTypeException, StringAttributeTooLong
     */
    public function setLogin($login) {
        $_login = CheckTyper::isString($login, 'login', __CLASS__);
        
        if(strlen($_login) > self::MAX_SIZE_LOGIN) {
            throw new StringAttributeTooLong('login', __CLASS__);
        }
        
        $this->_login = $login;
    }
    
    /**
     * 
     * @return string
     */
    public function getPassword() {
        return $this->_password;
    }
    
    /**
     * 
     * @param string $password
     * throws BadTypeException, StringAttributeTooLong
     */
    public function setPassword($password) {
        $_password = CheckTyper::isString($password, 'password', __CLASS__);
        
        if(strlen($_password) > self::MAX_SIZE_PASSWORD) {
            throw new StringAttributeTooLong('password', __CLASS__);
        }
        
        $this->_password = $password;
    }
}

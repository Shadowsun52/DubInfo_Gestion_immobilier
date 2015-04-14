<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\StringAttributeTooLong;
use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of Adresse
 *
 * @author Jenicot Alexandre
 */
class Adresse {
    const MAX_SIZE_RUE = 70;
    const MAX_SIZE_NUMERO = 6;
    const MAX_SIZE_BOITE = 10;
    const MAX_SIZE_VILLE = 70;
    
    /**
     *
     * @var string
     */
    private $_rue;
    
    /**
     *
     * @var string
     */
    private $_numero;
    
    /**
     *
     * @var string 
     */
    private $_boite;
    
    /**
     *
     * @var Ville
     */
    private $_ville;
    
    /**
     * 
     * @param string $rue
     * @param string $numero
     * @param string $boite 
     * @param Ville $ville
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function __construct($rue = NULL, $numero = NULL, $boite = NULL, 
            $ville = NULL) {
        $this->setRue($rue);
        $this->setNumero($numero);
        $this->setBoite($boite);
        $this->setVille($ville);
    }
    
    /**
     * 
     * @return string
     */
    public function getRue() {
        return $this->_rue;
    }
    
    /**
     * 
     * @param string $rue
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setRue($rue) {
        $_rue = CheckTyper::isString($rue, 'rue', __CLASS__);
        
        if(strlen($_rue) > self::MAX_SIZE_RUE) {
            throw new StringAttributeTooLong('rue', __CLASS__);
        }
        
        $this->_rue = $_rue;
    }
    
    /**
     * 
     * @return string
     */
    public function getNumero() {
        return $this->_numero;
    }
    
    /**
     * 
     * @param string $numero
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setNumero($numero) {
        $_numero = CheckTyper::isString($numero, 'numero', __CLASS__);
        
        if(strlen($_numero) > self::MAX_SIZE_NUMERO) {
            throw new StringAttributeTooLong('numero', __CLASS__);
        }
        
        $this->_numero = $_numero;
    }
    
    /**
     * 
     * @return string
     */
    public function getBoite() {
        return $this->_boite;
    }
    
    /**
     * 
     * @param string $boite
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setBoite($boite) {
        $_boite = CheckTyper::isString($boite, 'boite', __CLASS__);
        
        if(strlen($_boite) > self::MAX_SIZE_BOITE) {
            throw new StringAttributeTooLong('boite', __CLASS__);
        }
        
        $this->_boite = $_boite;
    }
    
    /**
     * 
     * @return Ville
     */
    public function getVille() {
        return $this->_ville;
    }
    
    /**
     * 
     * @param Ville $ville
     * @throws BadTypeException
     * @throws StringAttributeTooLong
     */
    public function setVille($ville) {
        $this->_ville = CheckTyper::isModel($ville, Ville::class, 'ville', __CLASS__);
    }
}

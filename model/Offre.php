<?php
namespace DubInfo_gestion_immobilier\model;

use DubInfo_gestion_immobilier\Exception\BadTypeException;
/**
 * Description of Offre
 *
 * @author Jenicot Alexandre
 */
class Offre extends Proposition {
    
    /**
     * 
     * @param int $id
     * @param double $prix_achat
     * @param Etat $etat
     * @param Maison $maison
     * @param Investisseur $investisseur
     * @throws BadTypeException
     */
    public function __construct($id = NULL, $prix_achat = NULL, $etat = NULL, 
            $maison = NULL, $investisseur = NULL) {
        parent::__construct($id, $prix_achat, $etat, $maison, $investisseur);
    }
}

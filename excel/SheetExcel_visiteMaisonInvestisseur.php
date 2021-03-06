<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of SheetExcel_visiteMaisonInvestisseur
 *
 * @author Jenicot Alexandre
 */
class SheetExcel_visiteMaisonInvestisseur extends SheetExcel{
    
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected function setColWidth() {
        $col = self::FIRST_COL;
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(30);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(45);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['Nom', 'Etat', 'Maison', 'Date visite', 'Rapport'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des visites de maison par un investisseur';
    }
}

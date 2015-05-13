<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of SheetExcel_maison
 *
 * @author Jenicot Alexandre
 */
class SheetExcel_maison extends SheetExcel{
    
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected function setColWidth() {
        $col = self::FIRST_COL;
        $this->getSheet()->getColumnDimension($col++)->setWidth(30);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(30);
        $this->getSheet()->getColumnDimension($col++)->setWidth(5);
        $this->getSheet()->getColumnDimension($col++)->setWidth(15);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(45);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['Titre', 'Etat', 'Rue', 'N°', 'Commune', 'Contact', 
            'Prix annoncé', 'Prix conseillé', 'Prix m²', 'Coüt travaux', 
            'coüt total', 'Nombre de chambres', 'Nombre de salles de bain', 
            'Rendement', 'Localisation', 'Localisation indice', 'Qualité', 
            'Qualité indice', 'Remarques'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des maisons';
    }
}

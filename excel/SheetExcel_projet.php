<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of SheetExcel_projet
 *
 * @author Jenicot Alexandre
 */
class SheetExcel_projet extends SheetExcel{
    
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected function setColWidth() {
        $col = self::FIRST_COL;
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(30);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(45);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['Nom', 'Etat', 'Maison', 'Date compromis', 'Date acte', 
            'Plan métré', 'Devis entrepreneur', 'Sélection des matériaux', 
            'Remarques'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des projets';
    }
}

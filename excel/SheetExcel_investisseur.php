<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of SheetExcel_investisseur
 *
 * @author Jenicot Alexandre
 */
class SheetExcel_investisseur extends SheetExcel{
    
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected function setColWidth() {
        $col = self::FIRST_COL;
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(20);
        $this->getSheet()->getColumnDimension($col++)->setWidth(15);
        $this->getSheet()->getColumnDimension($col++)->setWidth(15);
        $this->getSheet()->getColumnDimension($col++)->setWidth(35);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(45);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['Nom', 'Etat', 'Téléphone', 'Gsm', 'Mail', 'Budget', 'Remarques'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des investisseurs';
    }
}

<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of SheetExcel_chambre
 *
 * @author Jenicot Alexandre
 */
class SheetExcel_chambre extends SheetExcel{
    
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected function setColWidth() {
        $col = self::FIRST_COL;
        $this->getSheet()->getColumnDimension($col++)->setWidth(30);
        $this->getSheet()->getColumnDimension($col++)->setWidth(12);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(10);
        $this->getSheet()->getColumnDimension($col++)->setWidth(15);
        $this->getSheet()->getColumnDimension($col++)->setWidth(45);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['Maison', 'Chambre', 'Prix', 'Charges', 'Prix avec charges', 'Remarques'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des locataires';
    }
}

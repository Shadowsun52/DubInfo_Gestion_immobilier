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
        $this->getSheet()->getColumnDimension('A')->setWidth(20);
        $this->getSheet()->getColumnDimension('B')->setWidth(20);
        $this->getSheet()->getColumnDimension('C')->setWidth(15);
        $this->getSheet()->getColumnDimension('D')->setWidth(15);
        $this->getSheet()->getColumnDimension('E')->setWidth(35);
        $this->getSheet()->getColumnDimension('F')->setWidth(10);
        $this->getSheet()->getColumnDimension('G')->setWidth(45);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['nom', 'Etat', 'Téléphone', 'Gsm', 'Mail', 'Budget', 'Remarques'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des investisseurs';
    }
}

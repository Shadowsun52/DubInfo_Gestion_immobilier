<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of SheetExcel_rencontreInvestisseur
 *
 * @author Jenicot Alexandre
 */
class SheetExcel_rencontreInvestisseur extends SheetExcel{
    
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected function setColWidth() {
        $this->getSheet()->getColumnDimension('A')->setWidth(20);
        $this->getSheet()->getColumnDimension('B')->setWidth(20);
        $this->getSheet()->getColumnDimension('C')->setWidth(20);
        $this->getSheet()->getColumnDimension('D')->setWidth(10);
        $this->getSheet()->getColumnDimension('E')->setWidth(45);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['Nom', 'Etat', 'Date rencontre', 'Budget', 'Rapport'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des rencontres avec un investisseur';
    }
    
}

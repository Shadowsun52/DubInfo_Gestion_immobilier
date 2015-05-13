<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of SheetExcel_location
 *
 * @author Jenicot Alexandre
 */
class SheetExcel_location extends SheetExcel{
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected function setColWidth() {
        $this->getSheet()->getColumnDimension('A')->setWidth(20);
        $this->getSheet()->getColumnDimension('B')->setWidth(30);
        $this->getSheet()->getColumnDimension('C')->setWidth(12);
        $this->getSheet()->getColumnDimension('D')->setWidth(10);
        $this->getSheet()->getColumnDimension('E')->setWidth(10);
        $this->getSheet()->getColumnDimension('F')->setWidth(10);
        $this->getSheet()->getColumnDimension('G')->setWidth(15);
        $this->getSheet()->getColumnDimension('H')->setWidth(15);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['Locataire', 'Maison', 'Chambre', 'Bail', 'Etat des lieux', 
            'Charte', 'Garantie à payer', 'Garantie payée'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des locations';
    }
}

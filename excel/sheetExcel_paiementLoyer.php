<?php
namespace DubInfo_gestion_immobilier\excel;

/**
 * Description of sheetExcel_paiementLoyer
 *
 * @author Jenicot Alexandre
 */
class sheetExcel_paiementLoyer extends SheetExcel{
    
    /**
     * Méthode pour définir la taille des colonnes
     */
    protected function setColWidth() {
        $this->getSheet()->getColumnDimension('A')->setWidth(30);
        $this->getSheet()->getColumnDimension('B')->setWidth(15);
        $this->getSheet()->getColumnDimension('C')->setWidth(20);
        $this->getSheet()->getColumnDimension('D')->setWidth(10);
        $this->getSheet()->getColumnDimension('E')->setWidth(10);
        $this->getSheet()->getColumnDimension('F')->setWidth(10);
        $this->getSheet()->getColumnDimension('G')->setWidth(10);
    }

    /**
     * Fonction qui retourne le nom des colonnes de la table
     * @return array[string]
     */
    public function getNameColumns() {
        return ['Maison', 'Chambre', 'Locataire', 'Loyer', 'Loyer payé', 'Mois', 
            'Année'];
    }

    /**
     * Fonction qui retourne la partie personnalisé du titre du document
     * @return string 
     */
    public function getDocTitle() {
        return 'Liste des paiements de loyer';
    }
}

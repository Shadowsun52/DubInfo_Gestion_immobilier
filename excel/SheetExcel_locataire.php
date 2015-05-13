<?php
namespace DubInfo_gestion_immobilier\excel;
use DateTime;
/**
 * Description of SheetExcel_locataire
 *
 * @author Jenicot Alexandre
 */
class SheetExcel_locataire extends SheetExcel{
    protected function setColWidth() {
        
    }

    protected function writeDataTable() {
        
    }

    protected function writeHeaderTable() {
        
    }

    /**
     * 
     * @return string Nom de la feuille excel
     */
    public function getSheetName() {
        return "liste_locataires";
    }

    /**
     * Ecrit le nom du document dans le fichier excel
     */
    protected function writeTitle() {
        $today = new DateTime();
        $title = "Liste des locataires générée le " . $today->format('d/m/Y');
        $this->setStyleTitle();
        $this->getSheet()->setCellValue(
                'A'.$this->moveCurrentLine(self::SPACE_WITH_TITLE),$title);
    }

}
